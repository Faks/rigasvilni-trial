<?php

declare(strict_types=1);

use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Result\ResultController;
use App\Http\Controllers\UserAnswer\UserAnswersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home', Str::uuid());
})
    ->name('game.reset');

Route::group([
    'prefix' => '{gameUuid}'
], function () {
    Route::get('/', [HomeController::class, '__invoke'])
        ->name('home');

    Route::get('/results', [ResultController::class, '__invoke'])
        ->name('results');

    Route::resource('/user-answers', UserAnswersController::class)
        ->only(['store']);
});
