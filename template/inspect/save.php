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
				include "modules/save/query.php";
			break;
			case 'form':
				include "modules/save/form.php";
			break;
			case 'project_form':
				include "modules/save/project_form.php";
			break;
			case 'project_report':
				include "modules/save/project_report.php";
			break;
			case 'project_view':
				include "modules/save/project_view.php";
			break;
			case 'progress_form':
				include "modules/save/progress_form.php";
			break;
			case 'document_form':
				include "modules/save/document_form.php";
			break;
			default :
				include "modules/save/list.php";
 		    break;
	}
?>
</div><!--page-->
</body>
</html>