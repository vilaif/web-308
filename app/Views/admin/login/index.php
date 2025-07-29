<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | 308 Store</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
    body {
        background-color: #f8f9fa;
    }

    .login-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-box {
        width: 100%;
        max-width: 400px;
        padding: 30px;
        border-radius: 10px;
        background-color: white;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .form-title {
        margin-bottom: 20px;
        font-weight: 600;
        font-size: 1.5rem;
        text-align: center;
    }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-box">
            <div class="form-title">Sign In</div>

            <!-- Flash error message -->
            <?php if(session()->getFlashdata('error')): ?>
            <div class="alert"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form method="post" action="/login">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter password" required>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary w-100">Sign in</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>