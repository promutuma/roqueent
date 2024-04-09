<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    public function index()
    {
        $data['title'] = "Products / Stock";

        $product = new ProductModel();
        $data['product'] = $product->findAll();

        $category = new CategoryModel();
        $data['category'] = $category->findAll();


        return view('product/productlist', $data);
    }

    public function addProduct()
    {
        $session = session();
        helper(['form', 'url']);
        $Sys = new Sys();
        $product = new ProductModel();
        $getTime = $Sys->getTime();
        $sku =  $getTime['ts'];
        $Date = $getTime['date'];
        $Time = $getTime['time'];



        $data = [
            'product_sku' => $sku,
            'product_name' => $this->request->getVar('txtProductName'),
            'regular_price' => $this->request->getVar('txtRPrice'),
            'sale_price' => $this->request->getVar('txtSPrice'),
            'stock' => $this->request->getVar('txtStock'),
            'category' => $this->request->getVar('txtCategory'),
            'createdBy' => $session->get('user_id'),
        ];

        $product->save($data);
        if ($product != false) {
            $logDesc = "Product (" . $this->request->getVar('txtProductName') . ") added to the system by " . $session->get('user_name') . " on " . $Date . " " . $Time;
            $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);
            $data = $product->where('product_sku', $sku)->first();
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function addCategory()
    {
        $session = session();
        $Sys = new Sys();
        $product = new ProductModel();
        $getTime = $Sys->getTime();
        $sku =  $getTime['ts'];
        $Date = $getTime['date'];
        $Time = $getTime['time'];

        helper(['form', 'url']);
        $category = new CategoryModel();

        $category_name = strtoupper($this->request->getVar('txtCategoryName'));

        $data = [
            'category_name' => $category_name,
            'createdBy' => $session->get('user_id'),
        ];

        $category->save($data);
        if ($category != false) {
            $logDesc = "Category (" . $category_name . ") added to the system by " . $session->get('user_name') . " on " . $Date . " " . $Time;
            $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Create", $logDesc);
            $data = $category->where('category_name', $category_name)->first();
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function findProduct($sku)
    {
        $product = new ProductModel();
        $data = $product->where('product_sku', $sku)->first();
        echo json_encode(array("status" => true, 'data' => $data));
    }

    public function deleteProduct($sku)
    {
        $session = session();
        $product = new ProductModel();

        $Sys = new Sys();
        $getTime = $Sys->getTime();
        $Date = $getTime['date'];
        $Time = $getTime['time'];

        $product->where('product_sku', $sku);
        $product->delete();
        $logDesc = "Product with sku number (" . $sku . ") deleted from the system by " . $session->get('user_name') . " on " . $Date . " " . $Time;
        $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Delete", $logDesc);
        echo json_encode(array("status" => true));
    }

    public function updateProduct()
    {
        $session = session();
        $Sys = new Sys();
        $getTime = $Sys->getTime();
        $Date = $getTime['date'];
        $Time = $getTime['time'];

        $updateproduct = new ProductModel();

        $sku =  $this->request->getVar('txtProductSku');

        $setdata = [
            'product_name' => $this->request->getVar('txtProductName'),
            'regular_price' => $this->request->getVar('txtRPrice'),
            'sale_price' => $this->request->getVar('txtSPrice'),
            'stock' => $this->request->getVar('txtStock'),
            'category' => $this->request->getVar('txtCategory')
        ];

        $updateproduct->where('product_sku', $sku);
        $updateproduct->set($setdata);
        $updateproduct->update();

        if ($updateproduct != false) {
            $data = $updateproduct->where('product_sku', $sku)->first();
            $logDesc = "Product with sku number (" . $sku . ") updated by " . $session->get('user_name') . " on " . $Date . " " . $Time;
            $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Update", $logDesc);
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }

    public function addStock()
    {
        $session = session();
        $Sys = new Sys();
        $getTime = $Sys->getTime();
        $Date = $getTime['date'];
        $Time = $getTime['time'];

        $updateproduct = new ProductModel();

        $sku =  $this->request->getVar('txtProductSku');
        $oldStock = $this->request->getVar('txtStock');
        $addedStock =  $this->request->getVar('txtAddStock');
        $newStock = $oldStock + $addedStock;

        $setdata = [
            'stock' => $newStock,
        ];

        $updateproduct->where('product_sku', $sku);
        $updateproduct->set($setdata);
        $updateproduct->update();

        if ($updateproduct != false) {
            $data = $updateproduct->where('product_sku', $sku)->first();
            $logDesc = "A stock of " . $addedStock . " added to Product with sku number (" . $sku . ") by " . $session->get('user_name') . " on " . $Date . " " . $Time;
            $Sys->addLog($session->get('session_iddata'), $session->get('user_id'), "Update", $logDesc);
            echo json_encode(array("status" => true, 'data' => $data));
        } else {
            echo json_encode(array("status" => false, 'data' => $data));
        }
    }
}
