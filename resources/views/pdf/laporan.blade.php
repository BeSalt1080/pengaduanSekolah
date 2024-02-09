<head>
    <style>
        table {
            text-align: center;
            width: 100%;
        }
        table, th, td{
            border: 1px solid;
            border-collapse: collapse;
        }
        th,td{
            padding: 4px;
        }
    </style>
</head>
<body>
    <h1>Tabel Aspirasi</h1>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>
        </tr>
    </thead>
    <?php $keys=1; ?>
    @foreach ($aspirasis as $aspirasi)
    <tr>
        <td>{{ $keys++ }}</td>
        <td>{{ $aspirasi->nis}}</td>
        <td>{{ $aspirasi->kategori->name}}</td>
        <td>{{ $aspirasi->lokasi}}</td>
        <td>{{ $aspirasi->keterangan}}</td>
        <td>{{ $aspirasi->status}}</td>
    </tr>
    @endforeach
</table>
</body>

