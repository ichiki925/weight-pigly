<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="app">
    <header class="header">
        <div class="logo">
            <span class="logo-text">PiGLy</span>
        </div>
        @if (Auth::check())
        <nav class="nav-buttons">
            <a href="{{ route('goal.setting') }}" class="nav-link goal-link">
            <span class="material-icons">settings</span> 目標体重設定
            </a>
            <form method="post" action="{{ route('logout') }}" style="display: inline;">
            @csrf
            <button type="submit" class="nav-link logout-link">
                <span class="material-icons">exit_to_app</span> ログアウト
            </button>
            </form>
        </nav>
        @endif
        @yield('link')
    </header>
    <div class="content">
        @yield('content')
    </div>
</div>
</body>
</html>
