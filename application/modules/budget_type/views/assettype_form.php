<script type="text/javascript">
   
$().ready(function() {
        // validate signup form on keyup and submit
        $("#btn_search").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
		$("#show_result").click(function(){
			var txt_search = $("#tb_search").val();
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rbgpt");
			$.post('budget_asset/search_asset',{
				'txt_search' : txt_search
			},function(data){
				$("#dv_result").html(data);			
			})				
		})
		$(".tb_user_list td").live('click',function(){
			var item_id = $(this).closest("tr").find("#hd_item_id").val();
			var item_name = $(this).closest("tr").find("#hd_item_name").val();
			$("#assetid").val(item_id);
			$("#title").val(item_name);
			$().colorbox.close();
		})	
		$("#frmBudgetType").validate({
			rules: {
				 assetid: "required",           
				 budgettypeid: "required",
				 expensetypeid:"required",
				 assettypeid:"required"
			},
			messages: {
			    assetid: "เลือกรายการครุภัณฑ์",
				budgettypeid: "เลือกประเภทงบ",
				expensetypeid:"เลือกประเภทงบย่อย",
				assettypeid:"เลือกประเทภย่อย(ครุภัณฑ์)"
	        }
	    });
    
});
</script>               
<h3>หมวดงบประมาณ</h3>  
<form name="frmBudgetType" id="frmBudgetType" method="post" action="budget_type/save">
<table class="tbadd">
<tr>
  <td colspan="2" >กรณีเพิ่มรายการ (Level 4)</td>
  </tr>
<tr>
  <th width="18%">เลือกประเภทงบ <span class="Txt_red_8">*</span></th>
  <td >
	<? echo form_dropdown('budgettypeid',get_option('id','title','cnf_budget_type','lv=1 order by orderno asc '),@$prow['budgettypeid'],'','-- เลือกหมวดงบประมาณ --','');?>
	<input type="hidden" name="pid" id="pid" value="<?=@$prow['id'];?>">
	<input type="hidden" name="id" id="id" value="<?=@$row['id'];?>">
	<input type="hidden" name="lv" id="lv" value="4">     
  </td>
</tr>
<tr>
  <th>เลือกประเภทงบย่อย <span class="Txt_red_8">*</span></th>

  <td id="td_expensetype">
	<? echo form_dropdown('expensetypeid',get_option('id','title','cnf_budget_type','pid='.@$prow['budgettypeid'].' order by orderno asc '),@$prow['expensetypeid'],'','-- เลือกหมวดค่าใช้จ่าย --','');?>     
  </td>
</tr>
<tr>
  <th>เลือกประเภทย่อย (ครุภัณฑ์) <span class="Txt_red_8">*</span></th>
  	<td id="td_assettype">
		<? echo form_dropdown('assettypeid',get_option('id','title','cnf_budget_type','pid='.@$prow['expensetypeid'].' and isasset > 0 order by orderno asc '),@$prow['id'],'','-- เลือกหมวดประเภทสินทรัพย์ --','');?>
	</div>
  </td>
</tr>
<tr>
  <th>รายการครุภัณฑ์ <span class="Txt_red_8">*</span></th>
  <td>      
		<input type="hidden" name="assetid" id="assetid" value="<?=$row['assetid'];?>" />
		<input name="title" type="text" id="title" size="50" value="<?=$row['title'];?>"  />       
		<input type="button" name="btn_search" id="btn_search" value="ค้นหาสินทรัพย์"/>
   </td>
</tr>
<tr>
<th>ลำดับ</th>
<td><input type="text" id="orderno" name="orderno" value="<?=$row['orderno'];?>" class="Number" /></td>
</tr>
</table>
<div style="padding-left:18%; padding-top:10px;"><input type="submit" name="button" id="button" value="" class="btn_save" />
  <input type="button" name="button5" id="button5" value="" class="btn_back" onclick="history.back();" />
</div>
</form>    
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>เลือกครุภัณฑ์</h3>
        <div class="paddT20"></div>        
                      กรอกรายการครุภัณฑ์
        <input type="text" id="tb_search" name="tb_search" value="">
        <input type="button" name="show_result" id="show_result" value=" ค้นหา "> 
        <div id="dv_result" style="height: 550px;">
        	
        </div>
		</div>
</div>