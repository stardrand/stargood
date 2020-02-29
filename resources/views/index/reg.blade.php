@extends('layouts.1908')
@section('title', '注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/reg/do')}}" method="post" class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <b style="color:red">{{$errors->first('msg')}}</b>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_name" placeholder="输入手机号码" /><b style="color:red">{{$errors->first('u_name')}}</b></div>
       <div class="lrList2"><input type="text" name="code" placeholder="输入短信验证码" /> <button id="code" type="button">获取验证码</button><b style="color:red">**频繁发送会引起发送失败**</b></div>
       <div class="lrList"><input type="password" name="u_pwd" placeholder="设置新密码（6-18位数字或字母）" /><b style="color:red">{{$errors->first('u_pwd')}}</div>
       <div class="lrList"><input type="password" name="u_pwds" placeholder="再次输入密码" /><b style="color:red">{{$errors->first('u_pwds')}}</div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     <script src="/static/index/js/jquery.min.js"></script>
    <script>
    //表单令牌
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    //手机号失去焦点
    $('input[name="u_name"]').blur(function(){
        $(this).next().html('');
        var u_name=$(this).val(); //获取文本框的值
        var reg=/^1\d{10}$/; //正则
        if(!reg.test(u_name)){   //判断是否符合正则
            $(this).next().html('请输入正确手机号码');
            return;
        }

        $.ajax({
            type:'post',
            url:"/reg/add",
            data:{u_name:u_name},
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="u_name"]').next().html('账号已注册');
                }
            }
        });

    });

   
    //验证码点击
    $('#code').click(function(){
        // alert(1);
        var u_name=$('input[name="u_name"]').val();
        if(u_name==''){
            $('input[name="u_name"]').next().html('请输入手机号');
            return;
        }
        $.ajax({
            type:'post',
            url:"/reg/sms",
            data:{u_name:u_name},
            dataType:'json',
            success:function(result){
                console.log(result);
                if(result.code==00000){
                    alert('已发送,请注意短信接收');
                }else{
                    alert('发送失败');
                }
            }
        });
    })
    //验证码
    $('input[name="code"]').blur(function(){
        $('#code').next().html('**频繁发送会引起发送失败**');
        var code=$(this).val(); //获取文本框的值//正则
        // console.log(codes);
        if(code==''){ 
            $('#code').next().html('请输入验证码');
            return;
        }
        // if(code!=session('code')){
        //     $('#code').next().html('输入的与发送的验证码不符');
        //     return;
        // }
    })

    //密码
    $('input[name="u_pwd"]').blur(function(){
        $(this).next().html('');
        var u_pwd=$(this).val(); //获取文本框的值
        var u_pwds=$('input[name="u_pwds"]').val(); //获取文本框的值
        if(u_pwd==''){ 
            $(this).next().html('请输入密码');
            return;
        }
    })
        //确认密码
        $('input[name="u_pwds"]').blur(function(){
        $(this).next().html('');
        var u_pwds=$(this).val(); //获取文本框的值
        var u_pwd=$('input[name="u_pwd"]').val(); //获取文本框的值
        if(u_pwds==''){ 
            $(this).next().html('请输入密码');
            return;
        }
        if(u_pwds!=u_pwd){
            $(this).next().html('两次密码不一致');
            return;
        }
    })
    </script>


     @endsection      