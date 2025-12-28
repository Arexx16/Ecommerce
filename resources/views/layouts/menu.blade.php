<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
            <div class="position-sticky pt-3 px-3 vh-100 bg-dark">
                <h5 class="text-white text-center mb-4 fs-5">Admin</h5>
                <ul class="nav flex-column gap-2">

                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center gap-2"
                        href="{{route("dashboard")}}">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    </li>

                    <!-- Users -->
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center gap-2"
                        href="{{route("users")}}">
                            <i class="bi bi-people"></i>
                            Users
                        </a>
                    </li>

                    <!-- Products -->
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center gap-2"
                        href="{{route("products")}}">
                            <i class="bi bi-box"></i>
                            Products
                        </a>
                    </li>

                    <!-- Categories -->
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center gap-2"
                        href="{{route("categories")}}">
                            <i class="bi bi-tags"></i>
                            Categories
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center gap-2"
                        href="{{route("dashboard")}}">
                            <i class="bi bi-cart-check text-white"></i>
                            Orders
                        </a>
                    </li>
                    <!-- Divider -->
                    <hr class="text-secondary">

                    <!-- Logout Button -->
                    <li class="nav-item mt-auto">
                        <form action="" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </nav>
</body>
</html>