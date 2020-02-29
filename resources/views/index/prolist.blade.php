@extends('layouts.1908')
@section('title', '商品列表页')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <form action="#" method="get" class="prosearch"><input type="text" /></form>
      </div>
     </header>
     <ul class="pro-select">
      <li class="pro-selCur"><a href="javascript:;">新品</a></li>
      <li><a href="javascript:;">销量</a></li>
      <li><a href="javascript:;">价格</a></li>
     </ul><!--pro-select/-->
     <div class="prolist">
      @foreach($rew as $k=>$v)
        @foreach($v as $kk=>$vv)
      <dl>
       <dt><a href="{{url('/porinfo/'.$vv->g_id)}}"><img src="http://1908uploads.com/{{$vv->g_img}}" width="100" height="100" /></a></dt>
       <dd>
        <h3><a href="{{url('/porinfo/'.$vv->g_id)}}">{{$vv->g_name}}</a></h3>
        <div class="prolist-price"><strong>¥{{$vv->g_pirate}}</strong> <span>¥599</span></div>
        <div class="prolist-yishou"><span>5.0折</span> <em>已售：35</em></div>
       </dd>
       <div class="clearfix"></div>
      </dl>
        @endforeach
      @endforeach
     </div><!--prolist/-->
     <script>
        $("#sliderA").excoloSlider();
      </script>
     @endsection