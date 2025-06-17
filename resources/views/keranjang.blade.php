<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Keranjang Belanja - FashionBrand</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: #111;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #059669;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 1rem;
        }

        thead th {
            text-align: left;
            padding-bottom: 1rem;
            font-weight: 600;
            font-size: 1.125rem;
            border-bottom: 2px solid #059669;
        }

        tbody tr {
            background: #f9fafb;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.06);
            transition: box-shadow 0.3s ease;
        }

        tbody tr:hover,
        tbody tr:focus-within {
            box-shadow: 0 8px 24px rgb(0 0 0 / 0.12);
            outline: none;
        }

        td {
            vertical-align: middle;
            padding: 1rem 1.25rem;
        }

        /* Product info */
        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-img {
            width: 80px;
            height: 80px;
            border-radius: 0.75rem;
            object-fit: cover;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
        }

        .product-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #111;
        }

        /* Quantity controls */
        .quantity-input {
            width: 70px;
            text-align: center;
            font-size: 1rem;
            padding: 0.375rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            outline-offset: 2px;
            transition: border-color 0.3s ease;
        }

        .quantity-input:focus {
            border-color: #059669;
            box-shadow: 0 0 0 3px rgb(5 150 105 / 0.3);
            outline: none;
        }

        /* Price */
        .price {
            font-weight: 700;
            font-size: 1.125rem;
            color: #059669;
        }

        /* Remove button */
        .btn-remove {
            background: transparent;
            border: none;
            color: #dc2626;
            /* red-600 */
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .btn-remove:hover,
        .btn-remove:focus {
            color: #b91c1c;
            /* red-700 */
            outline: none;
        }

        /* Summary box */
        .cart-summary {
            max-width: 400px;
            margin-top: 3rem;
            padding: 2rem;
            background: #f3f4f6;
            border-radius: 1rem;
            box-shadow: 0 6px 18px rgba(5, 150, 105, 0.1);
        }

        .summary-title {
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #059669;
            padding-bottom: 0.5rem;
            color: #059669;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1rem;
        }

        .summary-total {
            font-size: 1.5rem;
            font-weight: 800;
            border-top: 2px solid #059669;
            padding-top: 1rem;
            color: #059669;
        }

        /* Checkout button */
        .btn-checkout {
            margin-top: 2rem;
            background: linear-gradient(135deg, #059669, #10b981);
            border: none;
            border-radius: 2rem;
            color: white;
            font-weight: 700;
            font-size: 1.25rem;
            padding: 1rem 2.5rem;
            width: 100%;
            transition: background 0.3s ease;
            user-select: none;
            cursor: pointer;
        }

        .btn-checkout:hover,
        .btn-checkout:focus {
            background: linear-gradient(135deg, #10b981, #059669);
            outline: none;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .product-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .product-img {
                width: 100%;
                height: auto;
                border-radius: 1rem;
            }

            td {
                padding: 0.75rem;
            }

            .cart-summary {
                max-width: 100%;
                margin-top: 2rem;
            }
        }
    </style>
</head>

<body>
    @include('layouts.header')
    <main class="container" role="main">
        <h1>Keranjang Belanja</h1>
        <div class="table-responsive" tabindex="0" aria-label="Daftar produk di keranjang belanja Anda">
            <table>
                <thead>
                    <tr>
                        <th scope="col">Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col" aria-label="Hapus item dari keranjang"></th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <!-- Cart items will be dynamically inserted here -->
                    <tr tabindex="0">
                        <td>
                            <div class="product-info">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/f69667a9-dec4-4b11-a396-fedc1ca3e5a8.png" alt="Produk fashion nomor satu - Jaket hijau premium minimalis" class="product-img" />
                                <div class="product-name">Jaket Hijau Premium</div>
                            </div>
                        </td>
                        <td>
                            <input type="number" min="1" value="1" class="quantity-input" aria-label="Jumlah Jaket Hijau Premium" />
                        </td>
                        <td class="price" aria-label="Harga satuan Jaket Hijau Premium">Rp450.000</td>
                        <td class="price subtotal">Rp450.000</td>
                        <td>
                            <button class="btn-remove" aria-label="Hapus Jaket Hijau Premium dari keranjang" title="Hapus">
                                <span class="material-icons">delete</span>
                            </button>
                        </td>
                    </tr>
                    <tr tabindex="0">
                        <td>
                            <div class="product-info">
                                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/07c6d9f0-7486-4466-a36d-624c484beaf5.png" alt="Produk fashion nomor dua - Sepatu hijau elegan minimalis" class="product-img" />
                                <div class="product-name">Sepatu Hijau Elegan</div>
                            </div>
                        </td>
                        <td>
                            <input type="number" min="1" value="2" class="quantity-input" aria-label="Jumlah Sepatu Hijau Elegan" />
                        </td>
                        <td class="price" aria-label="Harga satuan Sepatu Hijau Elegan">Rp650.000</td>
                        <td class="price subtotal">Rp1.300.000</td>
                        <td>
                            <button class="btn-remove" aria-label="Hapus Sepatu Hijau Elegan dari keranjang" title="Hapus">
                                <span class="material-icons">delete</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <aside class="cart-summary" aria-labelledby="summary-title" tabindex="0">
            <h2 id="summary-title" class="summary-title">Ringkasan Belanja</h2>
            <div class="summary-item">
                <span>Subtotal</span>
                <span id="subtotal-amount">Rp1.750.000</span>
            </div>
            <div class="summary-item">
                <span>Biaya Pengiriman</span>
                <span id="shipping-fee">Rp50.000</span>
            </div>
            <div class="summary-total">
                <span>Total</span>
                <span id="total-amount">Rp1.800.000</span>
            </div>
            <button class="btn-checkout" type="button" aria-label="Lanjut ke pembayaran">Lanjut ke Pembayaran</button>
        </aside>
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Helper to parse price string "Rp1.200.000" => 1200000
        function parsePrice(priceStr) {
            return Number(priceStr.replace(/[Rp.\s]/g, ''));
        }
        // Helper to format number to IDR string
        function formatPrice(num) {
            return 'Rp' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        document.addEventListener('DOMContentLoaded', () => {
            const cartItemsContainer = document.getElementById('cart-items');
            const subtotalElem = document.getElementById('subtotal-amount');
            const shippingFeeElem = document.getElementById('shipping-fee');
            const totalElem = document.getElementById('total-amount');
            const shippingFee = 50000; // fixed shipping fee

            // Calculate and update totals
            function updateTotals() {
                let subtotal = 0;
                const rows = cartItemsContainer.querySelectorAll('tr');
                rows.forEach(row => {
                    const qtyInput = row.querySelector('.quantity-input');
                    const priceElem = row.querySelector('td:nth-child(3)');
                    const subtotalElem = row.querySelector('.subtotal');
                    if (qtyInput && priceElem && subtotalElem) {
                        const qty = parseInt(qtyInput.value) || 1;
                        const unitPrice = parsePrice(priceElem.textContent);
                        const lineTotal = qty * unitPrice;
                        subtotalElem.textContent = formatPrice(lineTotal);
                        subtotal += lineTotal;
                    }
                });
                subtotalElem.textContent = formatPrice(subtotal);
                const total = subtotal + shippingFee;
                shippingFeeElem.textContent = formatPrice(shippingFee);
                totalElem.textContent = formatPrice(total);
            }

            // Handle quantity change
            cartItemsContainer.addEventListener('input', e => {
                if (e.target.classList.contains('quantity-input')) {
                    let val = parseInt(e.target.value);
                    if (isNaN(val) || val < 1) {
                        val = 1;
                        e.target.value = val;
                    }
                    updateTotals();
                }
            });

            // Handle remove item
            cartItemsContainer.addEventListener('click', e => {
                if (e.target.closest('.btn-remove')) {
                    const row = e.target.closest('tr');
                    if (row) {
                        row.remove();
                        updateTotals();
                    }
                }
            });

            updateTotals();
        });
    </script>
</body>

</html>