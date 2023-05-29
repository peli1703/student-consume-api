<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SHOW TRASH</title>
</head>
<body>
    @if (Session::get('success'))
    <p style="color:green">{{Session::get('success')}}</p>
    @endif
    <a href="/">back</a>
    @foreach ($trash as $show)
    <ol>
        <li> NIS : {{$show['nis_siswa']}}</li>
        <li> Nama : {{$show['nama']}}</li>
        <li> Rombel : {{$show['rombel']}}</li>
        <li> Rayon : {{$show['rayon']}}</li>
        <li>Tanggal Dihapus : {{\Carbon\Carbon::parse($show['deleted_at'])->format('j F,Y')}}</li>
        <li> Aksi : <a href="{{route('restore', $show['id'])}}">Restore</a></li>
        <li>
            <a href="{{route('permanen', $show['id'])}}"> Delete Permanen</a>
        </li>
    </ol> 
    @endforeach
</body>
</html>