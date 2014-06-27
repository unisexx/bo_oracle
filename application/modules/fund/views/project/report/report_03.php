<link rel='stylesheet' type='text/css' href='css/report.css'>

<h3>ผลการพิจารณา ของคณะกรรมการ บริหาร คคด.03 (ค)</h3>
<form id="search" action='' method='get'>
	<div id="searchBox">
		<?
			$goption = array(
				1=>'มกราคม',
				2=>'กุมภาพันธ์',
				3=>'มีนาคม',
				4=>'เมษายน',
				5=>'พฤษภาคม',
				6=>'มิถุนายน',
				7=>'กรกฏาคม',
				8=>'สิงหาคม',
				9=>'กันยายน',
				10=>'ตุลาคม',
				11=>'พฤศจิกายน',
				12=>'ธันวาคม'
			);
		
			echo form_dropdown('month', $goption, @$_GET['month'], '', '-- เลือกเดือน --'); ?>
		<? echo form_dropdown('year', array(2014=>2557), @$_GET['year'], '', '-- เลือกปี --'); ?>
		<input type="submit" title="ค้นหา" value=" " class="btn_search" />
	</div>
</form>

<div id="report">

 <div style="float:right; font-size:20px;">แบบรายงาน คคด.03 (ค)</div><div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">
    	ผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก/คณะอนุกรรมการบริหารกองทุนคุ้มครองเด็กจังหวัด<br>
    	จำแนกตามองค์กรที่ขอรับการสนับสนุน<br>
  		ประจำเดือน <? echo (empty($_GET['month']))?'..........':$goption[$_GET['month']]; ?> พ.ศ. <? echo (empty($_GET['year']))?'................':($_GET['year'] + 543); ?> 
  	</div>
  	
    <div style="clear:both;"></div><br>
 
	<table class="tbReport">
		<tr>
		    <th width="7%" rowspan="2" align="center" valign="middle"> ลำดับ<br /> ที่</th>
		    <th width="8%" rowspan="2" align="center" valign="middle">ชื่อองค์กร</th>
		    <th width="11%" rowspan="2" align="center" valign="middle">รหัสโครงการ</th>
		    <th width="20%" rowspan="2" align="center" valign="middle">ชื่อโครงการที่เสนอขอรับฯ</th>
		    <th width="16%" rowspan="2" align="center" valign="middle">จำนวนเงินที่เสนอขอ</th>
		    <th colspan="3" align="center" valign="top">ผลการพิจารณาอนุมัติฯ</th>
		</tr>
		<tr>
		    <th width="13%" align="center">อนุมัติ <br /> (ระบุจำนวนเงิน) </th>
		    <th width="13%" align="center">อยู่ระหว่างดำเนินการ</th>
		    <th width="12%" align="center">ไม่อนุมัติ</th>
  		</tr>
  		
	  	<? $no = 0;
		if(empty($rs) || empty($_GET['month']) || empty($_GET['year'])) {
			?> <tr> <td colspan='8' class='text-center'>ไม่พบข้อมูล</td> </tr> 
			<?
		} else {
			foreach($rs as $item){
	  			$no++ ;
				$item['project_budget'] = (empty($item['project_budget']))?0:$item['project_budget'];
	  			?>
	  			  <tr>
				    <td class='text-center'><? echo $no; ?></td>
				    <td><? echo $item['organization']; ?></td>
				    <td><? echo $item['project_code']; ?></td>
				    <td><? echo $item['project_name']; ?></td>
				    <td class='text-right'><? echo number_format($item['project_budget']); ?></td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				  </tr>
	  			<?
	  		}
			
		}	
		?>
	
	</table>
    <div style="margin-top:10px;"><strong>หมายเหตุ :</strong>	 แบบรายงานนี้ใช้สำหรับแจ้งผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก/คณะอนุกรรมการบริหารกองทุนคุ้มครองเด็กจังหวัด<br />
     <div style="padding-left:80px;">ให้องค์กรภาคเอกชน/หน่วยงานผู้ขอรับการสนับสนุนฯ ทราบผ่านช่องทางประชาสัมพันธ์ของระบบงานบริหารบริหารกองทุน </div></div>
</div>


</div></div><!--page-->
