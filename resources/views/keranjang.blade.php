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
            background-color: #ffffff;
            color: #000000;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #000000;
            text-align: center;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 1rem;
        }

        thead th {
            text-align: left;
            padding-bottom: 1rem;
            font-weight: 700;
            font-size: 1.125rem;
            border-bottom: 2px solid #000000;
            color: #000000;
        }

        tbody tr {
            background: #f2f2f2;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: box-shadow 0.3s ease;
        }

        tbody tr:hover,
        tbody tr:focus-within {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            outline: none;
        }

        td {
            vertical-align: middle;
            padding: 1rem 1.25rem;
            color: #000000;
        }

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
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .product-name {
            font-weight: 700;
            font-size: 1.1rem;
            color: #000000;
        }

        .quantity-input {
            width: 70px;
            text-align: center;
            font-size: 1rem;
            padding: 0.375rem;
            border-radius: 0.5rem;
            border: 1px solid #a6a6a6;
            transition: border-color 0.3s ease;
            background-color: #ffffff;
            color: #000000;
        }

        .quantity-input:focus {
            border-color: #000000;
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.15);
            outline: none;
        }

        .price {
            font-weight: 800;
            font-size: 1.125rem;
            color: #000000;
        }

        .btn-remove {
            background: transparent;
            border: none;
            color: #b91c1c;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .btn-remove:hover,
        .btn-remove:focus {
            color: #7f1d1d;
            outline: none;
        }

        .cart-summary {
            max-width: 400px;
            margin-top: 3rem;
            padding: 2rem;
            background: #f2f2f2;
            border-radius: 1rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        }

        .summary-title {
            font-weight: 800;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #000000;
            padding-bottom: 0.5rem;
            color: #000000;
            text-transform: uppercase;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1rem;
            color: #000000;
        }

        .summary-total {
            font-size: 1.5rem;
            font-weight: 900;
            border-top: 2px solid #000000;
            padding-top: 1rem;
            color: #000000;
        }

        .btn-checkout-custom {
            background-color: #000000;
            /* Hitam */
            color: #ffffff;
            /* Teks putih */
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.75rem;
            padding: 1.25rem 0;
            min-height: 80px;
            min-width: 100%;
            border: none;
            border-radius: 2rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.4);
            cursor: pointer;
            user-select: none;
            text-align: center;
        }

        .btn-checkout-custom:hover,
        .btn-checkout-custom:focus {
            background-color:rgb(255, 255, 255);
            transform: translateY(-2px);
            outline: none;
        }

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
    @include('layouts.app')

    <main class="container" role="main">
        @auth
        <h1>Keranjang Belanja</h1>

        <div class="table-responsive" tabindex="0" aria-label="Daftar produk di keranjang belanja Anda">
            <table>
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="check-all">
                        </th>
                        <th scope="col">Produk</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col" aria-label="Hapus item dari keranjang"></th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    @php $subtotal = 0; @endphp
                    @if(session('cart'))
                    @foreach(session('cart') as $id => $details)
                    @php
                    $lineTotal = $details['price'] * $details['quantity'];
                    $subtotal += $lineTotal;
                    @endphp
                    <tr tabindex="0">
                        <td>
                            <input type="checkbox" class="item-checkbox" data-id="{{ $id }}" checked>
                        </td>
                        <td>
                            <div class="product-info">
                                <img src="{{ asset('storage/' . $details['image']) }}" alt="Gambar produk {{ $details['name'] }}" class="product-img" />
                                <div class="product-name">{{ $details['name'] }}</div>
                            </div>
                        </td>
                        <td>
                            <input type="number" min="1" value="{{ $details['quantity'] }}" class="quantity-input" data-id="{{ $id }}" />
                        </td>
                        <td class="price">Rp{{ number_format($details['price'], 0, ',', '.') }}</td>
                        <td class="price subtotal">Rp{{ number_format($lineTotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-remove" aria-label="Hapus produk ini">
                                    <span class="material-icons">delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">Keranjang belanja kosong.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        @if(session('cart'))
        <aside class="cart-summary shadow-sm p-4 rounded" aria-labelledby="summary-title" tabindex="0" style="background-color: #f8f9fa;">
            <h2 id="summary-title" class="summary-title font-weight-bold mb-3">Ringkasan Belanja</h2>

            <div class="summary-item d-flex justify-content-between mb-2">
                <span>Subtotal</span>
                <span id="subtotal-amount">
                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                </span>
            </div>

            <div class="summary-item d-flex justify-content-between mb-2">
                <span>Biaya Pengiriman</span>
                <span id="shipping-fee">Rp 0</span>
            </div>

            <div class="summary-total d-flex justify-content-between font-weight-bold mt-3">
                <span>Total</span>
                <span id="total-amount">
                    Rp{{ number_format($subtotal, 0, ',', '.') }}
                </span>
            </div>

            <form action="{{ route('checkout') }}" method="GET" id="checkout-form">
                <input type="hidden" name="selected_items" id="selected-items-input">
                <button type="submit" class="btn btn-checkout-custom btn-block mt-4" aria-label="Lanjut ke pembayaran">
                    Lanjut ke Pembayaran
                </button>
            </form>

        </aside>
        @endif
        @else
        <div class="text-center mt-5">
            <p class="fs-5">Silakan login terlebih dahulu untuk melihat keranjang belanja Anda.</p>
            <a href="{{ route('login') }}" class="btn btn-success btn-lg mt-3">Login</a>
        </div>
        @endauth
    </main>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cartItemsContainer = document.getElementById('cart-items');
            const subtotalDisplay = document.getElementById('subtotal-amount');
            const shippingFeeElem = document.getElementById('shipping-fee');
            const totalElem = document.getElementById('total-amount');
            const selectedItemsInput = document.getElementById('selected-items-input');
            const checkoutForm = document.getElementById('checkout-form');
            const checkAll = document.getElementById('check-all');
            const checkboxSelector = '.item-checkbox';
            const shippingFee = 0;

            function parsePrice(priceStr) {
                return Number(priceStr.replace(/[Rp.\s]/g, ''));
            }

            function formatPrice(num) {
                return 'Rp' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function updateTotals() {
                let subtotal = 0;
                const rows = cartItemsContainer.querySelectorAll('tr');

                rows.forEach(row => {
                    const checkbox = row.querySelector(checkboxSelector);
                    const qtyInput = row.querySelector('.quantity-input');
                    const priceElem = row.querySelector('td:nth-child(4)');
                    const subtotalElem = row.querySelector('.subtotal');

                    if (checkbox && checkbox.checked && qtyInput && priceElem && subtotalElem) {
                        const qty = parseInt(qtyInput.value) || 1;
                        const unitPrice = parsePrice(priceElem.textContent);
                        const lineTotal = qty * unitPrice;
                        subtotalElem.textContent = formatPrice(lineTotal);
                        subtotal += lineTotal;
                    } else {
                        // Jika tidak dicek, kosongkan subtotal item
                        if (subtotalElem) subtotalElem.textContent = '-';
                    }
                });

                subtotalDisplay.textContent = formatPrice(subtotal);
                shippingFeeElem.textContent = formatPrice(shippingFee);
                totalElem.textContent = formatPrice(subtotal);
            }

            function getCheckedItems() {
                const checkboxes = document.querySelectorAll(checkboxSelector);
                return Array.from(checkboxes)
                    .filter(cb => cb.checked)
                    .map(cb => cb.dataset.id);
            }

            // Update saat quantity berubah
            cartItemsContainer.addEventListener('input', e => {
                if (e.target.classList.contains('quantity-input')) {
                    updateTotals();
                }
            });

            // Update saat checkbox berubah
            document.querySelectorAll(checkboxSelector).forEach(cb => {
                cb.addEventListener('change', updateTotals);
            });

            // Check all
            checkAll.addEventListener('change', function() {
                const allCheckboxes = document.querySelectorAll(checkboxSelector);
                allCheckboxes.forEach(cb => cb.checked = this.checked);
                updateTotals();
            });

            // Submit checkout form
            checkoutForm.addEventListener('submit', function(e) {
                const selected = getCheckedItems();
                if (selected.length === 0) {
                    e.preventDefault();
                    alert('Pilih setidaknya satu produk untuk melanjutkan pembayaran.');
                    return;
                }
                selectedItemsInput.value = selected.join(',');
            });

            // Panggil awal saat halaman dimuat
            updateTotals();
        });
    </script>

</body>

</html>