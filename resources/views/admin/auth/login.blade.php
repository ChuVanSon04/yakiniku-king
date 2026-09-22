<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Login - Yakiniku King</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            width: 400px;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        }

        .login-box h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background: #111;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-login:hover {
            background: #333;
        }

        .error {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h1>Yakiniku King</h1>

    <h2>Admin Login</h2>

    @if ($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.login.submit') }}" method="POST">

        @csrf

        <div class="form-group">
            <label>Email</label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Nhập email"
            >
        </div>

        <div class="form-group">
            <label>Mật khẩu</label>

            <input
                type="password"
                name="password"
                placeholder="Nhập mật khẩu"
            >
        </div>

        <button type="submit" class="btn-login">
            Đăng nhập
        </button>

    </form>

</div>

</body>
</html>