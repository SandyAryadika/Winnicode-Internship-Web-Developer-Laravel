@component('mail::message')
    # 📰 Artikel Terbaru dari Winnicode!

    Halo,
    Kami baru saja menerbitkan artikel terbaru yang mungkin menarik untuk Anda.

    ---

    ## 📌 {{ $article->title }}

    {!! \Illuminate\Support\Str::limit(strip_tags($article->content), 100) !!}...

    @component('mail::button', ['url' => url('/artikel/' . $article->id)])
        Baca Artikel
    @endcomponent


    ---

    🔔 Jangan lewatkan informasi terbaru dari kami.
    Terima kasih telah menjadi bagian dari komunitas Winnicode!

    Salam hangat,
    **Tim Winnicode**
@endcomponent
