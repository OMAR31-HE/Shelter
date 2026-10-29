<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'تسجيل الدخول')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Tahoma, Arial, sans-serif;
            background: #17243a;
            color: #253247;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 400px;
            background: white;
            border-radius: 16px;
            padding: 36px 32px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .auth-brand {
            text-align: center;
            margin-bottom: 26px;
        }

        .auth-brand .brand-icon {
            display: inline-flex;
            width: 52px;
            height: 52px;
            align-items: center;
            justify-content: center;
            background: #159a91;
            color: white;
            border-radius: 14px;
            font-size: 26px;
            margin-bottom: 14px;
        }

        .auth-brand h5 {
            margin: 0;
            font-weight: bold;
        }

        .auth-brand p {
            color: #7b8798;
            font-size: 14px;
            margin: 4px 0 0;
        }

        .btn-primary {
            background-color: #159a91;
            border-color: #159a91;
        }

        .btn-primary:hover {
            background-color: #117c75;
            border-color: #117c75;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
