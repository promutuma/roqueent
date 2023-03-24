<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\SaleModel;
use App\Models\ItemModel;

class Sales extends BaseController
{
    public function index()
    {
        $sale = new SaleModel();
        $data['allSales']=$sale->findAll();
        $data['CSales']=$sale->select('sum(sale_id) as TotalQ')->countAllResults();
        echo view('maintemp/header');
        echo view('sales/saleslist',$data);
        echo view('maintemp/footer');
    }

    public function newSale()
    {
        $Sys = new Sys();
        $getTime = $Sys->getTime();
        $saleId =  $getTime['ts'];
        $saleDate =  $getTime['date'];
        $saleTime =  $getTime['time'];

        $saleData=[
            'sale_id'=>$saleId,
            'sale_date'=>$saleDate,
            'sale_time'=>$saleTime
        ];

        $sale = new SaleModel();

        $sale->save($saleData);

        return redirect()->to('/html/sales-new.html/'.$saleId);
    }

    public function sale($saleId){
        $data['saleId']=$saleId;
        $product = new ProductModel();
        $data['product']=$product->where('stock >',0)->findAll();
        $item = new ItemModel();
        $item->where('sale_id',$saleId);
        $data['item'] =$item->findAll();
        $tP = $item->where('sale_id',$saleId)->select('sum(total_price) as TotalPrice')->first();
        $tQ = $item->where('sale_id',$saleId)->select('sum(quantity) as TotalQ')->first();
        $data['itemsN'] =  $item->where('sale_id',$saleId)->select('sum(quantity) as TotalQ')->countAllResults();

        if(empty($data['item'])){
            $data['totalPrice']= 0;
        }else{
            $data['totalPrice']= $tP['TotalPrice'];
        }

        if(empty($data['item'])){
            $data['totalQuantity']= 0;
        }else{
            $data['totalQuantity']= $tQ['TotalQ'];
        }
        

        echo view('maintemp/header');
        echo view('sales/sales_new',$data);
        echo view('maintemp/footer');
    }

    public function addCart(){
        $product = new ProductModel();
        $item = new ItemModel();
        $fitem = new ItemModel();
        $product_sku = $this->request->getVar('txtItem');
        $quantity = $this->request->getVar('txtQuantity');
        $sale_id= $this->request->getVar('txtSaleId');
        $cartitem = $fitem->where('item_sale_id', $product_sku.$sale_id)->first();
        if ($cartitem==null) {
            # code...
            $productdata = $product->where('product_sku', $product_sku)->first();
            $stock = $productdata['stock'];
            if($stock<$quantity){
                echo json_encode(array("status" => 0 , 'data' => "The quantity selected of ".$quantity ." items exceeds the available Stock of " .$stock." units"));
            }else{
                if($quantity==0){
                    echo json_encode(array("status" => 0 , 'data' => 'Sorry you cannot select null/zero quantity'));
                }else{
                    $sale_price = $productdata['sale_price'];
                    $total_price = $quantity*$sale_price;
                    $remainingstock = $stock - $quantity;
                    $totalBuyingP = $productdata['regular_price'] * $quantity;
                    $profit = $total_price-$totalBuyingP;
                        
                    $saledata = [
                        'item_sale_id' => $product_sku.$sale_id,
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
                    if($item == false){
                        echo json_encode(array("status" => 0 , 'data' => 'An error occured when trying to add the Items'));
                    }else{
                        $updateproduct = new ProductModel();
                        $updateproduct->where('product_sku',$product_sku);
                        $updateproduct->set($sproductdata);
                        $updateproduct->update();
                        if($updateproduct == false){
                            echo json_encode(array("status" => 0 , 'data' => 'An error occured when trying to add the Items, Item already added into cart do not resubmit'));
                        }else{
                            $item = new ItemModel();
                            $item->where('sale_id',$sale_id);
                            $data['item'] =$item->findAll();
                            $tP = $item->where('sale_id',$sale_id)->select('sum(total_price) as TotalPrice')->first();
                            $totalP = $tP['TotalPrice'];
                            $sts='Pending Payment';

                            $saleData = [
                                'amount'=>$totalP,
                                'sale_status' =>$sts,
                            ];

                            $sale = new SaleModel();
                            $sale->where('sale_id',$sale_id);
                            $sale->set($saleData);
                            $sale->update();

                            if($sale == false){
                                echo json_encode(array("status" => 0 , 'data' => 'Error occured when trying to add total amount. Please do not re-add the item'));
                            }else{
                                echo json_encode(array("status" => 1 , 'data' => $productdata['product_name'].' added to Cart with a Total Price of '.$total_price .'. With ultimate total price of Ksh'.$totalP));
                            }                            
                        }
                    }   
                }
            }
        } else {
            # code...
            echo json_encode(array("status" => 0 , 'data' => 'Duplicate entry please add another item or close SELECT ITEM dialogue and add quatity on the item where it appears on the NEW SALE page'));
        }              
    }

    public function addSaleItem($salesId)
    {
        $sale = new SaleModel();
        $sale->where('sale_id',$salesId);
        $fsale =$sale->first();

        if($fsale<1){
            echo json_encode(array("status" => 0 , 'data' => "Sale with Id (" .$salesId .") not found."));
        }else{
            echo json_encode(array("status" => true , 'data' => $fsale));
        }        
    }

    public function getItem($itemsaleid){
        $fitem = new ItemModel();
        $cartitem = $fitem->where('item_sale_id', $itemsaleid)->first();
        echo json_encode(array("status" => true , 'data' => $cartitem));
    }

    public function quantityChange(){
        
    }

    public function removeItem(){
        
    }
    
}
