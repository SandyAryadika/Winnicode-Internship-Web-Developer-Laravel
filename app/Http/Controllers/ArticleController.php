<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewArticleNotification;
use App\Helpers\CacheHelper;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    public function show($id)
    {
        // Ambil artikel lengkap dengan relasi kategori & penulis
        $article = Article::with(['category', 'author'])->findOrFail($id);

        // Tambahkan logika view counter berdasarkan IP + session
        $ip = request()->ip();
        $sessionId = Session::getId();
        $key = "article_{$id}_viewed_by_{$ip}_{$sessionId}";

        if (!Cache::has($key)) {
            $article->increment('views');
            Cache::put($key, true, now()->addMinutes(30));
        }

        // Komentar utama (tanpa parent), paginate dan eager load replies
        $comments = $article->comments()
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->paginate(5);

        // Artikel terkait berdasarkan kategori
        $relatedPosts = Cache::remember("article_{$id}_related", now()->addMinutes(10), function () use ($article) {
            return Article::where('id', '!=', $article->id)
                ->where('category_id', $article->category_id)
                ->latest()
                ->take(4)
                ->get();
        });

        // Artikel lain dari penulis yang sama
        $sameAuthor = Cache::remember("article_{$id}_same_author", now()->addMinutes(10), function () use ($article) {
            return Article::where('author_id', $article->author_id)
                ->where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });

        // Artikel lain dari kategori yang sama
        $sameCategory = Cache::remember("article_{$id}_same_category", now()->addMinutes(10), function () use ($article) {
            return Article::where('category_id', $article->category_id)
                ->where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });

        // Artikel pilihan editor
        $editorChoice = Cache::remember("article_{$id}_editor_choice", now()->addMinutes(10), function () use ($article) {
            return Article::where('is_editor_choice', true)
                ->where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });

        return view('articles.show', compact(
            'article',
            'relatedPosts',
            'sameAuthor',
            'sameCategory',
            'editorChoice',
            'comments'
        ));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        CacheHelper::clearAuthorRelatedCache($article);

        return redirect()->route('articles.show', $id)->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        CacheHelper::clearAuthorRelatedCache($article);

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
