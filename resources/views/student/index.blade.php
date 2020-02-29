<center>
<form>
    <input type="text" name="username" value="{{$username}}" placeholder="请输入姓名">
    <input type="text" name="class" value="{{$class}}" placeholder="请输入班级">
    <input type="submit" value="搜索">
</form>
<table>
    <tr>
        <td>ID</td>
        <td>姓名</td>
        <td>性别</td>
        <td>班级</td>
        <td>成绩</td>
        <td>头像</td>
        <td>操作</td>
    </tr>
    @foreach($data as $k=>$v)
    <tr>
        <td>{{$v->u_id}}</td>
        <td>{{$v->username}}</td>
        <td>{{$v->sex==1?'男':'女'}}</td>
        <td>{{$v->class}}</td>
        <td>{{$v->ceng}}</td>
        <td><img src="http://1908uploads.com/{{$v->simg}}" width="50"></td>
        <td><a href="{{url('student/edit/'.$v->u_id)}}">编辑</a>|<a href="{{url('student/destroy/'.$v->u_id)}}">删除</a></td>
    </tr>
    @endforeach
    <tr><td colspan="7">{{$data->appends(['username'=>$username,'class'=>$class])->links()}}</td></tr>
</table>
</center>