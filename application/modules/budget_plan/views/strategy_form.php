<script type="text/javascript">               
$().ready(function() {
    // validate signup form on keyup and submit
	$("select[name=syear]").change(function(){
		var budgetyear = $(this).val();
		var pid = $("#pid").val();
		var id = $("#id").val();
		var lv = 1;
		if(budgetyear > 0)window.location='budget_plan/form/' + budgetyear + '/' + lv + '/' + pid + '/' + id; 
	})
	$("#frmStrategy").validate({
		rules: {
			title: "required",
			syear: "required"                 
		},
		messages: {
			title: "กรอก ชื่อรายการ",
			syear: "กรุณาเลือกปี"
		}
    });
	
	$("#iscopy").click(function(){
		var check_stat = $("#frmStrategy").find('input:checked').length;
		var settings = $('#frmStrategy').validate().settings;
		if(check_stat==1){			
			delete settings.rules.title;
			delete settings.messages.title;
		}else{
			settings.rules.title = {required: true};
			settings.messages.title = "กรอก ชื่อรายการ";
		}
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
	<? if($lv==1 && $id==''){ ?>
		<input type="checkbox" name="iscopy" id="iscopy" value="1">ก๊อปปี๊ยุทธศาสตร์ล่าสุด 
	<? } ?>
</div>
 </div><!--strategy-->
<table class="tbadd">
  <tr>
    <th width="18%"> 
		ชื่อ <?=$lv_title[$lv];?> : <span class="Txt_red_8">*</span></th>
     <td>
     <input type="text" name="title" id="title" value="<?=$row['title'];?>" size="70">
     <input type="hidden" name="id" id="id" value="<?=$id;?>">
     <input type="hidden" name="pid" id="pid" value="<?=$pid;?>">
     <input type="hidden" name="lv" id="lv" value="1">
     <input type="hidden" name="createdate" id="createdate" value="<? if(@$row['createdate']>0)echo $row['createdate'];else echo date("Y-m-d");?>">           
     </td>
  </tr>
</table>
 </div>

 <div style="padding-left:18%; padding-top:10px;">
 <input type="submit" name="button" id="button" value="" class="btn_save">
 <input type="button" name="button2" id="button2" value="" class="btn_back" onClick="window.location='strategy.php?year=<?=@$_GET['budgetyear'];?>';">
 </div>
</div><!--add-->