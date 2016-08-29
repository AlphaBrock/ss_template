<!DOCTYPE html>
<html class="bg-dark" lang="en">
<head>
  <meta charset="utf-8">
  <title>注册/登录-Freedom</title>
  <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
  <link rel="stylesheet" href="../theme/freedom/css/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="../theme/freedom/css/animate.css" type="text/css">
  <link rel="stylesheet" href="../theme/freedom/css/font-awesome.min.css" type="text/css">
  <link rel="stylesheet" href="../theme/freedom/css/font.css" type="text/css">
    <link rel="stylesheet" href="../theme/freedom/css/app.css" type="text/css">
  <!--[if lt IE 9]>
    <script src="js/ie/html5shiv.js"></script>
    <script src="js/ie/respond.min.js"></script>
    <script src="js/ie/excanvas.js"></script>
  <![endif]-->
</head>
<body>
<section id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="../index.php">Freedom</a>
      <section class="panel panel-default m-t-lg bg-white">
        <header class="panel-heading text-center">
          <strong>注册会员</strong>
        </header>
		        <div class="panel-body wrapper-lg">


          <div class="form-group">
            <label class="control-label">Nick Name</label>
            <input id="name" placeholder="昵称" class="form-control input-lg" type="text">
          </div>          
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="email" placeholder="邮箱" class="form-control input-lg" type="text">
          </div>
                    <div class="form-group">
            <label class="control-label">Password</label>
            <input id="passwd" placeholder="密码(至少8位)" class="form-control input-lg" type="password">
          </div>
          <div class="form-group">
            <label class="control-label">Confirm Password</label>
            <input id="repasswd" placeholder="确认密码" class="form-control input-lg" type="password">
          </div>
          <div class="form-group">
            <label class="control-label">Choose Your Contact Style</label>
              <select class="form-control" id="imtype">
                <option></option>
                <option value="1">微信</option>
                <option value="2">QQ</option>
                <option value="3">Google+</option>
              </select>
          </div>
          <div class="form-group">
            <label class="control-label">Contact Account</label>
            <input id="wechat" placeholder="联系方式账号" class="form-control input-lg" type="text">          
          </div>
                                <div class="form-group">
              <div id="embed-captcha"></div>
            </div>
          	  
          <div class="checkbox">
            <label>
              <p>注册即代表同意<a href="../tos.php">服务条款</a>，以及保证所录入信息的真实性，如有不实信息会导致账号被删除。</p>
            </label>
          </div>
          <button id="reg" type="submit" class="btn btn-primary">确认注册</button>		  
          <div class="line line-dashed"></div>
		  
		  <div id="msg-success" class="alert alert-info alert-dismissable" style="display: none;">
            <button type="button" class="close" id="ok-close" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> 成功!</h4>
            <p id="msg-success-p"></p>
        </div>

        <div id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;">
            <button type="button" class="close" id="error-close" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-times"></i> 出错了!</h4>
            <p id="msg-error-p"></p>
        </div>

		
		
          <p class="text-muted text-center"><small>已经注册过了?</small></p>
          <a href="../user.1.php" class="btn btn-default btn-block">返回登录</a>
        </div>
      </section>
    

  		  
  
	</div>
  </section>
  <footer id="footer">
    <div class="text-center padder">
      <p>
        <small>使用本站服务请遵守当地法律<br>© <a href="../index.php">Freedom</a></small>
      </p>
    </div>
  </footer>		
 

<!-- jQuery 2.1.3 -->
<script src="../assets/public/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="../assets/public/js/bootstrap.min.js" type="text/javascript"></script>
<!-- iCheck -->
<script src="../assets/public/js/icheck.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

        $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        });
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        });
        $("#mail-ok-close").click(function(){
            $("#mail-msg-success").hide(100);
        });
        $("#mail-error-close").click(function(){
            $("#mail-msg-error").hide(100);
        });
    })
</script>


<script>
var handlerFloat = function (captchaObj) {
    $("#reg").click(function () {
    	  $("#reg").text("正在注册...");
        document.getElementById("reg").disabled = true;
        var validate = captchaObj.getValidate();
        if (!validate) {
        		$("#reg").text("确认注册");
        		document.getElementById("reg").disabled = false;
            $("#msg-success").hide(10);
            $("#msg-error").show(100);
            $("#msg-error-p").html('请先完成上述图片验证');
            return;
        }
        $.ajax({
            url: "/auth/register.php", // 进行二次验证
            type: "post",
            dataType: "json",
                data:{
                    name: $("#name").val(),
                    email: $("#email").val(),
                    passwd: $("#passwd").val(),
                    repasswd: $("#repasswd").val(),					
                    wechat: $("#wechat").val(),
                    imtype: $("#imtype").val(),

                                    },
                success:function(data){
                    if(data.ret == 1){
                    		$("#reg").text("注册成功");
                    		document.getElementById("reg").disabled = true;
                        $("#msg-error").hide(10);
                        $("#msg-success").show(100);
                        $("#msg-success-p").html(data.msg);
                        window.setTimeout("location.href='/auth/login'", 1800);
                    }else{
                    		$("#reg").text("确认注册");
                    		document.getElementById("reg").disabled = false;
                        $("#msg-success").hide(10);
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#reg").text("确认注册");
                    document.getElementById("reg").disabled = false;
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                }
        });
    });
    // 弹出式需要绑定触发验证码弹出按钮
    captchaObj.bindOn("#reg");
    // 将验证码加到id为captcha的元素里
    captchaObj.appendTo("#embed-captcha");
    // 更多接口参考：http://www.geetest.com/install/sections/idx-client-sdk.html
};



</script>




</body>
</html>
