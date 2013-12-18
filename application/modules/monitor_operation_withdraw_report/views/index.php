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
		
		$('select[name=pdepartment_id]').live('change',function(){
				var bg_year = ($('select[name=bg_year]').val());
				var departmentid = $('select[name=pdepartment_id]').val();
				var divisionid = $('select[name=pdivision_id]').val();
				var provinceid = $('select[name=pprovince_id]').val();
				if(bg_year > 0){
					$("select[name=pproductivity_id]").attr("disabled","disabled");
					$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo(".tdproduct");
					$.post('monitor_operation_withdraw_report/select_productivity_list',{
						'mtyear' : bg_year,
						'departmentid' : departmentid,
						'divisionid' : divisionid,
						'provinceid' : provinceid
					},function(data){
						$(".tdproduct").html(data);	
						//$("select[name=pproductivity_id]").attr('class','mustChoose');												
					})	
				}
			})	
		
		$('select[name=bg_year]').live('change',function(){
				var bg_year = ($(this).val());
				var departmentid = $('select[name=pdepartment_id]').val();
				var divisionid = $('select[name=pdivision_id]').val();
				var provinceid = $('select[name=pprovince_id]').val();
				if(bg_year > 0){
					$("select[name=pproductivity_id]").attr("disabled","disabled");
					$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo(".tdproduct");
					$.post('monitor_operation_withdraw_report/select_productivity_list',{
						'mtyear' : bg_year,
						'departmentid' : departmentid,
						'divisionid' : divisionid,
						'provinceid' : provinceid
					},function(data){
						$(".tdproduct").html(data);	
						//$("select[name=pproductivity_id]").attr('class','mustChoose');												
					})	
				}
			})	
		
		$('select[name=pproductivity_id]').live("change",function(){
			var province = $('select[name=pprovince_id]').val();
			var department = $('select[name=pdepartment_id]').val();
			var bg_year = $('select[name=bg_year]').val();
			var productivity = $('select[name=pproductivity_id]').val();
			$("select[name=mainact_id]").attr("disabled","disabled");			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo(".tdmainact");
			$.post('ajax/mt_load_mainactivity',{
				'province_id':province,
				'department_id':department,
				'bg_year':bg_year,
				'productivity_id':productivity,
				'controlname':'mainact_id'		
			},function(data){
				$(".tdmainact").html(data);																	
			});
		})
		
		$('select[name=mainact_id]').live("change",function(){
			var province = $('select[name=pprovince_id]').val();
			var department = $('select[name=pdepartment_id]').val();
			var bg_year = $('select[name=bg_year]').val();
			var productivity = $('select[name=pproductivity_id]').val();
			var mainact_id = $('select[name=mainact_id]').val();
			$("select[name=subact_id]").attr("disabled","disabled");
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo(".tdsubact");
			$.post('ajax/mt_load_subactivity',{
				'province_id':province,
				'department_id':department,
				'bg_year':bg_year,
				'productivity_id':productivity,
				'mainact_id':mainact_id,
				'control_name':'subact_id'		
			},function(data){
				$(".tdsubact").html(data);																	
			});
		})
		
		$('select[name=subact_id]').live("change",function(){
			var subact_id = $(this).val();
			$("select[name=project_id]").attr("disabled","disabled");
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo(".tdproject");
			$.post('ajax/mt_load_project',{
				'subactid':subact_id,				
				'control_name':'project_id'		
			},function(data){
				$(".tdproject").html(data);																	
			});
		})
		
		$('select').removeAttr('disabled');
		
		$( "#tabs" ).tabs({selected: 1});
		$("#tabs-2").attr("style","padding:10px 10px 0 10px;");
	})
</script>
<h3>รายงานผลการปฏิบัติงานและเบิกจ่าย (ภาพรวม) </h3>
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
						echo form_dropdown('pdepartment_id',get_option('id','title','cnf_department'),@$_GET['pdepartment_id'],'','-- ทุกกรม --')
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
		           	<td>ผลผลิต :</td>
		   			<td class="tdproduct">
		   				<?php 
		   					if(@$_GET['bg_year']>0)
								echo $productivity_list;
							else
		   						echo form_dropdown('pproductivity_id',get_option('id','title','mt_strategy WHERE ProductivityID < 1 AND sectionstrategyid > 0'),@$_GET['pproductivity_id'],'','-- เลือกผลผลิต --')
		   				?>
		   			</td>
		   		</tr>
		   		<tr>
		   			<td>กิจกรรมหลัก :</td>
		   			<td class="tdmainact">
		   				<?php
		   					$condition = @$_GET['pproductivity_id'] > 0 ? " mainactid < 1 AND productivityid > 0 AND PID = ".@$_GET['pproductivity_id'] : " mainactid < 1 AND productivityid > 0"; 
		   					echo form_dropdown('mainact_id',get_option('id','title','mt_strategy ',$condition),@$_GET['mainact_id'],'','-- เลือกกิจกรรมหลัก --')
		   				?>
   				  </td>
		   		</tr>
		   		<tr>
		   			<td>กิจกรรมย่อย :</td>
		   			<td class="tdsubact">
		   				<?php
		   					$condition = @$_GET['mainact_id'] > 0 ? " mainactid > 0 AND PID=".$_GET['mainact_id'] : " mainactid > 0 "; 
		   					echo form_dropdown('subact_id',get_option('id','title','mt_strategy ',$condition),@$_GET['subact_id'],'','-- เลือกกิจกรรมย่อย --')
		   				?>
		   			</td>
		    	</tr>
		    	<tr>
		    		<td>กิจกรรม / โครงการ</td>
		    		<td class="tdproject">
		    			<?
		    				$condition = @$_GET['subact_id'] > 0 ? "  SUBACTID=".$_GET['subact_id'] : "";
							echo form_dropdown('project_id',get_option('id','title','mt_project',$condition),@$_GET['project_id'],'','-- เลือกโครงการ --');
		    			?>
		    		</td>
		    	</tr>
		    	<? if(login_data('mt_access_all')): ?>
		    	<tr>
		    		<td>
		    			 
		    		</td>
		    		<td>
		    			<input type="checkbox" name="show_helper" value="on" <? if(@$_GET['show_helper']=='on')echo 'checked="checked"';?>> แสดงจำนวนคนที่ได้รับการช่วยเหลือจากเงินอุดหนุน
		    		</td>
		    	</tr>
		    	<? endif;?>
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
	  	<a href="monitor_operation_withdraw_report/print_page<?=$url_parameter;?>" target="_blank"><img src="images/printer_icon.gif" border="0" alt="พิมพ์หน้านี้" title="พิมพ์หน้านี้"></a>
	  	<a href="monitor_operation_withdraw_report/export<?=$url_parameter;?>" target="_blank"><img src="images/excel-button.png" border="0" alt="ส่งออกเป็น Excel" title="ส่งออกเป็น Excel"></a>
	  </div>
<div style="clear: both"></div>	
<?
	$total_col = @$_GET['show_helper']=='on' ? 32 : 31;
	$n_col = $end_month_idx - $start_month_idx; 
?>
<table id="tblist2" class="tblist2">
	<thead>
	<tr>
		<th colspan="<?=$total_col;?>" style="text-align: center;">
			รายงานผลการปฏิบัติงานสำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด (<? if(@$_GET['pprovince_id']==0)echo 'ทุกจังหวัด'; else echo "จังหวัด".@$province_data['title']; ?>)   
			ปีงบประมาณ <?=@($_GET['bg_year']+543);?><br>
			ผลผลิต <?=@$select_productivity['title'];?>
			<br>
			<? if(@$select_mainact['title']!='')echo "กิจกรรมหลัก : ".@$select_mainact['title'];?>
			<br>
			<? if(@$select_subact['title']!='')echo "กิจกรรมย่อย : ".@$select_subact['title'];?>
			<br>
			<? if(@$select_project['title']!='')echo "กิจกรรม / โครงการ : ".@$select_project['title'];?>		</th>
	</tr>
	<tr rowspan="2">
		<th rowspan="2" style="text-align:center;border:1px solid #CCC;">จังหวัด</th>
		<? if(@$_GET['show_helper']=='on'): ?>
		<th style="text-align:center;border:1px solid #CCC;" rowspan="2">จำนวนคนที่ได้รับ<br>การช่วยเหลือจากเงินอุดหนุน</th>
		<? endif;?>
		<th style="text-align:center;border:1px solid #CCC;" colspan="2">เป้าหมาย</th>
		<th style="text-align:center;border:1px solid #CCC;" rowspan="2">งบประมาณ<br>บาท</th>
		<th style="text-align:center;border:1px solid #CCC;" colspan="<?=$n_col+2;?>">ผลการดำเนินงาน</th>
		<th style="text-align:center;border:1px solid #CCC;" colspan="<?=$n_col+2;?>">เบิกจ่าย(บาท)</th>
	</tr>
	<tr>
		<th style="text-align:center;border:1px solid #CCC;">หน่วยนับ</th>
		<th style="text-align:center;border:1px solid #CCC;">จำนวน</th>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
		<th style="text-align:center;border:1px solid #CCC;"><?=$month_dec[$i];?></th>
		<? endfor; ?>		
		<th style="text-align:center;border:1px solid #CCC;">สะสม <?=$month_dec[$start_month_idx];?> - <?=$month_dec[$end_month_idx];?></th>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
		<th style="text-align:center;border:1px solid #CCC;"><?=$month_dec[$i];?></th>
		<? endfor; ?>		
		<th style="text-align:center;border:1px solid #CCC;">สะสม <?=$month_dec[$start_month_idx];?> - <?=$month_dec[$end_month_idx];?></th>
	</tr>
	<tr>
	  <td>จำนวนรวม</td>
	  <? if(@$_GET['show_helper']=='on'): ?>
	  <td style="text-align: right;border:1px solid #CCC;"><? echo number_format(GetSupportValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$start_month_idx],$month_value[$end_month_idx],@$_GET['project_id']),0);?></td>
	  <? endif;?>
	  <td style="text-align: center;border:1px solid #CCC;"><? 
			$target_type = GetTargetType(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['pdivision_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$_GET['project_id']);
			echo @$target_type['title'];
			?></td>
	  <td style="text-align: right;border:1px solid #CCC;"><?=number_format(GetTargetTypeValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$target_type['id'],@$_GET['project_id']));?></td>
	  <td style="text-align: right;border:1px solid #CCC;"><?=number_format(GetTotalValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$_GET['budgettype_id'],@$_GET['project_id']));?></td>
	  <? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
			<td style="text-align: right;border:1px solid #CCC;"><?
			$value3 = GetTargetResult(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$i],0,@$_GET['project_id']);
			echo number_format(@$value3);
			@$total_target3 += @$value3;//สาโรจน์
			?></td>
		<? endfor; ?>
	  <td style="text-align: right;border:1px solid #CCC;"><?=number_format($total_target3);?></td>
	  <? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
			<td style="text-align: right;border:1px solid #CCC;">
				<?
					$value = GetTotalResult(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$i],0,@$_GET['project_id']);
					echo number_format($value);
					@$total_value += $value;
				?>			</td>
		<? endfor; ?>		
		<td style="text-align: right;border:1px solid #CCC;"><?=number_format(@$total_value);?></td>
	  </tr>
	<? 
		
		foreach($province as $item):
			$row_class = @$row_class != ''  ? '' : 'class="odd"';
			$total_target = 0;$total_value = 0; 
	?>	
	<tr <?=$row_class;?>>
		<td><?=$item['title'];?></td>
		<? if(@$_GET['show_helper']=='on'): ?>
		<td style="text-align: right;border:1px solid #CCC;">
			<? echo number_format(GetSupportValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$start_month_idx],$month_value[$end_month_idx],@$_GET['project_id']),0);?>		</td>
		<? endif;?>
		<td style="text-align: center;border:1px solid #CCC;">
			<? 
			$target_type = GetTargetType(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['pdivision_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$_GET['project_id']);
			echo @$target_type['title'];
			?>		</td>		
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format(GetTargetTypeValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$target_type['id'],@$_GET['project_id']));?>		</td>
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format(GetTotalValue(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],@$_GET['budgettype_id'],@$_GET['project_id']));?>		</td>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
			<td style="text-align: right;border:1px solid #CCC;">
			<?
			$value = GetTargetResult(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$i],0,@$_GET['project_id']);
			echo number_format($value);
			$total_target +=$value;
			?>			</td>
		<? endfor; ?>		
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format($total_target);?>		</td>
		<? for($i=$start_month_idx;$i<=$end_month_idx;$i++):?>
			<td style="text-align: right;border:1px solid #CCC;">
				<?
					$value = GetTotalResult(@$_GET['bg_year'],@$_GET['pdepartment_id'],@$_GET['division_id'],@$item['id'],@$_GET['pproductivity_id'],@$_GET['mainact_id'],@$_GET['subact_id'],$month_value[$i],0,@$_GET['project_id']);
					echo number_format(@$value);
					@$total_value += @$value;
				?>			</td>
		<? endfor; ?>		
		<td style="text-align: right;border:1px solid #CCC;">
			<?=number_format(@$total_value);?>		</td>
	</tr>
	<? endforeach;?>
	</thead>
</table>	
<? }?>