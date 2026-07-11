@extends('user.layout')

@section('title', 'History Pembelian')

@section('content')

<h1 class="text-3xl font-bold text-white mb-8 text-center">
    History Pembelian
</h1>

@if($orders->count() > 0)

<div class="overflow-x-auto bg-white/10 backdrop-blur-md rounded-lg p-5">

    <table class="w-full text-white">

        <thead>
            <tr class="border-b border-white/30">
                <th class="p-3 text-left">Order ID</th>
                <th class="p-3 text-left">Nama</th>
                <th class="p-3 text-left">Meja</th>
                <th class="p-3 text-left">Menu</th>
                <th class="p-3 text-left">Total</th>
                <th class="p-3 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @foreach($orders as $order)

            <tr class="border-b border-white/10">

                <td class="p-3">
                    #{{ $order->id }}
                </td>

                <td class="p-3">
                    {{ $order->customer_name }}
                </td>

                <td class="p-3">
                    {{ $order->table_number }}
                </td>

                <td class="p-3">
                    @if($order->items && $order->items->count())
                        @foreach($order->items as $item)
                            {{ $item->product->name ?? '-' }}
                            @if(!$loop->last), @endif
                        @endforeach
                    @else
                        -
                    @endif
                </td>

                <td class="p-3 text-green-400">

                    Rp {{ number_format($order->total_price, 0, ',', '.') }}

                </td>

                <td class="p-3">

                    <form action="{{ route('user.orderAgain', $order->id) }}" method="POST">

                        @csrf

                        <button class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-1 rounded font-semibold transition">

                            Order Lagi

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

@else

<p class="text-center text-white">
    Belum ada history pembelian.
</p>

@endif

@endsection