<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\ItemModel;
use App\Models\PaymentModel;

class Sales extends BaseController
{
    private string $errorText = 'Error: ';
    private \App\Services\SaleService $saleService;

    public function __construct()
    {
        $this->saleService = new \App\Services\SaleService();
    }

    public function index()
    {
        $data['title'] = "Sales List";
        $sale = new SaleModel();
        $data['allSales'] = $sale->findAll();
        $data['CSales'] = $sale->countAllResults();

        return view('sales/saleslist', $data);
    }


    public function newSale()
    {
        $product = new ProductModel();
        $data['product'] = $product->getAllProducts();
        $session = session();
        $sys = new Sys();
        $getTime = $sys->getTime();
        $saleId =  $sys->generateString();
        $saleDate =  $getTime['date'];
        $saleTime =  $getTime['time'];

        $logDesc = "New sale (" . $saleId . ") initiated by " . $session->get('user_name') . " on " . $saleDate . " " . $saleTime;
        $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);

        // redirect()->to('/html/sales-new.html/' . $saleId);

        $data['saleId'] = $saleId;
        $data['title'] = "Sale : " . $saleId;

        $customer = new \App\Models\CustomerModel();
        $data['customers'] = $customer->getCustomers();

        $shiftModel = new \App\Models\ShiftModel();
        $data['activeShift'] = $shiftModel->getActiveShift(session()->get('user_id'));

        return view('sales/place_order', $data);
    }

    public function saveNewSale()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];
        $sys = new Sys();
        $getTime = $sys->getTime();
        $saleDate =  $getTime['date'];
        $saleTime =  $getTime['time'];

        try {
            $items = (array)$this->request->getVar('items');
            $quantities = (array)$this->request->getVar('quantities');
            $sale_reference = $this->request->getVar('txtSaleId');
            
            $itemsList = [];
            for ($i = 0; $i < count($items); $i++) {
                $itemsList[] = [
                    'sku' => $items[$i],
                    'quantity' => $quantities[$i]
                ];
            }

            $customer_id = $this->request->getVar('txtCustomerId');
            $discount_amount = (float)$this->request->getVar('txtDiscountAmount');
            $discount_type = $this->request->getVar('txtDiscountType') ?: 'Fixed';

            $result = $this->saleService->processNewSaleData(
                $sale_reference, 
                $itemsList, 
                session()->get('user_id'),
                $saleDate,
                $saleTime,
                $customer_id ? (int)$customer_id : null,
                $discount_amount,
                $discount_type
            );

            if ($result['status'] === true) {
                $data['status'] = 1;
                $data['message'] = $result['message'];
            } else {
                throw new \Exception($result['message']);
            }
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Sales::saveNewSale', $th->getMessage());
        }

        return $this->response->setJSON($data);
    }



    public function sale($saleId)
    {
        $s = new SaleModel();
        $saleData = $s->findSaleByID($saleId);

        if (!$saleData) {
            return redirect()->to('/html/sales-list.html')->with('error', 'Sale not found.');
        }

        $realSaleId = $saleData['id'];
        $data['sale'] = $saleData;
        $data['saleId'] = $saleId;
        $data['title'] = "Sale:" . $saleId;

        $product = new ProductModel();
        $data['product'] = $product->where('stock >', 0)->findAll();

        $itemModel = new ItemModel();
        $data['item'] = $itemModel->where('sale_id', $realSaleId)->findAll();

        $tP = $itemModel->where('sale_id', $realSaleId)->selectSum('total_price', 'TotalPrice')->first();
        $tQ = $itemModel->where('sale_id', $realSaleId)->selectSum('quantity', 'TotalQ')->first();
        $data['itemsN'] = $itemModel->where('sale_id', $realSaleId)->countAllResults();

        $checkpayment = new PaymentModel();
        $data['payment'] = $checkpayment->where('sale_id', $realSaleId)->findAll();

        if (empty($data['payment'])) {
            $data['Payment'] = 0;
        } else {
            $tPc = $checkpayment->where('sale_id', $realSaleId)->selectSum('amount', 'total_payment')->first();
            $data['Payment'] = $tPc['total_payment'];
        }

        if (empty($data['item'])) {
            $data['totalPrice'] = 0;
            $data['totalQuantity'] = 0;
        } else {
            $data['totalPrice'] = $tP['TotalPrice'];
            $data['totalQuantity'] = $tQ['TotalQ'];
        }

        return view('sales/sales_details', $data);
    }


    public function addCart()
    {
        $product_sku = $this->request->getVar('txtItem');
        $quantity = (float)$this->request->getVar('txtQuantity');
        $sale_reference = $this->request->getVar('txtSaleId');
        
        $result = $this->saleService->addItemToCart($product_sku, $quantity, $sale_reference, session()->get('user_id'));

        if ($result['status'] === true) {
            $sys = new Sys();
            $logDesc = "Item " . $result['product_name'] . " added to cart " . $sale_reference . " by " . session()->get('user_name') . " on " . $sys->getCurrentDate() . " " . $sys->getCurrentTime();
            $sys->addLog(session()->get('session_iddata'), session()->get('user_id'), "Create", $logDesc);
            
            return $this->response->setJSON(["status" => 1, 'data' => $result['message']]);
        } else {
            return $this->response->setJSON(["status" => 0, 'data' => $result['message']]);
        }
    }

    public function addSaleItem($salesId)
    {
        $saleModel = new SaleModel();
        $fsale = $saleModel->findSaleByID($salesId);

        if (!$fsale) {
            echo json_encode(array("status" => 0, 'data' => "Sale with Id/Ref (" . $salesId . ") not found."));
        } else {
            echo json_encode(array("status" => true, 'data' => $fsale));
        }
    }

    public function getItem($itemsaleid)
    {
        $fitem = new ItemModel();
        $cartitem = $fitem->where('id', $itemsaleid)->first();
        echo json_encode(array("status" => true, 'data' => $cartitem));
    }

    public function quantityChange()
    {
        $itemsaleid = (int)$this->request->getVar('txtItemSaleId');
        $quantityToAdd = (float)$this->request->getVar('txtQD');

        $result = $this->saleService->updateItemQuantity($itemsaleid, $quantityToAdd);

        if ($result['status'] === true) {
            $sys = new Sys();
            $logDesc = "Quantity of Item " . $result['product_name'] . " updated on sale " . $result['sale_id'] . " by " . session()->get('user_name') . " on " . $sys->getCurrentDate() . " " . $sys->getCurrentTime();
            $sys->addLog(session()->get('session_iddata'), session()->get('user_id'), "Update", $logDesc);
            
            return $this->response->setJSON(["status" => 1, 'data' => $result['message']]);
        } else {
            return $this->response->setJSON(["status" => 0, 'data' => $result['message']]);
        }
    }

    public function removeItem($itemId)
    {
        $result = $this->saleService->removeItemFromCart((int)$itemId);

        if ($result['status'] === true) {
            $sys = new Sys();
            $logDesc = "Item " . $result['product_name'] . " removed in sale " . $result['sale_id'] . " by " . session()->get('user_name') . " on " . $sys->getCurrentDate() . " " . $sys->getCurrentTime();
            $sys->addLog(session()->get('session_iddata'), session()->get('user_id'), "Delete", $logDesc);
            
            return $this->response->setJSON(["status" => 1, 'data' => ["message" => $result['message']]]);
        } else {
            return $this->response->setJSON(["status" => 0, 'data' => ["message" => $result['message']]]);
        }
    }

    public function getPayment($saleId)
    {
        $s = new SaleModel();
        $saleDataRow = $s->findSaleByID($saleId);
        if (!$saleDataRow) {
            return $this->response->setJSON(["status" => 0, 'data' => 'Sale not found']);
        }
        $realSaleId = $saleDataRow['id'];
        
        $checkpayment = new PaymentModel();
        $tPc = $checkpayment->where('sale_id', $realSaleId)->selectSum('amount')->first();
        $paymentAmount = $tPc['amount'] ?? 0;
        
        $s->update($realSaleId, ['sale_status' => "Payment Initiated"]);
        
        $item = new ItemModel();
        $tP = $item->where('sale_id', $realSaleId)->selectSum('total_price')->first();
        $expectedTotalPrice = (float)($tP['total_price'] ?? 0);
        $paymentAmount = (float)$paymentAmount;
        
        $remaining = $expectedTotalPrice - $paymentAmount;
        $message = "Do you want to recieve a remaining payment of Ksh {$remaining} Where a total payment of Ksh {$paymentAmount} was done for a expected price of Ksh{$expectedTotalPrice}?";
        return $this->response->setJSON(["status" => 1, 'data' => $message]);
    }

    public function addPayment()
    {
        $saleId = $this->request->getVar('txtSaleId'); // sale_reference
        $currentPayment = (float)$this->request->getVar('txtAmount');
        $transactionType = $this->request->getVar('txtTT');
        
        $sys = new Sys();
        $getTime = $sys->getTime();
        $transactionId = $getTime['ts'];
        $transactionDate = $getTime['date'];
        $transactionTime = $getTime['time'];
        
        $userId = session()->get('user_id');
        $shiftModel = new \App\Models\ShiftModel();
        $activeShift = $shiftModel->getActiveShift($userId);
        $shiftId = $activeShift ? $activeShift['id'] : null;

        $result = $this->saleService->addPayment($saleId, $currentPayment, $transactionType, $transactionId, $userId, $transactionDate, $transactionTime, $shiftId);

        if ($result['status'] > 0) {
            $ntransactionID = substr($transactionType, 0, 1) . $transactionId;
            $logDesc = "Payment " . $ntransactionID . " by " . $transactionType . " payment mode added to sale by " . session()->get('user_name') . " on " . $transactionDate . " " . $transactionTime;
            $sys->addLog(session()->get('session_iddata'), session()->get('user_id'), "Create", $logDesc);
            
            return $this->response->setJSON(["status" => $result['status'], 'data' => ['message' => $result['message'], 'toPay' => $result['toPay']]]);
        } else {
            return $this->response->setJSON(["status" => 0, 'data' => ['message' => $result['message']]]);
        }
    }


    public function printReceipt($saleId)
    {
        $saleModel = new SaleModel();
        $sale = $saleModel->findSaleByID($saleId);

        if (!$sale) {
            return "Sale not found.";
        }

        $realSaleId = $sale['id'];
        $data['sale'] = $sale;
        $data['saleId'] = $saleId;
        $data['title'] = "Receipt: " . $saleId;

        $itemModel = new \App\Models\ItemModel();
        $data['items'] = $itemModel->where('sale_id', $realSaleId)->findAll();

        $paymentModel = new \App\Models\PaymentModel();
        $data['payments'] = $paymentModel->where('sale_id', $realSaleId)->findAll();
        
        $totalPaid = $paymentModel->where('sale_id', $realSaleId)->selectSum('amount')->first();
        $data['totalPaid'] = (float)($totalPaid['amount'] ?? 0);

        $userModel = new \App\Models\UserModel();
        $data['cashier'] = $userModel->findUserById($sale['createdBy']);

        $customerModel = new \App\Models\CustomerModel();
        $data['customer'] = $sale['customer_id'] ? $customerModel->find($sale['customer_id']) : null;

        return view('sales/receipt_print', $data);
    }


    // logs all throwables and exeptions in this class
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
