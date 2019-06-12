<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>聊天室</title>
</head>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<body>
    <input type="text" id="name">
    <input type="button" value="send" id="button"></br>
    <ul id="message"></ul>
</body>
</html>
<script>
          //初始化一个websocket对象
          var ws_server ='ws://1809a.ks.com:9502'
           var ws =new WebSocket(ws_server);
           ws.onopen=function(){
            $(document).on("click","#button",function(){
                    var desc=$("#name").val();
                   
                            //websock 成功时触发事件
                                //使用send发送数据
                                var data={
                                    type:"message",
                                    text:desc,
                                    id:11,
                                    date:Date.now()
                                }
                                ws.send(JSON.stringify(data));
                        });
                       
                 }
               
                  //接收服务端数据时触发事件
                ws.onmessage=function(d){
                    $("#name").val('');
                     var data=d.data;
                     var a=JSON.parse(data);
                     console.log(a.text);
                  
                      $('#message').append($('<li>').text(a.text));
                    //alert(d.data);
                }
                console.log(ws);

       
  
      
</script>