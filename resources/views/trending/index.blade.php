<!DOCTYPE html>
<html>

<form method="GET" action="/">
    <input type="text" name="q" placeholder="Cari topik…" value="{{ $q ?? '' }}"
        style="
            width:100%;
            padding:12px;
            border-radius:8px;
            border:none;
            margin-bottom:20px;
        ">
</form>

<head>
    <title>Trashding – Trending</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            background: #0f172a;
            color: #e5e7eb;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .trend {
            background: #020617;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 12px;
            transition: .2s;
        }

        .trend:hover {
            background: #020617dd;
        }

        a {
            color: #38bdf8;
            text-decoration: none;
        }

        .score {
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    <h1>🔥 Trending Indonesia</h1>

    @forelse($trendingTopics as $topic)
        <div class="trend">
            <a href="/topic/{{ $topic->keyword }}">
                <strong>#{{ $topic->keyword }}</strong>
            </a>
            <div class="score">
                {{ $topic->mentions }} mentions · score {{ number_format($topic->score, 2) }}
            </div>
        </div>
    @empty
        <p>Tidak ada data trending.</p>
    @endforelse

</body>

</html>
