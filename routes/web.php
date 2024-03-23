<?php

use App\Http\Controllers\categoryBoardController;
use App\Http\Controllers\contentController;
use App\Http\Controllers\digitalBoardController;
use App\Http\Controllers\divisi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login;
use App\Http\Controllers\home;
use App\Http\Controllers\jenis_mesin;
use App\Http\Controllers\mesin;
use App\Http\Controllers\pointCheck;
use App\Http\Controllers\user;
use App\Http\Controllers\schedule;
use App\Http\Controllers\trouble;
use App\Models\categoryBoard;
use App\Models\contentBoard;
use App\Models\m_mesin;
use Illuminate\Http\Request;

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

Route::get('/', [login::class, 'index']);
Route::get('/dashboard', [home::class, 'index']);
//login
Route::post('/auth_login', [login::class, 'login']);
Route::get('/logout', [login::class, 'logout']);
//mesin
Route::get('/mesin', [mesin::class, 'index']);
Route::get('/displayMachine', function () {
    $judul = "Display Machine";

    return view('/digitalBoard/display/v_mesin', [
        'judul' => $judul,
    ]);
});
Route::get('/json_mesin',  [mesin::class, 'json']);
Route::post('/store_mesin', [mesin::class, 'store']);
Route::post('/edit_mesin', [mesin::class, 'edit']);
Route::put('/update_mesin/{id}', [mesin::class, 'update']);
Route::delete('/delete_mesin/{id}', [mesin::class, 'destroy']);
//divisi
Route::get('/divisi', [divisi::class, 'index']);
Route::get('/json_divisi',  [divisi::class, 'json']);
Route::post('/store_divisi', [divisi::class, 'store']);
Route::post('/edit_divisi', [divisi::class, 'edit']);
Route::put('/update_divisi/{id}', [divisi::class, 'update']);
Route::delete('/delete_divisi/{id}', [divisi::class, 'destroy']);
//jenisMesin
Route::get('/jenisMesin', [jenis_mesin::class, 'index']);
Route::get('/json_jenisMesin',  [jenis_mesin::class, 'json']);
Route::post('/store_jenisMesin', [jenis_mesin::class, 'store']);
Route::post('/edit_jenisMesin', [jenis_mesin::class, 'edit']);
Route::put('/update_jenisMesin/{id}', [jenis_mesin::class, 'update']);
Route::delete('/delete_jenisMesin/{id}', [jenis_mesin::class, 'destroy']);
//pointCheck
Route::get('/pointCheck', [pointCheck::class, 'index']);
Route::get('/json_pointCheck',  [pointCheck::class, 'json']);
Route::post('/store_pointCheck', [pointCheck::class, 'store']);
Route::post('/edit_pointCheck', [pointCheck::class, 'edit']);
Route::put('/update_pointCheck/{id}', [pointCheck::class, 'update']);
Route::delete('/delete_pointCheck/{id}', [pointCheck::class, 'destroy']);
//user
Route::get('/user', [user::class, 'index']);
Route::get('/json_user',  [user::class, 'json']);
Route::post('/store_user', [user::class, 'store']);
Route::post('/edit_user', [user::class, 'edit']);
Route::put('/update_user/{id}', [user::class, 'update']);
Route::delete('/delete_user/{id}', [user::class, 'destroy']);
//schedule
Route::get('/schedule', [schedule::class, 'index']);
Route::get('/json_schedule',  [schedule::class, 'json']);
Route::post('/store_schedule', [schedule::class, 'store']);
Route::post('/select_mesin', [schedule::class, 'mesin']);
Route::post('/search_pcheck', [schedule::class, 'pcheck']);
Route::post('/update_schedule', [schedule::class, 'update']);
Route::put('/delete_schedule/{id}', [schedule::class, 'destroy']);
Route::get('/print_spk/{id}', [schedule::class, 'spk']);
//schedule
Route::get('/trouble', [trouble::class, 'index']);
Route::get('/json_trouble',  [trouble::class, 'json']);
Route::post('/store_trouble', [trouble::class, 'store']);
Route::post('/select_mesin', [trouble::class, 'mesin']);
Route::put('/update_trouble/{id}', [trouble::class, 'update']);
Route::put('/delete_trouble/{id}', [trouble::class, 'destroy']);
//digital dashboard production
Route::get('/digitalProduction/{mesin}', [digitalBoardController::class, 'index']);
//show content
Route::get('/showContentBoard/{content}', function (Request $request) {
    $mesin = m_mesin::where('kode_mesin', $request->query('mesin'))->first();
    $content = contentBoard::find($request->query('content'));

    return view('/digitalBoard/v_contentDigital', [
        'content' => $content->directory,
        'mesin' => $mesin
    ]);
});


//categoryBoard
Route::get('/categoryBoard', [categoryBoardController::class, 'index']);
Route::get('/json_categoryBoard',  [categoryBoardController::class, 'json']);
Route::post('/store_categoryBoard', [categoryBoardController::class, 'store']);
Route::post('/select_categoryBoard', [categoryBoardController::class, 'edit']);
Route::post('/update_categoryBoard', [categoryBoardController::class, 'store']);
Route::delete('/delete_categoryBoard/{id}', [categoryBoardController::class, 'destroy']);
//contentBoard
Route::get('/contentBoard', [contentController::class, 'index']);
Route::get('/json_contentBoard',  [contentController::class, 'json']);
Route::post('/store_contentBoard', [contentController::class, 'store']);
Route::post('/select_contentBoard', [contentController::class, 'edit']);
Route::post('/update_contentBoard', [contentController::class, 'store']);
Route::delete('/delete_contentBoard/{id}', [contentController::class, 'destroy']);
Route::post('/get_contentBoard', [contentController::class, 'get_contentBoard']);
