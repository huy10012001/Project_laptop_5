<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Employee</title>
</head>

<body>


   
    <h1>Login</h1>
    <form action="{{ url('/postLogin') }}" method="post">
        {{ csrf_field() }}
     
        
        <div>EmployeeId: <input name="id"/></div>
        <div>Password: <input name="password"/></div>
        
        <div><input type="submit" value="Login"/></div>
    </form>
</body>
</html>