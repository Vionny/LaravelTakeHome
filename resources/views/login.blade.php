<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible"
          content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form action="/loginVal" method="POST" class="">
        <h1>Login</h1>
        @csrf
        <div>
        <label>Email</label>
        <input type="text" name="email" placeholder="Input your email">
        </div>
        <div>
        <label>Password</label>
        <input type="password" name="password" placeholder="Input your password">
        </div>
        <div>
            <input type="checkbox" name="checkremember">
            <label>Remember Me</label>
        </div>
        <button type="submit">Submit</button>
        @error('email','password')
        <div>
            {{$message}}
        </div>
        @enderror
    </form>

</body>
</html>
