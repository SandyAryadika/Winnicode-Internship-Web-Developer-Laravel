<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Subscriber;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewArticleNotification;
use App\Helpers\CacheHelper;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::with(['category', 'author'])
            ->withCount('comments')
            ->findOrFail($id);

        $relatedPosts = Cache::remember("article_{$id}_related", now()->addMinutes(30), function () use ($article) {
            return Article::where('id', '!=', $article->id)
                ->where('category_id', $article->category_id)
                ->latest()
                ->take(4)
                ->get();
        });


        $sameAuthor = Cache::remember("article_{$id}_same_author", now()->addMinutes(30), function () use ($article) {
            return Article::where('author_id', $article->author_id)
                ->where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });

        $sameCategory = Cache::remember("article_{$id}_same_category", now()->addMinutes(30), function () use ($article) {
            return Article::where('category_id', $article->category_id)
                ->where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });

        $editorChoice = Cache::remember("article_{$id}_editor_choice", now()->addMinutes(30), function () use ($article) {
            return Article::where('is_editor_choice', true)
                ->where('id', '!=', $article->id)
                ->where('status', 'published')
                ->latest()
                ->take(5)
                ->get();
        });

        // $subscribers = Subscriber::all();
        // foreach ($subscribers as $subscriber) {
        //     Notification::route('mail', 'admin@example.com')
        //         ->notify(new NewArticleNotification($article));
        // }

        return view('articles.show', compact('article', 'relatedPosts', 'sameAuthor', 'sameCategory', 'editorChoice'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        // Bersihkan semua cache terkait penulis dan artikel
        CacheHelper::clearAuthorRelatedCache($article);

        return redirect()->route('articles.show', $id)->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        // Bersihkan semua cache terkait penulis dan artikel
        CacheHelper::clearAuthorRelatedCache($article);

        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
