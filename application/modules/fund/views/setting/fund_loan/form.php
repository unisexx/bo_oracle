<h3>ตั้งค่า ประเภทเงินทุนให้กู้   (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_loan/save'); ?>
<table class="tbadd">
<tr>
  <th>ชื่อประเภทเงินทุนให้กู้<span class="Txt_red_12"> *</span></th>
  <td><input name="fund_name" type="text"  style="width:500px;" value="<?php echo $rs['fund_name']; ?>" /></td>
</tr>
</table>


<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
<?php echo form_close(); ?>