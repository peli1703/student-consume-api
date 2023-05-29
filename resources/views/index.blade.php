<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume Rest Api Student</title>
</head>
<body>
    <h1 style="text-align: center;">Ini Data Siswa Bro</h1>
    <form action="" method="GET" style="margin-left:76%">
        @csrf
        <input type="text" name="search" placeholder="cari berdasarkan nama ...">
        <button class="button-17" role="button" style="margin-left:5px;margin-top: -0.1px">Seacrh</button>
        <button class="button-17" role="button">Refresh</button>
    </form>

    <a href="{{(route('add'))}}"> Tambah Data Baru </a>
    <a href="{{(route('trash'))}}"> Lihat data dihapus</a>
    @if (Session::get('success'))
    <p style="color:green">{{Session::get('success')}}</p>
    @endif
    @foreach ($students as $student)
    <ol>
        <li> NIS : {{$student['nis_siswa']}}</li>
        <li> Nama : {{$student['nama']}}</li>
        <li> Rombel : {{$student['rombel']}}</li>
        <li> Rayon : {{$student['rayon']}}</li>
        <li> Aksi : <a href="{{route('edit', $student['id'])}}">Edit</a>|| 
        <form action="{{route('delete', $student['id'])}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit"> Hapus</button>
        </form>
        </li>
    </ol> 
    @endforeach
</body>
</html>