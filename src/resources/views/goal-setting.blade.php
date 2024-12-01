@extends('layouts/app')

@section('css')
    <link href="{{ asset('css/goal-setting.css') }}" rel="stylesheet">
@endsection

@section('content')
    <main>
    <div class="register-form">
        <div class="register-form__heading">

            <h2>目標体重設定</h2>
        </div>
            <div class="setting-form__inner">
                <form class="setting-form__form" action="/weight_logs/goal_setting" method="post">
                @method('PATCH')
                @csrf
                <div class="setting-form__group">

                    <div class="input-container">
                        <input type="text" id="weight" name="target_weight" class="form-control" placeholder="目標の体重を入力" value="{{ old('target_weight') }}" />
                        <span class="kg-label">kg</span>
                    </div>
                    <p class="setting-form__error-message">
                    @error('target_weight')
                    {{ $message }}
                    @enderror
                    </p>
                </div>

                <div class="setting-form__buttons">
                    <a href="/weight_logs" class="setting-form__button setting-form__button--back">戻る</a>
                    <button type="submit" class="setting-form__button setting-form__button--update">更新</button>
                </div>
                </form>


            </div>
    </div>

</main>
@endsection

