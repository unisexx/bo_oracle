<script type="text/javascript">
$(document).ready(function(){
	
	$(".btn_add").click(function(){
		var title = $(this).closest(".tbadd").find("input[name=ptitle]").val();
		var risktype = $(this).closest(".tbadd").find("select[name=risktype] option:selected").val();
		var risktype_txt = $(this).closest(".tbadd").find("select[name=risktype] option:selected").text();
		
		if(title == ""){
			alert("กรุณากรอกหัวข้อ");
			$("input[name=ptitle]").focus();
			return false;
		}else if(risktype == 0){
			alert("กรุณาเลือกประเถทความเสี่ยง");
			return false;
		}
		
		$('.tblist2 tr:last').after("<tr><td class=risktitle>"+title+"<input id=title type=hidden value='"+title+"' name=title[]></td><td>"+risktype_txt+"<input type=hidden value='"+risktype+"' id=risktype name=risktype[]></td><td><input type=button class=btn_edit /><input type=button class=btn_delete /></td></tr>");
		//$('.tblist2').rowCount();
	});
	
	$(".btn_delete").livequery("click",function(){
		var answer = confirm("ยืนยันการลบข้อมูล");
		if(answer){
			$(this).closest("tr").fadeOut("normal",function(){$(this).remove();});
		}
	});
	
	$(".btn_edit").livequery("click",function(){
		$.fn.colorbox({width:"60%", inline:true, href:"#bg_source_form"});
		var rowNumber = $(this).closest("tr").find(".rowNumber").text();
		var title = $(this).closest("tr").find(".risktitle").text();
		var risktype = $(this).closest("tr").find("input[type=hidden][id=risktype]").val();
		
		$("#rowIndex").val($(this).closest("tr").index());
		$("#eTitle").val(title);
		$("#prisktype option[value="+risktype+"]").attr('selected', 'selected');
  		return false;
	});

	$(".save_record").livequery("click",function(){
		var rowindex = $("#rowIndex").val();
		var title = $("#eTitle").val();
		var risktype = $("#prisktype option:selected").val();
		var risktype_txt = $("#prisktype option:selected").text();

		var foundin = $(".tblist2 tr").eq(rowindex);
		foundin.html('<td class=risktitle>'+title+'<input id=title type=hidden value='+title+' name=title[]></td><td>'+risktype_txt+'<input type=hidden value='+risktype+' id=risktype name=risktype[]></td><td><input type=button class=btn_edit /><input type=button class=btn_delete /></td>');

		$.colorbox.close();
	});
	
})
</script>
<form name="fm" enctype="multipart/form-data" method="post" action="inspect_risk_subject/save<?=$url_parameter;?>">
<h3>ตั้งค่า หัวข้อความเสี่ยง (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
	<tr>
	  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td>
		<select name="budgetyear" id="budgetyear">
	    <option value="">-- เลือกปีงบประมาณ --</option>
	    <?php foreach($byear as $item){
	    	$selected = $budgetyear == $item['byear'] ? " selected=selected" :  "";
	    	echo '<option value="'.$item['byear'].'" '.$selected.'" >'.($item['byear']+543).'</option>';
	    }
	    ?>
	    </select>      
	</tr>
	<tr>
		<th>หัวข้อ<span class="Txt_red_12"> *</span></th>
		<td>
          	<input type="text" name="ptitle" size="75">
		</td>
        </tr>
	<tr>
		<th>กลุ่มความเสี่ยง</th>
		<td>
			<select name="risktype">
                <option value="">-- เลือกกลุ่มความเสี่ยง --</option>
              	<option value="1">Key Risk area</option>
				<option value="2">Political Risk</option>
				<option value="3">Negotiation Risk</option>
				<option value="4">Ohter (อื่นๆ)</option>
            </select>
		</td>
	</tr>
	<tr>
		<th></th>
		<td>
			<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add"/></div>
		</td>
	</tr>
</table>

<div style="padding:20px 0;"></div>
<h3>รายการหัวข้อความเสี่ยง</h3>

<table class="tblist2">
<tr>  
  <th>ชื่อหัวข้อความเสี่ยง</th>
  <th>ประเภท</th>
  <th>แก้ไข / ลบ</th>
  </tr>
<?	
	if(@$riskdetail){
		$newrow = '';
	foreach($riskdetail as $srow){		 
	$newrow.='<tr><td class="risktitle">'.$srow['title'].'<input type="hidden" name="id[]" id="id" value="'.$srow['id'].'"><input type=hidden name="title[]" id="title" value="'.$srow['title'].'"></td>';
	$newrow.='<td class="risktype">'.GetRiskTypeDetail($srow['risktype']).'<input type=hidden name="risktype[]" id="risktype" value='.$srow['risktype'].'></td>';			
	$newrow.='<td><input type="button" class="btn_edit" /><input type="button" class="btn_delete" /></td></tr>';
	 }
		echo $newrow;
	 } 
?>
</table>


<div id="btnBoxAdd">
  <?php if(permission('inspect_risk_subject', 'canedit')):?>
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" " onclick="window.location='inspect_risk_subject/'" class="btn_back"/>
</div>
</form>


<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>เขตจังหวัด (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
          <tr>
          <th>หัวข้อ<span class="Txt_red_12"> *</span></th>
          <td>
          	<input type="hidden" id="rowIndex" name="rowIndex" value="">
          	<input type="text" id="eTitle" name="eTitle" size="75">
          </td>
        </tr>
          <tr>
            <th>กลุ่มความเสี่ยง</th>
            <td>
            <select name="prisktype" id="prisktype">
                <!--<option value="">-- เลือกกลุ่มความเสี่ยง --</option>-->
              	<option value="1">Key Risk area</option>
				<option value="2">Political Risk</option>
				<option value="3">Negotiation Risk</option>
				<option value="4">Ohter (อื่นๆ)</option>
            </select>
            </td>
          </tr>
        </table>
        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save save_record"/></div>
		</div>
</div>