<table>
    <tr>
        <td>ID</td>
        <td>品牌名称</td>
        <td>品牌LOGO</td>
        <td>品牌网址</td>
        <td>品牌描述</td>
        <td>操作</td>
    </tr>
    @foreach($res as $k=>$v)
    <tr>
        <td>{{$v->id}}</td>
        <td>{{$v->s_name}}</td>
        <td><img src="http://1908uploads.com/{{$v->logo}}" width="50"></td>
        <td>{{$v->url}}</td>
        <td>{{$v->desc}}</td>
        <td>
        <a href="{{url('cartgory/edit/'.$v->id)}}">修改</a>
        <a href="{{url('cartgory/destroy/'.$v->id)}}">删除</a>
        </td>
    </tr>
    @endforeach
</table>