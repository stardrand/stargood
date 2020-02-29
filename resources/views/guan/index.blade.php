<center>
@if(session('user')==1)
<h2>用户管理</h2><hr>
<table border=1>
    <tr>
        <td>id</td>
        <td>昵称</td>
        <td>账号</td>
        <td>级别</td>
        <td>操作</td>
    </tr>
    @foreach($res as $k=>$v)
    <tr>
        <td>{{$v->u_id}}</td>
        <td>{{$v->u_name}}</td>
        <td>{{$v->u_zh}}</td>
        <td>{{$v->sid==1?'主管':'普通库管员'}}</td>
        <td><a href="{{url('guan/edit/'.$v->u_id)}}">修改</a>|<a href="{{url('guan/destroy/'.$v->u_id)}}">删除</a> </td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><button><a href="{{url('guan/create')}}">库管员添加</a></button></td>
    </tr>
</table>
@endif

<h2>货物管理</h2><hr>
<table border=1>
    <tr>
        <td>id</td>
        <td>货物名称</td>
        <td>货物库存</td>
        <td>操作</td>
    </tr>
    @foreach($rew as $k=>$v)
    <tr>
        <td>{{$v->h_id}}</td>
        <td>{{$v->h_name}}</td>
        <td>{{$v->h_kun}}</td>
        <td><a href="{{url('guan/edithuo/'.$v->h_id)}}">修改</a>|<a href="{{url('guan/del/'.$v->h_id)}}">删除</a> </td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><button><a href="{{url('guan/createhuo')}}">货物添加</a></button></td>
    </tr>
</table>

<h2>入库管理</h2><hr>
<table border=1>
    <tr>
        <td>id</td>
        <td>名称</td>
        <td>时间</td>
        <td>数量</td>
        <td>操作</td>
    </tr>
    @foreach($req as $k=>$v)
    <tr>
        <td>{{$v->r_id}}</td>
        <td>{{$v->r_name}}</td>
        <td>{{date('Y-m-d H:i:s',$v->r_time)}}</td>
        <td>{{$v->r_sun}}</td>
        <td><a href="{{url('guan/editru/'.$v->r_id)}}">修改</a>|<a href="{{url('guan/dels/'.$v->r_id)}}">删除</a> </td>
    </tr>
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><button><a href="{{url('guan/createru')}}">入库添加</a></button></td>
    </tr>
</table>
</center>