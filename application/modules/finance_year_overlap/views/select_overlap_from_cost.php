<table class="tbadd">
<tr>
  <th>เลขที่หนังสืออนุมัติหลักการ<span class="Txt_red_12">*</span></th>
  <td id="td_budget_related">
  	  <span><?=@$cost['budget_related_book_id'];?></span> <? if(@$cost['budget_related_book_date']>0)echo stamp_to_th($cost['budget_related_book_date']);?>
  </td>
</tr>
<tr>
	<th>เลขที่หนังสืออนุมัติค่าใช้จ่าย</th>
	<td>
		<input type="hidden" name="id" value="<?=$id;?>">
		<input type="hidden" name="fn_cost_related_id" value="<?=@$cost['id'];?>">
		<input type="text" name="cost_no" id="cost_no" size="40" value="<?=@$cost['book_cost_id'];?>"><input type="button" name="btncostshow" id="btncostshow" value="แสดงข้อมูลผูกพันค่าใช้จ่าย">
	</td>
</tr>
<tr>
	<th>เลขที่ส่วนการคลังรับ</th>
	<td id="td_finance_id"></td>
</tr>
<tr>
	<th>เลขที่สำรองเงินกัน</th>
	<td>
		<span><input type="text" name="reserve_no" id="reserve_no" value="<?=@$data['reserve_no'];?>"></span>
		ลงวันที่ <input type="text" name="reserve_date" id="reserve_date" value="<? if(@$data['reserve_date']>0)echo stamp_to_th($data['reserve_date']);?>" class="datepicker">
	</td>
</tr>
<tr>
  <th>ประเภทเงินกัน</th>
  <td>
  	    <select name="reserve_type">
  	    	<option value="0"></option>
  	    	<option value="1" <? if(@$rs['reserve_type']==1)echo "selected";?>>ประเภทที่ 1</option>
  	    	<option value="2" <? if(@$rs['reserve_type']==2)echo "selected";?>>ประเภทที่ 2</option>
  	    </select>
  </td>
</tr>
<tr>
  <th>ปีงบประมาณ</th>
  <td>
  	<?php echo @$budgetyear;?>
    </td>
</tr>
<tr>
  <th>ช่วงแผนงบประมาณ</th>
  <td id="rbgpt"><?php echo @$budgetplantype['title'];?></td>
</tr>
<tr>
  <th>ประเภทงบประมาณ </th>
  <td id="rbgyt"><?php echo @$budgetyeartype['title'];?></td>
</tr>
<tr>
  <th>กรมที่รับผิดชอบ</th>
  <td id="rdept_id"><?php echo @$department['title'];?></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td id="rdiv_id"><?php echo @$division['title'];?></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td id="rworkgroup_id"><?=@$workgroup['title'];?></td>
</tr>
<tr>
  <th>แผนงาน (แผนงบประมาณ)</th>
  <td id="rplan_id"><?php echo @$plan['title'];?></td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td id="rproductivity_id">
  	<?php echo @$productivity['title'];?>
  </td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td id="rmainact"><?php echo @$mainact['title'];?></td>
</tr>
<tr>
  <th>กิจกรรมย่อย</th>
  <td id="rsubact"><?=@$subact['title'];?></td>
</tr>
<tr>
  <th>โครงการ</th>
  <td id="project"><?=@$project['projecttitle'];?></td>
</tr>
</table>
</div>

<div style="padding:20px 0;"></div>
<h3>รายละเอียดเงินงบประมาณ</h3>
<table class="tblist2" style="margin-top:10px;">
<tr>  	
  <th style="border:1px solid #ccc; text-align:center;">หมวดงบประมาณ</th>
  <th style="border:1px solid #ccc; text-align:center;">หมวดค่าใช้จ่าย</th>  
  <th style="border:1px solid #ccc; text-align:right">เงินงบประมาณ</th>
</tr>
<?
  echo $data_list;
?>
</table>