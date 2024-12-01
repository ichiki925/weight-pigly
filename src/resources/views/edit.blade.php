    @extends('layouts/app')

    @section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=delete" />
    <link href="{{ asset('css/edit.css') }}" rel="stylesheet">
    @endsection

    @section('content')
    <main>
    <div class="edit-form">
        <div class="edit-form__heading">
            <h2>Weight Log</h2>
        </div>
        <form action="{{ route('weight_logs.update', $weightLog->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="edit-form__group">
                <label for="date">日付</label>
                <div class="input-container">
                    <input type="date" id="date" name="date" value="{{ old('date', $weightLog->date) }}" />
                </div>
                <p class="edit-form__error-message">
                    @error('date')
                    {{ $message }}
                    @enderror
                    </p>

            </div>
            <div class="edit-form__group">
                <label for="weight">体重</label>
                <div class="input-container weight-input">
                    <input type="number" id="weight" name="weight" step="0.1" placeholder="例: 50.0" value="{{ old('weight', $weightLog->weight) }}" />
                    <span class="kg-label">kg</span>
                </div>
                <p class="edit-form__error-message">
                    @error('weight')
                    {{ $message }}
                    @enderror
                    </p>

            </div>
            <div class="edit-form__group">
                <label for="calories">摂取カロリー</label>
                <div class="input-container calories-input">
                    <input type="number" id="calories" name="calories" placeholder="例: 2000" value="{{ old('calories', $weightLog->calories_intake) }}" />
                    <span class="cal-label">cal</span>
                </div>
                <p class="edit-form__error-message">
                    @error('calories')
                    {{ $message }}
                    @enderror
                    </p>

            </div>
            <div class="edit-form__group">
                <label for="exercise_time">運動時間</label>
                <div class="input-container">
                    <input type="time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time', $weightLog->exercise_time) }}" />
                </div>
                <p class="edit-form__error-message">
                    @error('exercise_time')
                    {{ $message }}
                    @enderror
                    </p>

            </div>
            <div class="edit-form__group">
                <label for="exercise_content">運動内容</label>
                <div class="input-container">
                    <textarea id="exercise_content" name="exercise_content" rows="3" placeholder="運動内容を追加">{{ old('exercise_content', $weightLog->exercise_content) }}</textarea>
                </div>
                <p class="edit-form__error-message">
                    @error('exercise_content')
                    {{ $message }}
                    @enderror
                    </p>

            </div>
            <div class="edit-form__buttons">
                <div class="edit-form__button-group">
                    <a href="/weight_logs" class="edit-form__button edit-form__button--back">戻る</a>
                    <button type="submit" class="edit-form__button edit-form__button--update">
                        更新
                    </button>
                </div>
                <div class="edit-form__delete-container">
                    <form action="{{ route('weight.destroy', $weightLog->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-icon">
                            <span class="material-symbols-outlined">delete</span>
                        </button>
                    </form>
                </div>
            </div>

        </form>
    </div>
</main>
@endsection




