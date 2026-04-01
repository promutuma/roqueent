<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 10px;
            width: 80mm; /* Standard Thermal Printer Width */
        }
        @media print {
            body { padding: 0; }
            .no-print { display: none; }
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .dashed-line {
            border-bottom: 1px dashed #000;
            margin: 5px 0;
        }
        .logo {
            max-width: 150px;
            filter: grayscale(100%);
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th {
            text-align: left;
            border-bottom: 1px solid #000;
        }
        .totals-row td {
            padding-top: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 10px;
        }
        /* Page break after receipt if printing multiple */
        .receipt-container {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="no-print" style="margin-bottom: 20px; text-align: center;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #007bff; color: white; border: none; border-radius: 4px;">Print Receipt</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer; background: #6c757d; color: white; border: none; border-radius: 4px; margin-left: 10px;">Close Tab</button>
    </div>

    <div class="receipt-container">
        <div class="text-center">
            <img src="<?= base_url('files/images/logo-dark.png') ?>" alt="Logo" class="logo">
            <h2 style="margin: 0;">Camera20 POS</h2>
            <p style="margin: 5px 0;">Premium Production Gear & Services</p>
            <p style="margin: 2px 0;">Nairobi, Kenya</p>
        </div>

        <div class="dashed-line"></div>

        <div>
            <p style="margin: 2px 0;"><strong>REF:</strong> <?= $sale['sale_reference'] ?></p>
            <p style="margin: 2px 0;"><strong>Date:</strong> <?= $sale['sale_date'] ?> <?= $sale['sale_time'] ?></p>
            <p style="margin: 2px 0;"><strong>Cashier:</strong> <?= $cashier['user_fname'] ?? ($cashier['username'] ?? 'Admin') ?></p>
            <?php if ($customer): ?>
                <p style="margin: 2px 0;"><strong>Customer:</strong> <?= $customer['customer_name'] ?></p>
            <?php endif; ?>
        </div>

        <div class="dashed-line"></div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-right">Qty</th>
                    <th class="text-right">Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td style="max-width: 40mm; word-wrap: break-word;"><?= $item['product_name'] ?></td>
                        <td class="text-right"><?= $item['quantity'] ?></td>
                        <td class="text-right"><?= number_format($item['price_per_unit'], 0) ?></td>
                        <td class="text-right"><?= number_format($item['total_price'], 0) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="dashed-line"></div>

        <table>
            <tr class="totals-row">
                <td class="bold">GRAND TOTAL</td>
                <td class="text-right bold">KSh <?= number_format($sale['amount'], 2) ?></td>
            </tr>
            <?php if ($sale['discount_amount'] > 0): ?>
            <tr>
                <td>Discount</td>
                <td class="text-right">- KSh <?= number_format($sale['discount_amount'], 2) ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <td>Amount Paid</td>
                <td class="text-right">KSh <?= number_format($totalPaid, 2) ?></td>
            </tr>
            <tr class="bold">
                <td>BALANCE</td>
                <td class="text-right">KSh <?= number_format($sale['amount'] - $totalPaid, 2) ?></td>
            </tr>
        </table>

        <div class="dashed-line"></div>

        <div class="text-center footer">
            <p class="bold">Thank you for shopping with us!</p>
            <p>Goods once sold are only returnable under our refund policy terms.</p>
            <p>Printed on: <?= date('Y-m-d H:i:s') ?></p>
        </div>
    </div>

    <script>
        // Auto print after a short delay to allow logo to load
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
