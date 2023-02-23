<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    public function index()
    {

        $product = new ProductModel();
        $data['product']=$product->findAll();

        $category = new CategoryModel();
        $data['category']=$category->findAll();

        echo view('maintemp/header');
        echo view('product/productlist', $data);
        echo view('maintemp/footer');
    }

    public function addProduct(){
        helper(['form', 'url']);
        $Sys = new Sys();     
        $product = new ProductModel();
        $getTime = $Sys->getTime();
        $sku =  $getTime['ts'];

        
          
        $data = [
            'product_sku'=> $sku,
            'product_name'=> $this->request->getVar('txtProductName'),
            'regular_price'=> $this->request->getVar('txtRPrice'),
            'sale_price'=> $this->request->getVar('txtSPrice'),
            'stock'=> $this->request->getVar('txtStock'),
            'category'=> $this->request->getVar('txtCategory')
        ];

        $product->save($data);
        if($product != false)
        {
            $data = $product->where('product_sku', $sku)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }

    public function addCategory(){
        helper(['form', 'url']);
        $category = new CategoryModel();

        $category_name = strtoupper($this->request->getVar('txtCategoryName'));

        $data =[
            'category_name' => $category_name,
        ];
        
        $category->save($data);
        if($category != false)
        {
            $data = $category->where('category_name', $category_name)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }

    public function findProduct($sku){
        $product = new ProductModel();
        $data = $product->where('product_sku', $sku)->first();
        echo json_encode(array("status" => true , 'data' => $data));
    }

    public function deleteProduct($sku){
        $product = new ProductModel();
        $product->where('product_sku',$sku);
        $product->delete();
        echo json_encode(array("status" => true));
    }

    public function updateProduct(){
        $updateproduct = new ProductModel();

        $sku =  $this->request->getVar('txtProductSku');       
          
        $setdata = [
            'product_name'=> $this->request->getVar('txtProductName'),
            'regular_price'=> $this->request->getVar('txtRPrice'),
            'sale_price'=> $this->request->getVar('txtSPrice'),
            'stock'=> $this->request->getVar('txtStock'),
            'category'=> $this->request->getVar('txtCategory')
        ];

        $updateproduct->where('product_sku',$sku);
        $updateproduct->set($setdata);
        $updateproduct->update();

        if($updateproduct != false)
        {
            $data = $updateproduct->where('product_sku', $sku)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }

    public function addStock(){
        $updateproduct = new ProductModel();

        $sku =  $this->request->getVar('txtProductSku');
        $oldStock = $this->request->getVar('txtStock');
        $addedStock =  $this->request->getVar('txtAddStock');
        $newStock = $oldStock + $addedStock;     
          
        $setdata = [
            'stock'=> $newStock,
        ];

        $updateproduct->where('product_sku',$sku);
        $updateproduct->set($setdata);
        $updateproduct->update();

        if($updateproduct != false)
        {
            $data = $updateproduct->where('product_sku', $sku)->first();
            echo json_encode(array("status" => true , 'data' => $data));
        }
        else{
            echo json_encode(array("status" => false , 'data' => $data));
        }
    }
    
}
