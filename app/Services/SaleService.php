<?php

namespace App\Services;

use CodeIgniter\Config\Services;

class SaleService
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * Process a completely new sale with items
     */
    public function processNewSaleData(string $saleReference, array $itemsData, $userId, $saleDate, $saleTime): array
    {
        $this->db->transStart();

        try {
            $saleTotal = 0;
            $itemsToInsert = [];

            foreach ($itemsData as $index => $itemReq) {
                $sku = $itemReq['sku'];
                $quantity = (float)$itemReq['quantity'];

                // Get product information without lock first just to calculate details
                $productRow = $this->db->table('product')
                    ->where('product_sku', $sku)
                    ->get()->getRowArray();

                if (!$productRow) {
                    throw new \Exception("Product with SKU {$sku} not found.");
                }

                if ($productRow['stock'] < $quantity) {
                    throw new \Exception("{$productRow['product_name']} stock is below the requested quantity of {$quantity}.");
                }

                // Atomic stock decrement ensuring it doesn't go below 0
                $this->db->table('product')
                    ->where('id', $productRow['id'])
                    ->where('stock >=', $quantity)
                    ->set('stock', 'stock - ' . $quantity, false)
                    ->update();

                if ($this->db->affectedRows() === 0) {
                    throw new \Exception("Concurrency error: Insufficient stock for {$productRow['product_name']}.");
                }

                $totalPrice = $quantity * (float)$productRow['sale_price'];
                $totalBuyingPrice = $quantity * (float)$productRow['regular_price'];
                $profit = $totalPrice - $totalBuyingPrice;

                $saleTotal += $totalPrice;

                $itemsToInsert[] = [
                    // sale_id is attached below
                    'product_id' => $productRow['id'],
                    'product_sku' => $sku,
                    'product_name' => $productRow['product_name'],
                    'quantity' => $quantity,
                    'price_per_unit' => $productRow['sale_price'],
                    'total_price' => $totalPrice,
                    'total_buying_price' => $totalBuyingPrice,
                    'total_profit' => $profit,
                ];
            }

            // Create Sale
            $saleData = [
                'sale_reference' => $saleReference,
                'sale_date' => $saleDate,
                'sale_time' => $saleTime,
                'sale_status' => "Payment Initiated",
                'createdBy' => $userId,
                'amount' => $saleTotal,
            ];

            $this->db->table('sale')->insert($saleData);
            $saleId = $this->db->insertID();

            // Insert Items
            foreach ($itemsToInsert as &$itm) {
                $itm['sale_id'] = $saleId;
            }
            $this->db->table('sale_item')->insertBatch($itemsToInsert);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception("Database transaction failed during sale processing.");
            }

            return ['status' => true, 'message' => "Order saved and processed successfully."];

        } catch (\Throwable $th) {
            $this->db->transRollback();
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    /**
     * Add single item to existing cart
     */
    public function addItemToCart(string $productSku, float $quantity, string $saleReference, $userId): array
    {
        $this->db->transStart();

        try {
            // Find or create sale row based on reference
            $saleRow = $this->db->table('sale')->where('sale_reference', $saleReference)->get()->getRowArray();
            if (!$saleRow) {
                $saleData = [
                    'sale_reference' => $saleReference,
                    'sale_status' => 'IA, Pending Payment',
                    'amount' => 0,
                    'createdBy' => $userId
                ];
                $this->db->table('sale')->insert($saleData);
                $saleId = $this->db->insertID();
                $saleRow = $this->db->table('sale')->where('id', $saleId)->get()->getRowArray();
            } else {
                $saleId = $saleRow['id'];
            }

            $productRow = $this->db->table('product')->where('product_sku', $productSku)->get()->getRowArray();
            if (!$productRow) {
                throw new \Exception("Product not found");
            }
            if ($quantity <= 0) {
                throw new \Exception("Sorry you cannot select null/zero quantity");
            }

            // Check if item already exists in cart mapped to this sale_id and product_id
            $existingItem = $this->db->table('sale_item')
                ->where('sale_id', $saleId)
                ->where('product_id', $productRow['id'])
                ->get()->getRowArray();

            if ($existingItem) {
                throw new \Exception("Duplicate entry please add another item or adjust quantity in the newly mapped cart.");
            }

            // Atomic stock update
            $this->db->table('product')
                ->where('id', $productRow['id'])
                ->where('stock >=', $quantity)
                ->set('stock', 'stock - ' . $quantity, false)
                ->update();

            if ($this->db->affectedRows() === 0) {
                throw new \Exception("The quantity selected of {$quantity} items exceeds the available Stock.");
            }

            $salePrice = (float)$productRow['sale_price'];
            $totalPrice = $quantity * $salePrice;
            $buyingPrice = (float)$productRow['regular_price'];
            $totalBuyingPrice = $quantity * $buyingPrice;

            $itemData = [
                'sale_id' => $saleId,
                'product_id' => $productRow['id'],
                'product_sku' => $productSku,
                'product_name' => $productRow['product_name'],
                'quantity' => $quantity,
                'price_per_unit' => $salePrice,
                'total_price' => $totalPrice,
                'total_buying_price' => $totalBuyingPrice,
                'total_profit' => $totalPrice - $totalBuyingPrice,
            ];
            $this->db->table('sale_item')->insert($itemData);

            // Update entire cart total
            $itemsTotal = $this->db->table('sale_item')
                ->selectSum('total_price')
                ->where('sale_id', $saleId)
                ->get()->getRowArray();

            $newSaleAmount = $itemsTotal['total_price'] ?? 0;

            $this->db->table('sale')
                ->where('id', $saleId)
                ->update([
                    'amount' => $newSaleAmount,
                    'sale_status' => 'IA, Pending Payment'
                ]);

            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception("Adding to cart failed to commit.");
            }

            return [
                'status' => true,
                'message' => "{$productRow['product_name']} added to Cart with a Total Price of {$totalPrice}. With ultimate total price of Ksh{$newSaleAmount}",
                'product_name' => $productRow['product_name']
            ];

        } catch (\Throwable $th) {
            $this->db->transRollback();
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    /**
     * Remove item from cart and return stock
     */
    public function removeItemFromCart(int $itemId): array
    {
        $this->db->transStart();

        try {
            $itemRow = $this->db->table('sale_item')->where('id', $itemId)->get()->getRowArray();
            if (!$itemRow) {
                throw new \Exception("Item not found");
            }
            $saleId = $itemRow['sale_id'];
            $productId = $itemRow['product_id'];
            $quantity = (float)$itemRow['quantity'];

            // Return stock atomically
            if ($productId) {
                $this->db->table('product')
                    ->where('id', $productId)
                    ->set('stock', 'stock + ' . $quantity, false)
                    ->update();
            }

            $this->db->table('sale_item')->where('id', $itemId)->delete();

            // Refresh sale sum
            $itemsTotal = $this->db->table('sale_item')
                ->selectSum('total_price')
                ->where('sale_id', $saleId)
                ->get()->getRowArray();

            $newSaleAmount = $itemsTotal['total_price'] ?? 0;

            $this->db->table('sale')
                ->where('id', $saleId)
                ->update([
                    'amount' => $newSaleAmount,
                    'sale_status' => 'DI, Pending Payment'
                ]);

            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \Exception("Removal failed to commit.");
            }

            return ['status' => true, 'message' => "Item removed successfully", 'sale_id' => $saleId, 'product_name' => $itemRow['product_name']];
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    /**
     * Update quantity of an item
     */
    public function updateItemQuantity(int $itemId, float $quantityToAdd): array
    {
        $this->db->transStart();

        try {
            $itemRow = $this->db->table('sale_item')->where('id', $itemId)->get()->getRowArray();
            if (!$itemRow) {
                throw new \Exception("Cart item not found.");
            }

            $currentQuantity = (float)$itemRow['quantity'];
            $newQuantity = $currentQuantity + $quantityToAdd;
            if ($newQuantity < 1) {
                throw new \Exception("Sorry The Updated Quantity cannot be below 1. Please use the remove button to remove the item.");
            }

            $productId = $itemRow['product_id'];
            $productRow = $this->db->table('product')->where('id', $productId)->get()->getRowArray();

            if ($quantityToAdd > 0) {
                // Must deduct more stock
                $this->db->table('product')
                    ->where('id', $productId)
                    ->where('stock >=', $quantityToAdd)
                    ->set('stock', 'stock - ' . $quantityToAdd, false)
                    ->update();

                if ($this->db->affectedRows() === 0) {
                    throw new \Exception("Selected quantity of {$quantityToAdd} is more than the available stock.");
                }
            } elseif ($quantityToAdd < 0) {
                // Return stock
                $returnQty = abs($quantityToAdd);
                $this->db->table('product')
                    ->where('id', $productId)
                    ->set('stock', 'stock + ' . $returnQty, false)
                    ->update();
            }

            $salePrice = (float)$itemRow['price_per_unit'];
            $newTotalPrice = $newQuantity * $salePrice;
            $originalBuyingPrice = (float)$productRow['regular_price'];
            $newTotalBuyingPrice = $newQuantity * $originalBuyingPrice;

            $this->db->table('sale_item')
                ->where('id', $itemId)
                ->update([
                    'quantity' => $newQuantity,
                    'total_price' => $newTotalPrice,
                    'total_buying_price' => $newTotalBuyingPrice,
                    'total_profit' => $newTotalPrice - $newTotalBuyingPrice
                ]);

            $saleId = $itemRow['sale_id'];

            // Refresh sale sum
            $itemsTotal = $this->db->table('sale_item')
                ->selectSum('total_price')
                ->where('sale_id', $saleId)
                ->get()->getRowArray();

            $newSaleAmount = $itemsTotal['total_price'] ?? 0;

            $this->db->table('sale')
                ->where('id', $saleId)
                ->update([
                    'amount' => $newSaleAmount,
                    'sale_status' => 'IU, Pending Payment'
                ]);

            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \Exception("Quantity update failed to commit.");
            }

            return ['status' => true, 'message' => 'Item Update successful', 'sale_id' => $saleId, 'product_name' => $productRow['product_name']];
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return ['status' => false, 'message' => $th->getMessage()];
        }
    }

    /**
     * Add Payment to Sale
     */
    public function addPayment(string $saleReference, float $currentPayment, string $transactionType, string $transactionId, $userId, $date, $time): array
    {
        $this->db->transStart();

        try {
            $saleRow = $this->db->table('sale')->where('sale_reference', $saleReference)->get()->getRowArray();
            if (!$saleRow) {
                throw new \Exception("Sale not found.");
            }
            $saleId = $saleRow['id'];

            $paymentSumRow = $this->db->table('payment')->selectSum('amount')->where('sale_id', $saleId)->get()->getRowArray();
            $previouslyPaid = (float)($paymentSumRow['amount'] ?? 0);
            
            $totalPrice = (float)$saleRow['amount'];
            $totalPaymentIntended = $previouslyPaid + $currentPayment;

            if ($totalPrice <= $previouslyPaid) {
                throw new \Exception("Sorry... Full payment of Ksh {$previouslyPaid} was done to this Transaction array no Items have been added to the Cart.");
            }

            if ($totalPrice <= $totalPaymentIntended) {
                $balance = $totalPaymentIntended - $totalPrice;
                $message = "A Payment of Ksh {$currentPayment} plus a payment of Ksh {$previouslyPaid} done previously has been successful. Please give the customer a balance of Ksh {$balance}";
                $statusType = 1;
                $toPay = 0;
                $amountToRecord = $currentPayment - $balance;
                $saleStatus = "Complete";
                $updatedPaidAmount = $totalPrice; // Maxed out
            } else {
                $toPay = $totalPrice - $totalPaymentIntended;
                $message = "A Payment of Ksh {$currentPayment} has been received, plus a previous payment of Ksh {$previouslyPaid}. Please ask the customer for Ksh {$toPay} more.";
                $statusType = 2;
                $amountToRecord = $currentPayment;
                $saleStatus = "Partially Paid";
                $updatedPaidAmount = $totalPaymentIntended;
            }

            $paymentData = [
                'sale_id' => $saleId,
                'payment_reference' => substr($transactionType, 0, 1) . $transactionId,
                'payment_type' => $transactionType,
                'payment_date' => $date,
                'payment_time' => $time,
                'amount' => $amountToRecord,
                'total_price' => $totalPrice,
                'remarks' => $message,
                'balanceNotPaid' => $toPay,
                'createdBy' => $userId
            ];

            $this->db->table('payment')->insert($paymentData);

            $this->db->table('sale')->where('id', $saleId)->update([
                'paid_amount' => $updatedPaidAmount,
                'pay_method' => $transactionType,
                'sale_status' => $saleStatus
            ]);

            $this->db->transComplete();
            if ($this->db->transStatus() === false) {
                throw new \Exception("Payment update failed.");
            }

            return ['status' => $statusType, 'message' => $message, 'toPay' => $toPay ?? 0, 'sale_id' => $saleId];

        } catch (\Throwable $th) {
            $this->db->transRollback();
            return ['status' => 0, 'message' => $th->getMessage()];
        }
    }
}
