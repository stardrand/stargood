<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品分类表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<form class="form-horizontal" role="form" action="{{url('type/store')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类名称</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="t_name" placeholder="请输入分类名称">
            <b style="color:red">{{$errors->first('t_name')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">父级分类</label>
        <div class="col-sm-2">
        <select name="p_id" id="" class="form-control" id="firstname">
            <option value="0">顶级分类</option>
            @foreach($res as $k=>$v)
            <option value="{{$v->t_id}}">{{str_repeat("——",$v->level)}}{{$v->t_name}}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类描述</label>
        <div class="col-sm-2">
        <textarea name="t_desc" id="" class="form-control" id="firstname" cols="30" rows="10"></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">添加</button>
        </div>
    </div>
</form>
</body>
</html>
<script>
    //名称失去焦点
    $('input[name="t_name"]').blur(function(){
        $(this).next().html('');
        var t_name=$(this).val(); //获取文本框的值
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]+$/; //正则
        if(!reg.test(t_name)){   //判断是否符合正则
            $(this).next().html('分类名称由中文、数字、字母、下滑线组成且不能为空');
            return;
        }
        //表单令牌
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            type:'post',
            url:"/type/add",
            data:{t_name:t_name},
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="t_name"]').next().html('该分类已存在');
                }
            }
        });
    })

    //按钮
    $('button[type="button"]').click(function(){
        var t_nameflage=true;
        $('input[name="t_name"]').next().html('');
        var t_name=$('input[name="t_name"]').val(); //获取文本框的值
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]+$/; //正则
        if(!reg.test(t_name)){   //判断是否符合正则
            $('input[name="t_name"]').next().html('分类名称有中文、数字、字母、下滑线组成且不能为空');
            return;
        }
        $.ajax({
            type:'post',
            url:"/type/add",
            data:{t_name:t_name},
            async:false,
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="t_name"]').next().html('该分类已存在');
                    t_nameflage=false;
                }
            }
        });
        if(!t_nameflage){
            return;
        }
        $('form').submit();
    });
</script>  