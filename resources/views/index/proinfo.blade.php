@extends('layouts.1908')
@section('title', '商品详情页')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
     @foreach($res->g_imgs as $k=>$v)
      <img src="http://1908uploads.com/{{$v}}" />
      @endforeach
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">￥{{$res->g_pirate}}</strong></th>
       <td>
        <input type="text" id="num" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
       <P>访问量：{{$num}}</P>
        <strong>{{$res->g_name}}</strong>
        <p class="hui">{{$res->g_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>

     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
      <img src="http://1908uploads.com/{{$res->g_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="{{url('/')}}"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><button type="button"><a id="cart">加入购物车</a></button></td>
      </tr>
     </table>

  <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
    $("#sliderA").excoloSlider();
	$('.spinnerExample').spinner({});
    var g_id={{$res->g_id}};
    //表单令牌
    $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
    $('#cart').click(function(){
        // if(!session('u_id')){
        //     alert('未登录无法操作');
        //     return;
        // }
        
        var num=$('#num').val();
        // console.log(num);   
        if(num==0){
            alert('未选择购买数量');
            return;
        }
        $.ajax({
            type:'post',
            url:"/cart",
            data:{g_id:g_id,c_num:num},
            dataType:'json',
            success:function(result){
                console.log(result);
                if(result.code==0){
                    if(confirm('加入购物车成功')){
                        return location.href('cartindex');
                    }
                    // alert('加入购物车成功');
                }else{
                    alert(result.msg);
                }
            }
        });


    })
	</script>
       @endsection