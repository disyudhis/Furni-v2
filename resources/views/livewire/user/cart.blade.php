<div>
    <div class="container">
        @if (session()->has('message'))
            <div class="alert alert-success" id="auto-hide-alert">
                {{ session('message') }}
            </div>
            <script>
                setTimeout(function() {
                    document.getElementById('auto-hide-alert').style.display = 'none';
                }, 2000); // Menghilangkan setelah 5 detik (5000 milidetik)
            </script>
        @endif
        <h1>Your Shopping Cart</h1>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cart Items</div>
                    <div class="card-body">
                        <table class="table text-center align-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($carts as $cart)
                                    @php
                                        $realPrice = $cart->discount_price ?? $cart->price;
                                        $realPrice = preg_replace('/[^\d,]/', '', $realPrice);
                                        $realPrice = str_replace(',', '.', $realPrice);
                                        $realPrice = (float) $realPrice;
                                        $totalPrice += $realPrice * $cart->quantity;
                                    @endphp
                                    <tr>
                                        <td>{{ $cart->title }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center">
                                                <button wire:click="decrement({{ $cart->id }})"
                                                    class="btn btn-sm">-</button>
                                                <span
                                                    class="mx-2">{{ $cart->quantity != null ? $cart->quantity : '0' }}</span>
                                                <button wire:click="increment({{ $cart->id }})"
                                                    class="btn btn-sm">+</button>
                                            </div>
                                        </td>
                                        <td>Rp. @if ($cart->discount_price != null)
                                                {{ $cart->discount_price }}
                                            @else
                                                {{ $cart->price }}
                                            @endif
                                        </td>
                                        <td>Rp. {{ number_format($cart->quantity * $realPrice, 2) }}</td>
                                        <td>
                                            <button wire:click="delete({{ $cart->id }})"
                                                class="btn btn-danger">Remove</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No Product
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Cart Summary</div>
                    <div class="card-body" wire:poll>
                        <p>Total Items: <strong>{{ $totalItems }}</strong></p>
                        <p>Subtotal: <strong>Rp. {{ number_format($totalPrice, 2) }}</strong></p>
                        <hr>
                        <p>Total: <strong>Rp. {{ number_format($totalPrice, 2) }}</strong></p>
                        <a href="#" class="btn btn-primary btn-block">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
