<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">	
	function SendToLeader(pYear,pDivisionID,pWorkgroupID,pStep)
	{
		nProject = document.getElementById('hdNProject'+pStep).value;
		if(confirm('ยืนยันส่งข้อมูลให้ ผอ. ตรวจสอบโดยกลุ่มงานของคุณมีโครงการทั้งหมด '+nProject+' โครงการ '))
		{
                window.location='<?=JS_FIX_URLPATH;?>/budget_request/sendbudget/'+pYear+'/'+pDivisionID+'/'+pWorkgroupID+'/'+pStep+'/sendtolead';
		}
	}
	function ShowReturnRemark(pAction,pStep, pYear,pDivisionid, pWorkgroupid)		
	{				
			
		var divisionid = $("select[name=divisionid]").val();
		var divisionname= $("select[name=divisionid]").text();
		var budgetyear = $("select[name=budgetyear]").val();
		$.post('budget_request_commit/load_remark<?=$url_parameter;?>',{
			'act':pAction,
			'step':pStep,
			'budgetyear':pYear,
			'divisionid':pDivisionid,
			'workgroupid':pWorkgroupid
		},function(data){
			$("#dv_remark").html(data);
			$().colorbox({width:"50%",height:"550px", inline:true, href:"#bg_source_form"});
			tinyMCE.init({
			//			mode : "exact",
						mode : "textareas",
						width:550,
						height : 350,
			//			elements : "ajaxfilemanager",
						theme : "advanced",
						plugins : "advimage,advlink,media,contextmenu",
			theme_advanced_buttons1 : "forecolor,backcolor,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,|,fontselect,fontsizeselect,|,code",			
						theme_advanced_buttons2 : "",
						theme_advanced_buttons3 : "",
						theme_advanced_toolbar_location : "top",
						theme_advanced_toolbar_align : "left",
						extended_valid_elements : "hr[class|width|size|noshade]",
						file_browser_callback : "ajaxfilemanager",
						paste_use_dialog : false,
						theme_advanced_resizing : true,
						theme_advanced_resize_horizontal : true,
						apply_source_formatting : true,
						force_br_newlines : true,
						force_p_newlines : false,	
						relative_urls : false
			})			
		})				
	}
	$(document).ready(function()
	{		  	
		
		<?
		if($budgetyear > 0):
		$dTab = '';
		$step = $maxround+1;
		for($i=$step;$i<=8;$i++)
		{	$dTab  .= $dTab != '' ? ','.($i -1): $i-1; }
			if($step < 8)
			{
		?>
				$( "#tabs" ).tabs({ disabled: [<?=$dTab;?>] });
		<? } ?>		
		<? endif;?>
		
		$("select[name=divisionid]").live('change',function(){
			var divisionid = $(this).val();
			$("select[name=workgroupid]").attr('disabled','disabled');
			$("#dv_workgroup").append("<?=LOADING_IMG;?>");			
			if(divisionid > 0){
				$.post('ajax/load_workgroup_list/workgroupid',{
					'divisionid': divisionid,
					'canaccessall' :'on'  
				},function(data){
					$("#dv_workgroup").html(data);
				})
			}else{
				$("select[name=workgroupid]").attr('disabled','disabled');
			}
			
		})
   	})	
</script>
<h3>ตรวจสอบงบประมาณ</h3>
<fieldset>
	<legend>ค้นหา</legend>
<form>
  <div id="SelectBudget">  
			<label>ปีงบประมาณ</label>			
			<? echo form_dropdown("budgetyear",get_option("byear","byear as strbyear","cnf_set_time"," status > 0 order by byear "),@$_GET['budgetyear'],'','-- เลือกปีงบประมาณ --');?>
            <label>หน่วยงาน</label>
            <div id="dv_division" style="display:inline;">
            <?             
            echo form_dropdown("divisionid",get_option("id","title",'cnf_division',' departmentid=2  order by title '),@$divisionid,'','-- เลือกหน่วยงาน --');
            ?>
            </div>
            <label>กลุ่มงาน</label>
            <div id="dv_workgroup" style="display:inline;">
            <?            
            $condition = @$divisionid > 0 ? " and divisionid = ".@$divisionid : ""; 
			$disabled = @$divisionid > 0 ? '' : 'disabled="disabled"';
            echo form_dropdown("workgroupid",get_option("id","title",'cnf_workgroup',' 1=1 '.$condition.' order by title '),@$workgroupid,$disabled,'-- เลือกกลุ่มงาน --');
            ?>
            </div>
			<input type="submit" name="btn_search" id="btn_search" class="btn_search" value="">                			       
  </div>
</form>
</fieldset>
<? if(@$_GET['budgetyear']>0){ ?>
<div id="tabs">
    <ul>
      <li><a href="#tabs-1" title="เสนอคำของบประมาณ" alt="เสนอคำของบประมาณ" class="tip">ขั้นตอนที่ 1</a></li>
      <li><a href="#tabs-2" title="ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ" alt="ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ" class="tip">ขั้นตอนที่ 2</a></li>
      <li><a href="#tabs-3" title="ปรับปรุงคำของบประมาณตามมติ ครม." alt="ปรับปรุงคำของบประมาณตามมติ ครม." class="tip">ขั้นตอนที่ 3</a></li>
      <li><a href="#tabs-4" title="ปรับปรุงคำของบประมาณตามมติ กระทรวง" alt="ปรับปรุงคำของบประมาณตามมติ กระทรวง" class="tip">ขั้นตอนที่ 4</a></li>
      <li><a href="#tabs-5" title="แปรญิตติเพิ่ม" alt="แปรญิตติเพิ่ม" class="tip">ขั้นตอนที่ 5</a></li>
      <li><a href="#tabs-6" title="ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ" alt="ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ" class="tip">ขั้นตอนที่ 6</a></li>
      <li><a href="#tabs-7" title="รายละเอียดงบประมาณตาม พรบ." alt="รายละเอียดงบประมาณตาม พรบ." class="tip">ขั้นตอนที่ 7</a></li>
      <li><a href="#tabs-8" title="ปรับปรุงงบประมาณเพื่อการบริหาร" alt="ปรับปรุงงบประมาณเพื่อการบริหาร" class="tip">ขั้นตอนที่ 8</a></li>
    </ul>
    <? 
    	for($step=1;$step<=8;$step++):
			$bg_summary = GetBudgetSummary(@$_GET['budgetyear'],'','',$step,@$workgroupid,@$divisionid);			
			$bg_status = GetBudgetStatus(@$_GET['budgetyear'],$divisionid,$workgroupid,$step);
			$budget_set_date = GetSetTime(@$_GET['budgetyear'],$step);		
			$sql = "SELECT * FROM BUDGET_SEND_REMARK WHERE BUDGETYEAR=".@$_GET['budgetyear']." AND SECTION_ID=".login_data('divisionid')." AND STEP=".$step;			
			$comment = @dbConvert($this->db->getrow($sql));		            			
    ?>
    <div id="tabs-<?=$step;?>">
      <div id="status" class="left1">
      <h4 style="color:#0033CC">
      	ขั้นตอนที่ <?=$step;?> : <?=$step_title[$step];?>
      	<span style=" color:#F60">งบประมาณทั้งหมด : </span><? echo number_format($bg_summary,2); ?>
      	<span style=" color:#F60">สถานะ :</span><font color='#0033CC'><?=GetBudgetStatusDesc($bg_status);?></font>   
      	<span style=" color:#F60">กำหนดส่ง : </span> <font color="#0033CC"><?=mysql_to_date($budget_set_date,true);?></font>
      </h4>  
      </div>
      
      
    <?    		  	
	
    if(@$divisionid >0 ): 
    if($bg_status=='2'|| $bg_status=='1' && $divisionid > 0)
    { 
    ?>
    <input type="button" value="ส่งกลับไปแก้ไข" class="btn_backedit" onclick="ShowReturnRemark('edit','<?=$step;?>','<?=$budgetyear;?>','<?=$divisionid;?>','<?=$workgroupid;?>');"/> 
    <? 
	} 
	?>
   <? if($bg_status=='2' || $bg_status=='3'): ?>   
   <input type="button" value="ปรับงบประมาณ" class="btn_adjust" onclick="window.location='<?=JS_FIX_URLPATH;?>/budget_request_commit/adjust_budget/<?=$step;?>/<?=$divisionid;?>/<?=$budgetyear;?>'"/>
   <? endif;?>
    <? 
    if($bg_status>='3')
    { 
    ?>
    <input type="button" value="ดูรายการแก้ไข" class="btn_viewedit" onclick="ShowReturnRemark('view','1','<?=$budgetyear;?>','<?=$divisionid;?>','<?=$workgroupid;?>');"/> 
    <input type="button" value="ดูรายละเอียดยอดที่ปรับ" class="btn_define" onclick="Window.location='<?=JS_FIX_URLPATH;?>/budget_request_commit/view_adjust/<?=$budgetyear;?>/<?=$step;?>/<?=$divisionid;?>'" />
    <? 
	} 
	endif;
	?>
   
      <!-- ---------------------------------------->
      <? GetProjectList(@$_GET['budgetyear'],@$_GET['divisionid'],@$_GET['workgroupid'],$step,TRUE);?>
      <!-- ---------------------------------------->
    </div>       
    <? endfor;?>    
</div>    
<? } ?>
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
			<div id="dv_remark"></div>
		</div>
</div>
<script><? echo '$("#tabs").tabs({ selected:'.($maxround-1).' });';?></script>