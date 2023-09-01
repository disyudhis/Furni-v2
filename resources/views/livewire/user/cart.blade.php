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

        {{-- content --}}
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
                        {{-- <button wire:click="checkout({{ $totalPrice }},
                            {{ $totalItems }})"
                            class="btn btn-primary btn-block @if ($totalPrice != null) @else
disabled @endif">Proceed
                            to
                            Checkout</button> --}}
                        <button
                            class="btn btn-primary btn-block @if ($totalPrice != null) @else disabled @endif"
                            wire:click="openModal">Pay</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="creditCardModal" tabindex="-1"
            aria-labelledby="creditCardModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Isi modal dengan formulir pembayaran kartu kredit -->
                        <!-- Misalnya, masukkan nomor kartu, tanggal kedaluwarsa, CVV, dan lainnya -->
                        <h5 class="text-center"><strong>Payment Gateway</strong></h5>
                        <form wire:submit.prevent="store">
                            <div class="mb-3">
                                <label for="name_on_card" class="form-label">Name On Card</label>
                                <input type="text" wire:model="name" class="form-control" id="name_on_card"
                                    placeholder="Test" size="4">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="card_number" class="form-label">Card Number</label>
                                <input type="text" wire:model="cardNumber" class="form-control card-number"
                                    size="20" id="card_number" placeholder="1234 5678 9012 3456">
                                @error('cardNumber')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="expiration_month" class="form-label">Exp Month</label>
                                        <input type="text" wire:model="expMonth"
                                            class="form-control card-expiry-month" size="2" id="expiration_month"
                                            placeholder="MM">
                                        @error('expMonth')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="expiration_year" class="form-label">Exp Year</label>
                                        <input type="text" wire:model="expYear" class="form-control card-expiry-year"
                                            size="4" id="expiration_year" placeholder="YYYY">
                                        @error('expYear')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label for="cvc" class="form-label">CVC</label>
                                        <input type="text" wire:model="cvc" class="form-control card-cvc"
                                            id="cvc" placeholder="123">
                                        @error('cvc')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-block">Pay</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @push('script')
            <script>
                window.addEventListener('openModal', event => {
                    $("#creditCardModal").modal('show');
                })

                window.addEventListener('closeModal', event => {
                    $("#creditCardModal").modal('hide');
                })
            </script>
        @endpush
    </div>
</div>
