<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;
use App\Models\Article;

class CacheHelper
{
    public static function clearArticleCache(Article $article)
    {
        Cache::forget("article_{$article->id}_related");
        Cache::forget("article_{$article->id}_same_author");
        Cache::forget("article_{$article->id}_same_category");
        Cache::forget("article_{$article->id}_editor_choice");

        self::clearLandingCache();
        self::clearSearchCache();
    }

    public static function clearAuthorCache($authorId, $maxPages = 5)
    {
        Cache::forget("author_{$authorId}_info");

        for ($page = 1; $page <= $maxPages; $page++) {
            Cache::forget("author_{$authorId}_articles_page_{$page}");
        }

        self::clearLandingCache();
        self::clearSearchCache();
    }

    public static function clearCategoryCache($categoryId, $maxPages = 5)
    {
        Cache::forget("category_{$categoryId}_detail");
        Cache::forget("category_{$categoryId}_top_authors");
        Cache::forget("category_{$categoryId}_related_categories");

        for ($page = 1; $page <= $maxPages; $page++) {
            Cache::forget("category_{$categoryId}_articles_page_{$page}");
        }

        self::clearLandingCache();
        self::clearSearchCache();
    }

    public static function clearAuthorRelatedCache(Article $article)
    {
        self::clearAuthorCache($article->author_id);
        self::clearArticleCache($article);
    }

    public static function clearCommentRelatedCache(Article $article)
    {
        self::clearArticleCache($article);
        self::clearAuthorCache($article->author_id);
        self::clearCategoryCache($article->category_id);
    }

    public static function clearLandingCache()
    {
        Cache::forget('landing_berita_hangat');
        Cache::forget('landing_berita_utama');
        Cache::forget('landing_artikel_sorotan');
        Cache::forget('landing_editor_choice');
        Cache::forget('landing_top_contributors');
        Cache::forget('landing_internasional');
        Cache::forget('landing_rekomendasi');
    }

    public static function clearSearchCache()
    {
        // Karena kunci search bersifat dinamis (pakai md5), maka tidak bisa dihapus satu per satu.
        // Solusi: Gunakan tag atau prefix cache dengan driver seperti Redis atau gunakan queue/cache warming.
        // Untuk sementara, abaikan ini atau catat keyword yang umum dan hapus manual bila perlu.
    }

    public static function clearSubscriberCache()
    {
        self::clearLandingCache();
    }
}
