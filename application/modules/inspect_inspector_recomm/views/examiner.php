<style type="text/css">  
  body .tbadd td span {float:none; width:200px;}
  body .tbadd th{width: 195px;}
  body .ui-icon {width: 16px !important; height: 16px;}
  body .btn_add{display: inline;}
</style> 
<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<!-- Load jQuery build -->
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
					height : "480",
					width : "100%"
            });
    });
    

    $(document).ready(function(){
    	$(".btn_save").click(function(){
    		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:bottom;'>").appendTo(".loadingicon2");
    		
    		var budgetyear = $("select[name=budgetyear]").val();
    		var divisionid = $("select[name=divisionid]").val();
    		var provincearea_id = $("select[name=provincearea_id]").val();
    		var provinceid = $("select[name=provinceid]").val();
    		var suggestion = $('#suggestion').html();
    		var idEdit = $(this).prev("input[name=idEdit]").val();
    		
    		$.post('inspect_inspector_recomm/examiner_add_ajax',{
    			'id':idEdit,
    			'budgetyear':budgetyear,
    			'divisionid':divisionid,
    			'provincearea_id':provincearea_id,
    			'provinceid':provinceid,
    			'suggestion':suggestion
    		},function(data){
    			$("#suggesTb").html(data);
    			$('#suggestion').html("");
    			$(".ui-widget").fadeOut();
    			$("input[name=idEdit]").val("");
    			$('.loading').remove();
    			$("#sugges_tr,.btn_save").fadeOut();
    		});
    	});
    	
    	var getProvinceareaId = <?php echo @$_GET['provincearea_id'] == ""?"0":@$_GET['provincearea_id'];?>;
    	if(getProvinceareaId == 0){
    		$("select[name=provincearea_id]").attr("disabled",true);
    		$("select[name=provinceid]").attr("disabled",true);
    	}
    	
    	$("select[name=divisionid]").livequery("change",function(){
    		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:middle;'>").appendTo(".loadingicon:eq(0)");
    		var divisionid = $(this).val();
			$("select[name=provincearea_id]").removeAttr("disabled",true);
			$("select[name=provincearea_id]").val($("select[name=provincearea_id] option:first").val());
			$("select[name=provinceid]").val($("select[name=provinceid] option:first").val()).attr("disabled",true);
			$('.loading').remove();
			$('.btn_add,#sugges_tr').hide();
    	});
    	
    	$("select[name=provincearea_id]").livequery("change",function(){
    		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:middle;'>").appendTo(".loadingicon:eq(1)");
    		var provincearea_id = $(this).val();
    		$.post('c_province/select_province_from_area',{
				'provincearea' : provincearea_id
			},function(data){
				$("#dvProvinceID").html(data);
				$(".tblist2 tbody").children().filter(":not(tr:first)").remove();
				$('.loading').remove();
				$('.btn_add,#sugges_tr').hide();
			});
    	});
    	
    	$("select[name=provinceid]").livequery("change",function(){
    		$("<span class='loadingicon'><img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:middle;'></span>").appendTo("#dvProvinceID");
    		$("input[name=idEdit]").val("");
    		$(".ui-widget").fadeOut();
    		
    		var budgetyear = $("select[name=budgetyear]").val();
    		var divisionid = $("select[name=divisionid]").val();
    		var provincearea_id = $("select[name=provincearea_id]").val();
    		var provinceid = $(this).val();
    		
    		$.post("inspect_inspector_recomm/load_suggestion_ajax",{
    			"budgetyear":budgetyear,
    			"divisionid":divisionid,
    			"provincearea_id":provincearea_id,
    			"provinceid":provinceid
    		},function(data){
    			$("#suggesTb").html(data);
    			$('.loading').remove();
    			if(provinceid != ""){
	    			$(".btn_add").show();
	    		}
    		});
    	});
    	
    	var infoTopPosition = jQuery('#info').offset().top;
    	$(".edit").livequery("click",function(){
    		var id = $(this).closest("tr").find("input[name=id]").val();
    		var suggesTxt = $(this).html();
    		$("#sugges_tr,.btn_save").fadeIn();
    		$('#suggestion').html(suggesTxt);
    		$('input[name=idEdit]').val(id);
    		$('.ui-widget').fadeIn();
    		$('html, body').animate({scrollTop:infoTopPosition}, 'slow');
    	});
    	
    	$(".btn_delete").livequery("click",function(){
			var answer = confirm("ยืนยันการลบข้อมูล")
		    if (answer){
		        var id = $(this).prev("input[name=id]").val();
		        var budgetyear = $("select[name=budgetyear]").val();
	    		var divisionid = $("select[name=divisionid]").val();
	    		var provincearea_id = $("select[name=provincearea_id]").val();
	    		var provinceid = $("select[name=provinceid]").val();
	    		$.post('inspect_inspector_recomm/suggestion_delete_ajax',{
	    			'id':id,
	    			'budgetyear':budgetyear,
	    			'divisionid':divisionid,
	    			'provincearea_id':provincearea_id,
	    			'provinceid':provinceid
    			},function(data){
    				$("#suggesTb").html(data);
    				$('#suggestion').html("");
    				$(".ui-widget").fadeOut();
	    			$("input[name=idEdit]").val("");
	    			$('.loading').remove();
    			});
		    }
    	});
    	
    	$(".btn_add").livequery("click",function(){
    		$("#sugges_tr,.btn_save").fadeToggle();
    	});
    });
</script>
<h3>บันทึก ข้อเสนอแนะผู้ตรวจ (เพิ่ม / แก้ไข)</h3>
<h5>รายละเอียดข้อมูลเงินงบประมาณระหว่างปี</h5>
<input class="btn_add" type="button" value="" style="float: right; margin: 0 0 10px 0; <?php echo ($_GET)?"":"display: none;";?>">
<table class="tbadd">
	<tr>
		<th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
		<td>
			<select name="budgetyear" id="budgetyear">
	            <option value="">-- เลือกปีงบประมาณ --</option>
	            <?php foreach($byear as $item){
			    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
			    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
			    }
			    ?>
			</select>
		</td>
		<tr>
			<th>หน่วยงาน<span class="Txt_red_12"> *</span></th>
			<td>
            <?php echo @form_dropdown('divisionid',get_option("id","title","cnf_division where departmentid = 4 or id = 105"),@$_GET['divisionid'],'','-- เลือกหน่วยงาน --','0');  ?>
            <span class="loadingicon"></span>
            </td>
		</tr>
		<tr class="p_area">
			<th>เขตจังหวัด</th>
			<td>
			<?php if(login_data('insp_access_all') == 'on'):?>
            <?php echo @form_dropdown('provincearea_id',get_option("id","title","cnf_province_area"),@$_GET['provincearea_id'],'','-- เลือกเขตจังหวัด --','0');  ?> <span class="loadingicon"></span>
            <?php else:?>
			    <?php echo @form_dropdown("provincearea_id",get_option('id','title',"CNF_PROVINCE_AREA
where id in (select province_area from insp_group where users_id = ".login_data("id").")"),@$_GET['provincearea_id'],'',"-- เลือกเขต --",'0');
				?>
            <?php endif;?>
            </td>
		</tr>
		<tr>
			<th>จังหวัด</th>
			<td id="dvProvinceID">
            <?php echo @form_dropdown('provinceid',get_option("id","title","cnf_province where area = ".@$_GET['provincearea_id']),@$_GET['provinceid'],'','-- เลือกจังหวัด --','0');  ?>  <span class="loadingicon"></span>
            </td>
		</tr>
		<tr id='sugges_tr' style="display: none;">
			<th>ข้อเสนอแนะ</th>
			<td id="info">
				<div class="ui-widget" style="display:none;"><div class="ui-state-highlight ui-corner-all" style="margin: 5px 0; padding: 0 .7em;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>สถานะ!</strong> แก้ไขข้อเสนอแนะ</p></div></div>
				<textarea id="suggestion" class="tinymce" name="suggestion" rows="8" cols="40"></textarea>
			</td>
		</tr>
		<tr>
			<th></th>
			<td>
				<input type='hidden' name='idEdit' value=''>
				<input class="btn_save" type="button" name="input" title="บันทึก" value="" style="display:none;">
				<span class="loadingicon2"></span>
			</td>
		</tr>
</table>

<br>
<h3>ข้อเสนอแนะผู้ตรวจ</h3>
<div id="suggesTb">
<table class="tblist2">
	<tr>
		<th>ลำดับที่</th>
		<th>ข้อเสนอแนะ(ผู้ตรวจราชการ)</th>
		<th>ผลการดำเนินงาน</th>
		<th></th>
	</tr>
	<?php if($_GET):?>
	<?php foreach(@$recomm as $key=>$row):?>
		<tr <?=cycle($key)?>>
			<td width='60' align='center'><?=$key+1?></td>
			<td width='421' class='edit'><?=$row['suggestion']?></td>
			<td><?=$row['operationresult']?></td>
			<td width='30'><input type='hidden' name='id' value='<?=$row['id']?>'>
			<input type='button' class='btn_delete'></td>
		</tr>
	<?php endforeach;?>
	<?php endif;?>
</table>
</div>