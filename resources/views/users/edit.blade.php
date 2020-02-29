<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员表</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
<form class="form-horizontal" role="form" action="{{url('users/update/'.$res->u_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">账号</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="firstname" name="u_name" value="{{$res->u_name}}" placeholder="请输入账号">
            <b style="color:red">{{$errors->first('u_name')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="firstname" name="u_pwd" value="{{$res->u_pwd}}" placeholder="请输入密码">
            <b style="color:red">{{$errors->first('u_pwd')}}</b>
            <u style="color:red">如果不修改密码则为原密码</u>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-2">
            <input type="password" class="form-control" id="firstname" name="u_pwds" value="{{$res->u_pwd}}" placeholder="请再次输入密码">
            <b style="color:red">{{$errors->first('u_pwds')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">头像</label>
        <div class="col-sm-2">
        <img src="http://1908uploads.com/{{$res->u_img}}" width="50">
        <input type="file" name="u_img" class="form-control" id="firstname">
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="firstname" name="u_tel" value="{{$res->u_tel}}" placeholder="请输入手机号">
        <b style="color:red">{{$errors->first('u_tel')}}</b>
        </div>
    </div>

    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-2">
        <input type="text" class="form-control" id="firstname" name="u_email" value="{{$res->u_email}}" placeholder="请输入邮箱">
        <b style="color:red">{{$errors->first('u_email')}}</b>
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
    //表单令牌
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    //账号
    $('input[name="u_name"]').blur(function(){
        $(this).next().html('');
        var u_name=$(this).val(); //获取文本框的值
        var reg=/^\w{5,18}$/; //正则
        if(!reg.test(u_name)){   //判断是否符合正则
            $(this).next().html('账号由数字、字母、下滑线组成且5-18位');
            return;
        }
        
        $.ajax({
            type:'post',
            url:"/users/add",
            data:{u_name:u_name},
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="g_name"]').next().html('该账号已存在');
                }
            }
        });

    });
    //密码
    $('input[name="u_pwd"]').blur(function(){
        $(this).next().html('');
        var u_pwd=$(this).val(); //获取文本框的值
        var reg=/^\w{6,18}$/; //正则
        if(!reg.test(u_pwd)){   //判断是否符合正则
            $(this).next().html('密码由数字、字母、下滑线组成且6-18位');
            return;
        }

    });
    //确认密码
    $('input[name="u_pwds"]').blur(function(){
        $(this).next().html('');
        var u_pwds=$(this).val(); //获取文本框的值
        var u_pwd=$('input[name="u_pwd"]').val();
        if(u_pwds!=u_pwd){
            $(this).next().html('确认密码与密码不符');
            return;
        }

    });
    //手机号
    $('input[name="u_tel"]').blur(function(){
        $(this).next().html('');
        var u_tel=$(this).val(); //获取文本框的值
        var reg=/^1\d{10}$/; //正则
        if(!reg.test(u_tel)){   //判断是否符合正则
            $(this).next().html('手机号为11位数字且1开头');
            return;
        }

    });
    //邮箱
    $('input[name="u_email"]').blur(function(){
        $(this).next().html('');
        var u_email=$(this).val(); //获取文本框的值
        var reg=/^\d{6,11}@qq(\.)com$/; //正则
        if(!reg.test(u_email)){   //判断是否符合正则
            $(this).next().html('邮箱为*****@qq.com形式');
            return;
        }

    });
    //按钮
    $('button[type="button"]').click(function(){
        var u_nameflage=true;
        //账号
        $('input[name="u_name"]').next().html('');
        var u_name=$('input[name="u_name"]').val(); //获取文本框的值
        var reg=/^\w{5,18}$/; //正则
        if(!reg.test(u_name)){   //判断是否符合正则
            $('input[name="u_name"]').next().html('账号由数字、字母、下滑线组成且5-18位');
            u_nameflage=false;
            return;
        }
        
        $.ajax({
            type:'post',
            url:"/users/add",
            data:{u_name:u_name},
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="g_name"]').next().html('该账号已存在');
                    u_nameflage=false;
                }
            }
        });
        //密码
        $('input[name="u_pwd"]').next().html('');
        var u_pwd=$('input[name="u_pwd"]').val(); //获取文本框的值
        var reg=/^\w{6,18}$/; //正则
        if(!reg.test(u_pwd)){   //判断是否符合正则
            $('input[name="u_pwd"]').next().html('密码由数字、字母、下滑线组成且6-18位');
            u_nameflage=false;
            return;
        }
        //确认密码
        $('input[name="u_pwds"]').next().html('');
        var u_pwds=$('input[name="u_pwds"]').val(); //获取文本框的值
        var u_pwd=$('input[name="u_pwd"]').val();
        if(u_pwds!=u_pwd){
            $('input[name="u_pwds"]').next().html('确认密码与密码不符');
            u_nameflage=false;
            return;
        }
        //手机号
        $('input[name="u_tel"]').next().html('');
        var u_tel=$('input[name="u_tel"]').val(); //获取文本框的值
        var reg=/^1\d{10}$/; //正则
        if(!reg.test(u_tel)){   //判断是否符合正则
            $('input[name="u_tel"]').next().html('手机号为11位数字且1开头');
            u_nameflage=false;
            return;
        }
        //邮箱

        $('input[name="u_email"]').next().html('');
        var u_email=$('input[name="u_email"]').val(); //获取文本框的值
        var reg=/^\d{6,11}@qq(\.)com$/; //正则
        if(!reg.test(u_email)){   //判断是否符合正则
            $('input[name="u_email"]').next().html('邮箱为*****@qq.com形式');
            u_nameflage=false;
            return;
        }
        if(!u_nameflage){
            return;
        }
        $('form').submit();
    });
</script>  