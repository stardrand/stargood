<form method="get">
    <input type="text" name="title" value="{{$title}}" placeholder="标题">
    <select name="type">
        <option value="">请选择</option>
        <option value="1" {{$type==1?'selected':''}}>散文</option>
        <option value="2" {{$type==2?'selected':''}}>小说</option>
        <option value="3" {{$type==3?'selected':''}}>历史</option>
        <option value="4" {{$type==4?'selected':''}}>科技</option>
    </select>
    <input type="submit" value="搜索">
    </form>
    <table>
        <tr>
            <td>编号</td>
            <td>文章标题</td>
            <td>文章分类</td>
            <td>文章重要性</td>
            <td>是否显示</td>
            <td>添加日期</td>
            <td>操作</td>
        </tr>
        @foreach($res as $k=>$v)
        <tr addid="{{$v->id}}">
            <td>{{$v->id}}</td>
            <td>{{$v->title}}</td>
            <td>@if($v->type==1)
            散文
            @elseif($v->type==2)
            小说
            @elseif($v->type==3)
            历史
            @elseif($v->type==4)
            科技
            @endif
            </td>
            <td>{{$v->dons==1?'普通':'置顶'}}</td>
            <td>{{$v->xin==1?'√':'×'}}</td>
            <td>{{date('Y-m-d H:i:s',$v->time)}}</td>
            <td>
                <a href="{{url('article/edit/'.$v->id)}}">编辑</a>
                <a href="#" class="del">删除</a>
                <a href="{{url('article/destroy/'.$v->id)}}">删除</a>
            </td>
        </tr>
        @endforeach
        <tr><td colspan="7">{{$res->appends(['title'=>$title,'type'=>$type])->links()}}</td></tr>
    </table>