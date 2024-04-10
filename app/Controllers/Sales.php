<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\ItemModel;
use App\Models\PaymentModel;

class Sales extends BaseController
{
    private string $errorText = 'Error: ';

    public function index()
    {
        $data['title'] = "Sales List";
        $sale = new SaleModel();
        $data['allSales'] = $sale->findAll();
        $data['CSales'] = $sale->select('sum(sale_id) as TotalQ')->countAllResults();

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
        $product = new ProductModel();
        $sale = new SaleModel();
        $itmData = new ItemModel();

        try {
            $items = $this->request->getVar('items');
            $quantities = $this->request->getVar('quantities');
            $sale_id = $this->request->getVar('txtSaleId');
            $sale_total = 0;

            for ($i = 0; $i < count($items); $i++) {
                $itemId = $items[$i];
                $quantity = $quantities[$i];

                $productdata = $product->getProductBySKU($itemId);


                if (!empty($productdata)) {

                    $stock = $productdata['stock'];
                    $sale_price = $productdata['sale_price'];
                    $total_price = $quantity * $sale_price;
                    $remainingstock = $stock - $quantity;

                    $totalBuyingP = $productdata['regular_price'] * $quantity;
                    $profit = $total_price - $totalBuyingP;

                    $saledata = [
                        'item_sale_id' => $itemId . $sale_id . $i,
                        'product_sku' => $itemId,
                        'product_name' => $productdata['product_name'],
                        'sale_id' => $sale_id,
                        'quantity' => $quantity,
                        'total_buying_price' => $totalBuyingP,
                        'total_profit' => $profit,
                        'price_per_unit' => $productdata['sale_price'],
                        'total_price' => $total_price
                    ];
                    if ($quantity > $stock) {
                        throw new \Exception($productdata['product_name'] . ' Stock is ' . $stock . ' below the selected quantity of ' . $quantity);
                    }

                    // outputs
                    $sale_total += $total_price;
                    $sproductdata = [
                        'stock' => $remainingstock
                    ];
                    $pr_products[] = [
                        'id' => $itemId,
                        'data' => $sproductdata,
                        'itms_data' => $saledata
                    ];
                }
            }
            $p = [
                'pr' => $pr_products
            ];

            $data['data'] = $p;

            // save sale data
            $saleData = [
                'sale_id' => $sale_id,
                'sale_date' => $saleDate,
                'sale_time' => $saleTime,
                'sale_status' => "Payment Initiated",
                'createdBy' => session()->get('user_id'),
                'amount' => $sale_total
            ];

            $sale->addSale($saleData);

            foreach ($pr_products as $p) {
                // save the item data
                $itmData->addItem($p['itms_data']);

                // update the products table
                $product->updateProduct($p['id'], $p['data']);
            }

            $data['status'] = 1;
            $data['message'] = "Order saved and processed successfully. You will be directed to payment and procesing page";
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Expense::saveNewSale', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }



    public function sale($saleId)
    {

        $data['saleId'] = $saleId;
        $data['title'] = "Sale:" . $saleId;
        $product = new ProductModel();
        $data['product'] = $product->where('stock >', 0)->findAll();
        $item = new ItemModel();
        $item->where('sale_id', $saleId);
        $data['item'] = $item->findAll();
        $tP = $item->where('sale_id', $saleId)->select('sum(total_price) as TotalPrice')->first();
        $tQ = $item->where('sale_id', $saleId)->select('sum(quantity) as TotalQ')->first();
        $data['itemsN'] =  $item->where('sale_id', $saleId)->select('sum(quantity) as TotalQ')->countAllResults();

        $checkpayment = new PaymentModel();
        $checkpayment->where('sale_id', $saleId);

        $data['payment'] = $checkpayment->findAll();
        $s = new SaleModel();
        $data['sale'] = $s->findSaleByID($saleId);
        $tPc = $checkpayment->where('sale_id', $saleId)->select('sum(amount) as total_payment')->first();
        if (empty($data['payment'])) {
            $data['Payment'] = 0;
        } else {
            $data['Payment'] = $tPc['total_payment'];
        }

        if (empty($data['item'])) {
            $data['totalPrice'] = 0;
        } else {
            $data['totalPrice'] = $tP['TotalPrice'];
        }

        if (empty($data['item'])) {
            $data['totalQuantity'] = 0;
        } else {
            $data['totalQuantity'] = $tQ['TotalQ'];
        }

        return view('sales/sales_details', $data);
    }


    public function addCart()
    {
        $product = new ProductModel();
        $item = new ItemModel();
        $fitem = new ItemModel();
        $session = session();

        $sys = new Sys();
        $getTime = $sys->getTime();

        $Date =  $getTime['date'];
        $Time =  $getTime['time'];

        $product_sku = $this->request->getVar('txtItem');
        $quantity = $this->request->getVar('txtQuantity');
        $sale_id = $this->request->getVar('txtSaleId');
        $cartitem = $fitem->where('item_sale_id', $product_sku . $sale_id)->first();
        if ($cartitem == null) {
            # code...
            $productdata = $product->where('product_sku', $product_sku)->first();
            $stock = $productdata['stock'];
            if ($stock < $quantity) {
                echo json_encode(array("status" => 0, 'data' => "The quantity selected of " . $quantity . " items exceeds the available Stock of " . $stock . " units"));
            } else {
                if ($quantity == 0) {
                    echo json_encode(array("status" => 0, 'data' => 'Sorry you cannot select null/zero quantity'));
                } else {
                    $sale_price = $productdata['sale_price'];
                    $total_price = $quantity * $sale_price;
                    $remainingstock = $stock - $quantity;
                    $totalBuyingP = $productdata['regular_price'] * $quantity;
                    $profit = $total_price - $totalBuyingP;

                    $saledata = [
                        'item_sale_id' => $product_sku . $sale_id,
                        'product_sku' => $product_sku,
                        'product_name' => $productdata['product_name'],
                        'sale_id' => $sale_id,
                        'quantity' => $quantity,
                        'total_buying_price' => $totalBuyingP,
                        'total_profit' => $profit,
                        'price_per_unit' => $productdata['sale_price'],
                        'total_price' => $total_price
                    ];

                    $sproductdata = [
                        'stock' => $remainingstock
                    ];

                    $item->save($saledata);
                    if ($item == false) {
                        echo json_encode(array("status" => 0, 'data' => 'An error occured when trying to add the Items'));
                    } else {
                        $updateproduct = new ProductModel();
                        $updateproduct->where('product_sku', $product_sku);
                        $updateproduct->set($sproductdata);
                        $updateproduct->update();
                        if ($updateproduct == false) {
                            echo json_encode(array("status" => 0, 'data' => 'An error occured when trying to add the Items, Item already added into cart do not resubmit'));
                        } else {
                            $item = new ItemModel();
                            $item->where('sale_id', $sale_id);
                            $data['item'] = $item->findAll();
                            $tP = $item->where('sale_id', $sale_id)->select('sum(total_price) as TotalPrice')->first();
                            $totalP = $tP['TotalPrice'];
                            $sts = 'IA, Pending Payment';

                            $saleData = [
                                'amount' => $totalP,
                                'sale_status' => $sts,
                            ];

                            $sale = new SaleModel();
                            $sale->where('sale_id', $sale_id);
                            $sale->set($saleData);
                            $sale->update();

                            if ($sale == false) {
                                echo json_encode(array("status" => 0, 'data' => 'Error occured when trying to add total amount. Please do not re-add the item'));
                            } else {
                                $logDesc = "Item " . $productdata['product_name'] . " added to cart " . $sale_id . " by " . $session->get('user_name') . " on " . $Date . " " . $Time;
                                $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);
                                echo json_encode(array("status" => 1, 'data' => $productdata['product_name'] . ' added to Cart with a Total Price of ' . $total_price . '. With ultimate total price of Ksh' . $totalP));
                            }
                        }
                    }
                }
            }
        } else {
            # code...
            echo json_encode(array("status" => 0, 'data' => 'Duplicate entry please add another item or close SELECT ITEM dialogue and add quatity on the item where it appears on the NEW SALE page'));
        }
    }

    public function addSaleItem($salesId)
    {
        $sale = new SaleModel();
        $sale->where('sale_id', $salesId);
        $fsale = $sale->first();

        if ($fsale < 1) {
            echo json_encode(array("status" => 0, 'data' => "Sale with Id (" . $salesId . ") not found."));
        } else {
            echo json_encode(array("status" => true, 'data' => $fsale));
        }
    }

    public function getItem($itemsaleid)
    {
        $fitem = new ItemModel();
        $cartitem = $fitem->where('item_sale_id', $itemsaleid)->first();
        echo json_encode(array("status" => true, 'data' => $cartitem));
    }

    public function quantityChange()
    {
        $session = session();

        $sys = new Sys();
        $getTime = $sys->getTime();

        $Date =  $getTime['date'];
        $Time =  $getTime['time'];
        $itemsaleid = $this->request->getVar('txtItemSaleId');
        $fitem = new ItemModel();
        $Qitem = $fitem->where('item_sale_id', $itemsaleid)->first();
        $sale_id = $Qitem['sale_id'];
        $quantityToadd = $this->request->getVar('txtQD');
        $previousQuantity = $Qitem['quantity'];
        $newQuantity = $previousQuantity + $quantityToadd;
        $product_sku = $Qitem['product_sku'];
        $product = new ProductModel();
        $IProduct = $product->where('product_sku', $product_sku)->first();
        $availableStock = $IProduct['stock'];
        $total_price = $IProduct['sale_price'] * $newQuantity;
        $total_buying_price = $IProduct['regular_price'] * $newQuantity;
        $newStock = $availableStock - $quantityToadd;
        if ($availableStock >= $quantityToadd) {

            if ($newQuantity < 1) {
                # code...
                echo json_encode(array("status" => 0, 'data' => 'Sorry The Updated Quantity cannot be below 1. Please use the remove button to remove the item.'));
            } else {
                # code...
                $itemData = [
                    'quantity' => $newQuantity,
                    'price_per_unit' => $IProduct['sale_price'],
                    'total_price' => $total_price,
                    'total_buying_price' => $total_buying_price,
                    'total_profit' => $total_price - $total_buying_price,
                ];
                $productData = [
                    'stock' => $newStock,
                ];
                $updateproduct = new ProductModel();
                $updateitem = new ItemModel();
                $updateproduct->where('product_sku', $product_sku);
                $updateproduct->set($productData);
                $updateproduct->update();

                $updateitem->where('item_sale_id', $itemsaleid);
                $updateitem->set($itemData);
                $updateitem->update();

                $item = new ItemModel();
                $item->where('sale_id', $sale_id);
                $data['item'] = $item->findAll();
                $tP = $item->where('sale_id', $sale_id)->select('sum(total_price) as TotalPrice')->first();
                $totalP = $tP['TotalPrice'];
                $sts = 'IU, Pending Payment';

                $saleData = [
                    'amount' => $totalP,
                    'sale_status' => $sts,
                ];

                $sale = new SaleModel();
                $sale->where('sale_id', $sale_id);
                $sale->set($saleData);
                $sale->update();


                if ($updateitem == false || $updateproduct == false) {
                    echo json_encode(array("status" => 0, 'data' => 'An Error occured when trying to update the quantity'));
                } else {
                    $logDesc = "Quantity of Item " . $IProduct['product_name'] . " updated on sale  " . $sale_id . " by " . $session->get('user_name') . " on " . $Date . " " . $Time;
                    $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Update", $logDesc);
                    echo json_encode(array("status" => 1, 'data' => 'Item Update successful'));
                }
            }
        } else {
            echo json_encode(array("status" => 0, 'data' => 'Selected quatity of ' . $quantityToadd . ' is more than the available stock of ' . $IProduct['stock']));
        }
    }

    public function removeItem($itemId)
    {
        $session = session();

        $sys = new Sys();
        $getTime = $sys->getTime();

        $Date =  $getTime['date'];
        $Time =  $getTime['time'];

        $fitem = new ItemModel();
        $Qitem = $fitem->where('item_sale_id', $itemId)->first();
        $saleId = $Qitem['sale_id'];
        $product_sku = $Qitem['product_sku'];
        $quantity = $Qitem['quantity'];
        $totalBuyingPrice = $Qitem['total_buying_price'];
        $sale_id = $Qitem['sale_id'];

        $product = new ProductModel();
        $IProduct = $product->where('product_sku', $product_sku)->first();
        $oldStock = $IProduct['stock'];

        $newStock = $oldStock + $quantity;

        $deleteItem = new ItemModel();
        $deleteItem->where('item_sale_id', $itemId);
        $deleteItem->delete();

        $productData = [
            'stock' => $newStock,
        ];

        $item = new ItemModel();
        $item->where('sale_id', $sale_id);
        $tP = $item->where('sale_id', $sale_id)->select('sum(total_price) as TotalPrice')->first();
        if (empty($tP)) {
            # code...
            $totalP = 0;
        } else {
            # code...
            $totalP = $tP['TotalPrice'];
        }

        $sts = 'DI, Pending Payment';

        $saleData = [
            'amount' => $totalP,
            'sale_status' => $sts,
        ];

        $sale = new SaleModel();
        $sale->where('sale_id', $sale_id);
        $sale->set($saleData);
        $sale->update();

        $product = new ProductModel();
        $product->where('product_sku', $product_sku);
        $product->set($productData);
        $product->update();

        if ($product == false || $sale == false || $item == false || $deleteItem == false) {
            # code...
            $status = 0;
            $data['message'] = "An Error occured. Try again after sometime";
        } else {
            # code...
            $logDesc = "Item " . $IProduct['product_name'] . " removed in sale  " . $sale_id . " by " . $session->get('user_name') . " on " . $Date . " " . $Time;
            $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Delete", $logDesc);
            $status = 1;
            $data['message'] = "Item removed successfully";
        }
        echo json_encode(array("status" => $status, 'data' => $data));
    }

    public function getPayment($saleId)
    {
        $checkpayment = new PaymentModel();
        $checkpayment->where('sale_id', $saleId);
        $data['payment'] = $checkpayment->findAll();
        $tPc = $checkpayment->where('sale_id', $saleId)->select('sum(amount) as total_payment')->first();
        if (empty($data['payment'])) {
            $data['Payment'] = 0;
        } else {
            $data['Payment'] = $tPc['total_payment'];
        }
        $saleData = [
            'sale_status' => "Payment Initiated"
        ];

        $sale = new SaleModel();
        $sale->where('sale_id', $saleId);
        $sale->set($saleData);
        $sale->update();

        $item = new ItemModel();
        $tP = $item->where('sale_id', $saleId)->select('sum(total_price) as TotalPrice')->first();
        $data['message'] = "Do you want to recieve a remaining payment of Ksh " . $tP['TotalPrice'] - $data['Payment'] . " Where a total payment of Ksh " . $data['Payment'] . " was done for a expected price of Ksh" . $tP['TotalPrice'] . "?";
        echo json_encode(array("status" => 1, 'data' => $data['message']));
    }

    public function addPayment()
    {

        $session = session();

        $sys = new Sys();
        $getTime = $sys->getTime();

        $Date =  $getTime['date'];
        $Time =  $getTime['time'];
        $sys = new Sys();
        $getTime = $sys->getTime();
        $transactionId =  $getTime['ts'];
        $transactionDate =  $getTime['date'];
        $transactionTime =  $getTime['time'];

        $saleId = $this->request->getVar('txtSaleId');
        $currentPayment = $this->request->getVar('txtAmount');
        $transactionType = $this->request->getVar('txtTT');
        $ntransactionID = substr($transactionType, 0, 1) . $transactionId;

        $checkpayment = new PaymentModel();
        $checkpayment->where('sale_id', $saleId);
        $data['payment'] = $checkpayment->findAll();
        $tPc = $checkpayment->where('sale_id', $saleId)->select('sum(amount) as total_payment')->first();
        if (empty($data['payment'])) {
            $data['Payment'] = 0;
        } else {
            $data['Payment'] = $tPc['total_payment'];
        }
        $totalPayment = $data['Payment'] + $currentPayment;

        $item = new ItemModel();
        $item->where('sale_id', $saleId);
        $data['item'] = $item->findAll();
        $tP = $item->where('sale_id', $saleId)->select('sum(total_price) as TotalPrice')->first();
        $totalPrice = $tP['TotalPrice'];

        if ($totalPrice == $data['Payment']) {
            $data['message'] = "Sorry... Full payment of Ksh " . $data['Payment'] . " was done to this Transaction or no Items have been added to the Cart";
            $status = 1;
        } else {
            if ($totalPrice <= $totalPayment) {
                $balance = $totalPayment - $totalPrice;
                $data['message'] = "A Payment of Ksh " . $currentPayment . " plus a payment of Ksh " . $data['Payment'] . " done previously has been successful. Please give the customer a balance of Ksh " . $balance;
                $status = 1;
                $toPay = 0;
                $amount = $currentPayment - $balance;
                $saleStatus = "Complete";
                $Payment = $totalPayment;
            } else {
                $toPay = $totalPrice - $totalPayment;
                $data['toPay'] = $toPay;
                $data['message'] = "A Payment of Ksh " . $totalPayment . " as been done and saved, please Ask the customer for more payment of Ksh " . $toPay . " to complete the sale.";
                $status = 2;
                $amount = $currentPayment;
                $saleStatus = "Partially Paid";
                $Payment = $totalPayment;
            }
            $transactionData = [
                'payment_id' => $ntransactionID,
                'sale_id' => $saleId,
                'payment_type' => $transactionType,
                'payment_date' => $transactionDate,
                'payment_time' => $transactionTime,
                'amount' => $amount,
                'total_price' => $totalPrice,
                'remarks' => $data['message'],
                'balanceNotPaid' => $toPay,
                'createdBy' => $session->get('user_id')
            ];
            $saleData = [
                'paid_amount' => $Payment,
                'pay_method' => $transactionType,
                'sale_status' => $saleStatus
            ];
            $savepayment = new PaymentModel();
            $savepayment->save($transactionData);

            $sale = new SaleModel();
            $sale->where('sale_id', $saleId);
            $sale->set($saleData);
            $sale->update();

            $logDesc = "Payment " . $ntransactionID . " of Ksh " . $amount . " by " . $transactionType . " payment mode added to sale  " . $saleId . " by " . $session->get('user_name') . " on " . $Date . " " . $Time;
            $sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);
        }
        echo json_encode(array("status" => $status, 'data' => $data));
    }


    // logs all throwables and exeptions in this class
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
