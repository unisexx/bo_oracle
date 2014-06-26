<link rel='stylesheet' type='text/css' href='css/report.css'>

<h3>ผลการพิจารณา ของคณะกรรมการ บริหาร คคด.03 (ค)</h3>
<div id="search">
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
		
	<? echo form_dropdown('year', array(2557=>2557), @$_GET['year'], '', '-- เลือกปี --'); ?>
  <select name="select3" id="select3">
    <option>-- เลือกเดือน --</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<div id="report">

 <div style="float:right; font-size:20px;">แบบรายงาน คคด.03 (ค)</div><div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">ผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก/คณะอนุกรรมการบริหารกองทุนคุ้มครองเด็กจังหวัด<br>จำแนกตามองค์กรที่ขอรับการสนับสนุน<br>
  ประจำเดือน....................................................................</div>
    <div style="clear:both;"></div><br>
 
    <table class="tbReport">
<tr>
    <th width="7%" rowspan="2" align="center" valign="middle"><strong><br />
      ลำดับ<br />
      ที่</strong></th>
    <th width="8%" rowspan="2" align="center" valign="middle"><strong>ชื่อองค์กร</strong></th>
    <th width="11%" rowspan="2" align="center" valign="middle"><strong>รหัสโครงการ</strong></th>
    <th width="20%" rowspan="2" align="center" valign="middle"><strong>ชื่อโครงการที่เสนอขอรับฯ</strong></th>
    <th width="16%" rowspan="2" align="center" valign="middle"><strong>จำนวนเงินที่เสนอขอ</strong></th>
    <th colspan="3" align="center" valign="top"><strong>ผลการพิจารณาอนุมัติฯ</strong></th>
    </tr>
  <tr>
    <th width="13%" align="center">อนุมัติ 
      <br />
      (ระบุจำนวนเงิน) </th>
    <th width="13%" align="center">อยู่ระหว่างดำเนินการ</th>
    <th width="12%" align="center">ไม่อนุมัติ</th>
  </tr>
  	<? $no = 0;
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
	?>
	
</table>
    <div style="margin-top:10px;"><strong>หมายเหตุ </strong>:	 แบบรายงานนี้ใช้สำหรับแจ้งผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก/คณะอนุกรรมการบริหารกองทุนคุ้มครองเด็กจังหวัด<br />
     <div style="padding-left:80px;">ให้องค์กรภาคเอกชน/หน่วยงานผู้ขอรับการสนับสนุนฯ ทราบผ่านช่องทางประชาสัมพันธ์ของระบบงานบริหารบริหารกองทุน </div></div>
</div>


</div></div><!--page-->
