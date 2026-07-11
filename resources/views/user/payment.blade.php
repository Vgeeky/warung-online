@extends('layouts.user')

@section('content')
<div class="container text-center mt-5">

    <h2 class="mb-4">
        💳 Pembayaran Midtrans QRIS
    </h2>

    <p class="text-muted mb-4">
        Klik tombol di bawah untuk melakukan pembayaran.
    </p>

    @if($order->status == 'paid')

        <button
            class="w-100 bg-secondary text-white py-3 rounded border-0"
            disabled>
            ✔ Sudah Dibayar
        </button>

    @else

        <button
            id="pay-button"
            class="w-100 bg-primary text-white py-3 rounded border-0">
            Bayar Sekarang
        </button>

    @endif

    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            ← Kembali ke Dashboard
        </a>
    </div>

</div>

{{-- MIDTRANS SNAP --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>

<script>
document.getElementById('pay-button').onclick = function () {

    snap.pay('{{ $snapToken }}', {

        onSuccess: function(result) {

            fetch('/payment-success/{{ $order->id }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            })
            .then(() => {

                let payButton = document.getElementById('pay-button');

                payButton.innerHTML = '✔ Sudah Dibayar';

                payButton.disabled = true;

                payButton.classList.remove('btn-primary');

                payButton.classList.add('btn-secondary');

            });

        }

        onPending: function(result){
            alert("Menunggu pembayaran...");
        },

        onError: function(result){
            alert("Pembayaran gagal!");
        },

        onClose: function(){
            alert("Popup pembayaran ditutup.");
        }

    });

};
</script>
@endsection