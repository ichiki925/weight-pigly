<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeightPigly</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/register2.css') }}" />
</head>

<body>
    <main>
    <div class="register-form">
        <div class="register-form__heading">
        <h1 class="register-form__heading content__heading">PiGLy</h1>
            <h2>新規会員登録</h2>
            <p>STEP2 体重データの入力</p>
        </div>
            <div class="register-form__inner">
                <form class="register-form__form" action="{{ route('register2.store') }}" method="POST">
                @csrf
                <div class="register-form__group">
                    <label for="weight">現在の体重</label>
                    <div class="input-container">
                        <input type="text" id="current_weight" name="current_weight" class="form-control" placeholder="現在の体重を入力" value="{{ old('current_weight') }}" />
                        <span class="kg-label">kg</span>
                    </div>
                    <p class="register-form__error-message">
                    @error('current_weight')
                    {{ $message }}
                    @enderror
                    </p>
                </div>
                <div class="register-form__group">
                    <label for="weight">目標の体重</label>
                    <div class="input-container">
                        <input type="text" id="goal_weigh" name="target_weight" class="form-control" placeholder="目標の体重を入力" value="{{ old('target_weight') }}" />
                        <span class="kg-label">kg</span>
                    </div>
                    <p class="register-form__error-message">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                    </p>
                </div>

                <div class="register-form__buttons">
                    <button type="submit" class="register-form__button">アカウント作成</button>
                </div>
                </form>


            </div>
    </div>

</main>
</body>

</html>
