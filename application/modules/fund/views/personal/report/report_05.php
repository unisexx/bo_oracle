<link rel='stylesheet' type='text/css' href='css/report.css'>

<h3>สรุปการเบิกจ่ายเงิน สงเคราะห์รายบุคคล (คคด.05) (บ)</h3>
<form id="search" action='' method='get'>
	<div id="searchBox">
		<? echo form_dropdown('year_budget', get_option('year_budget a', 'year_budget b', 'fund_request_support group by year_budget'), @$_GET['year_budget'], '', '--ระบุปีงบประมาณ--'); ?>
		<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
	</div>
</form>

<div id="report">

 <div style="float:right; font-size:20px;">แบบรายงาน คคด.05(บ)</div><div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">รายงานสรุปการเบิกจ่ายเงินสงเคราะห์รายบุคคล (กองทุนคุ้มครองเด็ก)<br>ปีงบประมาณ  พ.ศ. <? echo (empty($_GET['year_budget']))?'..............':$_GET['year_budget']; ?></div>
    <div style="clear:both;"></div><br>
  <div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : บาท</div>
    <table class="tbReport">
  <tr>
    <th width="56" rowspan="2" align="center"><strong>ลำดับที่</strong></th>
    <th width="106" rowspan="2" align="center"><strong>จังหวัด</strong></th>
    <th colspan="2" align="center"><strong>เงินสงเคราะห์ (รายบุคคล)</strong></th>
    <th width="66" rowspan="2" align="center"><strong>รวม <br />
      <br />
    (1)</strong></th>
    <th colspan="2" align="center"><strong>ผลการอนุมัติ</strong></th>
    <th width="180" rowspan="2" align="center" valign="top"><strong>ผลการเบิกจ่ายจริง (บาท)<br />
      <br>(3)</strong></th>
    <th width="180" rowspan="2" valign="top"><strong>ยอดเงินคงเหลือ<br />
      <br>(1) - (3)</strong></th>
    <th width="176" rowspan="2" valign="top"><strong>ยอดเงินที่สามารถอนุมัติได้<br>
      <br />
      (1) - (2)</strong></th>
    </tr>
  <tr>
  	<th width="110" align="center"><strong>เงินคงเหลือ<br>ยกมาจากปีก่อน</strong></th>
    <th width="114" align="center"><strong>เงินที่ได้รับจัดสรร</strong></th>
    <th width="99" align="center" valign="top"><strong>จำนวน (ราย)</strong></th>
    <th width="113" align="center"><strong>จำนวนเงิน (บาท)<br>
      (2)</strong></th>
    </tr>
	<?
	
	if(empty($rs)) {
		echo '<tr><td colspan="10" class="text-center">ไม่พบข้อมูล</td></tr>';
		return false;
	}
	$no = 0 ; 
	$sum = array(
		'subvention_carry'=>0,
		'subvention_present'=>0,
		'subvention_total'=>0,
		'approve_count'=>0,
		'approve_amount'=>0,
		'actual_cost'=>0,
		'balance'=>0,
		'can_b_approve'=>0,
	);
	foreach($rs as $item) { 
		$no++; 
		
		$sum['subvention_carry'] += $item['subvention_carry'] = 0; //??? เงินสงเคราะห์ยกยอด
		$sum['subvention_present'] += $item['subvention_present'] = (empty($item['subvention_present']))?0:$item['subvention_present']; //เงินสงเคราะห์ปัจจุบัน
		$sum['subvention_total'] += $item['subvention_total'] = ($item['subvention_carry']+$item['subvention_present']); //เงินสงเคราะห์ "รวม"
		
		$sum['approve_count'] += $item['approve_count'] = (empty($item['approve_count']))?0:$item['approve_count']; //จำนวนที่ได้รับการอนุมัติ
		$sum['approve_amount'] += $item['approve_amount'] = (empty($item['approve_amount']))?0:$item['approve_amount']; // มูลค่าที่ได้รับการอนุมัติ
		
		$sum['actual_cost'] += $item['actual_cost'] = (empty($item['actual_cost']))?0:$item['actual_cost']; // ผลการเบิกจ่ายจริง
		$sum['balance'] += $item['balance'] = ($item['subvention_total']-$item['actual_cost']); //ยอดคงเหลือ
		$sum['can_b_approve'] += $item['can_b_approve'] = ($item['subvention_total']-$item['approve_amount']); //ยอดที่สามารถอนุมัติได้  
		?> 
		<tr>
			<td class='text-center'><? echo $no; ?></td>
			<td><? echo $item['province_title']; ?></td>
			<td class='text-right'><? echo number_format($item['subvention_carry']); ?></td>
			<td class='text-right'><? echo number_format($item['subvention_present']); ?></td>
			<td class='text-right'><? echo number_format($item['subvention_total']); ?> </td>
			<td class='text-center'><? echo number_format($item['approve_count']); ?></td>
			<td class='text-right'><? echo number_format($item['approve_amount']); ?></td>
			<td class='text-right'><? echo number_format($item['actual_cost']);?></td>
			<td class='text-right'><? echo number_format($item['balance']); ?></td>
			<td class='text-right'><? echo number_format($item['can_b_approve']); ?></td>
		</tr>
	<? } ?>

      <tr>
        <td colspan="2" align="center" ><strong>รวม</strong></td>
        <td class='text-right'><? echo number_format($sum['subvention_carry']); ?></td>
		<td class='text-right'><? echo number_format($sum['subvention_present']); ?></td>
		<td class='text-right'><? echo number_format($sum['subvention_total']); ?> </td>
		<td class='text-center'><? echo number_format($sum['approve_count']); ?></td>
		<td class='text-right'><? echo number_format($sum['approve_amount']); ?></td>
		<td class='text-right'><? echo number_format($sum['actual_cost']);?></td>
		<td class='text-right'><? echo number_format($sum['balance']); ?></td>
		<td class='text-right'><? echo number_format($sum['can_b_approve']); ?></td>
      </tr>
      <tr>
        <td colspan="2" align="center"><strong>คิดเป็นร้อยละ</strong></td>
        <td class="pattern-a">&nbsp;</td>
        <td class="pattern-a">&nbsp;</td>
        <td class="pattern-a">&nbsp;</td>
        <td class="pattern-a">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class="pattern-a">&nbsp;</td>
        <td class="pattern-a">&nbsp;</td>
      </tr>
  </table>


</div></div><!--page-->
