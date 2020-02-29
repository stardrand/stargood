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
  <input type="text" name="g_name" value="{{$g_name}}"   placeholder="请输入商品名称">
  <input type="submit" value="搜索">
  </form>
  <table class="table">
    <thead>
      <tr>
        <th>商品ID</th>
        <th>商品名称</th>
        <th>分类</th>
        <th>品牌</th>
        <th>商品货号</th>
        <th>商品价格</th>
        <th>商品缩略图</th>
        <th>商品库存</th>
        <th>是否精品</th>
        <th>是否热销</th>
        <th>商品详情</th>
        <th>商品相册</th>
        <td>操作</td>
      </tr>
    </thead>
    <tbody>
    @foreach($res as $k=>$v)
      <tr>
        <td>{{$v->g_id}}</td>
        <td>{{$v->g_name}}</td>
        <td>{{$v->t_name}}</td>
        <td>{{$v->s_name}}</td>
        <td>{{$v->g_art}}</td>
        <td>{{$v->g_pirate}}</td>
        <td><img src="http://1908uploads.com/{{$v->g_img}}" width="50"></td>
        <td>{{$v->g_repertory}}</td>
        <td>{{$v->is_jing==1?'√':'×'}}</td>
        <td>{{$v->is_hot==1?'√':'×'}}</td>
        <td>{{$v->g_desc}}</td>
        <td>
            @foreach($v->g_imgs as $kk=>$vv)
            <img src="http://1908uploads.com/{{$vv}}" width="50">
            @endforeach
        </td>
        <td><a href="{{url('goods/edit/'.$v->g_id)}}" class="btn btn-info">编辑</a> <a href="#" onclick="del({{$v->g_id}})" class="btn btn-danger">删除</a></td>
      </tr>
    @endforeach
    <tr><td colspan="7">{{$res->appends(['g_name'=>$g_name])->links()}}</td></tr>
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
                'goods/destroy/'+id,
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