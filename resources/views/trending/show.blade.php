<!DOCTYPE html>
<html>

<head>
    <title>#{{ $topic }} – Trashding</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #0f172a;
            color: #e5e7eb;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .card {
            background: #020617;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        a {
            color: #38bdf8;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <a href="/">← Kembali ke Trending</a>

    <h1>#{{ $topic }}</h1>
    <p>Berita terkait topik ini</p>

    @forelse($articles as $article)
        <div class="card">
            <strong>{{ $article->title }}</strong><br>
            <small>{{ strtoupper($article->source) }}</small>
        </div>
    @empty
        <p>Tidak ada berita terkait.</p>
    @endforelse

    <h2>Komentar</h2>

    <form method="POST" action="/topic/{{ $topic }}/comment">
        @csrf
        <textarea name="content" required placeholder="Tulis komentar..." style="width:100%;padding:10px;border-radius:8px"></textarea>
        <button style="margin-top:10px">Kirim</button>
    </form>

    @foreach ($comments as $comment)
        <div class="card">
            <strong>{{ $comment->username ?? 'Anonim' }}</strong><br>
            {{ $comment->content }}
        </div>
    @endforeach


</body>

</html>
