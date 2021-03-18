<?php

use App\Http\Controllers\ContractController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MailsController;
use App\Http\Controllers\NewsController;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('news',NewsController::class);
Route::post('restore/{id}',[MailsController::class,'restore'])->name('mailbox.restore');
Route::post('movetoFolder/{id}',[MailsController::class,'movetoFolder'])->name('mailbox.movetoFolder');
Route::post('moveToTrash/{id}',[MailsController::class,'moveToTrash'])->name('mailbox.moveToTrash');
Route::post('reply/{id}',[MailsController::class,'reply'])->name('mailbox.reply');
Route::post('forward/{id}',[MailsController::class,'forward'])->name('mailbox.forward');
Route::post('addfolders',[MailsController::class,'addfolders'])->name('mailbox.addfolders');
Route::post('deletefolder',[MailsController::class,'deletefolder'])->name('mailbox.deletefolder');
Route::post('msgcount',[MailsController::class,'msgcount'])->name('mailbox.msgcount');
Route::post('changelayout',[MailsController::class,'changelayout'])->name('mailbox.changelayout');
Route::resource('mailbox',MailsController::class);
Route::post('adddocument',[DocumentController::class,'adddocument'])->name('documents.adddocument');
Route::get('/download/{user}/{file}',[DocumentController::class,'get_file'])->name('documents.get_path');
Route::delete('deletedoc/{id}/{file}',[DocumentController::class,'deletedoc'])->name('documents.deletedoc');
Route::resource('documents',DocumentController::class);
Route::resource('contracts',ContractController::class);
