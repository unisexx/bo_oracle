<h3>รายงานหัวข้อ : Project Review (<?php echo $projectname;?>)</h3><br>

<table class="tblist3">
<tr class="odd">
  <th>ผลการดำเนินงาน<br />ตามแผนในแต่ละรอบ<br />(หน่วยรับตรวจรายงานผล)<br />(A)</th>
  <th>ประเภทความเสี่ยงที่พบ<br />(หน่วยรับตรวจสอบ)<br />(B)</th>
  <th>ประเภทความเสี่ยงจาการตรวจของ<br />ผู้ตรวจราชการกระทรวง<br />(C)</th>
</tr>
<tr class="topic">
  <td><strong>(A1) รอบ <?php echo $roundno?> </strong></td>
  <td><strong>( B1 ) Key Risk area</strong></td>
  <td><strong>( C1 ) Key Risk area</strong></td>
</tr>
<?php echo $keyRiskDataList;?>
<tr class="topic">
  <td>&nbsp;</td>
  <td><strong>( B2 ) Political Risk</strong></td>
  <td><strong>( C2 ) Political Risk</strong></td>
</tr>
<?php echo $politicalRiskDataList;?>
<tr class="topic">
  <td>&nbsp;</td>
  <td><strong>( B3 ) Negotiation Risk</strong></td>
  <td><strong>( C3 ) Negotiation Risk</strong></td>
</tr>
<?php echo $negotiationRiskDataList;?>
<tr class="topic">
  <td>&nbsp;</td>
  <td><strong>( B4 ) Ohter (อื่นๆ)</strong></td>
  <td><strong>( C4 ) Ohter (อื่นๆ)</strong></td>
</tr>
<?php echo $otherRiskDataList;?>
</table>