<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>活动添加</title>
</head>
<br>
<h2>凤凰岭爬山</h2>  </br>
        活动集合时间：<span id="gather"></span></br>
        活动结束时间：<span id="end"></span> </br>
        活动经费:50/人。 </br>
        活动介绍： </br>
                无 </br>
        活动剩余人数:<span id="num"></span></br>
<form action="">
        <h2>我要参与:</h2></br>
    姓名：<input type="text" id="name"></br>
    电话：<input type="text" id="tel"></br>
    <input type="button" id="button" value="我要参与">
</form>



</body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(function() {
        //给活动时间
        $.get(
            "/event/time",
            function(res){
                var str=JSON.parse(res);
                if(str.err==1){
                    $("#gather").html(str.set);
                    $("#end").html(str.end);
                    $("#num").html(str.num);
                }else{
                    alert("活动结束");
                }

            }
        )
        //报名结束报名按钮失效
        var myDate = new Date;
        var year = myDate.getFullYear(); //获取当前年
        var mon = myDate.getMonth() + 1; //获取当前月
        var date = myDate.getDate(); //获取当前日
        var time=(year + "-0" + mon + "-" + date  );
        var end=$("#end").html();
        // console.log(time);
        if(time==end){
            alert("活动结束");
        }else{
                //没有结束添加数据
            $(document).on('click','#button',function(){
                var name=$("#name").val();
                var tel=$("#tel").val();
                var num=parseInt($("#num").html());
                console.log(num);
                if(num <=0){
                    alert("活动报名人数结束");
                    return false;
                }
                 // console.log(num);
                $.get(
                    "/event/adda",
                    {name:name,tel:tel},
                    function(res){
                        console.log(res);
                        var str=JSON.parse(res);
                       if(res.err==1){
                           alert("添加成功");
                       }
                    }
                )
            })


        }

    })

</script>