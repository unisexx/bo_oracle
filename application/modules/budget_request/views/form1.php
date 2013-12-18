<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script>			 
	$(document).ready(function(){
		<? if($act=='view'):?>
			$('input[type=text]').attr("disabled",true);
			$('select').attr("disabled",true);
			$('input[type=checkbox]').attr("disabled",true);
			$('.btn_add').hide();			
		<? endif; ?>
		<? if($projectid=='' || @$bmaster['chkoperationregion']!='on'): ?>
			$("#DvRegion1").hide() 
		<? endif;?>
		<? if(@$bmaster['chkoperationregion']=='on'): ?>
			$("#DvRegion1").show() 
		<? endif;?>
		$('input[type=text]').setMask();		            
		$('.process_list').rowCount();
		$('.process_list .rowNumber:last').text("");
		$(".show_strategy_chart").colorbox({width:"50%",height:"550px", inline:true, href:"#bg_source_form"});		
		$('.tb_operation_area_province').rowCount();
		$('.tb_operation_area_province .rowNumber:last').text("");
		tinyMCE.init({
//			mode : "exact",
			mode : "textareas",
			width :"100%",
			height :"200",
			content_css : "css/style.css",
			skin: "cirkuit",
//			elements : "ajaxfilemanager",
			theme : "advanced",
			plugins : "advimage,advlink,media,contextmenu,paste",
			theme_advanced_buttons1 : "pastetext,pasteword,selectall,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,|,fontselect,fontsizeselect,forecolor,|,code",			
			theme_advanced_buttons2 : "",
			theme_advanced_buttons3 : "",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			extended_valid_elements : "hr[class|width|size|noshade]",
			file_browser_callback : "ajaxfilemanager",
			paste_use_dialog : false,
			//theme_advanced_resizing : true,
			//theme_advanced_resize_horizontal : true,
			//apply_source_formatting : true,
			<? if($act=='view'):?>readonly : true, <? endif;?>
			force_br_newlines : true,
			force_p_newlines : false,	
			relative_urls : false,
			 paste_auto_cleanup_on_paste : true,
			paste_preprocess : function(pl, o) {
				// Content string containing the HTML from the clipboard
//				alert(o.content);
//				o.content = "-: CLEANED :-\n" + o.content;
				o.content = "\n" + o.content;
			},
			paste_postprocess : function(pl, o) {
				// Content DOM node containing the DOM structure of the clipboard
//				alert(o.node.innerHTML);
//				o.node.innerHTML = o.node.innerHTML + "\n-: CLEANED :-";
				o.node.innerHTML = o.node.innerHTML + "\n";
				
			}			
		})   	
		
		
		$("select[name=budgetyear]").change(function(){
			var budget_year = $(this).val();
			if(budget_year >0)
			{
				
				$.post('budget_request/reload_subactivity_list',{
					'budgetyear':budget_year
				},function(data){
					$("#td_subactivity_list").html(data);
					$("#dv_budget_detail").show();					
				})				
				
			}
			else
			{
				$(".dv_budget_detail").hide();
			}
		})
		
		$("select[name=subactivityid]").live('change',function(){
			var subactivityid = $(this).val();
			$.post('budget_request/reload_strategy_chart',{
					'subactivityid': subactivityid  
				},function(data){
					$("#dv_strategy_chart").html(data);
			})
			
			$.post('budget_request/reload_keydetail_list',{
				'subactivityid': subactivityid	
			},function(data){
				$('#dvKeyDetailList').html(data);
			})			
		})
				
		$(".show_strategy_chart").click(function(){
			$("#dv_strategy_chart").html('<img src="images/loading.gif" style="align:center;text-align:center;vertical-align:middle;" align="absmiddle">');
			var subactivityid = $("select[name=subactivityid]").val();
			$.post('budget_request/reload_strategy_chart',{
					'subactivityid': subactivityid  
				},function(data){
					
					$("#dv_strategy_chart").html(data);
					$("#dv_strategy_chart").show();					
					$.colorbox.resize({width:'50%',height:'550px;',inline:true})
			})			
		})
		
		$("#btn_save_process").click(function(){
	   		var itemindex = $("#processitemindex").val();
		 	var detailid = $("#processitemid").val();
		 	var title = tinyMCE.get('processtitle').getContent();
		 	//alert(title);
		 	var newrow = '<tr><td></td><td class="td_processtitle">'+title+'<input type=hidden name="hd_processtitle[]" id="hd_processtitle" class="hd_processtitle" value=\''+title+'\'></td><td><input type="button" name="btnEdit" id="btnEdit" value="" class="btn_editico btn_edit_process"/><input type="button" class="btn_delete btn_delete_process" /></td></tr>';
		 	
		 	if(itemindex < 1){			
				$('.process_footer').before(newrow);	
				$('.process_list').rowCount();
				$('.process_list .rowNumber:last').text("");
			}else{				
				$('.process_list tr').each(function() {
				    var rowindex = $(this).find("#rowidx").val();				       
				    if(rowindex == itemindex)
				    {				    	
				    	$(this).find(".td_processtitle").html(title+'<input type=hidden name="hd_processtitle[]" id="hd_processtitle" class="hd_processtitle" value=\''+title+'\'>');
				    }
				});
			}
			tinymce.get('processtitle').setContent('');
			$("#process_form").fadeToggle();
		});
		
		$(".btn_delete_process").live('click',function(){
			if(confirm('ลบรายการนี้ ?')){
				$(this).closest('tr').remove();
				$('.process_list').rowCount();
				$('.process_list .rowNumber:last').text("");				
			}
		})
		
		$(".btn_edit_process").live('click',function(){
			var data = $(this).closest('tr').find('#hd_processtitle').val();
			var rowindex = $(this).closest('tr').find('#rowidx').val();
			tinyMCE.get('processtitle').setContent(data);
			$("#processitemindex").val(rowindex);
			if( $("#process_form").hide() ){
				$("#process_form").fadeToggle();
			}				
		})
		$("#btn_show_process_form").click(function(){
			$("#processitemindex").val('');
		 	$("#processitemid").val('');		 	
		 	tinymce.get('processtitle').setContent('');
		 	if( $("#process_form").hide() ){
				$("#process_form").fadeToggle();
			}
		})
		$("#btn_close_process").click(function(){
			tinymce.get('processtitle').setContent('');
			$("#process_form").hide();
		})
		
		$(".btn_add_operation_province").click(function(){
			var exist_province_id = '';
			$(".tb_operation_area_province tr").each(function() {
				if($(this).find("#hd_operation_province_id").val() > 0 ){					
					exist_province_id += exist_province_id != '' ? '|' + $(this).find("#hd_operation_province_id").val() : $(this).find("#hd_operation_province_id").val();
				}
			})
			
			var select_province = $("select[name=operationareaprovince]").val();
			if(select_province=='ALL'){
				$("select[name=operationareaprovince] option").each(function(){
					if($(this).val() != 'ALL')
						exist_province_id += exist_province_id != '' ? '|' + $(this).val() : $(this).val();
				})
			}else{
				exist_province_id += exist_province_id != "" ? "|" + select_province  : select_province;
			}
			
			$.post('budget_request/reload_operation_province_table',{
				'province_id':exist_province_id
			},function(data){
				$("#dv_operation_province_table").html(data);
				$('.tb_operation_area_province').rowCount();
				$('.tb_operation_area_province .rowNumber:last').text("");
			})	
		})
		
		$("select[name=operationareazone]").change(function(){
			var province_zone = $(this).val();
			$.post('budget_request/reload_operation_province',
			{
				'zone_id' : province_zone
			},function(data){
				$("#dv_operation_province").html(data);
			})
		})
		
		$("#chkoperationregion").click(function(){
			$("#DvRegion1").fadeToggle();
		})
		$("#btn_delete_all_operation_province").live('click',function(){
			if(confirm('ลบจังหวัดพื้นที่ดำเนินการทั้งหมด ?')){
				$('.tr_operation_province').remove();
			}
		})
		$(".btn_delete_operation_province").live('click',function(){
			if(confirm('ลบจังหวัดพื้นที่ดำเนินการนี้ ?')){
				$(this).closest('tr').remove();
				$('.tb_operation_area_province').rowCount();
				$('.tb_operation_area_province .rowNumber:last').text("");
			}
		})
		$(".ChkKey").live('click',function(){
			if($(this).attr('checked')){
				var unittypeid = $(this).closest('td').find('#unittypeid').val();
				$("select[name=summarycurrentyeartargetunit]").val(unittypeid);
				$("select[name=estimateunittypeid_y1]").val(unittypeid);
				$("select[name=estimateunittypeid_y2]").val(unittypeid);
				$("select[name=estimateunittypeid_y3]").val(unittypeid);				
			}
		})
	  
	})
</script>
<h3>คำของบประมาณ</h3>
<form name="form1"  id="form1" method="post" action="budget_request/save1<?=$url_parameter;?>" enctype="multipart/form-data" >
<div id="data">
  <fieldset>
    <legend>ความเชื่อมโยงระดับยุทธศาสตร์</legend>
<table class="tblist">
<tr>
  <th width="25%">ปีงบประมาณ <span class="Txt_red_8">*</span></th>
  <td width="75%">
  	<? echo form_dropdown("budgetyear",get_option("byear","byear as tbyear ","cnf_set_time","status = 1 order by byear"),@$budgetyear,'','-- เลือกปีงบประมาณ --');?>
  	<input type="hidden" name="id" id="id" value="<?=@$bmaster['id'];?>">
  	<input type="hidden" name="createdate" id="createdate" value="<?=@$bmaster['createdate'];?>">
  	<input type="hidden" name="createby" id="createby" value="<?=@$bmaster['createby'];?>">
  	<input type="hidden" name="act" id="act" value="<?=$act;?>">
  	<input type="hidden" name="step" id="step" value="<?=$_GET['step'];?>">
  </td>
</tr>
</table>
<div class="dv_budget_detail">
<table class="tblist">
<tr>
  <th width="25%">กิจกรรมย่อย <span class="Txt_red_8">*</span></th>
  <td id="td_subactivity_list">
  	<?
  	$condition = @$budgetyear > 0 ? " and syear = ".($budgetyear-543) : "";
  	echo form_dropdown("subactivityid",get_option("id","title","cnf_strategy","mainactid > 0 ".$condition." order by title"),@$bmaster['subactivityid'],'','-- เลือกกิจกรรมย่อย --');
  	?>
  </td>
</tr>
<tr>
  <th>แผนงานตามยุทธศาสตร์</th>
  <td>
  	<input type="button" class="show_strategy_chart" value="แสดงความเชื่อมโยง">
  </td>
</tr>
<tr>
  <th>ชื่อโครงการ/กิจกรรม <span class="Txt_red_8">*</span></th>
  <td><input name="projecttitle" type="text" id="projecttitle" value="<?=@$bmaster['projecttitle'];?>" size="90" class="required bgFillData" /></td>
</tr>
<tr>
  <th valign="top">ความสอดคล้องกับนโยบาย/มติ ครม.</th>
  <td><textarea name="policyaccord" cols="75" rows="5" id="policyaccord" class="bgFillData policyaccord"><?=@$bmaster['policyaccord'];?></textarea></td>
</tr>
<tr>
  <th valign="top">หลักการและเหตุผล</th>
  <td><textarea name="principles" cols="75" rows="5" id="principles" class="bgFillData principles"><?=@$bmaster['principles'];?></textarea></td>
</tr>
<tr>
  <th valign="top">วัตถุประสงค์</th>
  <td><textarea name="Objective" cols="75" rows="5" id="Objective" class="bgFillData"><?=@$bmaster['objective'];?></textarea></td>
</tr>
</table>
</fieldset>

<br />
<div class="dv_budget_detail">
<fieldset>
    <legend>กระบวนการ</legend>
    <table class="tblist">
<tr>
  <th valign="top" colspan="2">
  	ขั้นตอน / วิธีการ <br>  
   <div class="left1" id="process_form" style="display: none">
     <input type="hidden" id="processitemindex" name="processitemindex" value="" />
     <input type="hidden" id="processid" name="processid" value="" />
     <textarea name="processtitle" id="processtitle"></textarea>   
     <input name="btn_save_process" id="btn_save_process" type="button" value=""  class="btn_save" />
     <input name="btn_close_process" id="btn_close_process" type="button" value="" class="btn_cancel">
   </div>

  			<div id="dvProcessList">
  			<input type="button" namne="btn_show_process_form" id="btn_show_process_form" value="" class="btn_add">            
          	<table class="type1 process_list">
              <tr>                
                <th>รายละเอียด</th>
                <th>แก้ไข/ลบ</th>
              </tr>
              <?
              if(count(@$sprocess_result) > 0){ 
              foreach($sprocess_result as $sprocess): 
              ?>
			  <tr>				
                <td bgcolor="#FFFFFF" class="td_processtitle"><?=@$sprocess['description'];?><input type="hidden" name="hd_processtitle[]" id="hd_processtitle" class="hd_processtitle" value="<?=@$sprocess['description'];?>"></td>
				<td>											               
					<input type="button" name="btnEdit" id="btnEdit" value="" class="btn_editico btn_edit_process"/>
					<input type="button" name="btnDelete" id="btnDelete" value="" class="btn_delete btn_delete_process"  />
				</td>
			  </tr>
			  <? 
			  endforeach;
			  } 
			  ?>
	          <tr class="process_footer">                
                <td>&nbsp;</td>
                <td>&nbsp;</td>                
              </tr>              
            </table>
            </div>
    </td>
</tr>
<tr>
  <th valign="top" colspan="2">
  	กลุ่มเป้าหมาย
  	<br>
  	<textarea name="targetgroup" cols="75" rows="5" id="targetgroup" class="bgFillData"><?=@$bmaster['targetgroup'];?></textarea>
  </th>  
</tr>
<tr>
  <th valign="top" colspan="2">
  	ผลที่คาดว่าจะได้รับ
  	<br>
  	<textarea name="estimateresult" cols="75" rows="5" id="estimateresult" class="bgFillData"><?=@$bmaster['estimateresult'];?></textarea>
  </th>  
</tr>
</table>
</fieldset>

<br />

<fieldset>
    <legend>แผนการปฎิบัติงานและแผนการใช้จ่ายงบประมาณ</legend>
     	<div id="dvKeyDetailList">
		       	<? 
				if(@$bmaster['subactivityid']!='')
				{
				?>
		        <table class="type1">
					<tr>
					  <th width="70%">ตัวชี้วัดผลผลิต</th>
					  <th>ประเภทตัวชี้วัด</th>
					  <th>หน่วยนับ</th>
					  <th>ส่งผลต่อตัวชี้วัดผลผลิต</th>
					</tr>
		         <?
		         $sql = "SELECT * FROM CNF_STRATEGY WHERE ID=".$bmaster['subactivityid'];
		         $strategy = $this->db->getrow($sql);
				 dbConvert($strategy);
				
				 $sql = "SELECT 
				 CNF_STRATEGY_DETAIL.*,
				 CNF_COUNT_UNIT.TITLE UNIT 
				 FROM CNF_STRATEGY_DETAIL 
				 LEFT JOIN CNF_COUNT_UNIT ON CNF_STRATEGY_DETAIL.UNITTYPEID = CNF_COUNT_UNIT.ID
				 WHERE PID=".$strategy['productivityid']."  ORDER  BY KEYTYPE ";
				 $result = $this->db->getarray($sql);
				 dbConvert($result);
				 $i=0;
				 foreach($result as $productivity):										
				 $i++;
				 	if(@$bcurrenttarget['productivitykeyid'] != '') 
					{
						$pkey = explode(',',$bcurrenttarget['productivitykeyid']);
					}
				?>	        
		        <tr>
				  <td ><?=$i;?> .<?=$productivity['title'];?></td>
				  <td ><?=$productivity['keytype'];?>&nbsp;</td>
				  <td ><?=$productivity['unit'];?>&nbsp;</td>
				  <td >
				 <? if($productivity['keytype']=='เชิงปริมาณ'){ ?>
		         <input type="checkbox" class="ChkKey bgFillData" name="chkworkplan[]" id="chk_workplan" value="<?=$productivity['id'];?>"  <?	if(@$pkey != ''):if(in_array($productivity['id'],$pkey))echo "checked";?> <?	endif;?> /> ใช่  				         						
		         <input type="hidden" id="unittypeid" name="unittypeid" value="<?=@$productivity['unittypeid'];?>">
		         <? } ?>                                        
				 </td>
		        </tr>        
				 <? endforeach;?>		 
		        </table>
		        <? } ?>
     	</div>

			
        <table  class="tblist">
        <tr>
			  <th valign="top">เป้าหมายปี <?=$budgetyear;?></th>
			  <td>
					<input name="summaryunit" id="summaryunit" type="text" value="<?=number_format(@$bcurrenttarget['summaryunit']);?>" size="10"  alt="integer" class="bgFillData" />
					
                        <?
                        echo form_dropdown("summarycurrentyeartargetunit",get_option("id","title","cnf_count_unit"," 1=1 order by title "),@$bcurrenttarget['unitid'],'','-- เลือกหน่วยนับ --');
						?>                                                 
                     <input type="hidden" id="unitid" name="unitid" value="<?=@$bcurrenttarget['unitid'];?>" /> 			
                     <input type="hidden" id="productivitykeyid" name="productivitykeyid" value="<?=@$bcurrenttarget['productivitykeyid'];?>"  />
				<br />
				<br />
				  <span class="Txt_std14_blue">แผนการปฎิบัติงาน</span>
				  <table class="type1">
					<tr>
					  <th colspan="2">ไตรมาส 1</th>
					  <th colspan="2">ไตรมาส 2</th>
					  <th colspan="2">ไตรมาส 3</th>
					  <th colspan="2">ไตรมาส 4</th>
					</tr>
					<tr>
					  <td>ต.ค. </td>
					  <td><input name="current_target_m1"  id="current_target_m1" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m1']);?>" alt="integer" /></td>
					  <td>ม.ค.</td>
					  <td><input name="current_target_m4"  id="current_target_m4" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m4']);?>" alt="integer"  /></td>
					  <td>เม.ย. </td>
					  <td><input name="current_target_m7"  id="current_target_m7" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m7']);?>" alt="integer" /></td>
					  <td>ก.ค. </td>
					  <td><input name="current_target_m10"  id="current_target_m10" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m10']);?>" alt="integer"  /></td>
					</tr>
					<tr>
					  <td>พ.ย. </td>
					  <td><input name="current_target_m2"  id="current_target_m2" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m2']);?>" alt="integer" /></td>
					  <td>ก.พ. </td>
					  <td><input name="current_target_m5"  id="current_target_m5" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m5']);?>" alt="integer"  /></td>
					  <td>พ.ค. </td>
					  <td><input name="current_target_m8"  id="current_target_m8" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m8']);?>" alt="integer"  /></td>
					  <td>ส.ค. </td>
					  <td><input name="current_target_m11"  id="current_target_m11" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m11']);?>" alt="integer"  /></td>
					</tr>
					<tr>
					  <td>ธ.ค. </td>
					  <td><input name="current_target_m3"  id="current_target_m3" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m3']);?>" alt="integer"  /></td>
					  <td>มี.ค </td>
					  <td><input name="current_target_m6"  id="current_target_m6" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m6']);?>" alt="integer"  /></td>
					  <td>มิ.ย. </td>
					  <td><input name="current_target_m9"  id="current_target_m9" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m9']);?>" alt="integer"  /></td>
					  <td>ก.ย. </td>
					  <td><input name="current_target_m12"  id="current_target_m12" type="text" class="txtboxQuarter Number bgFillData"  value="<?=number_format(@$bcurrenttarget['m12']);?>" alt="integer"  /></td>
					</tr>
					<tr>
					  <td>รวม </td>
					  <td><input name="current_target_q1"  id="CurrentTargetQ1" type="text" class="txtboxQuarter bgFillData Number" value="<?=number_format(@$bcurrenttarget['q1']);?>"  alt="integer" /></td>
					  <td>รวม </td>
					  <td><input name="current_target_q2"  id="CurrentTargetQ2" type="text" class="txtboxQuarter bgFillData Number" value="<?=number_format(@$bcurrenttarget['q2']);?>" alt="integer" /></td>
					  <td>รวม </td>
					  <td><input name="current_target_q3"  id="CurrentTargetQ3" type="text" class="txtboxQuarter bgFillData Number" value="<?=number_format(@$bcurrenttarget['q3']);?>"  alt="integer"/></td>
					  <td>รวม</td>
					  <td><input name="current_target_q4"  id="CurrentTargetQ4" type="text" class="txtboxQuarter bgFillData Number" value="<?=number_format(@$bcurrenttarget['q4']);?>"   alt="integer" /></td>
					</tr>
			</table>
			</td>
		</tr>
        </table>            
<table class="tblist"  style="display:none">
<tr>
  <th width="25%">งบประมาณทั้งโครงการ (<?=$budgetyear;?>) </th>
  <td align="left">
  <span class="Txt_std14_orange" id="spBudgetTotal" > 
  <?=number_format(GetBudgetSummary('','',@$id,'','','',''),2);?> บาท </span> 
  รายจ่ายอื่น  <input type="text" class="Number bgFillData" name="OtherExpense" id="OtherExpense" value="<?=number_format($bmaster['OtherExpense'],2);?>" alt="decimal" />
   รายจ่ายขั้นต่ำ <input type="text" class="Number bgFillData" name="MinExpense" id="MinExpense" value="<?=number_format($bmaster['MinExpense'],2);?>" alt="decimal" />  
  </td>
</tr>
</table>

</fieldset>

<br />

<fieldset>
    <legend>ประมาณการรายจ่ายล่วงหน้าระยะปานกลาง</legend>
    <table class="tblist">
    	<? 
		if(@$projectid!='')
		{
			$sql = "SELECT SUM(BUDGET_NY1)ESTY1, SUM(BUDGET_NY2)ESTY2,SUM(BUDGET_NY3)ESTY3 
			FROM BUDGET_TYPE_DETAIL WHERE BUDGETID=".@$projectid;
			
			$esti = $this->db->getrow($sql);
			@dbConvert($esti);		    		
		}
		for($i=1;$i<=3;$i++)
		{
		?>
        <tr>
          <th width="25%"><?=$budgetyear+$i;?></th>
          <td width="75%" >
             <input name="estimateqty_y<?=$i;?>" id="estimateqty_y<?=$i;?>" type="text" value="<?=number_format(@$bmaster['estimateqty_y'.$i],2);?>" size="10" class="Number bgFillData" alt="integer" />
             <?
             echo form_dropdown("estimateunittypeid_y".$i,get_option("id","title","cnf_count_unit"," 1=1 order by title "),@$bmaster['estimateunittypeid_y'.$i],'class="EstimateUnitList bgFillData" ','-- เลือกหน่วยนับ --','0');
			 ?>             
            <input name="estimatebudget_y<?=$i;?>" id="estimatebudget_y<?=$i;?>" type="text" value="<?=number_format(@$esti['esty'.$i],2);?>" class="Number" disabled="disabled" alt="decimal" />
        บาท </td>
        </tr>
		<? } ?>
	</table>
</fieldset>

<br />

<fieldset>
    <legend>ผลการดำเนินงาน / การใช้จ่ายงบประมาณในปีที่ผ่านมา</legend>
    <table class="tblist">
    	<? 
		for($i=1;$i<3;$i++)
		{
		?>
        <tr>
          <th width="25%"><?=$budgetyear-$i;?></th>
          <td width="75%" ><input name="lastestimatebudget_y<?=$i;?>" id="lastestimatebudget_y<?=$i;?>" type="text" value="<?=@$bmaster['lastestimatebudget_y'.$i];?>" class="Number bgFillData" alt="decimal" />
        บาท </td>
        </tr>
		<? } ?>
	</table>
</fieldset>

<br />

<fieldset>
    <legend>พื้นที่ดำเนินการ</legend>
    <table class="tblist">
<tr>
  <th width="25%" valign="top">พื้นที่ดำเนินการ</th>
  <td width="75%" align="left">
    <input name="chkoperationcentral" id="chkoperationcentral" type="checkbox" class="bgFillData"  value="1" <? if(@$bmaster['chkoperationcentral']=='on')echo "checked";?> />
ส่วนกลาง 
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="checkbox" name="chkoperationregion" id="chkoperationregion"  rel="DvRegion1" class="ChkBox bgFillData" value="DvRegion1"  <? if(@$bmaster['chkoperationregion']=='on')echo "checked";?>  />
 ภูมิภาค <br />
 <br />
 <div id="DvRegion1" <? if(@$bmaster['chkoperationregion']=='off')echo "style=\"display:none\"";?>  >
	<table align="left" >
    <tr>
    	<td  align="left">
    		<? echo form_dropdown("operationareazone",get_option("id","title","cnf_province_zone"," zone_type_id=2 order by id "),"",' class="bgFillData"',"-- ทุกภาค --","ALL");?>       
       </td>
   		<td  align="left">
    	   <div id="dv_operation_province">
    		<? 
    		$table = " cnf_province_detail_zone 
    		left join cnf_province on cnf_province_detail_zone.provinceid = cnf_province.id 
    		left join cnf_province_zone on cnf_province_detail_zone.zoneid=cnf_province_zone.id ";
    		echo form_dropdown("operationareaprovince",get_option("cnf_province.id","cnf_province.title",$table," cnf_province.id <> 2 and zone_type_id=2 order by title"),"",' class="bgFillData"','--เลือกทุกจังหวัด--','ALL'); ?>               
           </div>
   		</td>
   		<td  align="left">        
		   <input type="button" name="button" value=""  class="btn_add btn_add_operation_province"/>
              
        </td>
   </tr>
   </table>
   <br />
  <br /><br />
  <div id="dv_operation_province_table" style="height:450px; overflow-y: auto;">
  <table class="type1 tb_operation_area_province">
    <tr>      
      <th>จังหวัด</th>
      <? if($act=='edit'):?>
      <th><input type="button" id="btn_delete_all_operation_province" name="btn_delete_all_operation_province" value="ลบทุกรายการ" /></th>
      <? endif;?>      
    </tr>   
    <?    
    if(@$bmaster['id'] > 0){
    foreach($operation_province as $province_item):			
	?>
		<tr class="tr_operation_province">		
		<td><?=$province_item['province_title']?><input type="hidden" id="hd_operation_province_id" name="hd_operation_province_id[]" value="<?=$province_item['provinceid'];?>"></td>
		<? if($act=='edit'):?>
		<td>			
			<input type="button" id="btn_delete_operation_province" name="btn_delete_operation_province" value="" class="btn_deleteico btn_delete_operation_province" />
		</td>
		<? endif;?>
		</tr>
	<? 
	endforeach;
	} 
	?>	
    <tr id="tr_operation_area_province_footer">
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>      
    </tr>
  </table>
  </div>
 </div>
 </td>
</tr>

</table>
</fieldset>

<br />



<br />

<fieldset>
    <legend>ประเภทงบรายจ่าย</legend>
    <table class="tblist">
    		<?
				$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE  PID=0 ORDER BY ORDERNO ";
				$sresult = $this->db->getarray($sql);
				array_walk($sresult,'dbConvert');
				foreach($sresult as $srow)
				{
			?> 
            <tr>
              <th width="25%"><?=$srow['title'];?></th>
              <td width="75%" align="left">
              			<?
							$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$srow['id']." AND LV=2 ORDER BY ORDERNO ";
							$ssresult = $this->db->getarray($sql);
							array_walk($ssresult,'dbConvert');
							foreach($ssresult as $ssrow)
							{
						?>
                        <input name="budgetexpensetype[]" id="budgetexpensetype" type="checkbox" class="bgFillData"  value="<?=$ssrow['id'];?>" <? if(@$bexpensetype[$ssrow['id']]['value']!='')echo "checked";?> />
                        	<?=$ssrow['title'];?>
                        <? } ?>
            	</td>
            </tr>
            <? } ?>
</table>
</fieldset>
</div><!--data-->
</div>
<div style="padding-left:35%; padding-top:10px;">
  <input type="hidden" name="status" id="status" value="<? if(@$bmaster['status']=='')echo '1'; else echo @$bmaster['status'];?>">	
<? if(@$act=='view'){ ?>  
  <input type="submit" name="btnNext" id="button22" value="ดูขั้นตอนต่อไป"  class="btn_nextstep" />
<?
}else{
?>
  <input type="submit" name="button22" id="button22" value="ทำขั้นต่อไป"  class="btn_nextstep" />
<? } ?>

    <input type="button" name="button" id="button" value="กลับไปหน้ารายการ"  class="btn_backmain" onclick="window.location='<?=JS_FIX_URLPATH;?>/budget_request/index<?=$url_parameter;?>';" style="display:inline" />      
</div><!--nextstep-->
</form>

<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
			<div id="dv_strategy_chart">			
				<h3 id="topic">กรุณาเลือกกิจกรรมย่อยก่อน</h3>
			</div>
		</div>
</div>