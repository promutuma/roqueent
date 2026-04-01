<?php

namespace App\Controllers;

use App\Models\RefundModel;
use App\Models\SaleModel;
use App\Models\ItemModel;
use App\Models\ProductModel;

class Refund extends BaseController
{
    private string $errorText = 'Error: ';

    public function processRefund()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
        ];

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $saleId = $this->request->getVar('txtSaleId');
            $reason = $this->request->getVar('txtReason');
            $session = session();
            $sys = new Sys();

            $saleModel = new SaleModel();
            $sale = $saleModel->find($saleId);

            if (!$sale) {
                throw new \Exception("Sale not found.");
            }

            if ($sale['is_voided']) {
                throw new \Exception("This sale has already been refunded/voided.");
            }

            // 1. Mark sale as voided
            $saleModel->update($saleId, [
                'is_voided' => 1,
                'void_reason' => $reason,
                'sale_status' => 'Refunded'
            ]);

            // 2. Add refund record
            $refundModel = new RefundModel();
            $getTime = $sys->getTime();
            $refundModel->insert([
                'sale_id' => $saleId,
                'refund_amount' => $sale['paid_amount'],
                'reason' => $reason,
                'refund_date' => $getTime['date'],
                'refund_time' => $getTime['time'],
                'createdBy' => $session->get('user_id')
            ]);

            // 3. Revert stock
            $itemModel = new ItemModel();
            $items = $itemModel->where('sale_id', $saleId)->findAll();
            $productModel = new ProductModel();

            foreach ($items as $item) {
                if ($item['product_id']) {
                    $product = $productModel->find($item['product_id']);
                    if ($product) {
                        $productModel->update($product['id'], [
                            'stock' => $product['stock'] + $item['quantity']
                        ]);
                    }
                }
            }

            // 4. Log activity
            $logDesc = "Sale #" . $sale['sale_reference'] . " refunded by " . $session->get('user_name') . ". Reason: " . $reason;
            $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Update", $logDesc);

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception("Database transaction failed.");
            }

            $data['status'] = 1;
            $data['message'] = "Sale refunded successfully. Stock has been reverted.";

        } catch (\Throwable $th) {
            $db->transRollback();
            $data['message'] = $this->errorText . $th->getMessage();
        }

        return $this->response->setJSON($data);
    }
}
