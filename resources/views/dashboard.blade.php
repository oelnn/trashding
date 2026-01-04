<!DOCTYPE html>
<html>
<head>
    <title>Trashding - Trending Topic Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #0f172a;
            color: #e5e7eb;
            margin: 0;
            padding: 30px;
        }
        h1 {
            color: #38bdf8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #020617;
        }
        th, td {
            padding: 14px;
            border-bottom: 1px solid #1e293b;
            text-align: left;
        }
        th {
            background: #020617;
            color: #38bdf8;
        }
        tr:hover {
            background: #020617;
        }
        .badge {
            padding: 6px 10px;
            border-radius: 8px;
            background: #1e293b;
            font-size: 12px;
        }
    </style>
</head>
<body>

<h1>📈 Trashding – Trending Topic Indonesia</h1>
<p>Real-time trending dari portal berita nasional</p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Keyword</th>
            <th>Mentions</th>
            <th>Score</th>
            <th>Sumber</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trending as $i => $item)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>#{{ $item->keyword }}</td>
            <td>{{ $item->mentions }}</td>
            <td>{{ $item->score }}</td>
            <td><span class="badge">{{ strtoupper($item->source) }}</span></td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
