<script type="text/javascript">
$(document).ready(function(){
	//$('select[name=pprovince_id],select[name=pproductivity_id],select[name=mtyear],select[name=pdepartment_id],select[name=pdivision_id]').attr('class','mustChoose');
	$('select[name=pdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		if(departmentid != 0){
			$("select[name=pdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpdivision_id");
			$.post('ajax/load_division_list',{
				'departmentid' : departmentid,
				'canaccessall' : '<?=login_data('mt_access_all');?>'
			},function(data){
				$("#dvpdivision_id").html(data);
				$("select[name=divisionid]").attr("id","pdivision_id");
				$("#pdivision_id").attr('name', 'pdivision_id');
				$("select[name=pdivision_id]").attr('class','mustChoose');										
			})
		}
	})
	
	$('select[name=mtyear]').live('change',function(){
		var mtyear = ($(this).val());
		var departmentid = $('select[name=pdepartment_id]').val();
		var divisionid = $('select[name=pdivision_id]').val();
		if(mtyear != 0){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvProductivity");
			$.post('monitor_operation_withdraw/select_productivity_list',{
				'mtyear' : mtyear,
				'departmentid' : departmentid,
				'divisionid' : divisionid,
			},function(data){
				$("#dvProductivity").html(data);	
				$("select[name=pproductivity_id]").attr('class','mustChoose');												
			})	
		}
	})		
})
</script>
<h3>รายงานสรุป แบบสำรวจความพึงพอใจของผู้รับบริการ รายจังหวัด</h3>
<form>
<fieldset>
	<legend>กรองข้อมูล</legend>
	<div>
	จังหวัด : 
	<?php
		$can_access_all = login_data('mt_access_all');
		if($can_access_all!="off"){
			echo form_dropdown('pprovince_id',get_option('id','title','cnf_province','id <> 2 '),@$_GET['pprovince_id'],'','-- ทั่วประเทศ --');
		}
		else{
			echo form_dropdown('pprovince_id',get_option('id','title','cnf_province',"id=".login_data('workgroup_provinceid')),'','');
		}				
	?>
           ตั้งแต่วันที่  
    <input type="text" class="datepicker" name="start_date" value="<?=@$_GET['start_date'];?>">
            ถึง
    <input type="text" class="datepicker" name="end_date" value="<?=@$_GET['end_date'];?>">
    <input type="submit" name="btnsubmit" value="" class="btn_search">
	</div>
</fieldset>
</form>
<? if($_GET){ 
		if($nrecord > 0){
?>		
	  <div style="clear: both"></div>	
	  <div style="float:right;padding-top: 10px;">
	  	<a href="monitor_questionair_total_report/print_page<?=$url_parameter;?>" target="_blank"><img src="images/printer_icon.gif" border="0" alt="พิมพ์หน้านี้" title="พิมพ์หน้านี้"></a>
	  	<a href="monitor_questionair_total_report/export<?=$url_parameter;?>" target="_blank"><img src="images/excel-button.png" border="0" alt="ส่งออกเป็น Excel" title="ส่งออกเป็น Excel"></a>
	  </div>
	  <div style="clear: both"></div>
      <fieldset>
	  <table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td>  	
	  <p align="center">
	  	<b>สรุปผลสำรวจความพึงพอใจของผุ้รับบริการต่อการให้บริการของ<br>
	   	<? if(@$_GET['pprovince_id'] > 0 ){
	   		echo "สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด".$province['title']."<br>";
		}else{ echo "สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด (สพจ.3)<br>";}
		 
		if(@$_GET['start_date']!="" && @$_GET['end_date'])
			echo "ตั้งแต่วันที่ ".$_GET['start_date']." - ".$_GET['end_date'];		
		?>
	  	</b>
	  </p>	                        
      <table class="tblist2" >                  	
      <tr height="25px" >
      	<td width="" style="border-top:1px #CCC solid;"><center>จังหวัด</center></td>
      	<td width="100" style="border-top:1px #CCC solid;"><center>จำนวน (N=<?=number_format($nrecord,0);?>)</center></td>
      	<td width="100" style="border-top:1px #CCC solid;"><center>ร้อยละ</center></td></tr>            
	  </tr>
	  <? foreach($province_list as $key=>$item){ ?>
	  <tr>
	  	<td><?=$item['title'];?></td>
	  	<td align="right"><?=number_format(GetQuestionairAmount($item['id'],@$_GET['start_date'],@$_GET['end_date'],@$_GET['pprovince_id'],"qty"),0);?></td>
	  	<td align="right"><?=number_format(GetQuestionairAmount($item['id'],@$_GET['start_date'],@$_GET['end_date'],@$_GET['pprovince_id'],"percent"),2);?></td>
	  </tr>
	  <? } ?>
	  </table>
<?
	}else{
		echo "<fieldset> ไม่มีข้อมูลการกรอกแบบสอบถาม</fieldset>";
	} 
} 
?>      