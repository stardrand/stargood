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
    <form action="{{url('guan/storehuo')}}" method="post">
    @csrf
        <table>
            <tr>
                <td>货物名称</td>
                <td><input type="text" name="h_name"></td>
            </tr>
            <tr>
                <td>货物数量</td>
                <td><input type="text" name="h_kun"></td>
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