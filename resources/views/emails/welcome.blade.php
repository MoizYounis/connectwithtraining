<!DOCTYPE html>
<html>
<head>
    <title> Welcome Sign Up Email On Giftszon </title>
</head>

<body>
<h2>Welcome to the site {{$user['first_name']}} &nbsp;{{$user['last_name']}}</h2>
<br/>
Your Login Id is {{$user['email']}} <br>
<!--Your Login Password is ({{$user['password']}})<br><br>-->
Your Login Link <a href="https://giftszon.com/login" target="_blank">Giftszon.com</a>
</body>

</html>