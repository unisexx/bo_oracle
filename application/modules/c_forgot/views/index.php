<style>
html, body {
height: 100%;
}
</style>
<link rel="stylesheet" type="text/css" href="css/style.css">
<form method="post" action="c_forgot/send_password">
<div style="width:370px;padding-left: 30%;padding-top:50px;" >
<fieldset style="background-color: #FFF;">
	<legend>ลืมรหัสผ่าน</legend>
<div style="padding:20px 0 0 0">กรุณากรอกอีเมล์  <br><span style="color:#F90404"><?=@$message;?></span><br><input name="email" type="text" class="txtbox" size="50" value="<?=@$_POST['email'];?>"/></div>
<div style="display:inline; float:left; padding:20px 0 0 100px">
	<input name="" type="submit" class="" value="Send Password"/> 
	<input type="button" value="Login" onclick="window.location='../home';">
</div>
</fieldset>
</div>
</form>