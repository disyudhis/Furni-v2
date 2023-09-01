<div>
    <div class="jumbotron text-center">
        <h1>Welcome to Our Furniture Store</h1>
        <p>Discover the finest selection of furniture for your home.</p>
    </div>
    <div class="container featured-products">
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                            height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></span>
                    <input type="text" class="form-control" wire:model="search" placeholder="Search ..."
                        aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col">
                <select class="form-select" aria-label="Default select example" wire:model="selectedCategory">
                    <option value="">Sort by Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="text-center" aria-hidden="true" wire:loading>
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            @forelse ($products as $product)
                <div class="col-md-4">
                    <div class="product-card" wire:loading.remove aria-hidden="true">
                        <img src="storage/{{ $product->image }}" alt="Product 1">
                        <h4>{{ $product->title }}</h4>
                        @if ($product->discount_price != null)
                            <div class="price placeholder-glow" style="text-decoration: line-through;">Rp.
                                {{ $product->price }}
                            </div>
                            <div class="discount-price placeholder-glow">Disc Rp.
                                {{ $product->discount_price }}</div>
                        @else
                            <div class="price placeholder-glow" style="font-weight: bold">Rp. {{ $product->price }}
                        @endif
                        <button wire:click="add_cart({{ $product->id }})" class="btn btn-secondary btn-block">Buy
                            Now</button>
                    </div>
                </div>
            @empty
                <div class="col">
                    <h5 class="text-center">No Product</h5>
                </div>
            @endforelse
        </div>
    </div>

</div>
