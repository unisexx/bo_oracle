<script type="text/javascript">
	  function SendBackToWorkgroup(pYear, pDivisionID, pWorkgroupID, pStep)
	  {
	  	  if(confirm('ต้องการส่งกลับให้กลุ่มที่ระบุ แก้ไข ?'))
		  {					
				window.location='<?=JS_FIX_URLPATH;?>/budget_request/sendbudget/'+pYear+'/'+pDivisionID+'/'+pWorkgroupID+'/'+pStep+'/sendtowork';
		  }
	  }
	  function SendToAdmin(pYear, pDivisionID, pWorkgroupID, pStep)
	  {
  		if(confirm('ต้องการส่งข้อมูลไปให้ สนย. ตรวจสอบ ?'))
		{				
				window.location='<?=JS_FIX_URLPATH;?>/budget_request/sendbudget/'+pYear+'/'+pDivisionID+'/'+pWorkgroupID+'/'+pStep+'/sendtoadmin';
		}
	  }
	function ShowReturnRemark(pStep,pYear,pDivisionid,pWorkgroupid)
	{
		var divisionid = $("select[name=divisionid]").val();
		var divisionname= $("select[name=divisionid]").text();
		var budgetyear = $("select[name=budgetyear]").val();
		$.post('budget_request_commit/load_remark<?=$url_parameter;?>',{
			'act':'view',
			'step':pStep,
			'budgetyear':pYear,
			'divisionid':pDivisionid,
			'workgroupid':pWorkgroupid
		},function(data){
			$("#dv_remark").html(data);
			$().colorbox({width:"50%",height:"550px", inline:true, href:"#bg_source_form"});				
		})	
	}
	$(document).ready(function()
	{		  	
		<?
		$dTab = '';
		$maxround = $maxround < 1  ? 1 : $maxround;
		$step = $maxround+1;
		for($i=$step;$i<=8;$i++)$dTab  .= $dTab != '' ? ','.($i -1): $i-1; 
			if($step < 8):			
			echo '$("#tabs").tabs({ disabled: ['.$dTab.'] });';
			endif; 						
		?>
   	})	
</script>
<h3>งบประมาณ</h3>
<fieldset>
	<legend>ค้นหา</legend>
<form>
  <div id="SelectBudget">  
			<label>ปีงบประมาณ</label>
			<? echo form_dropdown("budgetyear",get_option("byear","byear as tbyear","cnf_set_time"," status > 0 order by byear "),@$_GET['budgetyear'],'','-- เลือกปีงบประมาณ --');?>
            <label>หน่วยงาน</label>
            <div id="dv_division" style="display:inline;">
            <? 
            $condition = " and id=".@login_data('divisionid');
            echo form_dropdown("divisionid",get_option("id","title",'cnf_division',' departmentid=2 '.$condition.' order by title '),@login_data('divisionid'),'','-- เลือกหน่วยงาน --');
            ?>
            </div>
            <label>กลุ่มงาน</label>
            <div id="dv_workgroup" style="display:inline;">
            <?            
            $condition = login_data('budgetcanaccessall')=='on' ? " and divisionid=".login_data('divisionid') : " and id=".login_data('workgroupid');
			//$condition = login_data('budgetadmin')=='on' ? '' : $condition; 
            echo form_dropdown("workgroupid",get_option("id","title",'cnf_workgroup',' 1=1 '.$condition.' order by title '),@$_GET['workgroupid'],'','-- เลือกกลุ่มงาน --');
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
			$bg_summary = GetBudgetSummary(@$_GET['budgetyear'],'','',$step,@$_GET['workgroupid'],@$_GET['divisionid']);			
			$bg_status = GetBudgetStatus(@$_GET['budgetyear'],$divisionid,$workgroupid,$step);
			$budget_set_date = GetSetTime(@$_GET['budgetyear'],$step);		
			$sql = "SELECT REMARK FROM BUDGET_SEND_REMARK WHERE BUDGETYEAR=".@$budgetyear." AND SECTION_ID=".@$divisionid." AND STEP=".$step;			
			$comment = $this->db->getone($sql);			            			
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
<fieldset>
  	<legend>สถานะการส่งแต่ล่ะกลุ่มงาน ภายใน</legend>
    <table width="100%"  border="0" align="left">
    	<tr class="ui-state-focus">
        	<td width="158" style="padding:5px; width:150px;">กลุ่มงาน</td><td width="227">สถานะ</td>
        	<td width="101">จำนวนโครงการ</td>
        	<td width="101">&nbsp;</td>
      </tr>
      <?
      			$dontsend=false;
	  			$sql = "SELECT * FROM CNF_WORKGROUP WHERE divisionid=".$divisionid." ORDER BY TITLE ";
	  			$wresult = $this->db->getarray($sql);
				dbConvert($wresult);
	  			foreach($wresult as $wg){
	  ?>
    	<tr class="ui-widget-content">
    	  <td style="padding:5px;"><?=$wg['title'];?>&nbsp;</td>
    	  <td >
		  <? 		  					
							$sql = " SELECT COUNT(*)NREC FROM BUDGET_MASTER WHERE WORKGROUP_ID=".$wg['id']." AND BUDGETYEAR=".$budgetyear." AND STEP=".$step;
							$nrec = $this->db->getone($sql);							
		  					$sendStatus = GetWorkGroupSendStatus($wg['id'],$budgetyear,$step);
							echo GetBudgetStatusDesc($sendStatus);
							if($sendStatus  != 4 && $nrec>0)$dontsend = true;
		  ?>&nbsp;
		  </td>
    	  <td >
          					<?
							
							if($nrec<1)
								echo " ไม่มีโครงการ ";
							else
								echo $nrec;
							?>
          </td>
    	  <td >
		 <? if($sendStatus=='4'){ ?>          
          <input name="button2" type="button" class="ui-state-error ui-corner-all" id="button2" value="    ส่งกลับไปแก้ไข    "  style="height:30px;" onclick="SendBackToWorkgroup('<?=$budgetyear;?>','<?=$divisionid;?>','<?=$wg['id'];?>','<?=$step;?>');"/>
          <? } ?>
          </td>
      </tr>         
      <? } ?>
    </table>
  </fieldset>      	
      <div class="addProject" align="right">
	   <? if($comment!=''): ?> 
	   	 <input type="button" onclick="ShowReturnRemark('<?=$step;?>','<?=@$budgetyear;?>','<?=@$divisionid;?>','<?=@$workgroupid;?>');" style="cursor:pointer" class="btn_remark"  value=" ดูหมายเหตุการแก้ไข" />
	   	<? endif;?>
	   	<? if($step > 1 ): ?>
	     <input type="button" value="ดูรายละเอียดยอดที่ปรับ" class="btn_define" onclick="window.location='<?=JS_FIX_URLPATH;?>/budget_request/view_adjust/<?=($step-1);?>/<?=$divisionid;?>/<?=$budgetyear;?>';" />
	    <? endif;?>
	    <? if(@$dontsend != true){ ?>
	     <input type="button" value="ส่งให้ สนย. ตรวจสอบ" title="ส่งให้ สนย. ตรวจสอบ" class="btn_sendchk" onclick="SendToAdmin('<?=$budgetyear;?>','<?=$divisionid;?>','0','<?=$step;?>');" />
	    <? } ?>                 
	    <? if($bg_status <= 1 && login_data('budgetcanaccessall')!='' ){ ?>
	   	 <input type="button" value=""  class="btn_add" style="display: inline;" onclick="window.location='budget_request/form1/add/<?=$url_parameter;?>&step=<?=$step;?>';" />
	    <? } ?>
      </div>     
      <!-- ---------------------------------------->
      <? GetProjectList(@$_GET['budgetyear'],@$_GET['divisionid'],@$_GET['workgroupid'],$step);?>
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