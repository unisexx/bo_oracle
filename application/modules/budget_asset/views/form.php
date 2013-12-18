<script type="text/javascript">
$.validator.setDefaults({
	submitHandler: function() { form.submit() }
});

$().ready(function() {
	// validate signup form on keyup and submit
	$("#frmAsset").validate({
		rules: {
			assetname: "required",
			assettypeid: "required",
			unittypeid : "required",
			price : "required",
			
		},
		messages: {
			assetname: "กรอกชื่อครุภัณฑ์",
			assettypeid: "เลือกประเภทครุภัณฑ์",
			unittypeid : "เลือกประเภทหน่วยนับ",
		    price : "กรอกราคา"
		}
	});
	
});
</script>
<form name="frmAsset" id="frmAsset" method="post" enctype="multipart/form-data" action="budget_asset/save<?=$url_parameter;?>">
<div id="add">
<h3 id="topic">ครุภัณฑ์ (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th width="18%">ประเภทครุภัณฑ์ (ประเภทย่อย) <span class="Txt_red_8">*</span></th>
  <td>  
    <?
    	echo form_dropdown('assettypeid',get_option('id','title','cnf_budget_type',' isasset > 0 and (assetid = 0 or assetid is null) order by title '),@$row['assettypeid'],'','-- เลือกประเภทครุภัณฑ์ --');
	?>
  </td>
</tr>
<tr>
  <th>ชื่อรายการครุภัณฑ์ <span class="Txt_red_8">*</span></th>
  <td><input name="assetname" id="assetname" type="text" size="80" value="<?=$row['assetname'];?>" /></td>
</tr>
<tr>
  <th>หน่วยนับ <span class="Txt_red_8">*</span></th>
  <td>  
  	<?
  		echo form_dropdown('unittypeid',get_option('id','title','cnf_count_unit'," isassetunit <> '' order by title "),@$row['unittypeid'],'','-- เลือกหน่วยนับ  --');
	?>    
  </td>
</tr>
<tr>
  <th>ราคา <span class="Txt_red_8">*</span></th>
  <td><input name="price" id="price" type="text" size="20" value="<?=$row['price'];?>" class="Number" alt="decimal" /></td>
</tr>
<tr>
  <th>ใข้งาน</th>
  <td><input name="used" type="checkbox" id="used"  <? if($row['used']>0 || @$row['id']=='')echo "checked";?>    /></td>
</tr>
</table>
<div style="padding-left:18%; padding-top:10px;">
 <input type="submit" name="button" id="button" value="" class="btn_save" />
 <input type="button" name="button2" id="button2" value="" class="btn_back" onclick="history.back();" /></div>
</div><!--add-->
</form>