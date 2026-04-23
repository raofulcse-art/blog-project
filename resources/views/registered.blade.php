<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    @auth
        <div>{{ $status }}</div>
        <div>User: {{ $user->name }}</div>
        <div><p>Token: {{ $authorisation['token'] }}</p></div>
        <form action="/api/logout-test" method="POST">
            @csrf 
            
            <button type="submit">Logout</button>
        </form>
    @else
        <form action="/api/register-test" method="post">
            <label for="name">Username:</label><br>
            <input type="text" id="username" name="name" ><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" ><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" ><br><br>
            <label for="password_confirmation">Confirm Password:</label><br>
            <input type="password" id="password_confirmation" name="password_confirmation"><br><br>
            <button type="submit">Submit</button>
        </form>
        <form action="/api/login-test" method="POST">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" ><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" ><br><br>

            <button type="submit">Submit</button>
        </form>
    @endauth
</body>
</html>