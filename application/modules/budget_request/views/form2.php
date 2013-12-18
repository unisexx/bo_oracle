<? include_once "include/budget_type_config.php";?>
<style type="text/css">
.accord_title{
	padding-left:30px;
	padding-top:10px;
	padding-bottom:10px;
}
</style>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		<? if($act=='view'):?>
			$('input[type=text]').attr("disabled",true);
			$('select').attr("disabled",true);
			$('input[type=checkbox]').attr("disabled",true);
			$('.btn_add').hide();			
		<? endif; ?>
		function init_rte(){
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
		}

		
		function calculate_summary_expense(){
			$(".dvexpenseall").each(function(){
				tbsummary_expense = $(this).find('#summary_expense');
				$(this).find('.table_budget').each(function(){
					var bg1 = 0;
					var bg2 = 0;
					var bg3 = 0;
					var bg4 = 0;
					$(this).find("tr:not(:first,:last)").each(function(){
						bg1 += Number($(this).find('.budget_q1').val().replace(/[^0-9\.]+/g,""));						
						bg2 += Number($(this).find('.budget_q2').val().replace(/[^0-9\.]+/g,""));
						bg3 += Number($(this).find('.budget_q3').val().replace(/[^0-9\.]+/g,""));
						bg4 += Number($(this).find('.budget_q4').val().replace(/[^0-9\.]+/g,""));	 	
					});
					$(this).find("#summarybudget_q1").val(new NumberFormat(bg1).toFormatted());
					$(this).find("#summarybudget_q2").val(new NumberFormat(bg2).toFormatted());
					$(this).find("#summarybudget_q3").val(new NumberFormat(bg3).toFormatted());
					$(this).find("#summarybudget_q4").val(new NumberFormat(bg4).toFormatted());	
				})
				$(this).find('.td_subexpense_detail').each(function(){
					var summary_subexpense =0;
					$(this).find('.budget').each(function(){
						summary_subexpense += Number($(this).val().replace(/[^0-9\.]+/g,""));
					})						
					$(this).find(".summary_subexpense").val(new NumberFormat(summary_subexpense).toFormatted())
					
				})
				var summary_expense = 0;	
				$(this).find(".summary_subexpense").each(function(){
					summary_expense += Number($(this).val().replace(/[^0-9\.]+/g,""));
				})							
				tbsummary_expense.val(new NumberFormat(summary_expense).toFormatted());							
			})
			
			
		
			$(".dvexpenseall").each(function(){
				tbsummary_expense = $(this).find('#summary_expense');
				var summary_expense = 0;
				var summary_subexpense = 0;
				var summary_asset =0;
				$(this).find('.budget').each(function(){
						summary_expense += Number($(this).val().replace(/[^0-9\.]+/g,""));
				})
				tbsummary_expense.val(new NumberFormat(summary_expense).toFormatted());
				
				var qty = 0;				
				$(this).find(".tbassetlist").each(function(){
					qty = 0;
					summary_asset = 0;
					$(this).find(".AssetQTY").each(function(){
						qty += Number($(this).val().replace(/[^0-9\.]+/g,""));
					})			
					$(this).find('.budget').each(function(){
						summary_asset += Number($(this).val().replace(/[^0-9\.]+/g,""));						
					})		
					var nf = new NumberFormat(qty);
					nf.setPlaces(0);
					nf.setSeparators(true);
					var num = nf.toFormatted();
					//alert(qty);
					$(this).find("#assetsummaryqty").val(num);
					$(this).find("#assetsummarytotalamount").val(new NumberFormat(summary_asset).toFormatted());					
				})
				
				
				$(this).find('.tr_sub_expense_head').each(function(){
					summary_subexpense = 0;
					$(this).next('tr').find('#assetsummarytotalamount').each(function(){
						summary_subexpense+=Number($(this).val().replace(/[^0-9\.]+/g,""));	
					})
					var nitem = $(this).next('tr').find('.tbassetlist').length;
					$(this).find('.summary_subexpense').val(new NumberFormat(summary_subexpense).toFormatted());					
					var nf = new NumberFormat(nitem);
					nf.setPlaces(0);
					nf.setSeparators(true);
					var num = nf.toFormatted();
					$(this).find('#summary_subexpense_qty').val(num);		
				})
				
				var summary_budget = 0;
				$(".summary_expense").each(function(){
					summary_budget+=Number($(this).val().replace(/[^0-9\.]+/g,""));	
				})
				$("#tbBudgetAllSummary").val(new NumberFormat(summary_budget).toFormatted());
				
				var summary_mode = 0;
				$(".budget_expense_mode_1").each(function(){
					summary_mode+=Number($(this).val().replace(/[^0-9\.]+/g,""));
				})
				$("#otherexpense").val(new NumberFormat(summary_mode).toFormatted());
				
				summary_mode = 0;
				$(".budget_expense_mode_2").each(function(){
					summary_mode+=Number($(this).val().replace(/[^0-9\.]+/g,""));
				})
				$("#minexpense").val(new NumberFormat(summary_mode).toFormatted());
			})		
		}
		function calculate_operation_province_budget(){
			var budget =0;
			$(".tb_operation_area_province").find(".Number").each(function(){
				budget+=Number($(this).val().replace(/[^0-9\.]+/g,""));
			})
			$("#summaryprovincebudget").val(new NumberFormat(budget).toFormatted())
		}
		$('.tb_operation_area_province').rowCount();
		$('.tb_operation_area_province .rowNumber:last').text("");
		$('input:text').setMask();
		$("input[alt=decimal]").attr("style","text-align:right;");
		$("#accordion").accordion(
			{autoHeight: false}
		);		
		$('.ChkBox').click(function(){			
			$('#'+$(this).attr('rel')).slideUp();
			if($(this).attr('checked')) $('#'+$(this).attr('rel')).slideDown();
		}).each(function(i,item){
			$('#'+item.value).hide();			
			if(item.checked)  $('#'+item.value).show();
		})	;	
		$('.budget').live('keyup',function(){
			calculate_summary_expense();
		})				
		$(".btn_add_asset").colorbox({width:"50%",height:"550px", inline:true, href:"#bg_source_form"});		
		$(".btn_add_asset").click(function(){
			$("#hd_target_table").val("dvassetlist"+($(this).attr("rel")));
			$("#hd_target_subexpense").val($(this).attr("rel"));
		})
		$(".btn_search").click(function(){
			var search = $("#tb_search_asset").val();
			$.post('budget_request/search_asset',{
				'search':search
			},function(data){
				$("#dv_search_asset_result").html(data);
			})
		})
		$(".tb_asset_result td").live("click",function(){
			var dv_target = $("#hd_target_table").val();
			var subexpense_id = $("#hd_target_subexpense").val();
			var asset_id = $(this).closest('tr').find('#hd_asset_result_id').val();
			var asset_name = $(this).closest('tr').find('#hd_asset_result_name').val();
			var asset_price = $(this).closest('tr').find('#hd_asset_result_price').val();
			var budgetid = $("#budgetid").val();
			$.post('budget_request/append_asset_table',{
				'asset_id':asset_id,
				'subexpense_id':subexpense_id,
				'budgetid' : budgetid
			},function(data){
				$("#"+dv_target).append(data);					
				$("input:text").setMask();
				init_rte();
				//var nitem = $("#"+dv_target).find('.tbassetlist').length;
				//$("#"+dv_target).closest('tr').prev('tr').find('#summary_subexpense_qty').val(nitem);
				calculate_summary_expense();												
				$.colorbox.close();				
				
								
			})
			
		})
		$("#btnRemoveAsset").live("click",function(){
			if(confirm('ลบรายการนี้ ?'))
			{				
				$(this).closest("table").remove();
				calculate_summary_expense();
			}
		})
		
		
		$(".AssetQTY").live("keyup",function(){
			calculate_summary_expense();
		})
		
		$(".btn_add_operation_province").click(function(){
			$("#td_add_operation_province").append("<img id='loading' src='images/loading.gif' align='absmiddle'>");
			var current_budget = $("#budgetprovince").val();			
			var exist_province_id = '';
			var budget = '';
			$(".tb_operation_area_province tr").each(function() {
				if($(this).find("#hd_operation_province_id").val() > 0 ){					
					exist_province_id += exist_province_id != '' ? '|' + $(this).find("#hd_operation_province_id").val()  : $(this).find("#hd_operation_province_id").val();
					budget += budget != '' ? '|' + $(this).find("#operation_province_budget").val() :  $(this).find("#operation_province_budget").val();
				}
			})
			
			var select_province = $("select[name=operationareaprovince]").val();
			if(select_province=='ALL'){
				$("select[name=operationareaprovince] option").each(function(){
					if($(this).val() != 'ALL')
					{
						select_province = $(this).val();
						exist = false;
						$(".tb_operation_area_province tr").each(function() {
							if($(this).find("#hd_operation_province_id").val() == select_province){
								exist = true;
							}
						})
						if(exist == false){
							exist_province_id+= exist_province_id != '' ? '|' + select_province : select_province ;
							budget += budget != '' ? '|' + current_budget : current_budget;
						}
					}						
				})
			}else{
				exist = false;
				$(".tb_operation_area_province tr").each(function() {
					if($(this).find("#hd_operation_province_id").val() == select_province){
						exist = true;
					}
				})
				if(exist == false){
					exist_province_id+= exist_province_id != '' ? '|' + select_province  : select_province;
					budget+= budget != '' ? '|'+current_budget : current_budget;
				}
			}
			
			$.post('budget_request/reload_budget_province_table',{
				'province_id':exist_province_id,
				'budget' : budget
			},function(data){
				$("#dv_operation_province_table").html(data);
				$('.tb_operation_area_province').rowCount();
				$('.tb_operation_area_province .rowNumber:last').text("");
				calculate_operation_province_budget();
				$("#loading").remove();
			})
		})
		
		$("select[name=operationareazone]").change(function(){
			var province_zone = $(this).val();			
			$("#dv_operation_province").append("<img src='images/loading.gif' align='absmiddle'>");
			$("select[name=operationareaprovince]").attr("disabled","disabled");
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
				calculate_operation_province_budget();
			}
		})
		$(".btn_delete_operation_province").live('click',function(){
			if(confirm('ลบจังหวัดพื้นที่ดำเนินการนี้ ?')){
				$(this).closest('tr').remove();
				$('.tb_operation_area_province').rowCount();
				$('.tb_operation_area_province .rowNumber:last').text("");
				calculate_operation_province_budget();
			}
		})
		
		
		init_rte();
		calculate_summary_expense();	
		calculate_operation_province_budget();	
	})
</script>
<form method="post" enctype="multipart/form-data" action="budget_request/save2<?=$url_parameter;?>">
<h3>รายละเอียดงบประมาณ (ขั้นตอนที่ <?=$step;?>)</h3>
<br>
<h4 id="topic">ชื่อโครงการ / กิจกรรม : <?=@$bmaster['projecttitle'];?></h4>
<div id="accordion">
	<? 	
	foreach($budget_type_result as $budget_type):
		$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$budget_type['id']." and ID in (".$expenseid.")  AND LV=2 ORDER BY ORDERNO ";
		$expense_result = $this->db->getarray($sql);
		array_walk($expense_result,'dbConvert');
		foreach($expense_result as $expense):				
	?>        
        	<h4 class="accord_title"><?=$budget_type['title']." - ".$expense['title'];?></h4>
			<div id="dvexpenseall" class="dvexpenseall">
				<table width="100%" cellpadding="0" cellspacing="0" class="Txt_std14" >
                <tr>
                  <td>รวม<?=$expense['title'];?><br />&nbsp;</td>
                  <td>
                  	<input name="summary_expense" type="text" id="summary_expense" class="summary_expense" value="" disabled="disabled" alt="decimal" /> บาท  <br />
                  &nbsp;
                  </td>
                </tr>		
				<?
                $sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$expense['id']." ORDER BY ISASSET, ORDERNO  ";
                $subexpense_result = $this->db->getarray($sql);
				array_walk($subexpense_result,'dbConvert');
				foreach($subexpense_result as $subexpense):					
				if($subexpense['isasset']>0)
				 include('application/modules/budget_request/views/subexpense_asset_table_view.php');	
				else						 				
            	 include('application/modules/budget_request/views/subexpense_table_view.php');
            	endforeach;
            	?>      			
				</table>
			</div>
		<? endforeach;?>
	<? endforeach; ?> 	
</div>
<fieldset>
    <legend>การจัดสรรงบประมาณ</legend>
<table class="tblist" >
<tr>
  <th width="25%">งบประมาณทั้งโครงการ (<?=$budgetyear;?>) </th>
  <td align="left">  
    <span class="Txt_std14_orange" id="spBudgetTotal" ><input type="text" disabled="disabled" id="tbBudgetAllSummary" name="tbBudgetAllSummary" alt="decimal"> </span> 
  	รายจ่ายอื่น  
  	<input type="text" class="Number bgFillData" name="otherexpense" id="otherexpense" value="<?=number_format(@$bmaster['otherexpense'],2);?>" alt="decimal" />
   	รายจ่ายขั้นต่ำ 
   	<input type="text" class="Number bgFillData" name="minexpense" id="minexpense" value="<?=number_format(@$bmaster['minexpense'],2);?>" alt="decimal" />  
  </td>
</tr>
</table><br />    
<table class="tblist">
<tr>
  <th width="25%" valign="top">พื้นที่ดำเนินการ</th>
  <td width="75%" align="left">
    <input name="chkoperationcentral" id="chkoperationcentral" type="checkbox" class="bgFillData"  value="1" <? if(@$bmaster['chksummarycentralbudget']=='on')echo "checked";?> />
ส่วนกลาง 
	  <input name="summarycentralbudget" id="summarycentralbudget" type="text" value="<?=number_format(@$bmaster['summarycentralbudget'],2);?>" size="14" class="Number bgFillData" alt="decimal" style="text-align: right; ">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="checkbox" name="chkoperationregion" id="chkoperationregion"  rel="DvRegion1" class=" bgFillData" value="DvRegion1"  <? if(@$bmaster['chksummaryregionbudget']=='on')echo "checked";?>  />
	     ภูมิภาค
	  <input name="summaryprovincebudget" id="summaryprovincebudget" type="text" value="<?=number_format(@$bmaster['summaryprovincebudget'],2);?>" size="14" class="Number" disabled="disabled"" alt="decimal" style="text-align: right; "> 
	  <br />
 <br />
 <div id="DvRegion1" <? if(@$bmaster['chksummaryregionbudget']=='off')echo "style=\"display:none\"";?>  >
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
   		   <? if($act=='edit' || $act=='add'): ?> 
   		   <input type="text" name="budgetprovince" id="budgetprovince" class="Number bgFillData" alt="decimal" style="text-align: right; " value="">       		   
		   <? endif;?>              
        </td>
   		<td nowrap="nowrap" align="left" id="td_add_operation_province">
   		   <? if($act=='edit' || $act=='add'): ?>    		          
		   <input type="button" name="button" value=""  class="btn_add btn_add_operation_province" style="display:inline"/>
		   <? endif;?>              
        </td>
   </tr>
   </table>
   <br />
  <br /><br />
  <div id="dv_operation_province_table" style="height:450px; overflow-y: auto;">
  <table class="type1 tb_operation_area_province">
    <tr>      
      <th>จังหวัด</th>
      <th>งบประมาณ</th>
      <? if($act=='edit' || $act=='add'): ?>
      <th><input type="button" id="btn_delete_all_operation_province" name="btn_delete_all_operation_province" value="ลบทุกรายการ" /></th>
      <? endif;?>      
    </tr>   
    <?    
    if(@$bmaster['id'] > 0){
    foreach($budget_area as $province_item):			
	?>
		<tr class="tr_operation_province">		
		<td><?=$province_item['province_title']?><input type="hidden" id="hd_operation_province_id" name="hd_operation_province_id[]" value="<?=$province_item['provinceid'];?>"></td>
		<td>
			<? if($act=='edit' || $act=='add'): ?>
			<input type="text" class="Number bgFillData" id="operation_province_budget" name="operation_province_budget[]" value="<?=number_format(@$province_item['budget'],2);?>" alt="decimal">
			<? else: ?>
			<?=number_format(@$province_item['budget'],2);?>
			<input type="hidden" class="Number bgFillData" id="operation_province_budget" name="operation_province_budget[]" value="<?=number_format(@$province_item['budget'],2);?>" alt="decimal">
			<? endif;?> 
		</td>
		<? if($act=='edit' || $act=='add'): ?>
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
<div style="padding-left:35%; padding-top:10px;">
	<input type="hidden" name="budgetid" id="budgetid" value="<?=$projectid;?>">
	<input type="hidden" name="act" id="act" value="<?=$act;?>">
<? if($act!='view'): ?>
    <input type="submit" name="btnSave" id="btnSave" value=""  class="btn_save" />
<? endif;?>
  &nbsp;
	<input type="button" name="btnBack" id="btnBack" value="" class="btn_back" onclick="history.back();">
    &nbsp;
    <input type="button" name="btnList" id="btnList" value="กลับไปหน้ารายการ"  class="btn_backmain" onclick="window.location='<?=JS_FIX_URLPATH;?>/budget_request/index<?=$url_parameter;?>'" />
</div><!--nextstep-->
</form>
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
			<h3 id="topic">เพิ่มรายการครุภัณฑ์</h3>
			ค้นหาชื่อรายการครุภัณฑ์ <input type="text" name="tb_search_asset" id="tb_search_asset" value=""><input type="button" class="btn_search" >
			<input type="hidden" name="hd_target_table" id="hd_target_table" value="">
			<input type="hidden" name="hd_target_subexpense" id="hd_target_subexpense" value="">
			<div id="dv_search_asset_result">
				
			</div>
		</div>
</div>