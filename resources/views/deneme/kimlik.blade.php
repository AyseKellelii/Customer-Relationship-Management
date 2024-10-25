<!DOCTYPE html>
<html>
<head>
    <title>Kişi Kimlikleri</title>
</head>
<body>
<h1>Kişi Kimlikleri</h1>
<table border="1">
    <thead>
    <tr>
        <th>Dosya_no</th>
        <th>Ad</th>
        <th>Soyad</th>
        <th>Cinsiyet</th>
        <th>Meslek</th>
        <th>Memleket</th>
        <th>Dogum_tarihi</th>


    </tr>
    </thead>
    <tbody>
    @foreach($kimlikler as $kimlik)
        <tr>
            <td>{{ $kimlik->dosya_no }}</td>
            <td>{{ $kimlik->adi }}</td>
            <td>{{ $kimlik->soyadi }}</td>
            <td>{{ $kimlik->cins }}</td>
            <td>{{ $kimlik->meslek }}</td>

            <td>{{ $kimlik->memleket }}</td>
            <td>{{ $kimlik->dogum_tar }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
