<style type="text/css">
.clFile,.clAdd2{
white-space: nowrap;
background-color: #555;
-moz-border-radius: 3px;
-webkit-border-radius: 3px;
border-radius: 3px;
padding: 1px 5px 1px 4px;
color: white;
font-size: 8pt;
font-weight: bold;
display: inline;
text-transform: uppercase;
}

.clFile{background-color: #65358F;}
.clFile a{color:#ffffff; text-decoration:none;}

.clAdd2{background-color: #D74A38;}

.delFile{color:#FFDD99 !important; cursor: pointer;}
</style>

<script type="text/javascript" src="media/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
$(function() {
            $('textarea.tinymce').tinymce({
                   	theme : "advanced",
                    skin: "cirkuit",
				    theme_advanced_buttons1 : "bold,italic,underline, strikethrough,|,bullist,numlist,|,forecolor,|,backcolor,|,undo,redo,|,removeformat,|, help",
				    theme_advanced_buttons2: "",
				    theme_advanced_buttons3: "",
				    theme_advanced_buttons4: "",
				    theme_advanced_toolbar_location : "top",
				    theme_advanced_toolbar_align : "left",
				    forced_root_block : false,
					force_br_newlines : true,
					force_p_newlines : false,
					height : "300",
					width : "100%"
            });
});


$(document).ready(function(){
	
	// $(".btn_save").livequery("click",function(){
		// $("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:top;'>").appendTo($(this).parent());
// 		
		// var id = $(this).prev("input[name=id]").val();
		// var operationresult = $(this).closest("td").find("textarea[name=operationresult]").html();
		// var infoEle = $(this).next(".info");
		// $.post("inspect_inspector_recomm/operationresult_save_ajax",{
			// "id":id,
			// "operationresult":operationresult
		// },function(data){
			// $(".loading").remove();
			// $("<span style='color:green;'>บันทึกข้อมูลเรียบร้อย</span>").appendTo(infoEle).hide().fadeIn('fast').delay(1000).fadeOut('slow');
		// });
	// });
		
	$("select[name=provincearea]").live("change",function(){
		var provincearea = ($(this).val());			
		$.post('c_province/select_province_from_area',{
				'provincearea' : provincearea,				
			},function(data){
				$("#dvProvinceID").html(data);
		});
	});
	
	$(".clAdd2").click(function(){
		$(this).next().next().find("input[type=file]:first").clone().appendTo($(this).next());
	});
	
	$(".delFile").click(function(){
		if(confirm("ยืนยันการลบไฟล์")){
			var $this = $(this);
			var fileId = $(this).next("input[type=hidden][name=fileId]").val();
			$.get('inspect_inspector_recomm/delFile',{id:fileId},
			function(data){
				$this.closest(".clFile").fadeOut();
			});
		}
	});
	
});
</script>

<h3>บันทึก ข้อเสนอแนะผู้ตรวจ</h3>
<?php if(login_data('is_inspector') == 'on'): ?>
<form method="get" >
<div id="search">
<div id="searchBox">
  <select name="budgetyear" id="budgetyear">
    <option value="">-- เลือกปีงบประมาณ --</option>
    <?php foreach($byear as $item){
    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
    }
    ?>
  </select>
  <?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid = 4 or id = 105"),@$_GET['divisionid'],'','-- เลือกหน่วยงาน --','0');  ?>
  <?php if(login_data('insp_access_all') == 'on'):?>
  	<select name="provincearea" id="provincearea">
    <option value="">-- เลือกเขต --</option>
    <?php foreach($provincearealist as $item){
    	$selected = @$provincearea == $item['id'] ? " selected=selected" :  "";
    	echo '<option value="'.$item['id'].'" '.$selected.' >'.$item['title'].'</option>';
    } ?>
    </select>
  <?php else:?>
  	<select name="provincearea" id="provincearea">
    <option value="">-- เลือกเขต --</option>
    <?php foreach($provincearealist as $row){
    	$selected = (@$provincearea == $row['id']) ? " selected='selected'" :  "";
    	echo '<option value="'.$row['id'].'" '.$selected.'>'.$row['title'].'</option>';
    } ?>
    </select>
  <?php endif;?>
  <?php echo @form_dropdown('provinceid',get_option("id","title","cnf_province where id <> 2"),$_GET['provinceid'],'','-- เลือกจังหวัด --','0');  ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
</div>
</div>
</form>

<?php else:?>

<form method="get" action="inspect_inspector_recomm/index">
<div id="search">
<div id="searchBox">
  <select name="budgetyear" id="budgetyear" class="mustChoose">
    <option value="">-- เลือกปีงบประมาณ --</option>
    <?php foreach($byear as $item){
    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
    }
    ?>
  </select>
  <input type="hidden" name="provincearea" value="<?php echo login_data('user_province_area_id')?>">
  <input type="hidden" name="provinceid" value="<?php echo login_data('user_province_id')?>">
  <input type="hidden" name="divisionid" value="<?php echo login_data('divisionid')?>">
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
</div>
</div>
</form>
<?php endif;?>


<?php if(login_data('is_inspector') == 'on'):?>	
	<input class="btn_add" type="button" value="" style="float: right; margin: 0 0 10px 0;" onclick="window.location='inspect_inspector_recomm/newform'">
<?=$pagination;?>        

<table class="tblist">
	<tr>
	  <th align="left">ปีงบประมาณ</th>
	  <th align="left">หน่วยงาน</th>
	  <th align="left">จังหวัด</th>
	  <th align="left">ข้อเสนอแนะ</th>
	  <th align="left">ตอบกลับ</th>
	  <th align="left">ลบ</th>
	</tr>
	<?php foreach($result as $key=>$row):?>
		<tr <?=cycle($key)?> onclick="window.location='inspect_inspector_recomm/newform?budgetyear=<?=$row['budgetyear']?>&divisionid=<?=$row['divisionid']?>&provincearea_id=<?=$row['provincearea_id']?>&provinceid=<?=$row['provinceid']?>'">
			<td><?=$row['budgetyear']+543?></td>
			<td><?=$row['division_title']?></td>
			<td><?=$row['province_title']?></td>
			<td><?=$row['nsuggestion']?></td>
			<td><?=$row['noperationresult']?></td>
			<td>
				<a href="inspect_inspector_recomm/newdelete/<?=$row['budgetyear']?>/<?=$row['divisionid']?>/<?=$row['provincearea_id']?>/<?=$row['provinceid']?>" style="text-decoration:none;" onclick="return confirm('ยืนยันการลบ')"><input type="button" class="btn_delete"></a>
			</td>
		</tr>
	<?php endforeach;?>
</table>

<?=$pagination;?>
<?php else:?>
	<? if(!empty($_GET['budgetyear'])):?>
	<style type="text/css">
		#operation-zone .tblist4 td span{color:#333;}
		#operation-zone .tblist4 td span strong{font-weight:bold;}
	</style>
	<div id="operation-zone">
	<form action="inspect_inspector_recomm/operation_save" method="post" enctype="multipart/form-data">
	<table width="100%" class="tblist4">
		<tr class="topic">
		</tr>
		<tr>
		  <th width="50%">ข้อเสนอแนะ (ผู้ตรวจราชการ)</th>
		  <th width="50%">ผลการดำเนินงาน</th>
		</tr>
		<?php foreach($result as $key=>$row):?>
			<tr>
			  <td><?=$row['suggestion']?></td>
			  <td>
			  	<textarea class="tinymce" name="operationresult[]" rows="5" id="operationresult-<?=$key+1?>" style="width:100%;"><?=$row['operationresult']?></textarea>
			  	<div>
			  		<input type="hidden" name="id[]" value="<?=$row['id']?>">
			  		<div class="clAdd2" style="cursor: pointer;">เพิ่มไฟล์แนบ</div>
			  		<div style="margin:3px 0;">
				  		<?php
				  			$file = $this->recomm_file->where("insp_inspector_recomm_id = ".$row['id'])->get(false,true);
				  			foreach($file as $item):
				  		?>
				  			<div class="clFile"><a href="inspect_inspector_recomm/download_file/<?php echo $item['id']?>"><?php echo $item['file_name']?></a> <span class="delFile">x</span><input type="hidden" name="fileId" value="<?php echo $item['id']?>"></div>
				  		<?php endforeach;?>
			  		</div>
			  		<div style="background:#f2f2f2;">
			  			<input type="file" name="file_<?=$row['id']?>[]">
			  		</div>
			  		<!-- <input type="button" class="btn_save" value=" " title="บันทึก" name="input"> -->
			  		<span class="info"></span> 		
			  	</div>
			  </td>
			</tr>
		<?php endforeach;?>
		<tr>
			<td></td>
			<td>
				<input type="hidden" value="<?php echo GetCurrentUrlGetParameter();?>" name="urlParameter">
				<input type="submit" class="btn_save" value="บันทึกทั้งหมด">
			</td>
		</tr>
	</table>
	</form>
	</div>
	<?php endif;?>
<?php endif;?>