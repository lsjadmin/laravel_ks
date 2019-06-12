<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style type="text/css">
        .talk_con{
            width:600px;
            height:500px;
            border:1px solid #666;
            margin:50px auto 0;
            background:#f9f9f9;
        }
        .talk_show{
            width:580px;
            height:420px;
            border:1px solid #666;
            background:#fff;
            margin:10px auto 0;
            overflow:auto;
        }
        .talk_input{
            width:580px;
            margin:10px auto 0;
        }
        .whotalk{
            width:80px;
            height:30px;
            float:left;
            outline:none;
        }
        .talk_word{
            width:420px;
            height:26px;
            padding:0px;
            float:left;
            margin-left:10px;
            outline:none;
            text-indent:10px;
        }
        .talk_sub{
            width:56px;
            height:30px;
            float:left;
            margin-left:10px;
        }
        .atalk{
            margin:10px;
        }
        .atalk span{
            display:inline-block;
            background:#0181cc;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
        .btalk{
            margin:10px;
            text-align:right;
        }
        .btalk span{
            display:inline-block;
            background:#ef8201;
            border-radius:10px;
            color:#fff;
            padding:5px 10px;
        }
    </style>
    <script src="/js/jquery/jquery-3.1.1.min.js"></script>
</head>
<body>
<div class="talk_con">
    <div class="talk_show" id="words">

        <div class="atalk"><span id="asay">A说:我去吃饭 </span></div>
        <div class="btalk">



        </div>
    </div>
    <div class="talk_input">

        <span class="whotalk" id="name">{{$user_name}}</span>
        <input type="text" class="talk_word" id="talk">
        <input type="button" value="发送" class="talk_sub" id="talksub">
    </div>
</div>
</body>
</html>
<script>
        $(function(){
            //ajax轮询
            var user_name=$("#name").text();
            var asay=$("#asay").text();
            if(asay!==''){
                setInterval(function(){
                    $.ajax({
                        url:'/chat/chatdesc',
                        type:'get',
                        dataType:'json',
                        success:function(res){
                           // console.log(res);
                            if(user_name==res.user_name&&res.err==1){
                                $(".btalk").append('<span id="bsay"></span>');
                                $("#bsay").text(res.chat_desc);
                                $("#bsay").next('span').remove();
                                //return false;
                            }
                        }
                    })
                },3000)
            }


            $(document).on("click","#talksub",function(){
               var chat_desc=$("#talk").val();
                var user_name=$("#name").text();
                if(chat_desc==''){
                    alert('发送内容不能为空');
                    return false;
                }
               // console.log(user_name);
                //console.log(chat_desc);
                $.post(
                        "/chat/chatdo",
                        {chat_desc:chat_desc},
                        function(res){
                            if(res.err==1){
                                $("#talk").val('');
                            }
                        }
                )
            })
        })
</script>


