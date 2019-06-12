<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<script>
        //初始化一个websocket对象
        var ws_server ='ws://1809a.ks.com:9502'
        var ws =new WebSocket(ws_server);
        //websock 成功时触发事件
        ws.onopen=function(){
            //使用send发送数据
            ws.send("hello");
        }
        //接收服务端数据时触发事件
        ws.onmessage=function(d){
            console.log(d.data);
            alert(d.data);
        }
        console.log(ws);
</script>
    
</body>
</html>