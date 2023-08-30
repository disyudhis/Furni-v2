<div>
    <div class="container">
        <h5 class="p-3">Tambah Product</h5>
        <div class="d-grid col-3">
            <button wire:click="openModal" class="btn btn-primary">+ Add</button>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="p-3">
                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="title" class="form-control" id="title">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="number" wire:model="price" class="form-control" id="price">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="discount_price" class="col-sm-2 col-form-label">Discount</label>
                        <div class="col-sm-10">
                            <input type="number" wire:model="discount_price" class="form-control" id="discount_price">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-select" id="category">
                                <option value="" selected>Open this select menu</option>
                                <option value="">One</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-2 col-form-label">Image :</label>
                        <div class="col-sm-10">
                            <input type="file" wire:model="image" class="form-control" id="image">
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button wire:click="store" type="button" class="btn btn-primary">Save changes</button>
                </div>
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
    @endpush
</div>
