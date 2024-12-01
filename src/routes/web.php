<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\WeightController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;




Route::middleware(['auth'])->group(function () {

    Route::post('/weight_logs', [WeightController::class, 'registerData'])->name('weight_logs.store');
    Route::get('/weight_logs/search', [WeightController::class, 'search'])->name('weight_logs.search');
    Route::get('/weight_logs/{id}', [WeightController::class, 'details'])->name('weight_logs.details');
    Route::get('/weight_logs/{id}/edit', [WeightController::class, 'edit'])->name('weight_logs.edit');
    Route::patch('/weight_logs/{id}', [WeightController::class, 'update'])->name('weight_logs.update');
    Route::delete('/weight_logs/{id}', [WeightController::class, 'destroy'])->name('weight_logs.destroy');


    Route::get('/weight_logs/goal_setting', [WeightController::class, 'goalSetting'])->name('goal.setting');
    Route::patch('/weight_logs/goal_setting', [WeightController::class, 'updateGoalSetting'])->name('goal-setting.update');

    Route::post('/logout', function (Request $request) {
    Auth::logout(); // ログアウト処理
    $request->session()->invalidate(); // セッションの無効化
    $request->session()->regenerateToken(); // セッションのトークンを再生成
    return redirect('/login'); // ログイン画面へリダイレクト
})->name('logout');
});


Route::get('/weight_logs', [WeightController::class, 'index'])->name('weight_logs');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [RegisterController::class, 'storeRegisterForm'])->name('register.store');
Route::get('/register2', [RegisterController::class, 'showRegister2Form'])->name('register2.show');
Route::post('/register2', [RegisterController::class, 'storeRegister2Form'])->name('register2.store');



