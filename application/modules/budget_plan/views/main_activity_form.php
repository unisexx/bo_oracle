<script type="text/javascript">               
$().ready(function() {
    // validate signup form on keyup and submit
	$("#frmStrategy").validate({
		rules: {
			title: "required",
			syear: "required",
			budgetstrategyid: "required",
			planid: "required",
			strategytargetid: "required",
			ministrytargetid: "required" ,
			ministrystrategyid: "required",
			sectiontargetid: "required",			
			sectionstrategyid: "required",
			productivityid: "required",
			budgetpolicyid: "required"
		},
		messages: {
			title: "กรอก ชื่อรายการ",
			syear: "กรุณาเลือกปี",
			budgetstrategyid: "กรุณาเลือก<?=$lv_title[1];?>",
			planid: "กรุณาเลือก<?=$lv_title[2];?>",
			strategytargetid: "กรุณาเลือก<?=$lv_title[3];?>",
			ministrytargetid: "กรุณาเลือก<?=$lv_title[4];?>",
			ministrystrategyid: "กรุณาเลือก<?=$lv_title[5];?>",
			sectiontargetid:"กรุณาเลือก<?=$lv_title[6];?>",
			sectionstrategyid:"กรุณาเลือก<?=$lv_title[7];?>",
			productivityid:"กรุณาเลือก<?=$lv_title[7];?>",
			budgetpolicyid:"กรุณาเลือก<?=$lv_title[9];?>"
		}
    });	
     $("select[name=budgetstrategyid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'planid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_planid").html(data);
    	})
    })
    
    $("select[name=planid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'strategytargetid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_strategytargetid").html(data);
    	})
    })
    
    $("select[name=strategytargetid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'ministrytargetid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_ministrytargetid").html(data);
    	})
    })
    $("select[name=ministrytargetid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'ministrystrategyid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_ministrystrategyid").html(data);
    	})
    })
    $("select[name=ministrystrategyid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'sectiontargetid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_sectiontargetid").html(data);
    	})
    })
    $("select[name=sectiontargetid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'sectionstrategyid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_sectionstrategyid").html(data);
    	})
    })
    $("select[name=sectionstrategyid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'productivityid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_productivityid").html(data);
    	})
    })
    $("select[name=productivityid]").live('change',function(){
    	$.post('budget_plan/reload_list',{
    		'target_lv' : 'budgetpolicyid',
    		'pid' : $(this).val()    		
    	},function(data)
    	{
    		$("#td_budgetpolicyid").html(data);
    	})
    })
});					
</script>
<h3 id="topic">แผนงานตามยุทธศาสตร์ (เพิ่ม / แก้ไข)</h3>
<form name="frmStrategy" id="frmStrategy" method="post"  enctype="multipart/form-data" action="budget_plan/save">
<div id="add">
<div id="strategy">
<div style="padding:10px;">
เลือกปีงบประมาณ
  <select name="syear" id="syear">
      <option value="">ปีงบประมาณ</option>
      <?
      $sql = "SELECT * FROM CNF_SET_TIME ORDER BY BYEAR ";
      $result = $this->db->getarray($sql);
      foreach($result as $ryear)
      {
      ?>
      <option value="<?=$ryear['BYEAR']-543;?>" <? if(($ryear['BYEAR']-543)==@$budgetyear)echo "selected";?>><?=$ryear['BYEAR'];?></option>
      <?
      }
      ?>
  </select> 	
</div>
 </div><!--strategy-->
<table class="tbadd">  
  <tr>
  	<th><?=$lv_title[1];?></th>
  	<td>
  		<?php echo form_dropdown('budgetstrategyid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=0 "),@$prow['budgetstrategyid'],'','-- '.$lv_title[1].' --');?>
  	</td>
  </tr> 
  <tr>
  	<th><?=$lv_title[2];?></th>
  	<td id="td_planid">
  		<?php echo form_dropdown('planid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['budgetstrategyid']),@$prow['planid'],'','-- '.$lv_title[2].' --');?>
  	</td>
  </tr>
  <tr>
  	<th><?=$lv_title[3];?></th>
  	<td id="td_strategytargetid">
  		<?php echo form_dropdown('strategytargetid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['planid']),@$prow['strategytargetid'],'','-- '.$lv_title[3].' --');?>
  	</td>
  </tr>
  <tr>
  	<th><?=$lv_title[4];?></th>
  	<td id="td_ministrytargetid">
  		<?php echo form_dropdown('ministrytargetid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['strategytargetid']),@$prow['ministrytargetid'],'','-- '.$lv_title[4].' --');?>
  	</td>
  </tr>  
  <tr>
  	<th><?=$lv_title[5];?></th>
  	<td id="td_ministrystrategyid">
  		<?php echo form_dropdown('ministrystrategyid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['ministrytargetid']),@$prow['ministrystrategyid'],'','-- '.$lv_title[5].' --');?>
  	</td>
  </tr>
  <tr>
  	<th><?=$lv_title[6];?></th>
  	<td id="td_sectiontargetid">
  		<?php echo form_dropdown('sectiontargetid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['ministrystrategyid']),@$prow['sectiontargetid'],'','-- '.$lv_title[6].' --');?>
  	</td>
  </tr>
  <tr>
  	<th><?=$lv_title[7];?></th>
  	<td id="td_sectionstrategyid">
  		<?php echo form_dropdown('sectionstrategyid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['sectiontargetid']),@$prow['sectionstrategyid'],'','-- '.$lv_title[7].' --');?>
  	</td>
  </tr>
  <tr>
  	<th><?=$lv_title[8];?></th>
  	<td id="td_productivityid">
  		<?php echo form_dropdown('productivityid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['sectionstrategyid']),@$prow['productivityid'],'','-- '.$lv_title[8].' --');?>
  	</td>
  </tr>
  <tr>
  	<th><?=$lv_title[9];?></th>
  	<td id="td_budgetpolicyid">
  		<?php echo form_dropdown('budgetpolicyid',get_option("id","title","cnf_strategy"," syear=".$budgetyear." AND  pid=".$prow['pid']),@$prow['id'],'','-- '.$lv_title[9].' --');?>
  	</td>
  </tr>
  <tr>
    <th width="18%"> 
		ชื่อ <?=$lv_title[$lv];?> : <span class="Txt_red_8">*</span></th>
     <td>
     <input type="text" name="title" id="title" value="<?=$row['title'];?>" size="70">
     <input type="hidden" name="id" id="id" value="<?=$id;?>">
     <input type="hidden" name="pid" id="pid" value="<?=$pid;?>">
     <input type="hidden" name="lv" id="lv" value="10">     
     <input type="hidden" name="createdate" id="createdate" value="<? if(@$row['createdate']>0)echo $row['createdate'];else echo date("Y-m-d");?>">      
     </td>
  </tr>
</table>
 </div>

 <div style="padding-left:18%; padding-top:10px;">
 <input type="submit" name="button" id="button" value="" class="btn_save">
 <input type="button" name="button2" id="button2" value="" class="btn_back" onClick="history.back();">
 </div>
</div><!--add-->