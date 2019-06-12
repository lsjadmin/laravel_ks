<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
        <h2>长时间不登录自动退出</h2>
        <input type="text" name="name" id="name">
</body>
</html>
<script src="/js/jquery/jquery-3.1.1.min.js"></script>
<script>
    var lastTime = new Date().getTime();   //更新操作时间
    var currentTime = new Date().getTime();  //更新当前时间
    var timeOut = 10000; //设置超时时间： 10秒

    $(function(){
        $(document).mouseover(function(){
             //alert("aa");
            lastTime = new Date().getTime(); //更新操作时间

        });
    })

    function toLoginPage(){
        currentTime = new Date().getTime(); //更新当前时间
        if(currentTime - lastTime > timeOut){ //判断是否超时

            window.location.href="/text/text";

        }
    }

    window.setInterval(toLoginPage, 1000); //每过一秒就去执行toLoginPage方法
</script>