<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Notifications\NewArticleNotification;

class ArticleController extends Controller
{
    public function show($id)
    {
        $article = Article::with(['category', 'author'])->findOrFail($id);

        $relatedPosts = Article::where('id', '!=', $article->id)
            ->where('category_id', $article->category_id)
            ->latest()
            ->take(4)
            ->get();

        $sameAuthor = Article::where('author_id', $article->author_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $sameCategory = Article::where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $editorChoice = Article::where('is_editor_choice', true)
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            Notification::route('mail', $subscriber->email)->notify(new NewArticleNotification($article));
        }

        return view('articles.show', compact('article', 'relatedPosts', 'sameAuthor', 'sameCategory', 'editorChoice'));
    }
}
