<div class="container">
    <h1>Checkout Payment</h1>
    <div class="row">
        <div class="col-md-8">
            <!-- Metode Pembayaran -->
            <h2>Metode Pembayaran</h2>
            <div class="mb-3">
                <label class="form-label">Pilih Metode Pembayaran</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="card" id="card" value="card"
                        wire:model="selectedPaymentMethod" required>
                    <label class="form-check-label" for="credit_card">
                        Card
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cod" id="cod" value="cod"
                        wire:model="selectedPaymentMethod" required>
                    <label class="form-check-label" for="bank_transfer">
                        Cash on Delivery
                    </label>
                </div>
            </div>
            @if ($selectedPaymentMethod)
                <div wire:loading wire:target="selectPaymentMethod">
                    Sedang memproses...
                </div>
            @endif

            <!-- Tombol Submit -->
            <button wire:click="selectPaymentMethod" class="btn btn-primary">Bayar Sekarang</button>
        </div>
        <div class="col-md-4">
            <!-- Ringkasan Pesanan -->
            <div class="card">
                <div class="card-header">Ringkasan Pesanan</div>
                <div class="card-body">
                    <p>Total Items: <strong>{{ $totalItems }}</strong></p>
                    <p>Subtotal: <strong>Rp. {{ number_format($totalPrice, 2) }}</strong></p>
                    <hr>
                    <p>Total: <strong>Rp. {{ number_format($totalPrice, 2) }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>
