<h5>ผูกพัน/โอนจัดสรรงบประมาณจาก</h5>
<input type="hidden" name="fn_cost_related_id" value="<?php echo @$cost['id'];?>">
<table class="tbadd">
<tr>
  <th>ปีงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td class="td_cost_budgetyear">
  	<?php echo (@$budgetyear+543);?>  	
    </td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ<span class="Txt_red_12"> *</span></th>
  <td id="cbgpt"><?php echo @$budgetplantype['title'];?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td id="cbgyt"><?php echo @$budgetyeartype['title'];?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td id="cdept_id"><?php echo @$department['title'];?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td id="cdiv_id"><?php echo @$division['title'];?></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td id="cworkgroup_id"><?=@$workgroup['title'];?></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td id="cplan_id"><?php echo @$plan['title'];?></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td id="cproductivity_id">
  	<?php echo @$productivity['title'];?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td id="cmainact"><?php echo @$mainact['title'];?></td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td id="csubact"><?=@$subact['title'];?></td>
</tr>
<tr>
  <th>โครงการ</th>
  <td id="cproject"><?=@$project['projecttitle'];?></td>
</tr>
</table>