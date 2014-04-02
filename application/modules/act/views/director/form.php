<script type="text/javascript">
$(document).ready(function(){
	$.get('act/director/ajax_subcommittee_edit',{
		committee_id : $("input[name=committee_id]").val()
	},function(data){
		$("#subcommittee_form").html(data);
	});
    
	$(".example8").colorbox({width:"50%", inline:true, href:"#inline_example1"});
    
    $(".btn_add,.btn_edit").click(function(){
    	$.get('act/director/ajax_subcommittee_edit',{
    		id : $(this).prev('input[name=subcommittee_id]').val(),
    		committee_id : $("input[name=committee_id]").val()
    	},function(data){
    		$("#subcommittee_form").html(data);
    	});
    });
    
    $("#director").validate({
		rules: {
			committee_type:"required",
			province_code:"required",
			order_no:"required",
			order_date:"required",
			status:"required"
		},
		messages:{
			committee_type:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			province_code:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			order_no:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			order_date:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			status:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
	
});
</script>

<?php
	$subtype_arr = array(
		'1'=>'ส่วนราชการ',
		'2'=>'ผู้แทนองค์กรสาธารณประโยชน์',
		'3'=>'ผู้แทนองค์กรปกครองส่วนท้องถิ่น',
		'4'=>'ผู้แทนองค์กรสวัสดิการชุมชน',
		'5'=>'ผู้ทรงคุณวุฒิ',
	);
?>

<h3>บันทึก คณะกรรมการ (บันทึก / แก้ไข)</h3>

<form id="director" method="post" action="act/director/save">
<table class="tbadd">
  <tr>
    <th>คณะกรรมการ<span class="Txt_red_12"> *</span></th>
    <td><select name="committee_type">
      <option value="">-- เลือกประเภทคณะกรรมการ --</option>
      <option value="1" <?php echo ($main['committee_type'] == 1)?"selected=selected":"";?>>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมแห่งชาติ</option>
      <option value="2" <?php echo ($main['committee_type'] == 2)?"selected=selected":"";?>>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมจังหวัด</option>
      <option value="3" <?php echo ($main['committee_type'] == 3)?"selected=selected":"";?>>คณะกรรมการส่งเสริมการจัดสวัสดิการสังคมกรุงเทพมหานคร</option>
      <option value="4" <?php echo ($main['committee_type'] == 4)?"selected=selected":"";?>>คณะกรรมการบริหารกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
      <option value="5" <?php echo ($main['committee_type'] == 5)?"selected=selected":"";?>>คณะกรรมการติดตามและประเมินผลการดำเนินงานของกองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
    </select></td>
  </tr>
  <tr>
    <th>จังหวัด<span class="Txt_red_12"> *</span></th>
    <td>
    	<?php echo form_dropdown('province_code', get_option('province_code', 'province_name', 'act_province', '1=1 order by province_name asc'), @$main['province_code'], '', '- เลือกจังหวัด -'); ?>
    </td>
  </tr>
  <tr>
    <th>แต่งตั้งตามคำสั่งที่ <span class="Txt_red_12"> *</span></th>
    <td><input name="order_no" type="text" value="<?php echo $main['order_no']?>" style="width:200px;"/></td>
  </tr>
  <tr>
    <th>ลงวันที่<span class="Txt_red_12"> *</span></th>
    <td><input class="datepicker" name="order_date" type="text" value="<?php echo $main['order_date']?>" style="width:80px;"/></td>
  </tr>
  <tr>
    <th>สถานะ<span class="Txt_red_12"> *</span></th>
    <td>
    	<span><input type="radio" name="status" value="1" <?php echo ($main['status'] == 1)?'checked=chedked':'';?> /> ยังเป็นคณะกรรมการอยู่</span> 
    	<span><input type="radio" name="status" value="2" <?php echo ($main['status'] == 2)?'checked=chedked':'';?>/> ไม่ได้เป็นคณะกรรมการแล้ว</span>
    </td>
  </tr>
</table>

<div id="btnBoxAdd">
  <input type="hidden" name="committee_id" value="<?php echo $main['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="document.location='act/director/index'" class="btn_back"/>
</div>
</form>


<?php if($this->uri->segment(4) != ""):?>
<h3>รายชื่อคณะกรรมการ</h3>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add example8"/></div>
<table class="tblist">
<tr>
  <th>ลำดับ</th>
<th>ชื่อคณะกรรมการ</th>
<th>ที่อยู่</th>
<th>โทรศัพท์</th>
<th>แฟกซ์</th>
<th>อีเมล์</th>
<th>ประเภทกรรมการ</th>
<th>ตำแหน่งในคณะกรรมการ</th>
<th>ตำแหน่งหน้าที่การงาน</th>
<th>จัดการ</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($subs as $row):?>
<tr>
	<td><?php echo $i?></td>
	<td><?php echo act_get_title($row['title_id']).$row['fname'].' '.$row['lname']?></td>
	<td>
	  	<?php echo ($row['home_no'])?$row['home_no']:"";?>
	  	<?php echo ($row['moo'])?"&nbsp;หมู่ที่ ".$row['moo']:"";?>
	  	<?php echo ($row['soi'])?"&nbsp;ซ. ".$row['soi']:"";?>
	  	<?php echo ($row['road'])?"&nbsp;ถ. ".$row['road']:"";?>
	  	<?php echo ($row['tumbon_code'])?" &nbsp;ต. ".act_get_tumbon($row['province_code'],$row['ampor_code'],$row['tumbon_code']):"";?>
	  	<?php echo ($row['ampor_code'])?" &nbsp;อ. ".act_get_ampor($row['province_code'],$row['ampor_code']):"";?>
	  	<?php echo ($row['province_code'])?" &nbsp;จ. ".act_get_province($row['province_code']):"";?>
	  	<?php echo ($row['post_code'])?'&nbsp;'.$row['post_code']:"";?>
	</td>
	<td><?php echo $row['tel']?></td>
	<td><?php echo $row['fax']?></td>
	<td><?php echo $row['email']?></td>
	<td><?php echo $subtype_arr[$row['sub_type_id']]?></td>
	<td><?php echo act_get_position($row['position_id'])?></td>
	<td><?php echo $row['position']?></td>
	<td nowrap="nowrap">
		<input type="hidden" name="subcommittee_id" value="<?php echo $row['id']?>">
		<input type="submit" name="button3" id="button3" title="แก้ไข" value=" " class="btn_edit vtip example8" />
	    <a href="act/director/subcommittee_delete/<?php echo $row['id']?>" onclick="return confirm('<?php echo NOTICE_CONFIRM_DELETE?>')"><input type="submit" name="button" id="button" value="x" class="btn_delete" /></a></td>
</tr>
<?$i++;?>
<?php endforeach;?>
</table>
<?php endif;?>


<!-- This contains the hidden content for inline calls -->
<div style="display:none">
<div id="inline_example1" style="padding:10px; background:#fff;">
<div id="subcommittee_form">

</div>
</div>
</div>