<?php 
	$month_array = array('01'=>'มกราคม', '02'=>'กุมภาพันธ์', '03'=>'มีนาคม', '04'=>'เมษายน', '05'=>'พฤษภาคม', '06'=>'มิถุนายน', '07'=>'กรกฏาคม', '08'=>'สิงหาคม', '09'=>'กันยายน', '10'=>'ตุลาคม', '11'=>'พฤศจิกายน', '12'=>'ธันวาคม'); 
?>
<link rel='stylesheet' type='text/css' href='css/report.css'>
<h3>สรุปผลการเบิกจ่าย เงินสงเคราะห์ รายบุคคล (คคด.04) (บ)</h3>
<form action='' method='get' id="search">
<div id="search">
<div id="searchBox">
  <?php echo form_dropdown("province_id",get_option("ID","TITLE","FUND_PROVINCE",NULL,"TITLE"),@$_GET["province_id"],"id=\"province_id\"","-- เลือกหน่วยงาน --",null)?>
  <?php echo form_dropdown('fund_year', get_year_option('2556'), @$_GET['fund_year'], '', '-- ระบุปีงบประมาณ --'); ?>
  <?php echo form_dropdown('fund_month',$month_array , @$_GET['fund_month'], '', '-- เลือกเดือน --'); ?>
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<?php 
if(@$_GET['fund_year'] != '' && @$_GET['fund_month'] != '' && @$_GET['province_id'] != '') {
	if (count($rs) > 0 ) {
?>
<div id="report">

 <div style="float:right; font-size:20px;">แบบรายงาน คคด.04 (บ)</div><div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">สรุปผลการเบิกจ่ายเงินสงเคราะห์รายบุคคล (กองทุนคุ้มครองเด็ก)<br>หน่วยงาน <?php echo $provine_name; ?><br />
ประจำเดือน <?php echo $month_array[@$_GET['fund_month']]; ?> ปีงบประมาณ <?php echo @$_GET['fund_year']; ?><br> </div>วัน/เดือน/ปี ที่พิมพ์ : 
    <div style="clear:both;"></div><br>
  <div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : บาท</div>
    <table class="tbReport">
  <tr>
    <th width="73" rowspan="2" align="center"><strong>ลำดับที่</strong></th>
    <th colspan="2" align="center"><strong>วัน/เดือน/ปี</strong></th>
    <th width="270" rowspan="2" align="center"><strong>ชื่อ - สกุลเด็ก</strong></th>
    <th colspan="2" align="center"><strong>ชื่อผู้รับเงิน</strong></th>
    <th colspan="2" align="center"><strong>การเบิกจ่ายเงิน</strong></th>
    </tr>
  <tr>
  	<th width="87" align="center"><strong>รับเรื่อง</strong></th>
    <th width="92" align="center"><strong>อนุมัติ</strong></th>
    <th width="240" align="center"><strong>ชื่อ - สกุล</strong></th>
    <th width="240" align="center"><strong>ที่อยู่</strong></th>
    <th width="96" align="center"><strong>จำนวนเงิน</strong></th>
    <th width="85" align="center"><strong>วันที่จ่ายเงิน</strong></th>
  </tr>
  <?php 
  		$sum_fund_cost = '0';
  		foreach ($rs as $key => $item) {
  			$sum_fund_cost += $item['fund_cost']; 
  ?>
		  <tr>
		    <td class='text-center pattern-a'><?php echo $key+1; ?></td>
		    <td class='text-center pattern-a'><?php echo db2date($item['date_request']); ?></td>
		    <td class='text-center pattern-a'><?php echo db2date($item['meeting_date']); ?></td>
		    <td class="pattern-a"><?php echo $item['fund_child_name'] ?></td>
		    <td class="pattern-a"><?php echo $item['presonal_name'] ?></td>
		    <td class="pattern-a">
		    	<?php
		    		echo "เลขที่ ".$item['addr_number']." ";
					echo "หมู่ที่ ".$item['addr_moo']." ";
					echo "ตรอก ".$item['addr_trok']." ";
					echo "ซอย ".$item['addr_soi']." ";
					echo "ถนน  ".$item['addr_road']." ";
					echo "<br />";
					echo "ตำบล  ".$item['district_name']." ";
					echo "อำเภท  ".$item['amphur_name']." ";
					echo "จังหวัด  ".$item['province_name']." ";
		    	?>
		    </td>
		    <td class='text-center pattern-a'><?php echo number_format($item['fund_cost'],2); ?></td>
		    <td class='text-center pattern-a'><?php echo db2date($item['date_payment']); ?></td>
		  </tr>
  <?php } ?>  
      <tr>
        <td colspan="3" align="center"><strong>รวม</strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td class='text-center'><?php echo number_format($sum_fund_cost,2); ?></td>
        <td>&nbsp;</td>
      </tr>
</table>


</div></div><!--page-->
<?php 
	} else { echo "<div align='center'>ไม่พบข้อมูล</div>"; }
} else { echo "<div align='center'>กรุณาเลือก ปีงบประมาณ และ เดือน</div>"; } ?>