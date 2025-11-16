<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <!-- Basic training form that posts to the example controller -->
    <form action="{{ route('form.result') }}" method="post">
        @csrf

        <!-- Capture the message field that the middleware inspects -->
        <textarea name="message" placeholder="Type your sample message here"></textarea> <br>
        <input type="submit" name="submit" value="Send">
    </form>
</body>
</html>
