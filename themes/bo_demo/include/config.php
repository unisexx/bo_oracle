<? 
global $title;
$bf_title = "ระบบจัดการหลังบ้าน (Back Office System) กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์";
$fn_title = "ระบบงานการคลัง (Finanace System) กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์";
$mo_title = "ระบบติดตามและประเมินผล (Monitor System) กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์";
$is_title = "ระบบตรวจราชการ (Inspect System) กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์";
$footer = "&copy; Copyright  Co., Ltd.";


function db_connect()
{
$link = mysql_connect("localhost","backoffice","arromdee");
mysql_select_db("name_db",$link);
$charset = "SET NAMES 'utf8'";
mysql_query($charset);

}
?>

<? 
function db_close()
{
mysql_close();
}
?>

