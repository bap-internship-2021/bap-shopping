<?php

use App\Http\Controllers\User\Comment\CommentController;
use Illuminate\Support\Facades\Route;
use App\Models\Comment;

Route::resource('comments', CommentController::class);
Route::post('comments/child-comment', [CommentController::class, 'storeChildComment'])->name('child.comments.store');
Route::get('test/comment', function () {

});
