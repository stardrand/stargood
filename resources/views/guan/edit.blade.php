<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<center>
    <form action="{{url('guan/update/'.$res->u_id)}}" method="post">
    @csrf
        <table>
            <tr>
                <td>昵称</td>
                <td><input type="text" name="u_name" value="{{$res->u_name}}"></td>
            </tr>
            <tr>
                <td>账号</td>
                <td><input type="text" name="u_zh"  value="{{$res->u_zh}}"></td>
            </tr>
            <tr>
                <td>等级</td>
                <td><input type="radio" name="sid" value="1" {{$res->sid==1?'checked':''}}>主管<input type="radio" name="sid" value="2" {{$res->sid==2?'checked':''}}>普通库管员</td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="库管员修改"></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>