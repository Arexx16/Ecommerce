<!-- resources/views/products.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }
        .sidebar {
            min-height: 100vh;
        }
        .modal-content {
            border-radius: 1rem;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @include('layouts.menu')

        <main class="col-md-10 ms-sm-auto px-md-4">

            <!-- Top Navbar with Search -->
            <nav class="navbar navbar-light bg-white shadow-sm my-3 rounded">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <span class="navbar-brand mb-0 h1">Products</span>

                    <div class="d-flex gap-2">

                        <!-- Search Form -->
                        <form class="d-flex" method="GET" action="{{ route('products.index') }}">
                            <div class="input-group rounded-pill overflow-hidden shadow-sm">
                                <input type="text"
                                       name="search"
                                       class="form-control border-0 ps-3"
                                       placeholder="Search Product"
                                       value="{{ request('search') }}">
                                <button class="btn btn-dark px-4">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>

                        <!-- Add Product Button -->
                        <button class="btn btn-dark btn-sm d-flex align-items-center gap-1 py-2 px-4 rounded-pill"
                                data-bs-toggle="modal"
                                data-bs-target="#addProductModal">
                            <i class="bi bi-plus-circle"></i>
                            <span>Add Product</span>
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Products Table -->
            <div class="card shadow-sm mb-4">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->category?->name ?? 'N/A' }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        <span class="badge bg-{{ $product->status ? 'success' : 'secondary' }}">
                                            {{ $product->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#updateProductModal{{ $product->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Update Product Modal -->
                                <div class="modal fade" id="updateProductModal{{ $product->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content shadow">
                                            <div class="modal-header bg-warning">
                                                <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i> Update Product</h5>
                                                <button class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('products.update', $product->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Product Name</label>
                                                            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Category</label>
                                                            <select name="category_id" class="form-select" required>
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                                        {{ $category->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Price ($)</label>
                                                            <input type="number" name="price" step="0.01" min="0" class="form-control" value="{{ $product->price }}" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Stock</label>
                                                            <input type="number" name="stock" min="0" class="form-control" value="{{ $product->stock }}" required>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label">Status</label>
                                                            <select name="status" class="form-select" required>
                                                                <option value="active" {{ $product->status ? 'selected' : '' }}>Active</option>
                                                                <option value="inactive" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Brand</label>
                                                            <input type="text" name="brand" class="form-control" value="{{ $product->brand }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Thumbnail</label>
                                                            <input type="text" name="thumbnail" class="form-control" value="{{ $product->thumbnail }}" required>
                                                        </div>
                                                        <div class="col-12">
                                                            <label class="form-label">Description</label>
                                                            <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-warning">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Product Modal -->
                                <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title"><i class="bi bi-trash me-2"></i> Delete Product</h5>
                                                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body text-center">
                                                    <i class="bi bi-exclamation-triangle text-danger display-4"></i>
                                                    <p class="mt-3 fs-5">Are you sure you want to delete "{{ $product->name }}"?</p>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button class="btn btn-danger">Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            @empty
                                <tr>
                                    <td colspan="9">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i> Add Product</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select name="category_id" class="form-select" required>
                                <option disabled selected>Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Price ($)</label>
                            <input type="number" name="price" step="0.01" min="0" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Stock</label>
                            <input type="number" name="stock" min="0" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Thumbnail</label>
                            <input type="text" name="thumbnail" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-dark">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
