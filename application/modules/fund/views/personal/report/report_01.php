<link rel='stylesheet' type='text/css' href='css/report.css'>

<h3>สรุปผลการพิจารณา อนุมัติการช่วยเหลือ เด็กฯ (คคด.01) (บ)</h3>
<div id="search">
<div id="searchBox">
  <select name="select2" id="select2">
    <option>-- ระบุจังหวัด --</option>
  </select>
  <select name="select" id="select">
  	<option>-- ระบุปีงบประมาณ --</option>
    <option>2557</option>
    <option>2556</option>
  </select>
    <select name="select" id="select">
    <option>-- ระบุครั้งที่ --</option>
    <option>1</option>
    <option>2</option>
  </select>

      <input type="text" name="textfield" id="textfield" style="width:100px;" />
    <img src="images/calendar.png" width="16" height="16" style="margin-right:20px;" />   
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

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
	  	$no = 0;
	  	foreach ( $items as $item ) {
	  		$no++;
			echo '<pre>';
	  		print_r($item);
			echo '</pre>';
			echo '<BR>';
			?>
			<tr>
				<td><? echo $no; ?></td>
				<td><? echo $item['fund_reg_personal_name']; ?></td>
				<td><? echo $item['per_idcard']; ?></td>
				<td><? echo db2date($item['per_birth']); ?></td>
				<td>
					<? 
						echo date('Y-m-d');
						echo '<br>';
						echo $item['per_birth'];
					
						echo '<HR>';
						echo strtotime(date('Y-m-d'));
						echo '<BR>'; 
						echo strtotime($item['per_birth']);
						
					?>
				</td>
				<td>xxx</td>
				<td><? echo $item['fund_child_name']; ?></td>
				<td><? echo $item['child_idcard']; ?></td>
				<td><? echo db2date($item['child_birth']); ?></td>
				<td>xxx</td>
				<td>xxx</td>
				<td>xxx</td>
				<td>xxx</td>
			</tr>
			<?
	  	}
	  ?>
	  <tr>
	    <td align="center">1</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="center">2</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="center">3</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="center">4</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
	  <tr>
	    <td align="center"> 5</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	  </tr>
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