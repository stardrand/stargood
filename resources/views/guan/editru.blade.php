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
    <form action="{{url('guan/updateru/'.$res->r_id)}}" method="post">
    @csrf
        <table>
            <tr>
                <td>入库货物名称</td>
                <td><input type="text" name="r_name" value="{{$res->r_name}}"></td>
            </tr>
            <tr>
                <td>入库数量</td>
                <td><input type="text" name="r_sun"  value="{{$res->r_sun}}"></td>
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