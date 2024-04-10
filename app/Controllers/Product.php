<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Product extends BaseController
{
    private string $errorText = 'Error: ';

    public function index()
    {
        $data['title'] = "Products / Stock";

        $category = new CategoryModel();
        $product = new ProductModel();


        $data['product'] = $product->getAllProducts();
        $data['category'] = $category->getAllCategories();


        return view('product/productlist', $data);
    }

    // bridge to add new product
    public function addProduct()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        $sys = new Sys();
        $product = new ProductModel();

        try {

            $getTime = $sys->getTime();
            $sku =  $getTime['ts'];
            $pr_data = [
                'product_sku' => $sku,
                'product_name' => $this->request->getVar('txtProductName'),
                'regular_price' => $this->request->getVar('txtRPrice'),
                'sale_price' => $this->request->getVar('txtSPrice'),
                'stock' => $this->request->getVar('txtStock'),
                'category' => $this->request->getVar('txtCategory'),
                'createdBy' => session()->get('user_id'),
            ];
            $product->addProduct($pr_data);

            $data['status'] = 1;
            $data['message'] = $pr_data['product_name'] . " Added Successfully. Product SKU: " . $sku;
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Product::addProduct', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }

    // function to create categories
    public function addCategory()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        $category = new CategoryModel();

        $cat_data = [
            'category_name' => strtoupper($this->request->getVar('txtCategoryName')),
            'createdBy' => session()->get('user_id'),
        ];

        try {
            $category->createCategory($cat_data);

            $data['status'] = 1;
            $data['message'] = "Category " . $cat_data['category_name'] . ' Created Successfully';
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Product::addCategory', $th->getMessage());
        }


        // Return JSON response
        return $this->response->setJSON($data);
    }


    // get product data by sku
    public function findProduct($sku)
    {
        $data = [
            'status' => 0,
            'message' => '',
            'data' => [],
        ];

        try {
            $product = new ProductModel();
            $data['data'] = $product->getProductBySKU($sku);
            $data['status'] = 1;
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Product::findProduct', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }


    public function deleteProduct($sku)
    {
        $data = [
            'status' => 0,
            'message' => '',
            'data' => [],
        ];

        try {
            $product = new ProductModel();

            $product->deleteProduct($sku);

            $data = [
                'status' => 1,
                'message' => "Product deleted successfully"
            ];
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Product::deleteProduct', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }


    public function updateProduct()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        try {
            $sku =  $this->request->getVar('txtProductSku');
            $setdata = [
                'product_name' => $this->request->getVar('txtProductName'),
                'regular_price' => $this->request->getVar('txtRPrice'),
                'sale_price' => $this->request->getVar('txtSPrice'),
                'stock' => $this->request->getVar('txtStock'),
                'category' => $this->request->getVar('txtCategory')
            ];

            $updateproduct = new ProductModel();
            $updateproduct->updateProduct($sku, $setdata);

            $data['status'] = 1;
            $data['message'] = "Product updated successfully";
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Product::updateProduct', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }

    public function addStock()
    {
        $data = [
            'status' => 0,
            'message' => '',
            'tn' => csrf_hash(),
            'data' => [],
        ];

        try {

            $sku =  $this->request->getVar('txtProductSku');
            $oldStock = $this->request->getVar('txtStock');
            $addedStock =  $this->request->getVar('txtAddStock');
            $newStock = $oldStock + $addedStock;

            $setdata = [
                'stock' => $newStock,
            ];

            $updateproduct = new ProductModel();
            $updateproduct->updateProduct($sku, $setdata);

            $data['status'] = 1;
            $data['message'] = "Product updated successfully";
        } catch (\Throwable $th) {
            $data['message'] = $this->errorText . $th->getMessage();
            $this->logError('Product::addStock', $th->getMessage());
        }

        // Return JSON response
        return $this->response->setJSON($data);
    }


    // logs all throwables and exeptions in this class
    private function logError($method, $message)
    {
        $logMessage = "Error in $method method: $message";
        log_message('error', $logMessage);
    }
}
