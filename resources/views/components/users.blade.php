<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6fa;
        }
        .sidebar {
            min-height: 100vh;
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
                    <span class="navbar-brand mb-0 h1">Users</span>
                </div>
            </nav>

            <!-- Card -->
            <div class="card shadow-sm">

                <!-- Card Header -->
                <div class="card-header d-flex justify-content-between align-items-center">

                    <!-- Search -->
                    <form class="d-flex">
                        <div class="input-group rounded-pill overflow-hidden shadow-sm">
                            <input type="text"
                                   class="form-control border-0 ps-3"
                                   placeholder="Search User">
                            <button class="btn btn-dark px-4">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Add User Button -->
                    <button class="btn btn-dark btn-sm d-flex align-items-center gap-1 py-2 px-4 rounded-pill"
                            data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                        <i class="bi bi-person-plus"></i>
                        <span>Add User</span>
                    </button>

                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <img src="https://via.placeholder.com/40"
                                             class="rounded-circle"
                                             width="40">
                                    </td>
                                    <td>John Doe</td>
                                    <td>johndoe</td>
                                    <td>john@mail.com</td>
                                    <td>012345678</td>
                                    <td>Male</td>
                                    <td>Admin</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateUserModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <button class="btn btn-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteUserModal">
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

<!-- ================= ADD USER MODAL ================= -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">
                    <i class="bi bi-person-plus me-2"></i> Add User
                </h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" enctype="multipart/form-data">
                <!-- @csrf -->
                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select class="form-select">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Role</label>
                            <select class="form-select">
                                <option>Admin</option>
                                <option>User</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Avatar</label>
                            <input type="file" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-dark rounded-pill px-4">
                        <i class="bi bi-save me-1"></i> Save User
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ================= UPDATE USER MODAL ================= -->
<div class="modal fade" id="updateUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header bg-warning">
                <h5 class="modal-title">
                    <i class="bi bi-pencil-square me-2"></i> Update User
                </h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST">
                <!-- @csrf -->
                <!-- @method('PUT') -->

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" value="John Doe">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" value="johndoe">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" value="john@mail.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" value="012345678">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Gender</label>
                            <select class="form-select">
                                <option selected>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Role</label>
                            <select class="form-select">
                                <option selected>Admin</option>
                                <option>User</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>Active</option>
                                <option>Inactive</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-warning rounded-pill px-4">
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ================= DELETE USER MODAL ================= -->
<div class="modal fade" id="deleteUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="bi bi-trash me-2"></i> Delete User
                </h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST">
                <!-- @csrf -->
                <!-- @method('DELETE') -->

                <div class="modal-body text-center">
                    <i class="bi bi-exclamation-triangle text-danger display-4"></i>
                    <p class="mt-3 fs-5">
                        Are you sure you want to delete this user?
                    </p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button class="btn btn-outline-secondary rounded-pill px-4"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button class="btn btn-danger rounded-pill px-4">
                        Delete
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
