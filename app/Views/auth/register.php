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
            <div class="form-title">Register Customer</div>

            <form method="post" action="/register">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username"
                        required>
                </div>
                <?php if (session()->getFlashdata('errors')['username'] ?? false): ?>
                <small style="color:red"><?= session()->getFlashdata('errors')['username'] ?></small><br>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
                <?php if (session()->getFlashdata('errors')['email'] ?? false): ?>
                <small style="color:red"><?= session()->getFlashdata('errors')['email'] ?></small><br>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Enter password" required>
                </div>
                <?php if (session()->getFlashdata('errors')['password'] ?? false): ?>
                <small style="color:red"><?= session()->getFlashdata('errors')['password'] ?></small><br>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="confirm" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="confirm" name="confirm"
                        placeholder="Enter confirm password" required>
                </div>
                <?php if (session()->getFlashdata('errors')['confirm'] ?? false): ?>
                <small style="color:red"><?= session()->getFlashdata('errors')['confirm'] ?></small><br>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>

            <?php if (session()->getFlashdata('error')): ?>
            <p style="color:red"><?= session()->getFlashdata('error') ?></p>
            <?php elseif (session()->getFlashdata('success')): ?>
            <p style="color:green"><?= session()->getFlashdata('success') ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>