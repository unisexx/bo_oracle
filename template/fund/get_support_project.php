<? include "../include/config.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$fd_title;?></title>
<? include '_script.php'?>
</head>

<body>
<div id="page">
<div id="head"><? include '_header.php'?></div>
<? switch($_GET['act'])
	{
			case 'query':
				include "modules/get_support_project/query.php";
			break;
			case 'form':
				include "modules/get_support_project/form.php";
			break;
			case 'form2':
				include "modules/get_support_project/form2.php";
			break;
			case 'list2':
				include "modules/get_support_project/list2.php";
			break;
			default :
				include "modules/get_support_project/list.php";
 		    break;
	}
?>
</div><!--page-->
</body>
</html>