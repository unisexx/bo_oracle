<script language='javascript'>
	$(function(){
		$('#search').submit(function(){
			for(i=0; i<$('.s_input').length; i++) { // วน for หา input, select ของขอบเขตข้อมูลการค้นหารายงาน
				if($('.s_input').eq(i).val() == '') {
					alert('กรุณาระบุข้อมูลเขตของรายงานให้ครบถ้วน');
					
					$('.s_input').eq(i).focus();
					
					i = $('.s_input').length; // ทำให้ i เท่ากับ $('.s_input').length; โดยโปรแกรมจะได้ไม่ต้องไปวน for ต่ออีก (เพราะได้ focus ตัวที่ไม่มีค่าไปแล้ว)
					
					return false; // หยุดการทำงานของ submit เพื่อให้ผู้ใช้งานเลือกขอบเขตการค้นหาก่อน
				}
			} //end : for(i=0; i<$('.s_input').length; i++)
		});
	});
</script>

<link rel='stylesheet' type='text/css' href='css/report.css'>
<style type='text/css'>
	#search input, #search select {
		margin-left:5px;
	}
</style>

<h3>สรุปผลการพิจารณา อนุมัติเงินสงเคราะห์ รายบุคคล (คคด.03) (บ)</h3>
<form id="search">
	<div id="searchBox">
		<? 
			echo form_dropdown(
					'sch_province', 
					get_option('ID', 'TITLE', 'fund_province order by title asc'), 
					@$_GET['sch_province'], 
					'class="s_input"', 
					'-- เลือกหน่วยงาน (จังหวัด) --'
				); 
			
			echo form_dropdown(
					'sch_year', 
					get_option('year_budget as a', 'year_budget as b', 'fund_request_support group by year_budget order by year_budget desc'), 
					@$_GET['sch_year'], 
					'class="s_input"',
					'-- ระบุปีงบประมาณ --'
				); 
				
			echo form_dropdown(
					'sch_times', 
					get_option('meeting_number as a', 'meeting_number as b', 'fund_request_support where meeting_number is not null group by meeting_number order by meeting_number asc'), 
					@$_GET['sch_times'], 
					'class="s_input"',
					'-- ระบุครั้งที่ --'
				); 
				
			echo form_input(
					'sch_date_meeting', 
					@$_GET['sch_date_meeting'], 
					'class="datepicker s_input" style="width:90px; height:20px;"'
				); 
			
			echo form_submit(false, 'ค้นหา', 'class="btn_search"'); 
		?>
	</div>
</form>
<? if(empty($_GET['sch_province']) || empty($_GET['sch_year']) || empty($_GET['sch_times']) || empty($_GET['sch_date_meeting'])) {
	return false; //ถ้าไม่มีการระบุขอบเขตข้อมูล จะไม่แสดงรายงาน
} ?>


<div id="report">

	<div style="float:right; font-size:20px;">แบบรายงาน คคด.03 (บ)</div>
 
	<div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">
    	รายงานสรุปผลการพิจารณาอนุมัติเงินสงเคราะห์รายบุคคล (กองทุนคุ้มครองเด็ก)<br>
    	หน่วยงาน <? echo (empty($province_title))?'......................................................................................':$province_title; ?> <br />
		ปีงบประมาณ <? echo (empty($_GET['sch_year']))?'................................................................................':$_GET['sch_year']; ?>   <br>
		ประชุมครั้งที่  <? echo (empty($_GET['sch_times']))?'_____':$_GET['sch_times']; ?> / <? echo (empty($_GET['sch_year']))?'__________':$_GET['sch_year']; ?>   
		วัน/เดือน/ปี ที่ประชุม <? 
		
		$goption = $month_ary;
		
		if(empty($_GET['sch_date_meeting'])) {
			echo '__ __/__ __/__ __ __ __';
		} else {
			$tmp = explode('-', $_GET['sch_date_meeting']);
			echo 'วันที่ '.$tmp[0].' เดือน '.$goption[($tmp[1]*1)].' พ.ศ. '.$tmp[2];
		} ?>
	</div>
	
    <div style="clear:both;"></div><br>
  <div style="float:right; font-size:20px; margin-top:-30px;">หน่วย : บาท</div>
    <table class="tbReport">
  <tr>
    <th width="5%" rowspan="2" align="center"><strong>ลำดับที่</strong></th>
    <th width="18%" rowspan="2" align="center"><strong>ชื่อ - สกุลเด็ก</strong></th>
    <th colspan="10" align="center"><strong>ผลการพิจารณาอนุมัติ</strong></th>
  </tr>
  <tr>
    <th width="5%" align="center"><strong>ข้อ 4 (1)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4 (2)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4 (3)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4 (4)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4 (5)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4 (6)</strong></th>
    <th width="5%" align="center"><strong>ข้อ 4 (7)</strong></th>
    <th width="5%" align="center"><strong>พิเศษ (DNA)</strong></th>
    <th width="5%" align="center"><strong>อื่นๆ</strong></th>
    <th width="11%" align="center"><strong>จำนวนรวม</strong></th>
  </tr>
  
  	<?php
  		$total = 0;
		$total_4_1 = 0;
		$total_4_2 = 0;
		$total_4_3 = 0;
		$total_4_4 = 0;
		$total_4_5 = 0;
		$total_4_6 = 0;
		$total_4_7 = 0;
		$total_4_8 = 0;
		$total_dna = 0;
		foreach ($variable as $key => $value):
			$page = 0;
			if(@$_GET["page"]) {
				$page = ($_GET["page"]-1)*20;
			}
			$number= $page+($key+1);
			
			$total_4_1 = $total_4_1+$value["4_1_total"];
			$total_4_2 = $total_4_2+$value["4_2_total"];
			$total_4_3 = $total_4_3+$value["4_3"];
			$total_4_4 = $total_4_4+$value["4_4"];
			$total_4_5 = $total_4_5+$value["4_5_total"];
			$total_4_6 = $total_4_6+$value["4_6_total"];
			$total_4_7 = $total_4_7+$value["4_7"];
			$total_dna = $total_dna+$value["dna_charges"];
			
			$total_row = ($value["4_1_total"])+($value["4_2_total"])+($value["4_3"])+($value["4_4"])+($value["4_5_total"])+($value["4_6_total"])+($value["4_7"])+($value["dna_charges"]);
			$total = $total+$total_row;
  	?>
  	<tr>
    	<td><?php echo $number?></td>
    	<td><?php echo $value["fund_child_name"]?></td>
    	<td><?php echo ($value["4_1_total"]) ? $value["4_1_total"] : "-" ?></td>
    	<td><?php echo ($value["4_2_total"]) ? $value["4_2_total"] : "-" ?></td>
    	<td><?php echo ($value["4_3"]) ? $value["4_3"] : "-" ?></td>
    	<td><?php echo ($value["4_4"]) ? $value["4_4"] : "-" ?></td>
    	<td><?php echo ($value["4_5_total"]) ? $value["4_5_total"] : "-" ?></td>
    	<td><?php echo ($value["4_6_total"]) ? $value["4_6_total"] : "-" ?></td>
    	<td><?php echo ($value["4_7"]) ? $value["4_7"] : "-" ?></td>
    	<td><?php echo ($value["dna_charges"]) ? $value["dna_charges"] : "-" ?></td>
    	<td></td>
		<td><?php echo $total_row?></td>
	</tr>
	<?php endforeach?>
	<tr>
	    <td colspan="2" align="center"><strong>จำนวนรวมทั้งสิ้น</strong></td>
		<td><?php echo $total_4_1?></td>
		<td><?php echo $total_4_2?></td>
		<td><?php echo $total_4_3?></td>
		<td><?php echo $total_4_4?></td>
		<td><?php echo $total_4_5?></td>
		<td><?php echo $total_4_6?></td>
		<td><?php echo $total_4_7?></td>
		<td><?php echo $total_4_8?></td>
		<td><?php echo $total_dna?></td>
		<td><?php echo $total_row?></td>
	</tr>
</table>


</div>
</div><!--page-->
