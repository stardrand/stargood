<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>外来人口登记表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<!-- @if ($errors->any())
<div class="alert alert-danger">
<ul>
@foreach ($errors->all() as $error)
<li>{// { $error }}</li>
@endforeach
</ul>
</div>
@endif -->


<h3>外来人口登记表</h3></hr>
<form class="form-horizontal" role="form" action="{{url('pople/store')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="uname" placeholder="请输入名字">
            <b style="color:red">{{$errors->first('uname')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="u_age" placeholder="请输入年龄">
            <b style="color:red">{{$errors->first('u_age')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">身份证号</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="card" placeholder="请输入身份证号">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-2">
            <input type="file" id="firstname" name="head">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否湖北地方</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="is_hu">是
            <input type="radio" id="firstname" value="2" name="is_hu" checked>否
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">登记</button>
        </div>
    </div>
</form>
</body>
</html>