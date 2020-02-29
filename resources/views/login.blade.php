<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登陆</title>
</head>
<body>
<center>
<h2>成绩登记</h2><hr>
    <form action="{{url('reglogin/do')}}" method="post">
    @csrf
        <table>
        <b style="color:red">{{session('msg')}}</b>
            <tr>
                <td>账号</td>
                <td><input type="text" name="username"></td>
                
            </tr>
            <tr>
                <td>密码</td>
                <td><input type="password" name="pwd"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="登陆"></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>