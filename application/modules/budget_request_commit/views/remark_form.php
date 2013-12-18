<style type="text/css">
h4{	
	color:#F60;
}
span{
	color:#0033CC;
}
</style>
<?
if($divisionid>0)
{	   		
switch($act):
	case 'view':
	$message = '<h4 id="topic">หมายเหตุการแก้ไข ถึงหน่วยงาน <span>'.$division['title'].'</span> ขั้นตอนที่ <span>'.$step.'</span> ปีงบประมาณ <span>'.$budgetyear.'</span></h4>
	<br>'.$comment['remark'].'</br>	
	<div align="right" style="width:100%; display:block;  float:left; background-color:#F4F4F4; padding-bottom:2px; text-align:right;">
	  ปรับปรุงล่าสุดวันที่ : '.stamp_to_th_fulldate($comment['commentdate']).'
	</div>
	<input type="button" name="button2" id="button2" value="" class="btn_print" onclick="window.open(\'budget_request_commit/print_remark/'.$step.'/'.$budgetyear.'/'.$divisionid.'\');">
	';	    							
	break;
	case 'edit':
	$message = '<h4 id="topic">หมายเหตุการแก้ไข ถึงหน่วยงาน <span>'.$division['title'].'</span> ขั้นตอนที่ <span>'.$step.'</span> ปีงบประมาณ <span>'.$budgetyear.'</span></h4>                         
		<form method="post" action="budget_request_commit/send_back'.$url_parameter.'">							
		<input type="hidden" id="step" name="step" value="'.$step.'" />
		<input type="hidden" id="budgetyear" name="budgetyear" value="'.$budgetyear.'" />
		<input type="hidden" id="divisionid" name="divisionid" value="'.$divisionid.'" />		
		<textarea name="remark" id="remark" >'.@$comment['remark'].'</textarea>
		<div style="clear:both"></div>
		<div style="background-color:#F4F4F4; padding-bottom:2px;">
		 <input type="submit" name="btn_edit" id="btn_edit" value="" class="btn_save"  />
		 <input type="button" name="button2" id="button2" value="" class="btn_print" onclick="window.open(\'budget_request_commit/print_remark/'.$step.'/'.$budgetyear.'/'.$divisionid.'\');">		 
		</div>
		</form>';
	break;
	case 'print':	
	$message = '
	<html>
	<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	</head>
	<body>
	<h4 id="topic">หมายเหตุการแก้ไข ถึงหน่วยงาน <span>'.$division['title'].'</span> ขั้นตอนที่ <span>'.$step.'</span> ปีงบประมาณ <span>'.$budgetyear.'</span></h4>
	'.$comment['remark'].'<br>
	<div align="right" style="width:650px; display:block;  float:left; background-color:#F4F4F4; padding-bottom:2px; text-align:right;">
	  ปรับปรุงล่าสุดวันที่ : '.stamp_to_th_fulldate($comment['commentdate']).'    พิมพ์เมื่อวันที่ : '.date('Y/m/d H:i:s').'
	</div><script>window.print();</script>
	</body>
	</html>
	';
	break;
	default:
	break;
endswitch;
echo $message;
}
?>	
						