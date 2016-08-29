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
  <section id="content" class="m-t-lg wrapper-md animated fadeInUp">    
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="../index.php">Freedom</a>
      <section class="panel panel-default bg-white m-t-lg">
        <header class="panel-heading text-center">
          <strong>会员登陆</strong>
        </header>
        
		 <div class="panel-body wrapper-lg">			
          <div class="form-group">
            <label class="control-label">Email</label>
            <input id="email" name="Email" placeholder="邮箱" class="form-control input-lg" type="text">
          </div>		  		 		  
          <div class="form-group">
            <label class="control-label">Password</label>
            <input id="passwd" name="Password" placeholder="密码" class="form-control input-lg" type="password">
          </div>
		  
          <div class="checkbox">
            <label>
              <input id="remember_me" value="week" type="checkbox"> 记住我
            </label>
          </div>		  
		  
		  
          <a href="../password/reset.php" class="pull-right m-t-xs"><small>忘记密码?</small></a>          
		 <button id="login" type="submit" class="btn btn-primary">确认登陆</button>          
		   <div class="line line-dashed"></div>
		   <div id="msg-success" class="alert alert-info alert-dismissable" style="display: none;">
            <button type="button" class="close" id="ok-close" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> 登录成功!</h4>
            <p id="msg-success-p"></p>
        </div>
				 
          <div id="msg-error" class="alert alert-warning alert-dismissable" style="display: none;"> 		
            <button type="button" class="close" id="error-close" aria-hidden="true">×</button>   
           <h4><i class="icon fa fa-times"></i> 出错了!</h4>
		   <p id="msg-error-p"></p>
        </div>

          <p class="text-muted text-center"><small>没有账号?</small></p>
          <a href="register.php" class="btn btn-default btn-block">马上注册新账号</a>
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
        function login(){
            $.ajax({
                type:"POST",
                url:"/auth/login",
                dataType:"json",
                data:{
                    email: $("#email").val(),
                    passwd: $("#passwd").val(),
                    remember_me: $("#remember_me").val()
                },
                success:function(data){
                    if(data.ret == 1){
                        $("#msg-error").hide(100);
                        $("#msg-success").show(100);
                        $("#msg-success-p").html(data.msg);
                        window.setTimeout("location.href='/user'", 2000);
                    }else{
                    		$("#login").text("确认登陆");
                    		document.getElementById("login").disabled = false;
                        $("#msg-success").hide(100);
                        $("#msg-error").show(100);
                        $("#msg-error-p").html(data.msg);
                    }
                },
                error:function(jqXHR){
                    $("#login").text("确认登陆");
                    document.getElementById("login").disabled = false;
                    $("#msg-error").hide(10);
                    $("#msg-error").show(100);
                    $("#msg-error-p").html("发生错误："+jqXHR.status);
                }
            });
        }
        $("html").keydown(function(event){
            if(event.keyCode==13){
            	$("#login").text("正在登陆...");
            	document.getElementById("login").disabled = true;
                login();
            }
        });
        $("#login").click(function(){
        		$("#login").text("正在登陆...");
            document.getElementById("login").disabled = true;
            login();
        });
        $("#ok-close").click(function(){
            $("#msg-success").hide(100);
        });
        $("#error-close").click(function(){
            $("#msg-error").hide(100);
        });
    })
</script>

</body>
</html>
