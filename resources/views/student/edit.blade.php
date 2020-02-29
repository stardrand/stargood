<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>成绩表</title>
</head>
<body>
<center>
<h2>成绩表</h2><hr>
    <form action="{{url('student/update/'.$res->u_id)}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>姓名</td>
                <td><input type="text" name="username" value="{{$res->username}}"><b style="color:red">{{$errors->first('username')}}</b></td>
            </tr>
            <tr>
                <td>性别</td>
                <td><input type="radio" name="sex" value="1" @if($res->sex==1) checked @endif>男<input type="radio" name="sex" value="2" @if($res->sex==2) checked @endif>女</td>
            </tr>
            <tr>
                <td>班级</td>
                <td><input type="text" name="class" value="{{$res->class}}"></td>
            </tr>
            <tr>
                <td>成绩</td>
                <td><input type="text" name="ceng" value="{{$res->ceng}}"><b style="color:red">{{$errors->first('ceng')}}</b></td>
            </tr>
            <tr>
                <td>头像</td>
                <td><input type="file" name="simg"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="修改"></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>