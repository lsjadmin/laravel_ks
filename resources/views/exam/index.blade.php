<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
        <h2>登陆</h2>
       姓名： <input type="text" name="user_name" id="name"></br>
        密码: <input type="text" name="user_pwd" id="pwd"></br>
            <button class="button">登陆</button>
</body>
</html>
<script src="/js/jquery/jquery-3.1.1.min.js"></script>
<script>
        $(function(){
            $(document).on("click",".button",function(){
                    //alert('aa');
                var user_name=$("#name").val();
                var user_pwd=$("#pwd").val();
//                console.log(user_name);
//                console.log(user_pwd);
                $.ajax({
                    url:'/exam/login',
                    data:{user_name:user_name,user_pwd:user_pwd},
                    type:"post",
                    dataType:"json",
                    success:function(res){
                       console.log(res);
                    }
                })
            })
        })

</script>