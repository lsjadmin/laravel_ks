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
        <h2>表单验证</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <br action="">
            姓名：<input type="text" name="name" id="name"></br>
            密码：<input type="text" name="pwd" id="pwd"></br>
            <input type="button" value="提交" id="button">
        </form>
</body>
</html>
<script src="/js/jquery/jquery-3.1.1.min.js"></script>
<script>
    $(function(){

            $(document).on("click","#button",function(){
                var name=$("#name").val();
                console.log(name);
                var pwd=$("#pwd").val();
                $.post(
                    "/verify/push",
                    {name:name,pwd:pwd},
                    function(res){
                            console.log(res);
                    }
                )
            })

    })

</script>