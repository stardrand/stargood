<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>成绩登记</title>
</head>
<body>
<center>
<h2>成绩登记</h2><hr>
    <form action="{{url('student/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>姓名</td>
                <td><input type="text" name="username"><b style="color:red">{{$errors->first('username')}}</b></td>
                
            </tr>
            <tr>
                <td>性别</td>
                <td><input type="radio" name="sex" value="1" checked>男<input type="radio" name="sex" value="2">女<b style="color:red">{{$errors->first('sex')}}</b></td>
                
            </tr>
            <tr>
                <td>班级</td>
                <td><input type="text" name="class"></td>
            </tr>
            <tr>
                <td>成绩</td>
                <td><input type="text" name="ceng"><b style="color:red">{{$errors->first('ceng')}}</b></td>
                
            </tr>
            <tr>
                <td>头像</td>
                <td><input type="file" name="simg"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="添加"></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>