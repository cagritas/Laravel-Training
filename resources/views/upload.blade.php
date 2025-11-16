<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Resim Yükleme Uygulaması</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<form action="{{ route('upload.form') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="file">Resim Seçin:</label>
    <input type="file" name="file" id="file" accept="image/*"> <br><br>
    <input type="submit" value="Yükle">
</body>
</html>
