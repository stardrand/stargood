<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>品牌修改</title>
</head>
<body>
    <form action="{{url('cartgory/update/'.$res->id)}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>品牌名称</td>
                <td><input type="text" name="s_name" value="{{$res->s_name}}"></td>
            </tr>
            <tr>
                <td>品牌LOGO</td>
                <td>
                <img src="http://1908uploads.com/{{$res->logo}}" width="50">
                <input type="file" name="logo">
                </td>
            </tr>
            <tr>
                <td>品牌网址</td>
                <td><input type="text" name="url" value="{{$res->url}}"></td>
            </tr>
            <tr>
                <td>品牌描述</td>
                <td><textarea name="desc"cols="30" rows="10">{{$res->desc}}</textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="修改"></td>
            </tr>
        </table>
    </form>
</body>
</html>