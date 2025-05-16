<?php

namespace App\Http\Controllers\Comment;


use App\Http\Requests\Comment\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use App\Services\Comment\CommentService;
use Illuminate\Http\Request;

class CommentController {
    public $commenService;

    public function __construct(CommentService $commenService) {
        $this->commenService = $commenService;
    }

    public function index(string $id) {
        return $this->commenService->index($id);
    }

    public function store(CommentRequest $request, string $productId) {
        return $this->commenService->store($request, $productId);
    }

    public function destroy(Request $request, string $commentId) {
        return $this->commenService->destroy($request, $commentId);
    }

    public function update(CommentRequest $request, string $commentId) {
        return $this->commenService->update($request, $commentId);
    }
}
