<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard</title>

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
        .card-icon {
            font-size: 2rem;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        @include('layouts.menu')
        <!-- Main Content -->
        <main class="col-md-10 ms-sm-auto px-md-4">

            <!-- Top Navbar -->
            <nav class="navbar navbar-light bg-white shadow-sm my-3 rounded">
                <div class="container-fluid">
                    <span class="navbar-brand mb-0 h1">Product</span>
                </div>
            </nav>
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="">
                        <form action="" class="d-flex">
                            <div class="input-group rounded-pill overflow-hidden shadow-sm">
                                <input 
                                    type="text" 
                                    class="form-control border-0 ps-3" 
                                    placeholder="Search Product"
                                >
                                <button class="btn btn-dark px-4" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <button class="btn btn-dark btn-sm d-flex align-items-center gap-1 py-2 px-4 rounded-pill"
                            data-bs-toggle="modal"
                            data-bs-target="#addProductModal">
                        <i class="bi bi-plus-circle"></i>
                        <span>Add Product</span>
                    </button>
                </div>

                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Category_id</th>
                                    <th>Brand</th>
                                    <th>Thumbnail</th>
                                    <th>Stock</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        iphone
                                    </td>
                                    <td>iPhone 15</td>
                                    <td>Phone</td>
                                    <td>$1200</td>
                                    <td>20</td>
                                    <td>aaaa</td>
                                    <td>20</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateProductModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteProductModal">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow">

            <!-- Modal Header -->
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle me-2"></i> Add Product
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal Body -->
            <form action="" method="POST" enctype="multipart/form-data">
                <!-- @csrf -->
                <div class="modal-body">

                    <div class="row g-3">
                        <!-- Product Name -->
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" placeholder="Enter product name">
                        </div>

                        <!-- Category -->
                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option selected disabled>Choose category</option>
                                <option>Phone</option>
                                <option>Laptop</option>
                                <option>Accessory</option>
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="col-md-4">
                            <label class="form-label">Price ($)</label>
                            <input type="number" class="form-control" placeholder="0.00">
                        </div>

                        <!-- Stock -->
                        <div class="col-md-4">
                            <label class="form-label">Stock</label>
                            <input type="number" class="form-control" placeholder="0">
                        </div>

                        <!-- Status -->
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <!-- Image -->
                        <div class="col-md-6">
                            <label class="form-label">Product Image</label>
                            <input type="file" class="form-control">
                        </div>

                        <!-- Brand -->
                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <input type="text" class="form-control" placeholder="Apple, Samsung...">
                        </div>

                        <!-- Description -->
                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Product description"></textarea>
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-dark rounded-pill px-4">
                        <i class="bi bi-save me-1"></i> Save Product
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Update Product Modal -->
<div class="modal fade" id="updateProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i> Update Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="POST" enctype="multipart/form-data">
                <!-- @csrf -->
                <!-- @method('PUT') -->

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control" value="iPhone 15">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option>Phone</option>
                                <option>Laptop</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Price ($)</label>
                            <input type="number" class="form-control" value="1200">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Stock</label>
                            <input type="number" class="form-control" value="20">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Brand</label>
                            <input type="text" class="form-control" value="Apple">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Change Image</label>
                            <input type="file" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3">Product description here</textarea>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4">
                        <i class="bi bi-check-circle me-1"></i> Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- Delete Product Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-trash me-2"></i> Delete Product
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="" method="POST">
                <!-- @csrf -->
                <!-- @method('DELETE') -->

                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle text-danger display-4"></i>
                    <p class="mt-3 fs-5">
                        Are you sure you want to delete this product?
                    </p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        <i class="bi bi-trash me-1"></i> Delete
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
