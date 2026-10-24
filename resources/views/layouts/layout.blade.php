<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'مرحبا بالايواء')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            background: #f4f7fb;
            color: #253247;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            right: 0;
            background: #17243a;
            color: white;
            padding: 24px 16px;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .brand {
            padding: 8px 10px 25px;
            border-bottom: 1px solid #344158;
            margin-bottom: 22px;
        }

        .brand-icon {
            display: inline-flex;
            width: 43px;
            height: 43px;
            align-items: center;
            justify-content: center;
            background: #159a91;
            border-radius: 12px;
            font-size: 23px;
            margin-left: 9px;
        }

        .brand h5 {
            display: inline-block;
            font-size: 15px;
            margin: 0;
            line-height: 1.8;
            vertical-align: middle;
        }

        .menu-title {
            color: #a8b5c9;
            font-size: 12px;
            margin: 22px 12px 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #d5deeb;
            padding: 13px 14px;
            margin-bottom: 5px;
            border-radius: 9px;
            font-size: 14px;
        }

        .sidebar a i {
            font-size: 18px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #159a91;
            color: white;
        }

        .main {
            margin-right: 250px;
            min-height: 100vh;
        }

        .topbar {
            height: 76px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 1px solid #e8edf4;
        }

        .topbar h6 {
            margin: 0;
            font-weight: bold;
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #dff5f1;
            color: #13877f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .content {
            padding: 30px;
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h4 {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .page-heading p {
            color: #7b8798;
            font-size: 14px;
            margin: 0;
        }

        .stat-card {
            background: white;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            padding: 22px;
            height: 100%;
            box-shadow: 0 4px 15px rgba(30, 50, 80, 0.03);
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 18px;
        }

        .stat-card p {
            color: #7b8798;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .stat-card h3 {
            font-size: 28px;
            font-weight: bold;
            margin: 0;
        }

        .panel {
            background: white;
            padding: 24px;
            border-radius: 14px;
            border: 1px solid #edf0f5;
            margin-top: 25px;
        }

        .panel h5 {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .menu-toggle {
            display: none;
            background: none;
            border: 0;
            font-size: 25px;
        }

        .overlay {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
                width: 260px;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main {
                margin-right: 0;
            }

            .topbar {
                padding: 0 16px;
                height: 66px;
            }

            .menu-toggle {
                display: inline-block;
            }

            .content {
                padding: 20px 14px;
            }

            .profile-name {
                display: none;
            }

            .overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 999;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- القائمة الجانبية -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <span class="brand-icon">
                <i class="bi bi-houses-fill"></i>
            </span>
            <h5>إدارة مراكز<br>الإيواء</h5>
        </div>

        <div class="menu-title">القائمة الرئيسية</div>

        <a href="{{ url('/dashboard') }}"
            class="{{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            لوحة التحكم
        </a>

        <a href="{{ url('/families') }}"
            class="{{ request()->is('families*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            الأسر المسجلة
        </a>

        <a href="{{ url('/individuals') }}"
            class="{{ request()->is('individuals*') ? 'active' : '' }}">
            <i class="bi bi-person-vcard"></i>
            الأفراد
        </a>

        
        <a href="{{ url('/needs') }}"
            class="{{ request()->is('needs*') ? 'active' : '' }}">
            <i class="bi bi-clipboard-check"></i>
            <span>متابعة الاحتياجات</span>
        </a>

        <a href="{{ url('/activity') }}"
            class="{{ request()->is('activity*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
           <span>سجل النشاط</span>
        </a>

        <div class="menu-title">إدارة المركز</div>

        <a href="{{ url('/arrivals') }}">
            <i class="bi bi-box-arrow-in-left"></i>
            الوصول والمغادرة
        </a>

        <a href="{{ url('/needs') }}">
            <i class="bi bi-box-seam"></i>
            الاحتياجات
        </a>

        <a href="{{ url('/facilities') }}">
            <i class="bi bi-building"></i>
            مرافق المركز
        </a>

        <a href="{{ url('/reports') }}">
            <i class="bi bi-bar-chart"></i>
            التقارير
        </a>

        <div class="menu-title">الحساب</div>

        <a href="{{ url('/profile') }}">
            <i class="bi bi-person-circle"></i>
            الملف الشخصي
        </a>

    </aside>

    <!-- محتوى الموقع -->
    <div class="main">

        <header class="topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="menu-toggle"
                    onclick="toggleSidebar()"
                    aria-label="فتح القائمة">
                    <i class="bi bi-list"></i>
                </button>

                <h6>@yield('header', 'لوحة التحكم')</h6>
            </div>

            <div class="profile">
                <div class="avatar">
                    <i class="bi bi-person"></i>
                </div>

                <div class="profile-name">
                    <strong>مدير المركز</strong>
                    <div class="text-secondary small">إدارة النظام</div>
                </div>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('overlay').classList.toggle('show');
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>
