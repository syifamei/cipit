<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Laporan Pengaduan</title>

<style>

body{
font-family: Arial, sans-serif;
font-size:12px;
}

.header{
text-align:center;
border-bottom:3px solid black;
padding-bottom:10px;
margin-bottom:20px;
position:relative;
}

.logo-kiri{
position:absolute;
left:0;
top:10px;
width:70px;
}

.logo-kanan{
position:absolute;
right:0;
top:10px;
width:70px;
}

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

table, th, td{
border:1px solid black;
}

th, td{
padding:6px;
}

th{
background:#eeeeee;
}

</style>

</head>
<body>

<div class="header">

<img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('logo-kiri.jpg'))) }}" class="logo-kiri">

<img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('logo-kanan.jpg'))) }}" class="logo-kanan">

<h1>PEMERINTAH KOTA BOGOR</h1>
<h1>BAPPERIDA</h1>
<h4>Jl. Kapten Muslihat No.21 - Bogor 16121</h4>

</div>

<table>

<thead>

<tr>
<th>No</th>
<th>Nama</th>
<th>Jenis Layanan</th>
<th>Judul</th>
<th>Isi Pengaduan</th>
<th>Status</th>
<th>Tanggal</th>
</tr>

</thead>

<tbody>

@foreach($pengaduan as $index => $p)

<tr>
<td>{{ $index + 1 }}</td>
<td>{{ $p->nama }}</td>
<td>{{ $p->jenis_layanan }}</td>
<td>{{ $p->judul_pengaduan }}</td>
<td>{{ $p->isi_pengaduan }}</td>
<td>{{ $p->status }}</td>
<td>{{ $p->tanggal_pengaduan }}</td>
</tr>

@endforeach

</tbody>

</table>

</body>
</html>
