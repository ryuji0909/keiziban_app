<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\TrustVoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserListController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();
Route::group(['middleware' => 'auth'], function() {
    // 一般ユーザー
    // 一般ユーザー向けのルート定義
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); //ログアウト
    Route::get('/topichome', [TopicController::class, 'create'])->name('user.topichome')->middleware('userType:0'); //ユーザートップ画面の表示
    Route::post('/topic/store', [TopicController::class, 'store'])->name('topic.store')->middleware('userType:0'); //ユーザートップ画面でバリデーションを行う
    Route::get('/topic/{id}', [TopicController::class, 'show'])->name('topic.show')->middleware('userType:0'); //コメント一覧遷移
    Route::get('/topic/edit/{id}', [TopicController::class, 'edit'])->name('topic.edit')->middleware('userType:0'); //コメント一覧遷移
    Route::put('/topic/update/{id}', [TopicController::class, 'update'])->name('topic.update')->middleware('userType:0'); //コメント一覧遷移
    Route::delete('topic/destroy/{id}', [TopicController::class, 'destroy'])->name('user.destroy'); //投稿の削除
    Route::get('/commentcreate/{id}', [CommentController::class, 'commentcreate'])->name('user.commentcreate')->middleware('userType:0'); //コメント作成画面遷移
    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store')->middleware('userType:0'); //コメント作成画面でコメントを作成し、コメント一覧に遷移させる。
    Route::delete('comment/destroy/{id}', [CommentController::class, 'destroy'])->name('comment.destroy'); //投稿のコメント削除
    Route::post('/topics/{topic}/highlight', [HighlightController::class, 'create'])->name('highlights.create')->middleware('userType:0');
    Route::get('/highlight', [HighlightController::class, 'index'])->name('highlight.index')->middleware('userType:0');
    Route::post('/highlight/store/{id}', [HighlightController::class, 'store'])->name('highlight.store')->middleware('userType:0'); //ユーザートップ画面でバリデーションを行う
     // コメントへのアップボート・ダウンボート
    Route::post('/comments/{commentid}/vote', [TrustVoteController::class, 'vote'])->middleware('userType:0');
    Route::get('/report/{id}', [ReportController::class, 'create'])->name('reports.create')->middleware('userType:0');
    Route::post('/report/store', [ReportController::class, 'store'])->name('report.store')->middleware('userType:0');
    
    
    // 管理者ユーザー向けのルート定義
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('userType:1');
    Route::delete('dashboard/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy'); //投稿のコメント削除
    Route::get('/userlist', [UserListController::class, 'index'])->name('userlist.index')->middleware('userType:1');
    Route::delete('userlist/destroy/{id}', [UserListController::class, 'destroy'])->name('userlist.destroy'); //ユーザーの削除
    Route::get('/report', [ReportController::class, 'index'])->name('reports.index')->middleware('userType:1');
    // Route::get('/topics/{topic}/comments', [AdminController::class, 'showComments'])->name('admin.comments')->middleware('userType:1');
    // Route::get('/reports', [AdminController::class, 'showReports'])->name('admin.reports')->middleware('userType:1');
    // Route::get('/users', [AdminController::class, 'manageUsers'])->name('admin.users')->middleware('userType:1');
    
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('auth.register'); //新規登録画面表示
Route::post('/store', [RegisteredUserController::class, 'store'])->name('auth.store'); //新規登録画面の処理
