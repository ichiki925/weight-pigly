<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeightPigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register.css') }}" />
</head>

<body>
    <main>
    <div class="register-form">
        <div class="register-form__heading">
        <h1 class="register-form__heading content__heading">PiGLy</h1>
            <h2>新規会員登録</h2>
            <p>STEP1 アカウント情報登録</p>
        </div>
            <div class="register-form__inner">
                <form class="register-form__form" action="/register" method="post">
                @csrf
                <div class="register-form__group">
                    <label class="register-form__label" for="name">お名前</label>
                    <input class="register-form__input" type="text" name="name" id="name" placeholder="名前を入力" value="{{ old('name') }}" />
                    <p class="register-form__error-message">
                    @error('name')
                    {{ $message }}
                    @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <label class="register-form__label" for="email">メールアドレス</label>
                    <input class="register-form__input" type="mail" name="email" id="email" placeholder="メールアドレスを入力" value="{{ old('email') }}" />
                    <p class="register-form__error-message">
                    @error('email')
                    {{ $message }}
                    @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <label class="register-form__label" for="password">パスワード</label>
                    <input class="register-form__input" type="password" name="password" id="password" placeholder="パスワードを入力" value="{{ old('password') }}" />
                    <p class="register-form__error-message">
                    @error('password')
                    {{ $message }}
                    @enderror
                    </p>
                </div>
                <div class="register-form__buttons">
                        <button type="submit" class="register-form__button">次へ進む</button>
                </div>
                </form>

                <div class="register-form__login-link">
                <a href="{{ route('login') }}" class="register-form__button--link">ログインはこちら</a>
                </div>
            </div>
    </div>

</main>
</body>

</html>
