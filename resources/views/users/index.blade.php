<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<div class="table-responsive">
  <form>
  <input type="text" name="u_name" value="{{$u_name}}"   placeholder="请输入商品名称">
  <input type="submit" value="搜索">
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>管理员ID</th>
        <th>账号</th>
        <th>头像</th>
        <th>手机号</th>
        <th>邮箱</th>
        <td>操作</td>
      </tr>
    </thead>
    <tbody>
    @foreach($res as $k=>$v)
      <tr>
        <td>{{$v->u_id}}</td>
        <td>{{$v->u_name}}</td>
        <td><img src="http://1908uploads.com/{{$v->u_img}}" width="50"></td>
        <td>{{$v->u_tel}}</td>
        <td>{{$v->u_email}}</td>
        <td><a href="{{url('users/edit/'.$v->u_id)}}" class="btn btn-info">编辑</a> <a href="#" onclick="del({{$v->u_id}})" class="btn btn-danger">删除</a></td>
      </tr>
    @endforeach
    <tr><td colspan="7">{{$res->appends(['u_name'=>$u_name])->links()}}</td></tr>
    </tbody>
  </table>
</div>
</center>
</body>
</html>
<script>
    function del(id){
        if(!id){
            return;
        }
        if(confirm('是否删除此管理账号')){
            $.get(
                'users/destroy/'+id,
                function(res){
                    // alert(res);
                    if(res.code==1){
                        location.reload();
                    }else{
                        alert(res.fond);
                    }
                },
                'json'
            );
        }
    }
</script>