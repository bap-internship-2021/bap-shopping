<?php

namespace App\Http\Controllers\User\Comment;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Http\Requests\User\Comment\CreateCommentRequest;
use App\Http\Requests\User\Comment\CreateParentCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * List comments by product id
     * @param $productId
     * @return mixed
     */
    public static function listCommentsByProduct($productId)
    {
        $comments = Comment::where('product_id', $productId)->where('parent_comment_id', null)->get();
        return $comments;
    }

    public function store(CreateParentCommentRequest $request)
    {
        $data = $request->only(['content', 'product_id']);
        $data['user_id'] = Auth::id();
        Comment::create($data);

        return redirect()->route('user.products.show', ['product' => $request->input('product_id')]);
    }

    public function storeChildComment(CreateCommentRequest $request)
    {
        $data = $request->only(['content', 'parent_comment_id', 'product_id']);
        $data['user_id'] = Auth::id();
        Comment::create($data);

        return redirect()->route('user.products.show', ['product' => $request->input('product_id')]);
    }
}
