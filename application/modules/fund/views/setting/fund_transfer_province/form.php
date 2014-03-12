<h3>ตั้งค่า ชื่อกองทุน   (บันทึก / แก้ไข)</h3>
<?php echo form_open('fund/setting/fund_transfer_province/save'); ?>
<table class="tbadd">
<tbody>
	<tr>
	  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
	  <td><?php echo form_dropdown('budget_year', get_year_option(2540, 1), $rs['budget_year'], null, '-- ปีงบประมาณ --'); ?></td>
	</tr>
	<tr>
	  <th>จังหวัด <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('province_id', get_option('id', 'title', 'cnf_province'), $rs['province_id'], null, '-- เลือกจังหวัด --'); ?></td>
	</tr>
	<tr>
	  <th>กองทุน <span class="Txt_red_12">*</span></th>
	  <td><?php echo form_dropdown('fund_id', get_option('id', 'fund_name', 'fund_mst_fund_name'), $rs['fund_id'], null, '-- เลือกกองทุน --'); ?></td>
	</tr>
	<tr>
	  <th>งบประมาณ</th>
	  <td><?php echo form_input('transfer_amount', $rs['transfer_amount']); ?> บาท</td>
	</tr>
</tbody>
</table>

<div id="btnBoxAdd">
  <input type="submit" value="" class="btn_save"/>
  <input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>
<?php echo form_hidden('id', $rs['id']); ?>
<?php echo form_close(); ?>