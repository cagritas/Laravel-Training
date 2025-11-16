<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Register Form</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    @if( $errors->any() )
        <div style="color: red;">
            <ul>
                @foreach ( $errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="post">
        @csrf
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required> <br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required> <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required> <br><br>
        <input type="submit" value="Register">
    </form> 
</body>
</html>
