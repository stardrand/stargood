<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>文章修改</title>
</head>
<body>
<center>
    <form action="{{url('article/update/'.$res->id)}}" method="post" enctype="multipart/form-data">
    @csrf
        <table>
            <tr>
                <td>文章标题</td>
                <td><input type="text" value="{{$res->title}}" name="title"><b style="color:red">{{$errors->first('title')}}</b></td>
            </tr>
            <tr>
                <td>文章分类</td>
                <td>
                    <select name="type">
                        <option value="">请选择</option>
                        <option value="1" {{$res->type==1?'selected':''}}>散文</option>
                        <option value="2" {{$res->type==2?'selected':''}}>小说</option>
                        <option value="3" {{$res->type==3?'selected':''}}>历史</option>
                        <option value="4" {{$res->type==4?'selected':''}}>科技</option>
                    </select><b style="color:red">{{$errors->first('type')}}</b>
                </td>
            </tr>
            <tr>
                <td>文章重要性</td>
                <td>
                    <input type="radio" name="dons" value="1" {{$res->dons==1?'checked':''}}>普通
                    <input type="radio" name="dons" value="2" {{$res->dons==2?'checked':''}}>置顶
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" name="xin" value="1" {{$res->xin==1?'checked':''}}>显示
                    <input type="radio" name="xin" value="2" {{$res->xin==2?'checked':''}}>不显示
                </td>
            </tr>
            <tr>
                <td>文章作者</td>
                <td><input type="text" name="man" value="{{$res->man}}"><b style="color:red"></b></td>
            </tr>
            <tr>
                <td>作者email</td>
                <td><input type="text" name="email" value="{{$res->email}}"></td>
            </tr>
            <tr>
                <td>关键字</td>
                <td><input type="text" name="guan" value="{{$res->guan}}"></td>
            </tr>
            <tr>
                <td>网页描述</td>
                <td><textarea name="desc" cols="30" rows="10">{{$res->desc}}</textarea></td>
            </tr>
            <tr>
                <td>上传文件</td>
                <td>
                <img src="http://1908uploads.com/{{$res->img}}" width="50">
                <input type="file" name="img">
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="修改"></td>
            </tr>
        </table>
    </form>
    </center>
</body>
</html>
<script src="/static/js/jquery.min.js"></script>
<script>
    //标题 失去焦点
    $('input[name="title"]').blur(function(){
        $(this).next().html('');
        var id={{$res->id}};
        var title=$(this).val(); //获取文本框的值
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]+$/; //正则
        if(!reg.test(title)){   //判断是否符合正则
            $(this).next().html('文章标题有中文、数字、字母、下滑线组成且不能为空');
            return;
        }
        //表单令牌
        $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            type:'post',
            url:"/article/adds",
            data:{title:title,id:id},
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="title"]').next().html('该标题已存在');
                }
            }
        });
    })
    //作者框 失去焦点
    $('input[name="man"]').blur(function(){
        $(this).next().html('');
        var title=$(this).val();
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]{2,8}$/;
        if(!reg.test(title)){
            $(this).next().html('文章作者，由中文、数字、字母、下滑线组成且不能为空');
            return;
        }
    });
    //添加按钮
    $('input[type="button"]').click(function(){
        var titleflage=true;
        var id={{$res->id}};
        $('input[name="title"]').next().html('');
        var title=$('input[name="title"]').val(); //获取文本框的值
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]+$/; //正则
        if(!reg.test(title)){   //判断是否符合正则
            $('input[name="title"]').next().html('文章标题有中文、数字、字母、下滑线组成且不能为空');
            return;
        }
        $.ajax({
            type:'post',
            url:"/article/adds",
            data:{title:title,id:id},
            async:false,
            dataType:'json',
            success:function(result){
                // console.log(result);
                if(result.count>0){
                    $('input[name="title"]').next().html('该标题已存在');
                    titleflage=false;
                }
            }
        });
        if(!titleflage){
            return;
        }
        $('input[name="man"]').next().html('');
        var title=$('input[name="man"]').val();
        var reg=/^[\u4e00-\u9fa50-9a-zA-Z]{2,8}$/;
        if(!reg.test(title)){
            $('input[name="man"]').next().html('文章作者，由中文、数字、字母、下滑线组成且不能为空');
            return;
        }
        //表单提交
        $('form').submit();
    
    });
</script>