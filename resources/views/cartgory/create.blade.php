<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>品牌添加</title>
</head>
<body>
    <form action="{{url('cartgory/store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>品牌名称</td>
                <td><input type="text" name="s_name"></td>
            </tr>
            <tr>
                <td>品牌LOGO</td>
                <td><input type="file" name="logo"></td>
            </tr>
            <tr>
                <td>品牌网址</td>
                <td><input type="text" name="url"></td>
            </tr>
            <tr>
                <td>品牌描述</td>
                <td><textarea name="desc"cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="添加"></td>
            </tr>
        </table>
    </form>
</body>
</html>