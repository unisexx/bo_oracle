<script type="text/javascript">
$(document).ready(function(){
    $("#meetreport").validate({
		rules: {
			headline:"required",
			session_h:"required"
		},
		messages:{
			headline:"ฟิลด์นี้ห้ามเป็นค่าว่าง",
			session_h:"ฟิลด์นี้ห้ามเป็นค่าว่าง"
		}
	});
});
</script>

<h3>บันทึก รายงานการประชุม (บันทึก / แก้ไข)</h3>

<form id="meetreport" method="post" action="act/meet_report/save" enctype="multipart/form-data">
<table class="tbadd">
  <tr>
    <th>เรื่องการประชุม <span class="Txt_red_12"> *</span></th>
    <td><input name="headline" type="text" value="<?php echo $meeting['headline']?>" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>วาระการประชุม <span class="Txt_red_12">*</span></th>
    <td><input name="session_h" type="text" value="<?php echo $meeting['session_h']?>" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>วันที่ประชุม</th>
    <td><input name="meeting_date" type="text" class="datepicker" value="<?php echo $meeting['meeting_date']?>" style="width:80px;"/>
      เวลา
      <input name="meeting_time" type="text" value="<?php echo $meeting['meeting_time']?>" style="width:50px;"/></td>
  </tr>
  <tr>
    <th>ครั้งที่</th>
    <td><input name="meeting_no" type="text" value="<?php echo $meeting['meeting_no']?>" style="width:30px;"/></td>
  </tr>
  <tr>
    <th>พ.ศ.</th>
    <td><input name="meeting_year" type="text" value="<?php echo $meeting['meeting_year']?>" style="width:50px;"/></td>
  </tr>
  <tr>
    <th>สถานที่</th>
    <td><input name="place" type="text" value="<?php echo $meeting['place']?>" style="width:400px;"/></td>
  </tr>
  <tr>
    <th>สรุปสาระสำคัญ</th>
    <td><textarea name="conclude" rows="3" style="width:500px;"><?php echo $meeting['conclude']?></textarea></td>
  </tr>
  <tr>
    <th>รายละเอียด</th>
    <td><textarea name="detail" rows="3" style="width:500px;"><?php echo $meeting['detail']?></textarea></td>
  </tr>
  <tr>
    <th>มติที่ประชุม</th>
    <td><textarea name="resolution" rows="3" style="width:500px;"><?php echo $meeting['resolution']?></textarea></td>
  </tr>
  <tr>
    <th>ผู้จดรายงานการประชุม</th>
    <td><input name="pwrite" type="text" value="<?php echo $meeting['pwrite']?>" style="width:200px;"/> 
      ตำแหน่ง 
      <input name="pwritep" type="text" value="<?php echo $meeting['pwritep']?>" style="width:250px;"/></td>
</tr>
<tr>
  <th>ผู้ตรวจรายงานการประชุม</th>
  <td><input name="pvaridate" type="text" value="<?php echo $meeting['pvaridate']?>" style="width:200px;"/>
ตำแหน่ง
  <input name="pvaridatep" type="text" value="<?php echo $meeting['pvaridatep']?>" style="width:250px;"/></td>
</tr>
<tr>
  <th>ไฟล์เอกสาร</th>
  <td>
  	<input type="file" name="UploadFile" />
  	<?php if($meeting['file_data']):?>
  		<a href="uploads/act/meet_report/<?php echo $meeting['file_data']?>"><?php echo $meeting['file_data']?></a>
  		<input type="hidden" name="hdfilename" value="<?php echo $meeting['file_data']?>">
  	<?php endif;?>
  </td>
</tr>
</table>

<div id="btnBoxAdd">
  <input type="hidden" name="id" value="<?php echo $meeting['id']?>"/>
  <input type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>

