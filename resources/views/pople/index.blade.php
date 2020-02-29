<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>外来人口表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<h3>外来人口表</h3></hr>
<div class="table-responsive">
  <form>
  <input type="text" name="uname" value="{{$uname}}" placeholder="请输入名字">
  <input type="submit" value="搜索">
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>年龄</th>
        <th>身份证号</th>
        <th>头像</th>
        <th>是否湖北人</th>
        <th>登记时间</th>
        <td>操作</td>
      </tr>
    </thead>
    <tbody>
    @foreach($data as $k=>$v)
      <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->uname}}</td>
        <td>{{$v->u_age}}</td>
        <td>{{$v->card}}</td>
        <td><img src="http://1908uploads.com/{{$v->head}}" width="50"></td>
        <td>{{$v->is_hu==1?'是':'否'}}</td>
        <td>{{date('Y-m-d H:i:s',$v->addtime)}}</td>
        <td><a href="{{url('pople/edit/'.$v->id)}}" class="btn btn-info">编辑</a> <a href="{{url('pople/destroy/'.$v->id)}}" class="btn btn-danger">删除</a></td>
      </tr>
    @endforeach
    <tr><td colspan="7">{{$data->appends(['uname'=>$uname])->links()}}</td></tr>
    </tbody>
  </table>
</div>
</center>
</body>
</html>