<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>外来人口修改表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<h3>外来人口修改表</h3></hr>
<form class="form-horizontal" role="form" action="{{url('pople/update/'.$res->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">姓名</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="uname" value="{{$res->uname}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">年龄</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="u_age" value="{{$res->u_age}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">身份证号</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="card" value="{{$res->card}}">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-2">
            <img src="http://1908uploads.com/{{$res->head}}" width="50">
            <input type="file" name="head" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否湖北地方</label>
        <div class="col-sm-2">
            <input type="radio" id="firstname" value="1" name="is_hu" @if($res->is_hu==1) checked @endif>是
            <input type="radio" id="firstname" value="2" name="is_hu" @if($res->is_hu==2) checked @endif>否
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">编辑</button>
        </div>
    </div>
</form>
</body>
</html>