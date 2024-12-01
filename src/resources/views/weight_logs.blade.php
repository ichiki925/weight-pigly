    @extends('layouts/app')

    @section('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=edit" />
    <link rel="stylesheet" href="{{ asset('css/weight_logs.css') }}" >
    <link rel="stylesheet" href="{{ asset('css/admin.css')}}">
    @endsection

    @section('content')
    <main>

        <div class="container">
            <div class="header">
                <table class="goal-table">
                    <tr>
                        <th>目標体重</th>
                        <th>目標まで</th>
                        <th>現在体重</th>
                    </tr>
                    <tr>
                        <td><span class="number">{{ $targetWeight ?? 'N/A' }}</span><span class="unit">kg</span></td>
                        <td><span class="number">{{ $remainingWeight ?? 'N/A' }}</span><span class="unit">kg</span></td>
                        <td><span class="number">{{ $currentWeight ?? 'N/A' }}</span><span class="unit">kg</span></td>

                    </tr>
                </table>
            </div>



            <section class="search-section">

                <form class="search-form" action="{{ route('weight_logs.search') }}" method="GET">
                    @csrf
                    <div class="date-inputs">
                        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">
                        <label for="end_date">〜</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
                        <button type="submit" class="btn-search">検索</button>
                        @if(request('start_date') || request('end_date'))
                            <a href="{{ route('weight_logs') }}" class="btn-reset">リセット</a>
                        @endif
                    </div>
                    <div class="add-button">
                        <a href="#modal-create" class="add-data-button">データを追加</button>
                    </div>

                </form>


            @if($searchResults && $searchResults->count())
                <div class="search-results">
                    <p>{{ $searchCondition }}の検索結果 {{ $searchResults->count() }}件</p>
                </div>
            @elseif(isset($searchResults))
                <div class="search-results">
                    <p>{{ $searchCondition }}の検索結果 0件</p>
                </div>
            @endif

            <div class="data-table">
            @if($weightLogs->count())
                <table>
                    <thead>
                        <tr>
                            <th>日付</th>
                            <th>体重</th>
                            <th>摂取カロリー</th>
                            <th>運動時間</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($weightLogs as $weightlog)
                            <tr>
                                <td>{{ $weightlog->date }}</td>
                                <td>{{ $weightlog->weight }} kg</td>
                                <td>{{ $weightlog->calories }} kcal</td>
                                <td>{{ $weightlog->exercise_time }}</td>
                                <td><a class="material-symbols-outlined" href="{{ route('weight_logs.edit', $weightlog->id) }}">✏️</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $weightLogs->links() }}
                @else
                    <p>表示できるデータがありません</p>
            @endif

            </div>
            </section>
        </div>





        <div class="modal" id="modal-create">
            <a href="#!" class="modal-overlay"></a>
            <div class="modal__inner">
                <div class="modal-form__heading">
                    <h2>Weight Logを追加</h2>
                </div>
                <form class="modal__create-form" action="{{ route('weight_logs.store') }}" method="POST">
                    @csrf
                <div class="modal-form__group">
                    <div class="label-container">
                        <label for="date">日付</label>
                        <span class="required-label">必須</span>
                    </div>
                    <div class="input-container">
                        <input type="date" id="date" name="date" value="{{ old('date') }}">
                    </div>
                    <p class="modal-form__error-message">
                        @error('date')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="modal-form__group">
                    <div class="label-container">
                        <label for="weight">体重</label>
                        <span class="required-label">必須</span>
                    </div>
                    <div class="input-container weight-input">
                        <input type="number" id="weight" name="weight" value="{{ old('weight') }}" step="0.1">
                        <span class="kg-label">kg</span>
                    </div>
                    <p class="modal-form__error-message">
                        @error('weight')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="modal-form__group">
                    <div class="label-container">
                        <label for="calories">摂取カロリー</label>
                        <span class="required-label">必須</span>
                    </div>
                    <div class="input-container calories-input">
                        <input type="number" id="calories" name="calories" value="{{ old('calories') }}">
                        <span class="cal-label">cal</span>
                    </div>
                    <p class="modal-form__error-message">
                        @error('calories')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="modal-form__group">
                    <div class="label-container">
                        <label for="exercise_time">運動時間</label>
                        <span class="required-label">必須</span>
                    </div>
                    <div class="input-container">
                        <input type="time" id="exercise_time" name="exercise_time" value="{{ old('exercise_time') }}">
                    </div>
                    <p class="modal-form__error-message">
                        @error('exercise_time')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="modal-form__group">
                    <label for="exercise_content">運動内容</label>
                    <div class="input-container">
                        <textarea id="exercise_content" name="exercise_content">{{ old('exercise_content') }}</textarea>
                    </div>
                    <p class="modal-form__error-message">
                        @error('exercise_content')
                        {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="modal-form__buttons">
                    <div class="modal-form__button-group">
                        <a href="#close-modal" class="modal-form__button modal-form__button--back">戻る</a>
                        <button type="submit" class="modal-form__button modal-form__button--create">
                            登録
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </main>
    @endsection


