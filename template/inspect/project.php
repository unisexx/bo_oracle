<? include "../include/config.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$is_title;?></title>
<? include '_script.php'?>
</head>

<body>
<div id="page">
<div id="head"><? include '_header.php'?></div>
<? switch($_GET['act'])
	{
			case 'query':
				include "modules/project/query.php";
			break;
			case 'form':
				include "modules/project/form.php";
			break;
			case 'view':
				include "modules/project/view.php";
			break;
			case 'report':
				include "modules/project/report.php";
			break;
			default :
				include "modules/project/list.php";
 		    break;
	}
?>
</div><!--page-->
</body>
</html>