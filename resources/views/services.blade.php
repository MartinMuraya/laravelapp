@extends('layouts.app')

@section('title', 'Our Services - MyBlogsite')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16">

    <!-- Heading -->
    <h2 class="text-4xl md:text-5xl font-bold text-center text-indigo-600 dark:text-indigo-400 mb-6">
        Our Services
    </h2>
    <p class="text-center text-gray-700 dark:text-gray-200 max-w-3xl mx-auto mb-12">
        Choose a service and pay securely with MPESA.
    </p>

    <!-- Services Grid -->
    <div class="grid md:grid-cols-3 gap-8 mb-16">
        @foreach($services as $service)
        <div class="bg-white dark:bg-gray-800 p-8 rounded-xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1 flex flex-col justify-between">
            <div>
                <div class="text-indigo-600 text-4xl mb-4">🛠️</div>
                <h3 class="text-2xl font-semibold mb-2">{{ $service->title }}</h3>
                <p class="text-gray-700 dark:text-gray-200 mb-4">{{ $service->description }}</p>
            </div>
            <div class="mt-4 flex flex-col gap-2">
                <span class="inline-block bg-indigo-100 dark:bg-indigo-700 text-indigo-800 dark:text-white px-3 py-1 rounded-full font-semibold">
                    KSh {{ number_format($service->price, 2) }}
                </span>
                <form method="POST" action="{{ route('cart.add') }}">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-500 transition">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Cart & Checkout Section -->
    <div class="bg-gray-100 dark:bg-gray-900 p-8 rounded-xl shadow-lg mb-16">
        <h3 class="text-3xl font-bold text-gray-800 dark:text-gray-200 mb-6">Your Cart</h3>
        @php $cart = session()->get('cart', []); @endphp

        @if(count($cart) > 0)
            <ul class="mb-6 space-y-3">
                @foreach($cart as $item)
                <li class="flex justify-between bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <span>{{ $item['title'] }}</span>
                    <span>KSh {{ number_format($item['price'], 2) }}</span>
                </li>
                @endforeach
            </ul>

            @php
                $total = array_sum(array_column($cart, 'price'));
            @endphp

            <div class="flex justify-between items-center mb-4">
                <span class="font-semibold text-lg">Total:</span>
                <span class="font-bold text-xl text-indigo-600 dark:text-indigo-400">KSh {{ number_format($total, 2) }}</span>
            </div>

            <button id="mpesaCheckout" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-500 transition">
                Pay with MPESA
            </button>
        @else
            <p class="text-gray-700 dark:text-gray-200">Your cart is empty.</p>
        @endif
    </div>

</div>

@endsection

@section('scripts')
<script>
document.getElementById('mpesaCheckout')?.addEventListener('click', function() {
    fetch("{{ route('checkout.mpesa') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        if(data.message){
            alert(data.message); // STK Push initiated
        } else {
            alert("Something went wrong.");
        }
    })
    .catch(error => {
        console.error(error);
        alert("Failed to initiate payment.");
    });
});
</script>
@endsection
