<h3>ตั้งค่า ชื่อกองทุน   (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_name/save'); ?>
<table class="tbadd">
<tr>
  <th>ชื่อกองทุน<span class="Txt_red_12"> *</span></th>
  <td><input name="fund_name" type="text"  style="width:500px;" value="<?php echo $rs['fund_name']; ?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input type="submit" value="" class="btn_save"/>
  <input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>
<?php echo form_hidden('id', $rs['id']); ?>
<?php echo form_close(); ?>