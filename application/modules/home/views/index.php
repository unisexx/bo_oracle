<html>
	<head>
			<title>ระบบบงานริหารราชการ กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์</title>
			<link rel="stylesheet" type="text/css" media="screen"  href="themes/bo/css/colorbox.css" />
			<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
			<script type="text/javascript" src="themes/bo/js/jquery.colorbox.js"></script>
			<style>
			html, body {
			height: 100%;
			background:url(images/bg.jpg) repeat;
			}
			.download { padding-top:20px; text-align:center; position:relative;}
			.download div { display:block; height:35px;}
			a:link { color:#FFF; font-weight:700;}
			a:visited { color:#FFF; font-weight:700;}
			a:hover {color:#FC0; font-weight:700;}
			</style>
			<script type="text/javascript">
				$(document).ready(function(){
					$("#img_lost").colorbox({width:"450px;", inline:true, href:"#inline_example1"});
					$("btn_send").click({
						//var input_email = $("#email").val();
						//if(input_email)
					})		
				})
			</script>
			<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
<body>
<form method="post" action="home/login">
<div id="loginpage">
<div id="bglogin">
<div style="padding:185px 0 0 110px"><input name="username" type="text" class="txtbox"/></div>
<div style="padding:32px 0 0 110px"><input name="password" type="password" class="txtbox" /></div>
<div style="display:inline; float:left; padding:20px 0 0 110px"><img id="img_lost" src="images/lost_password.png" /></div>
<div style="display:inline; float:left; padding:20px 0 0 90px"><input name="" type="submit" class="btn_login" value=""/></div>
</div>

<div class="download">
<div><a href="bo_user_monitor.zip">ดาวน์โหลดคู่มือผู้ใช้งานระบบติดตามและประเมินผล</a></div>
<div><a href="bo_user_inspect.zip">ดาวน์โหลดคู่มือผู้ใช้งานระบบตรวจราชการ</a></div>
</div>
</div>

</form>



<div style='display:none;'>
	<div id='inline_example1' style='padding:10px; background:#fff;'>
		<fieldset style="width:350px">
			<legend>ลืมรหัสผ่าน</legend>
			<label>กรุณากรอกอีเมล์ ที่ท่านได้ทำการลงทะเบียนไว้</label>
			<p>อีเมล์ : <input type="text" name="email" value="" size="60"><input type="button" name="btn_send" value="ส่งรหัสผ่าน"></p>
			<p></p>
		</fieldset>		
	</div>
</div>
</body>
</html>