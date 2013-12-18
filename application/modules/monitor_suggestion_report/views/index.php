<style>
fieldset{
	padding: 0px;
}
.tblist2 td{
	border-left:0px;
	border-right:0px;
}
</style>
<script type="text/javascript">
	$(document).ready(function(){		
		$('select[name=productivity_id],select[name=mainact_id],select[name=subact_id]').attr('disabled','disabled');
		
		
		
		$('select').removeAttr('disabled');
		
		$( "#tabs" ).tabs({selected: 1});
		$("#tabs-2").attr("style","padding:10px 10px 0 10px;");
	})
</script>
<h3>รายงานผลการปฏิบัติงาน (สรุปปัญหาอุปสรรคและข้อเสนอแนะ) </h3>
<div id="tabs">
    <ul>
      <? 
      	if(login_data('mt_access_all')=='on'){ 
      ?>
      	<li><a href="#tabs-1">ส่วนกลาง</a></li>
      	<li><a href="#tabs-2" >จังหวัด</a></li>
      <? 
	  	}elseif(login_data('user_province_id')==2 && login_data('mt_access_all')=='off'){
	  ?>
     	 <li><a href="#tabs-1">ส่วนกลาง</a></li>
      <? 
	  	}elseif(login_data('user_province_id')!=2 && login_data('mt_access_all')=='off'){ 
	  ?>
      	<li><a href="#tabs-2">จังหวัด</a></li>      
      <? } ?>
    </ul>
    <div id="tabs-1">
    </div>	
    <div id="tabs-2">		
    		<form>
    		<input type="hidden" name="type" value="province">
			<table class="tblist2">	
				<tr>
					<td>กรม</td>
					<td>
						<?php						
						echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'),@$_GET['pdepartment_id'],'','-- เลือกกรม --')
						?>
					</td>
				</tr>
				<tr id="tr_province">
					<td>จังหวัด :</td>
					<td> 
					<?php
						$select_province = @$_GET['pprovince_id']!="" ? $_GET['pprovince_id'] : login_data('user_province_id');		
						$can_access_all = login_data('mt_access_all');
						$condition = " id <> 2 ";
						if($can_access_all!="on")
						{							
							$condition .= $can_access_all=="on" ? "" : " and id=".login_data('user_province_id');		
							echo form_dropdown('pprovince_id',get_option('id','title','cnf_province',$condition),$select_province,'','','0');
						}else{
							$condition .= $can_access_all=="on" ? "" : "id=".login_data('user_province_id');
							echo form_dropdown('pprovince_id',get_option('id','title','cnf_province',$condition),$select_province,'','--เลือกทุกจังหวัด--');
						}
					?>
					</td>
				</tr>			
				<tr>					
		           	<td>ปีงบประมาณ :</td>
		    		<td>
		    			<?php echo form_dropdown('bg_year',get_option('fnyear','(fnyear +543) as years','fn_strategy'),@$_GET['bg_year'],'','-- เลือกปีงบประมาณ --');?>
		    			<? 
		    			if(login_data('mt_access_all')!='on'){
		    				$user_province = login_data('workgroup_provinceid') > 0  ? login_data('workgroup_provinceid') : 0;
							$user_province = $user_province == 0 && login_data('division_provinceid') ==2  ? 2 : $user_province;
							$user_mode = $user_province == 2 ? 'central' : 'domestic';
							echo '<input type="hidden" name="mode" id="mode" value="'.$user_mode.'">';
		    			}
						?>
		    		</td>
		    	</tr>   
		    	<tr>
		    		<td>เดือน</td>
		    		<td>		    			
		    			<?
		    				
		    				echo '<select name="start_month_idx">'; 
		    				for($i=0;$i<=11;$i++)
		    				{
		    					$selected = @$_GET['start_month_idx']==$i ? 'selected="selected"' : "";
		    					echo '<option value="'.$i.'" '.$selected.' >'.$month[$i].'</option>';
							}
							echo '</select>';	
						?>
						ถึง
						<?
		    				echo '<select name="end_month_idx">'; 
		    				for($i=0;$i<=11;$i++)
							{
		    					$selected = @$_GET['end_month_idx']==$i ? 'selected="selected"' : "";
		    					echo '<option value="'.$i.'" '.$selected.' >'.$month[$i].'</option>';
							}
							echo '</select>';	
						?>
		    		</td>
		    	</tr> 																						    	
		    	<tr>
		    		<td></td><td><input type="submit" name="btnsubmit" value="" class="btn_search"></td>
		    	</tr>
		    </table>
		    </form>			 	
    </div>
</div>
<br><br>
<? if(@$_GET['bg_year']>0){ ?>
	<div style="clear: both"></div>	
	  <div style="float:right;padding-top: 10px;">
	  	<a href="monitor_suggestion_report/print_page<?=$url_parameter;?>" target="_blank"><img src="images/printer_icon.gif" border="0" alt="พิมพ์หน้านี้" title="พิมพ์หน้านี้"></a>
	  	<a href="monitor_suggestion_report/export<?=$url_parameter;?>" target="_blank"><img src="images/excel-button.png" border="0" alt="ส่งออกเป็น Excel" title="ส่งออกเป็น Excel"></a>
	  </div>
<div style="clear: both"></div>	
<table id="tblist2" class="tblist2">
	<thead>
	<tr>
		<th style="text-align: center;">
			สรุปรายงานสรุปผลการดำเนินงานปัญหาอุปสรรคและข้อเสนอแนะ (<? if(@$_GET['pprovince_id']==0)echo 'ทุกจังหวัด'; else echo "จังหวัด".@$province_data['title']; ?>)   
			ประจำปีงบประมาณ <?=@($_GET['bg_year']+543);?><br>
			<? if(@$_GET['pprovince_id']>0)echo "ของ สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด".@$province_data['title']; ?> (ตั้งแต่เดือน <?=$month[$start_month_idx];?> - <?=$month[$end_month_idx];?>)<br>
			<?=$select_department['title'];?>			
		</th>
	</tr>	
</table>
<? echo $data_list;?>
<? }?>