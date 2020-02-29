<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>商品表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<form class="form-horizontal" role="form" action="{{url('goods/update/'.$ret->g_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="g_name" value="{{$ret->g_name}}">
            <b style="color:red">{{$errors->first('g_name')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="g_pirate" value="{{$ret->g_pirate}}">
            <b style="color:red">{{$errors->first('g_pirate')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">品牌</label>
        <div class="col-sm-2">
        <select name="id"  class="form-control" id="firstname">
            <option value="">--请选择--</option>
            @foreach($res as $k=>$v)
            <option value="{{$v->id}}" @if($ret->id==$v->id)selected @endif>{{$v->s_name}}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">分类</label>
        <div class="col-sm-2">
        <select name="t_id" id="" class="form-control" id="firstname">
            <option value="">--请选择--</option>
            @foreach($date as $k=>$v)
            <option value="{{$v->t_id}}" @if($ret->t_id==$v->t_id)selected @endif>{{str_repeat("——",$v->level)}}{{$v->t_name}}</option>
            @endforeach
        </select>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品缩略图</label>
        <div class="col-sm-2">
        <img src="http://1908uploads.com/{{$ret->g_img}}" width="50">
        <input type="file" name="g_img" class="form-control" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="g_repertory" value="{{$ret->g_repertory}}">
            <b style="color:red">{{$errors->first('g_repertory')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-2">
            <input type="radio"  id="firstname" value="1" name="is_jing" {{$ret->is_jing==1?'checked':''}}>是
            <input type="radio"  id="firstname" value="2" name="is_jing" {{$ret->is_jing==2?'checked':''}}>否
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否热销</label>
        <div class="col-sm-2">
            <input type="radio"  id="firstname" value="1" name="is_hot" {{$ret->is_hot==1?'checked':''}}>是
            <input type="radio"  id="firstname" value="2" name="is_hot" {{$ret->is_hot==2?'checked':''}}>否
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否在首页显示</label>
        <div class="col-sm-2">
            <input type="radio"  id="firstname" value="1" name="is_shi" {{$ret->is_shi==1?'checked':''}}>是
            <input type="radio"  id="firstname" value="2" name="is_shi" {{$ret->is_shi==2?'checked':''}}>否
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品详情</label>
        <div class="col-sm-2">
        <textarea name="g_desc" id="" class="form-control" id="firstname" cols="30" rows="10">{{$ret->g_name}}</textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-2">
        @foreach($ret->g_imgs as $k=>$v)
            <img src="http://1908uploads.com/{{$v}}" width="50">
            @endforeach
        <input type="file" name="g_imgs[]" class="form-control" id="firstname" multiple="multiple">
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="button" class="btn btn-default">修改</button>
        </div>
    </div>
</form>
</body>
</html>
<script>
var g_id={{$ret->g_id}}
    // 名称失去焦点
    $('input[name="g_name"]').blur(function(){
        $(this).next().html('');
        var g_name=$(this).val(); //获取文本框的值
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]+$/; //正则
        if(!reg.test(g_name)){   //判断是否符合正则
            $(this).next().html('商品名称由中文、数字、字母、下滑线组成且不能为空');
            return;
        }
        //表单令牌
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            type:'post',
            url:"/goods/add",
            data:{g_name:g_name,g_id:g_id},
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="g_name"]').next().html('该商品已存在1');
                }
            }
        });
    })
    //价格
    $('input[name="g_pirate"]').blur(function(){
        $(this).next().html('');
        var g_pirate=$(this).val(); //获取文本框的值
        var reg=/^\d+$/; //正则
        if(!reg.test(g_pirate)){   //判断是否符合正则
            $(this).next().html('价格只能是数字且不能为空');
            return;
        }
    });
    //库存
    $('input[name="g_repertory"]').blur(function(){
        $(this).next().html('');
        var g_repertory=$(this).val(); //获取文本框的值
        var reg=/^\d+$/; //正则
        if(!reg.test(g_repertory)){   //判断是否符合正则
            $(this).next().html('库存只能是数字且不能为空');
            return;
        }
    });

    //按钮
    $('button[type="button"]').click(function(){
        var g_nameflage=true;
        $('input[name="g_name"]').next().html('');
        var g_name=$('input[name="g_name"]').val(); //获取文本框的值
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]+$/; //正则
        if(!reg.test(g_name)){   //判断是否符合正则
            $('input[name="g_name"]').next().html('商品名称有中文、数字、字母、下滑线组成且不能为空');
            return;
        }
        
        $.ajax({
            type:'post',
            url:"/goods/add",
            data:{g_name:g_name,g_id:g_id},
            async:false,
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="g_name"]').next().html('该商品已存在2');
                    g_nameflage=false;
                }
            }
        });
        if(!g_nameflage){
            return;
        }
        
        //价格
        $('input[name="g_pirate"]').next().html('');
        var g_pirate=$('input[name="g_pirate"]').val(); //获取文本框的值
        var reg=/^\d+$/; //正则
        if(!reg.test(g_pirate)){   //判断是否符合正则
            $('input[name="g_pirate"]').next().html('价格只能是数字且不能为空');
            return;
        }
        //库存
        $('input[name="g_repertory"]').next().html('');
        var g_repertory=$('input[name="g_repertory"]').val(); //获取文本框的值
        var reg=/^\d+$/; //正则
        if(!reg.test(g_repertory)){   //判断是否符合正则
            $('input[name="g_repertory"]').next().html('库存只能是数字且不能为空');
            return;
        }

        $('form').submit();
    });
</script>  