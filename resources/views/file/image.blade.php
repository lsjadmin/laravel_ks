<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">视频添加</h4>
            <form class="forms-sample"  id="ajax-upload-demo" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputName1">标题</label>
                    <input type="text" class="form-control" id="exampleInputName1" id="name" name="name" placeholder="标题">
                </div>
                <div class="form-group">
                    <label>封面添加</label>
                    <div class="input-group col-xs-12">
                        <input type="file" id="doc-ipt-file-1" class="un" name="picture">
                    </div>
                </div>
              
                <div class="form-group">
                    <label for="exampleTextarea1">简介</label>
                    <textarea class="form-control" id="exampleTextarea1" id="text" name="text" rows="4"></textarea>
                </div>
                <input  type="button"class="btn btn-gradient-primary mr-2" id="sub" value="添加">
                <button class="btn btn-light">清空</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(function(){
        $("#sub").click(function () {
            // 上传文件
            var name=$("#name").val();
            var text=$("#text").val();
            var form = document.getElementById('ajax-upload-demo');
            $.ajax({
                url: '/file/image1',
                type: 'POST',
                cache: false,
                data: new FormData(form),name:name,text:text,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (res) {
                    console.log(res);
                }
            });
        })
    })
</script>
