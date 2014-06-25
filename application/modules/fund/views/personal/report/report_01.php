<link rel='stylesheet' type='text/css' href='css/report.css'>

<?
	function __construct() {
		parent::__construct();
	}
	
	function find_age($birth = false) {
		if(!$birth) {
			return false;
		}
		
		$date_now = array(
			'd'=>(date('d')*1),
			'm'=>(date('m')*1),
			'y'=>date('Y')
		);
		
		$date_birth = array(
			'd'=>(date('d', (strtotime($birth)))*1),
			'm'=>(date('m', (strtotime($birth)))*1),
			'y'=>date('Y', strtotime($birth))
		);
	
		$date_now_ = gregoriantojd($date_now['m'], $date_now['d'], $date_now['y']);
		$date_birth_ = gregoriantojd($date_birth['m'], $date_birth['d'], $date_birth['y']);
		
		return ceil(($date_now_ - $date_birth_)/365);
	} //End : (f) find_age(); 
?>

<h3>สรุปผลการพิจารณา อนุมัติการช่วยเหลือ เด็กฯ (คคด.01) (บ)</h3>
<form action='' method='get' id="search">
	<div id="searchBox">
		<? echo form_dropdown('province_id', get_option('ID', 'TITLE', 'fund_province order by title asc'), @$_GET['province_id'], '', '-- ระบุจังหวัด --'); ?> 
		<? echo form_dropdown('year_budget', get_option('year_budget as a', 'year_budget as b', 'fund_request_support group by year_budget order by year_budget desc'), @$_GET['year_budget'], '', '-- ระบุปีงบประมาณ --'); ?>
		<? echo form_dropdown('times', get_option('meeting_number as a', 'meeting_number as b', 'fund_request_support where meeting_number is not null group by meeting_number order by meeting_number asc'), @$_GET['times'], '', '-- ระบุครั้งที่ --'); ?>
	  	
	  	<? echo form_input(false, false, 'class="datepicker" style="width:80px;"'); ?>
		<!--
		<input type="text" name="textfield" id="textfield" style="width:100px;" />
		<img src="images/calendar.png" width="16" height="16" style="margin-right:20px;" />
		-->   
		<input type="submit" title="ค้นหา" value=" " class="btn_search" />
	</div>
</form>

<div id="report">
	
	<div style="text-align:center; font-weight:bold; font-size:20px;">รายงานสรุปผลการพิจารณาอนุมัติการช่วยเหลือเด็กและครอบครัว ครอบครัวอุปถัมภ์</div>
	<div style="float:right; margin-top:-30px; font-size:20px;">แบบรายงาน คคด.บ 01</div>
	<div style="text-align:center; font-size:20px;"><strong>ของคณะอนุกรรมการบริหารกองทุนคุ้มครองเด็กจังหวัด จังหวัด............................................. (ครั้งที่......./..............    วันที่....... เดือน......................... พ.ศ. ..............)</strong></div><br>
	<table class="tbReport">
	  <tr>
	    <th rowspan="2" align="center"><strong>ลำดับที่</strong></th>
	    <th colspan="5" align="center"><strong>ข้อมูลผู้ขอรับการช่วยเหลือ</strong></th>
	    <th colspan="4" align="center"><strong>ข้อมูลเด็ก</strong></th>
	    <th rowspan="2" align="center"><strong>ประเภท<br />
	      (บุคคล)ผู้ขอรับ<br />
	      การช่วยเหลือ</strong></th>
	    <th rowspan="2" align="center"><strong>สภาพปัญหา<br />
	      ความเดือดร้อน</strong></th>
	    <th rowspan="2" align="center"><strong>ผลการพิจารณา<br />
	      อนุมัติ</strong></th>
	  </tr>
	  <tr>
	    <th align="center"><strong>ชื่อ-สกุล</strong></th>
	    <th align="center"><strong>เลขประจำตัว<br />
	      ประชาชน</strong></th>
	    <th align="center"><strong>วัน เดือน ปี<br />
	      เกิด</strong></th>
	    <th align="center"><strong>อายุ<br />
	      (ปี)</strong></th>
	    <th align="center"><strong>ความเกี่ยวข้อง<br />
	      กับเด็ก</strong></th>
	    <th align="center"><strong>ชื่อ-สกุล</strong></th>
	    <th align="center"><strong>เลขประจำตัว<br />
	      ประชาชน</strong></th>
	    <th align="center"><strong>วัน เดือน ปี<br />
	      เกิด</strong></th>
	    <th align="center"><strong>อายุ<br />
	      (ปี)</strong></th>
	  </tr>
	  <?
	
	  	$relation_type_detail = array(
	  		1=>'บิดา/มารดา',
	  		2=>'ญาติ',
	  		3=>'ผู้ดูแล/อุปถัมภ์',
	  		4=>'คนรู้จัก'
		);
		
		$request_type_detail = array(
	  		1=>'เด็กและครอบครัว',
	  		2=>'ครอบครัวอุปถัมภ์'
		);
		
		$status_detail = array(
	  		1=>'อนุมัติ',
	  		2=>'ไม่อนุมัติ'
		);
	  
	  	$no = 0;
	  	foreach ( $items as $item ) {
	  		$no++;
			?>
			<tr>
				<td class='text-center'><? echo $no; ?></td>
				<td><? echo $item['fund_reg_personal_name']; ?></td>
				<td><? echo $item['per_idcard']; ?></td>
				<td><? echo db2date($item['per_birth']); ?></td>
				<td class='text-center'> <? echo find_age($item['per_birth']); ?> ปี </td>
				<td><? echo @$relation_type_detail[$item['relation_type']]; ?></td>
				<td><? echo $item['fund_child_name']; ?></td>
				<td><? echo $item['child_idcard']; ?></td>
				<td><? echo db2date($item['child_birth']); ?></td>
				<td class='text-center'><? echo find_age($item['child_birth']); ?> ปี</td>
				<td><? echo @$request_type_detail[$item['request_type']]; ?></td>
				<td><? echo $item['abstract']; ?></td>
				<td><? echo @$status_detail[$item['status']]; ?></td>
			</tr>
			<?
	  	}
	  ?>
	</table>
	<div style="margin:0 auto; width:100%">
	    <div style="float:left; margin-top:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	    ตำแหน่ง ผู้ว่าราชการจังหวัดหรือหรือผู้ที่ได้รับ
	                      มอบหมายจากผู้ว่าราชการจังหวัด
	        ประธานอนุกรรมการ<br>
	    วันที่..........เดือน........................พ.ศ. .............
	  </div>
	    
	    <div style="float:left; margin-top:30px; margin-left:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	    ตำแหน่ง ท้องถิ่นจังหวัดหรือผู้แทนอนุกรรมการ
	<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	
	    <div style="float:left; margin-top:30px; margin-left:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	   ตำแหน่ง ผู้อำนวยการสำนักงานเขตพื้นที่การศึกษาที่
	ปฏิบัติหน้าที่ผู้แทนกระทรวงศึกษาธิการ หรือผู้แทน
	อนุกรรมการ
	<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	    
	        <div style=" float:left; margin-top:30px; margin-left:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	   ตำแหน่ง สาธารณสุขจังหวัดหรือผู้แทนอนุกรรมการ
	<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	    
	</div>
	<div style="clear:both;"></div>
	
	<div style=" margin:0 auto; padding-left:155px;">
	    <div style="float:left; margin-top:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	    ตำแหน่ง ผู้ทรงคุณวุฒิอนุกรรมการ<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	    
	    <div style="float:left; margin-top:30px; margin-left:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	     ตำแหน่ง ผู้ทรงคุณวุฒิอนุกรรมการ<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	
	    <div style="float:left; margin-top:30px; margin-left:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	    ตำแหน่ง ผู้ทรงคุณวุฒิอนุกรรมการ<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	    
	</div>
	
	<div style="clear:both;"></div>
	
	<div style=" margin:0 auto; padding-left:320px;">
	    <div style="float:left; margin-top:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	    ตำแหน่ง พัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด
	อนุกรรมการและเลขานุการ
	<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	    
	    <div style="float:left; margin-top:30px; margin-left:30px; width:270px; text-align:center;">
	    ลงชื่อ...............................................................<br>
	          (..............................................................)<br>
	     ตำแหน่ง หัวหน้ากลุ่มสวัสดิการสังคมและพิทักษ์คุ้มครองสิทธิ
	อนุกรรมการและเลขานุการ
	<br>
	    วันที่..........เดือน........................พ.ศ. .............
	    </div>
	    
	</div>
	<div style="clear:both;"></div>
	<div style=" border-bottom:1px solid black; margin-top:20px; margin-bottom:20px;"></div>
	<div><span style="float:left;">หมายเหตุ</span>	<div style="padding-left:70px; style="float:left;"">- การขอรับการช่วยเหลือให้ใช้แบบบันทึก คคด.บ01</div></div>
	<div style="padding-left:70px;">- ผลการพิจารณาอนุมัติ ให้อธิบายรายการค่าใช้จ่ายและจำนวนเงินที่อนุมัติ โดยให้เป็นตามประกาศคณะกรรมการบริหารกองทุน เรื่องหลักเกณฑ์การกำหนดรายการและวงเงินฯ ลว. 6 ก.ค. 50</div>
	<div style="padding-left:70px;">- แบบฟอร์มนี้ใช้สรุปการพิจารณาอนุมัติของคณะอนุกรรมการบริหารกองทุนคุ้มครองเด็กจังหวัดที่ได้รับการแต่งตั้งจากคณะกรรมการบริหารกองทุน โดยให้ประธานและคณะอนุกรรมการฯ ลงนามอย่างน้อยกึ่งหนึ่ง (ในจำนวนนี้ ต้องให้ผู้ทรงคุณวุฒิลงนามร่วมด้วยอย่างน้อย 1 คน เพื่อให้ครบองค์ประกอบ)</div>
	<div style="padding-left:70px;">- แบบฟอร์มนี้สามารถบันทึกข้อมูลการอนุมัติช่วยเหลือเด็กและครอบครัวฯ ได้ตามจำนวนที่ได้รับอนุมัติ โดยมีคณะอนุกรรมการลงลายมือชื่อต่อจากผู้ได้รับการช่วยเหลือคนสุดท้าย</div>


</div></div><!--page-->
</body>
</html>