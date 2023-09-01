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
        <h5 class="p-3">Tambah Product</h5>
        <div class="d-grid col-3 mb-3">
            <button wire:click="openModal" class="btn btn-primary">+ Add</button>
        </div>
        <div class="row align-middle">
            <div class="col">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg></span>
                    <input id="search" wire:model="search" type="text" class="form-control"
                        placeholder="Search ..." aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </div>
            <div class="col">
                <select id="selectCategory" wire:model="selectedCategory" class="form-select">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <table class="table table-striped table-responsive text-center my-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Discount Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @forelse ($products as $index => $product)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->title }}</td>
                        <td><img src="{{ asset('storage/' . $product->image) }}" alt="" width="100"
                                height="100"></td>
                        <td>Rp. {{ $product->price }}</td>
                        @if ($product->discount_price != null)
                            <td>Rp. {{ $product->discount_price }}</td>
                        @else
                            <td>-</td>
                        @endif
                        <td><button wire:click="delete({{ $product->id }})" class="btn btn-danger">Hapus</button>
                            <button wire:click="edit({{ $product->id }})" class="btn btn-warning">Edit</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No Product</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ $select_product ? 'Edit Product' : 'Add Product' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="p-3" wire:submit.prevent="{{ $select_product ? 'update' : 'store' }}"
                    enctype="multipart/form-data">
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="title" class="form-control" id="title">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp</span>
                                <input type="number" wire:model="price" class="form-control" aria-label="Price">
                                <span class="input-group-text">.00</span>
                            </div>
                            @error('price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="discount_price" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp</span>
                                <input type="number" wire:model="discount_price" class="form-control"
                                    aria-label="Discount_price">
                                <span class="input-group-text">.00</span>
                            </div>
                            @error('discount_price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="category" wire:model="category">
                                <option value="" selected>
                                    Open this option
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Image :</label>
                        <div class="col-sm-10">
                            <input type="file" wire:model="image" class="form-control" id="image">
                            @error('image')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">
                            <div wire:loading wire:target="store">
                                <span class="spinner-border spinner-border-sm" role="status"
                                    aria-hidden="true"></span>
                            </div>{{ $select_product ? 'Edit' : 'Tambah' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('script')
        <script>
            window.addEventListener('openModal', event => {
                $("#addProductModal").modal('show');
            })

            window.addEventListener('closeModal', event => {
                $("#addProductModal").modal('hide');
            })
        </script>

        <script>
            function confirmation(ev) {
                ev.preventDefault();
                var urlToRedirect = ev.currentTarget.getAttribute('href');
                console.log(urlToRedirect);
                swal({
                        title: "Are you sure to remove this product?",
                        text: "You will not be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willCancel) => {
                        if (willCancel) {
                            window.location.href = urlToRedirect;
                        }
                    })
            }
        </script>

        <script>
            document.addEventListener('livewire:load', function() {
                Livewire.on('deleteConfirmation', productId => {
                    Swal.fire({
                        title: 'Konfirmasi',
                        text: 'Anda yakin ingin menghapus produk ini?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            @this.call('delete', productId);
                        }
                    });
                });
            });
        </script>
    @endpush
</div>
