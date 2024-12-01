<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeightPigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>
    <main>
    <div class="login-form">
        <div class="login-form__heading">
        <h1 class="login-form__heading content__heading">PiGLy</h1>
            <h2>ログイン</h2>

        </div>
            <div class="login-form__inner">
                <form class="login-form__form" action="/login" method="post">
                @csrf
                <div class="login-form__group">
                    <label class="login-form__label" for="email">メールアドレス</label>
                    <input class="login-form__input" type="email" name="email" id="email" placeholder="メールアドレスを入力" value="{{ old('email') }}" />
                    <p class="login-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                    </p>
                </div>
                <div class="login-form__group">
                    <label class="login-form__label" for="password">パスワード</label>
                    <input class="login-form__input" type="password" name="password" id="password" placeholder="パスワードを入力" />
                    <p class="login-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                    </p>
                </div>

                <div class="login-form__buttons">
                    <button type="submit" class="login-form__button">ログイン</button>
                </div>
                </form>
                <div class="login-form__login-link">
                <a href="{{ route('register.show') }}" class="login-form__button--link">アカウント作成はこちら</a>
                </div>
            </div>
    </div>

</main>
</body>

</html>
