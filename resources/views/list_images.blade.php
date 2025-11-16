<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>List Images</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <h1>Uploaded Images</h1>
    <div>
        @foreach ($files as $file)
            <div style="margin-bottom: 20px;">
                <img src="{{ Storage::url($file) }}" alt="Uploaded Image" style="max-width: 300px; height: auto;">
            </div>
        @endforeach
    </div>  
</body>
</html>
