<link rel='stylesheet' type='text/css' href='css/report.css'>

<h3>การจัดสรรเงิน สงเคราะห์รายบุคคล (คคด.02) (บ)</h3>
<form id="search" action = '' method = 'get'>
	<div id="searchBox">
		<?
			//select year_budget from FUND_REQUEST_SUPPORT group by year_budget order by YEAR_BUDGET desc
			echo form_dropdown('year_budget', get_option('year_budget as a', 'year_budget as b', 'fund_request_support group by year_budget order by year_budget desc'), $_GET['year_budget'], '', '--ระบุปีงบประมาณ--');
		?>
		<input type="submit" title="ค้นหา" value=" " class="btn_search" />
	</div>
</form>

<div id="report">

	<div style="float:right; font-size:20px;">แบบรายงาน คคด.02 (บ)</div><div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">รายงานการจัดสรรเงินสงเคราะห์รายบุคคล<br>กองทุนคุ้มครองเด็ก<br>ปีงบประมาณ <? echo $_GET['year_budget']; ?></div>
    <div style="clear:both;"></div><br>
	<div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : บาท</div>
    
    <table class="tbReport">
		<tr>
			<th align="center" style='width:100px;'><strong>ลำดับที่</strong></th>
			<th align="center"><strong>จังหวัด</strong></th>
			<th align="center"><strong>เงินคงเหลือยกมาจากปีก่อน (1)</strong></th>
			<th align="center"><strong>จำนวนเงินที่ได้รับจัดสรร (2)</strong></th>
			<th align="center"><strong>รวม (1)+ (2)</strong></th>
		</tr>
		<?
			if(empty($rs)) {
				?>
				<tr>
					<td colspan='5' class='text-center'>ไม่พบข้อมูลการจัดสรรเงินสงเคราะห์รายบุคคล</td>
				</tr>
				<?
			} else { 
				$cost_total = $no = 0; 
				foreach($rs as $item) { 
					$no++; 
					$cost_sum = $item['cost_2'];
					$cost_total += $cost_sum;
					?>
			 		<tr>
			 			<td class='text-center'><? echo $no; ?></td>
			 			<td><? echo $item['province_title']; ?></td>
			 			<td class='text-right'>0</td>
			 			<td class='text-right'><? echo number_format(($item['cost_2']*1)); ?></td>
			 			<td class='text-right'><? echo number_format(($cost_sum*1)); ?></td>
			 		</tr>
				<? } 
			?>
			<tr>
				<td colspan="4" align="center"><strong>รวมทั้งประเทศ</strong></td>
				<td class='text-right'><? echo number_format(($cost_total*1)); ?></td>
			</tr>
		<? } ?>
	</table>
<br>
หมายเหตุ : วัตถุประสงค์ของตารางนี้<br>
1. ให้ กบท.พิมพ์สรุปเสนอ คคก. / ปพม. เลือกถามในภาพรวมในตอนต้นปีงบประมาณ<br>
2. ให้ กบท.เวียนแจ้ง พมจ. / กทม. ทราบตั้งแต่ต้นปีงบประมาณว่าในปีงบประมาณนั้นจะมีเงินใช้จ่ายเท่าไหร่<br>	


</div></div><!--page-->
