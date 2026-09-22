<!DOCTYPE html>
<html lang="vi">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Admin') - Yakiniku King
    </title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            width: 240px;
            background: #111;
            color: white;
            padding: 20px;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu a {
            display: block;
            padding: 12px;
            color: #ddd;
            text-decoration: none;
            border-radius: 5px;
        }

        .menu a:hover {
            background: #333;
            color: white;
        }

        /* MAIN */

        .main {
            flex: 1;
        }

        /* HEADER */

        .header {
            height: 65px;
            background: white;
            border-bottom: 1px solid #ddd;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 25px;
        }

        .header-title {
            font-size: 20px;
            font-weight: bold;
        }

        .logout-btn {
            border: none;
            background: #dc3545;
            color: white;

            padding: 8px 15px;
            border-radius: 5px;

            cursor: pointer;
        }

        /* CONTENT */

        .content {
            padding: 25px;
        }

    </style>

</head>

<body>

<div class="admin-wrapper">

    <!-- SIDEBAR -->

    <aside class="sidebar">

        <div class="logo">
            Yakiniku King
        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('admin.menu.categories.index') }}">
                    Menu Categories
                </a>
            </li>

            <li>
                <a href="{{ route('admin.menu.items.index') }}">
                    Menu Items
                </a>
            </li>

            <li>
                <a href="#">
                    Combo
                </a>
            </li>

            <li>
                <a href="#">
                    Banner
                </a>
            </li>

            <li>
                <a href="#">
                    Khuyến mãi
                </a>
            </li>

            <li>
                <a href="#">
                    Recipes
                </a>
            </li>

            <li>
                <a href="#">
                    Bí kíp ăn ngon
                </a>
            </li>

            <li>
                <a href="#">
                    Nhà hàng
                </a>
            </li>

            <li>
                <a href="#">
                    Đặt bàn
                </a>
            </li>

            <li>
                <a href="#">
                    Leads
                </a>
            </li>

        </ul>

    </aside>


    <!-- MAIN -->

    <main class="main">

        <!-- HEADER -->

        <header class="header">

            <div class="header-title">
                @yield('page-title', 'Dashboard')
            </div>

            <div>

                <span>
                    {{ auth()->user()->name }}
                </span>

                <form
                    action="{{ route('admin.logout') }}"
                    method="POST"
                    style="display:inline;"
                >

                    @csrf

                    <button
                        type="submit"
                        class="logout-btn"
                    >
                        Đăng xuất
                    </button>

                </form>

            </div>

        </header>


        <!-- CONTENT -->

        <section class="content">

            @yield('content')

        </section>

    </main>

</div>

</body>

</html>