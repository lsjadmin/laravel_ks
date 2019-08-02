<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>图片上传</title>
    <style>
		.degue {
			width:400px;
			height:20px;
			background-color: green;
		}
		.show {
			height: 20px;
			background-color: red;
			width:0px;
		}
	</style>
</head>
<body>
    <h2>上传</h2>
    请选择图片:<input type="file" id="img"></br>
                <input type="button" name="bun" value="确定"></br>

    进度条：  <div class="degue">
                  <div class="show"></div></br>
                  <span class="text"></span>
        	</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
        $(function(){
            size=1024*20*1;
            index=1;
            totalPage=0;
            var per=0;
             $("input[name='bun']").click(function(){
                      upload(index);
             })

             function upload(index){
                    var obj=document.getElementById("img").files[0]; //获得文件信息
                    var filesize=obj.size;//获得文件大小
                   // console.log(filesize);
                    totalPage=Math.ceil(filesize/size); //查看分多少次
                  //console.log(totalPage);
                    var filename=obj.name; //获得文件的名字
                    var start=(index-1)*size; //开始位置
                    // console.log(start);
                    var end=start+size; //获得结束位置

                    var chunk=obj.slice(start,end);//获得切开图片的内容
                  //  console.log(chunk);
                     per =((start/filesize)*100).toFixed(2); //变成两位数字（进度条%。。。）
                    // console.log(per);
                    var form=new FormData(); //表单对象
                    form.append("file",chunk,filename); //append 传到后台是一个数组 ，file名 chunk,filename值
                    $.ajax({
                        type:"post",
                        data: form,
                        url : "/file/b",
                        processData: false,
                        contentType: false,//mima类型 
                        cache:false,
                        dataType : "json",
                        async:true,//同步
                        success:function(msg){
                            console.log(index);
                            console.log(totalPage);
                           if(index < totalPage ){
                                  index++;
                                  per = per+"%";
                               //console.log(per);
                                  $(".show").css("width",per);
                                  $(".text").text(per);
                                  upload(index);
                                }else{
                                  $(".show").css("width","100%");
                                  $(".text").text("100%");
                                }
                        }
		        });
             }
        })
</script>