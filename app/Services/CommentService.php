<?php

namespace App\Services;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentService {
    public function index(string $id) {
        $product = Product::find($id);

        return response()->json($product->comments()->get());
    }

    public function store(CommentRequest $request, string $productId) {
        $validateComment = $request->validated();
        $userId = $request->user()->id;
        $text = $validateComment['text'];
        $product = Product::find($productId);

        if ($product) {
            $newComment = Comment::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'text' => $text
            ]);

            return response()->json(new CommentResource ($newComment->fresh()));
        }

        return response()->json(['message' => "Product {$productId} not found"], 404);
    }

    public function destroy(Request $request, string $commentId) {
        $comment = Comment::find($commentId);

        if ($comment) {
            $comment = $comment->delete();

            return response()->json(['message' => 'success remove']);
        }

        return response()->json(['message' => "Comment {$commentId} not found"], 404);
    }

    public function update(CommentRequest $request, string $commentId) {
        $validated = $request->validated();
        $comment = Comment::find($commentId);

        if ($comment) {
            $comment->update(['text' => $validated['text']]);

            return response()->json(new CommentResource($comment->fresh()));
        }

        return response()->json(['message' => "Comment {$commentId} not found"], 404);
    }
}
