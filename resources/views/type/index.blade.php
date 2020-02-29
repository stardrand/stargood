<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品分类表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center>
<div class="table-responsive">
  <form>
  <input type="text" name="t_name" value="{{$t_name}}"  placeholder="请输入分类名称">
  <input type="submit" value="搜索">
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>分类ID</th>
        <th>分类名称</th>
        <th>分类描述</th>
        <td>操作</td>
      </tr>
    </thead>
    <tbody>
    @foreach($res as $k=>$v)
      <tr>
        <td>{{$v->t_id}}</td>
        <td>{{str_repeat('——',$v->level)}}{{$v->t_name}}</td>
        <td>{{$v->t_desc}}</td>
        <td><a href="{{url('type/edit/'.$v->t_id)}}" class="btn btn-info">编辑</a> <a href="#" onclick="del({{$v->t_id}})" class="btn btn-danger">删除</a></td>
      </tr>
    @endforeach
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
        if(confirm('是否删除此分类')){
            $.get(
                'type/destroy/'+id,
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