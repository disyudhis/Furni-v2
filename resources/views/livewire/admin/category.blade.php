<div>
    <div class="container">
        <div class="row mb-4">
            <div class="col">
                <h5 class="form-label mb-4">Add Categories</h5>
                <div class="d-grid col-3">
                    <button wire:click="openModal" class="btn btn-primary">+ Add</button>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                        <tr>
                            <th>{{ $index + 1 }}</th>
                            <th>{{ $category->name }}</th>
                            <th>{{ $category->updated_at }}</th>
                            <th><button wire:loading.attr="disabled" wire:click="delete({{ $category->id }})"
                                    class="btn btn-danger">
                                    <div wire:loading wire:target="delete({{ $category->id }})">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                    </div>
                                    Delete
                                </button>
                            </th>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="p-3" wire:submit.prevent="store">
                    <div class="row mb-3">
                        <label for="category" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="name" class="form-control" id="category">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">
                            <div wire:loading wire:target="store">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            </div>
                            Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    @push('script')
        <script>
            window.addEventListener('openModal', event => {
                $("#addCategoryModal").modal('show');
            })

            window.addEventListener('closeModal', event => {
                $("#addCategoryModal").modal('hide');
            })
        </script>
    @endpush
</div>
