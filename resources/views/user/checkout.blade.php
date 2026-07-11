@extends('user.layouts.app')

@section('content')

<div class="min-vh-100 d-flex justify-content-center align-items-center bg-light py-5">

    <div class="card shadow-lg border-0 p-4"
         style="max-width: 500px; width: 100%; border-radius: 20px;">

        <h2 class="text-center text-primary fw-bold mb-4">
            💳 Checkout Pembayaran
        </h2>

        <form id="payment-form">

            @csrf

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nama Pelanggan
                </label>

                <input type="text"
                       id="customer_name"
                       class="form-control"
                       placeholder="Masukkan nama Anda"
                       required>

            </div>

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Nomor Meja
                </label>

                <input type="number"
                       id="table_number"
                       class="form-control"
                       placeholder="Contoh: 12"
                       required>

            </div>

            <div class="alert alert-success text-center fw-bold">

                Total Pembayaran:
                Rp {{ number_format($total, 0, ',', '.') }}

            </div>

            <button type="button"
                    id="pay-button"
                    class="btn btn-primary w-100 py-2 fw-semibold">

                Bayar Sekarang

            </button>

            <a href="{{ route('dashboard') }}"
               class="btn btn-outline-secondary w-100 mt-2">

                ← Kembali ke Dashboard

            </a>

        </form>

    </div>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>

document.getElementById('pay-button').onclick = function () {

    let customerName = document.getElementById('customer_name').value;

    let tableNumber = document.getElementById('table_number').value;

    if(customerName === '' || tableNumber === '') {

        alert('Nama pelanggan dan nomor meja wajib diisi!');

        return;
    }

    fetch('/save-order-data', {

        method: 'POST',

        headers: {

            'Content-Type': 'application/json',

            'X-CSRF-TOKEN': '{{ csrf_token() }}'

        },

        body: JSON.stringify({

            customer_name: customerName,

            table_number: tableNumber

        })

    })

    .then(response => response.json())

    .then(data => {

        snap.pay(data.snap_token, {

            onSuccess: function(result){

                fetch('/payment-success/' + data.order_id, {

                    method: 'POST',

                    headers: {

                        'X-CSRF-TOKEN': '{{ csrf_token() }}'

                    }

                })
                .then(() => {

                    alert('Pembayaran berhasil!');

                    window.location.href = "/user/history";

                });

            },

            onPending: function(result){

                alert('Menunggu pembayaran...');

            },

            onError: function(result){

                alert('Pembayaran gagal!');

            },

            onClose: function(){

                alert('Popup pembayaran ditutup.');

            }

        });

    });

};

</script>

@endsection