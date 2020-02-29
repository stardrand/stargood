@extends('layouts.1908')
@section('title', '登陆')
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
     <form action="{{url('/login/do')}}" method="post" class="reg-login">
     @csrf
      <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
      <div class="lrBox">
       <div class="lrList"><input type="text" name="u_name" placeholder="输入账号" /><b style="color:red">{{$errors->first('u_name')}}</b></div>
       <div class="lrList"><input type="password" name="u_pwd" placeholder="输入密码" /><b style="color:red">{{$errors->first('u_pwd')}}</b></div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即登录" />
      </div>
     </form><!--reg-login/-->
     <script>
     $('input[name="u_name"]').blur(function(){
        $(this).next().html('');
        var u_name=$(this).val(); //获取文本框的值
        if(u_name==''){   //判断是否符合正则
            $(this).next().html('请输入账号');
            return;
        }
     });
     
     $('input[name="u_pwd"]').blur(function(){
        $(this).next().html('');
        var u_pwd=$(this).val(); //获取文本框的值
        if(u_pwd==''){   //判断是否符合正则
            $(this).next().html('请输入密码');
            return;
        }
     });
     </script>
     @endsection  