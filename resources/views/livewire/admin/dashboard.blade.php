<div class="container mt-4">
    <div class="row">
        <div class="col-md-3 sidebar">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                    Dashboard
                </a>
                <a href="{{ url('product') }}" class="list-group-item list-group-item-action">Products</a>
                <a href="{{ url('category') }}" class="list-group-item list-group-item-action">Categories</a>
                <a href="{{ url('order') }}" class="list-group-item list-group-item-action">Orders</a>
            </div>
        </div>
        <div class="col-md-9 content">
            <h2>Welcome to the Admin Dashboard</h2>
            <p>This is the control panel for managing your furniture store.</p>
            <div class="row">
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-header">Total Orders</div>
                        <div class="card-body">

                            <h4 class="card-title">
                                {{ count($orders) }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-header">Total Products</div>
                        <div class="card-body">
                            <h4 class="card-title">{{ count($products) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-light mb-3">
                        <div class="card-header">Total Category</div>
                        <div class="card-body">
                            <h4 class="card-title">{{ count($categories) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
