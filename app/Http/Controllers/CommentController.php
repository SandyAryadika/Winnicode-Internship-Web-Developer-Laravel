<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $article->comments()->create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'content' => $request->input('content'),
            'parent_id' => $request->input('parent_id'),
        ]);

        session(['comment_email' => $request->input('email')]);

        \App\Helpers\CacheHelper::clearCommentRelatedCache($article);

        return back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function destroy(Comment $comment)
    {
        $sessionEmail = session('comment_email');

        if ($comment->email && $comment->email === $sessionEmail) {
            $comment->delete();
            return back()->with('success', 'Komentar berhasil dihapus.');
        }

        return back()->with('error', 'Anda tidak diizinkan menghapus komentar ini.');
    }
}
