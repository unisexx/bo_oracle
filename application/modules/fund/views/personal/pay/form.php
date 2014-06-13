<h3>บันทึก ผลการจ่ายเงินขอรับเงินสนับสนุน กองทุนเด็กรายบุคคล</h3>

<div class="topicDetail">
	ปีงบประมาณ <span>2557</span> จังหวัด <span>นนทบุรี</span>	ชื่อผู้รับ (เด็ก)<span>ด.ช.ชูศักดิ์ เกียรติเฉลิมคุณ	</span> ชื่อผู้ขอ  <span>นายสมหวัง จตุรงค์ล้ำเลิศ</span>
</div>

<table class="tblist">
	<tr>
		<th rowspan="2">ครั้ง/ปี</th>
		<th rowspan="2">ปี พ.ศ.</th>
		<th rowspan="2">เดือน</th>
		<th rowspan="2">จำนวนเงิน (บาท)</th>
		<th colspan="2" style="text-align:center">สถานะ</th>
		<th rowspan="2" style="text-align:center">กรอกรายละเอียด</th>
	</tr>
	<tr>
		<th style="text-align:center">จ่ายเงินไปแล้ว</th>
		<th style="text-align:center">ยุติการช่วยเหลือ</th>
	</tr>
	<tr class="topic">
		<td colspan="7" >ข้อ 4(1) ค่าเลี้ยงดู/ค่าพาหนะ</td>
	</tr>
	
		<?php if(empty($variable41)):?>
		<tr>
			<td colspan="7" class="text-center" >- ไม่มีข้อมูล -</td>
		</tr>
		<?php
			else:
				foreach ($variable41 as $key41 => $value41):
					$page = 0;
					$status = "รอดำเนินการ";
					
					if(@$_GET["page"]) {
						$page = ($_GET["page"]-1)*20;
					}
					$number = $page+($key41+1);
					$province = $this->province->get_row($value41["province_id"]);
					
					if($value41["status"]==0) {
						$status = "รอดำเนินการ";
					}
					if($value41["status"]==1) {
						$status = "<img src=\"images/fund/ico_check.png\" width=\"24\" height=\"24\" />";
					}
					
					if($key41%2==0) {
						$odd = " odd";
					} else {
						$odd = null;
					}
		?>
		<tr class="cursor<?php echo $odd?>" >
			<td><?php echo $number?></td>
			<td><?php echo $value41["fund_year"]+543?></td>
			<td><?php echo month_th($value41["fund_month"])?></td>
			<td><?php echo number_format($value41["fund_cost"])?></td>
			<td style="text-align: center;" ><?php echo $status?></td>
			<td style="text-align: center;" >&nbsp;</td>
			<td style="text-align: center;" >
				<a href="inline_example82" class="example82 cboxElement subform" data-value="<?php echo $value41["id"]?>" >
					<img src="images/fund/list_data.png" alt="" width="32" height="32" />
				</a>
			</td>
		</tr>
		<?php endforeach?>
		<?php endif?>
		
	<tr class="topic">
		<td colspan="7">ข้อ 4(2) ค่าใช้จ่ายทางการศึกษา </td>
	</tr>
	<tr class="odd">
		<td colspan="4">ประถม</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	
		<?php if(empty($variable42)):?>
		<tr>
			<td colspan="7" class="text-center" >- ไม่มีข้อมูล -</td>
		</tr>
		<?php
			else:
				foreach ($variable42 as $key42 => $value42):
					$page = 0;
					$status = "รอดำเนินการ";
					
					if(@$_GET["page"]) {
						$page = ($_GET["page"]-1)*20;
					}
					$number = $page+($key42+1);
					$province = $this->province->get_row($value42["province_id"]);
					
					if($value42["status"]==0) {
						$status = "รอดำเนินการ";
					}
					if($value42["status"]==1) {
						$status = "<img src=\"images/fund/ico_check.png\" width=\"24\" height=\"24\" />";
					}
					
					if($key41%2==0) {
						$odd = " odd";
					} else {
						$odd = null;
					}
		?>
		<tr>
			<td>ปีที่ <?php echo $number?></td>
			<td></td>
			<td></td>
			<td><?php echo number_format($value41["fund_cost"])?></td>
			<td style="text-align: center;" ><?php echo $status?></td>
			<td style="text-align: center;" >&nbsp;</td>
			<td style="text-align: center;" >
				<a href="inline_example82" class="example82 cboxElement subform" data-value="<?php echo $value42["id"]?>" >
					<img src="images/fund/list_data.png" alt="" width="32" height="32" />
				</a>
			</td>
		</tr>
		<?php endforeach?>
		<?php endif?>
		
	<tr class="odd">
		<td colspan="4">มัธยม</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
		
	<tr class="odd">
		<td colspan="4">อาชีวศึกษา</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>

	<tr class="topic">
		<td colspan="7">ข้อ 4(3) ทุนประกอบอาชีพ/ค่ารักษาพยาบาล</td>
	</tr>
	
		<?php if(empty($variable43)):?>
		<tr>
			<td colspan="7" class="text-center" >- ไม่มีข้อมูล -</td>
		</tr>
		<?php
			else:
				foreach ($variable43 as $key43 => $value43):
					$page = 0;
					$status = "รอดำเนินการ";
					
					if(@$_GET["page"]) {
						$page = ($_GET["page"]-1)*20;
					}
					$number = $page+($key43+1);
					
					if($value43["status"]==0) {
						$status = "รอดำเนินการ";
					}
					if($value43["status"]==1) {
						$status = "<img src=\"images/fund/ico_check.png\" width=\"24\" height=\"24\" />";
					}
		?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><?php echo number_format($value43["fund_cost"])?></td>
			<td style="text-align: center;" ><?php echo $status?></td>
			<td style="text-align: center;" >&nbsp;</td>
			<td style="text-align: center;" >
				<a href="inline_example82" class="example82 cboxElement subform" data-value="<?php echo $value43["id"]?>" >
					<img src="images/fund/list_data.png" alt="" width="32" height="32" />
				</a>
			</td>
		</tr>
		<?php endforeach?>
		<?php endif?>
		
	<tr class="topic">
		<td colspan="7">ข้อ 4(4) ค่าใช้จ่ายเกี่ยวกับกายอุปกรณ์</td>
	</tr>
	
		<?php if(empty($variable44)):?>
		<tr>
			<td colspan="7" class="text-center" >- ไม่มีข้อมูล -</td>
		</tr>
		<?php
			else:
				foreach ($variable44 as $key44 => $value44):
					$page = 0;
					$status = "รอดำเนินการ";
					
					if(@$_GET["page"]) {
						$page = ($_GET["page"]-1)*20;
					}
					$number = $page+($key44+1);
					
					if($value43["status"]==0) {
						$status = "รอดำเนินการ";
					}
					if($value43["status"]==1) {
						$status = "<img src=\"images/fund/ico_check.png\" width=\"24\" height=\"24\" />";
					}
		?>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td><?php echo number_format($value44["fund_cost"])?></td>
			<td style="text-align: center;" ><?php echo $status?></td>
			<td style="text-align: center;" >&nbsp;</td>
			<td style="text-align: center;" >
				<a href="inline_example82" class="example82 cboxElement subform" data-value="<?php echo $value44["id"]?>" >
					<img src="images/fund/list_data.png" alt="" width="32" height="32" />
				</a>
			</td>
		</tr>
		<?php endforeach?>
		<?php endif?>
		
	<tr class="topic">
		<td colspan="7">ข้อ 4(5) ค่าเครื่องอุปโภคบริโภค</td>
	</tr>
	
		<?php if(empty($variable45)):?>
		<tr>
			<td colspan="7" class="text-center" >- ไม่มีข้อมูล -</td>
		</tr>
		<?php
			else:
				foreach ($variable45 as $key45 => $value45):
					$page = 0;
					$status = "รอดำเนินการ";
					
					if(@$_GET["page"]) {
						$page = ($_GET["page"]-1)*20;
					}
					$number = $page+($key45+1);
					$province = $this->province->get_row($value45["province_id"]);
					
					if($value45["status"]==0) {
						$status = "รอดำเนินการ";
					}
					if($value45["status"]==1) {
						$status = "<img src=\"images/fund/ico_check.png\" width=\"24\" height=\"24\" />";
					}
					
					if($key45%2==0) {
						$odd = " odd";
					} else {
						$odd = null;
					}
		?>
		<tr class="cursor<?php echo $odd?>" >
			<td><?php echo $number?></td>
			<td><?php echo $value45["fund_year"]+543?></td>
			<td><?php echo month_th($value45["fund_month"])?></td>
			<td><?php echo number_format($value45["fund_cost"])?></td>
			<td style="text-align: center;" ><?php echo $status?></td>
			<td style="text-align: center;" >&nbsp;</td>
			<td style="text-align: center;" >
				<a href="inline_example82" class="example82 cboxElement subform" data-value="<?php echo $value45["id"]?>" >
					<img src="images/fund/list_data.png" alt="" width="32" height="32" />
				</a>
			</td>
		</tr>
		<?php endforeach?>
		<?php endif?>
		
	<tr class="topic">
		<td colspan="7">ข้อ 4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์</td>
	</tr>
	
		<?php if(empty($variable46)):?>
		<tr>
			<td colspan="7" class="text-center" >- ไม่มีข้อมูล -</td>
		</tr>
		<?php
			else:
				foreach ($variable46 as $key46 => $value46):
					$page = 0;
					$status = "รอดำเนินการ";
					
					if(@$_GET["page"]) {
						$page = ($_GET["page"]-1)*20;
					}
					$number = $page+($key46+1);
					$province = $this->province->get_row($value46["province_id"]);
					
					if($value46["status"]==0) {
						$status = "รอดำเนินการ";
					}
					if($value46["status"]==1) {
						$status = "<img src=\"images/fund/ico_check.png\" width=\"24\" height=\"24\" />";
					}
					
					if($key46%2==0) {
						$odd = " odd";
					} else {
						$odd = null;
					}
		?>
		<tr class="cursor<?php echo $odd?>" >
			<td><?php echo $number?></td>
			<td><?php echo $value46["fund_year"]+543?></td>
			<td><?php echo month_th($value46["fund_month"])?></td>
			<td><?php echo number_format($value46["fund_cost"])?></td>
			<td style="text-align: center;" ><?php echo $status?></td>
			<td style="text-align: center;" >&nbsp;</td>
			<td style="text-align: center;" >
				<a href="inline_example82" class="example82 cboxElement subform" data-value="<?php echo $value46["id"]?>" >
					<img src="images/fund/list_data.png" alt="" width="32" height="32" />
				</a>
			</td>
		</tr>
		<?php endforeach?>
		<?php endif?>
		
	<tr class="topic">
		<td colspan="7">ข้อ 4(7) ค่าใช้จ่ายในการให้ความรู้/ฝึกอบรมเกี่ยวกับวิธีการอุปการะเลี้ยงดูเด็ก</td>
	</tr>
	<tr>
		<td>1</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr class="topic">
		<td colspan="7">(พิเศษ) ค่าตรวจ DNA</td>
	</tr>
	<tr>
		<td>1</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>



<!-- This contains the hidden content for inline calls -->
<div style="display:none">
	<div id="inline_example82" style="padding:10px; background:#fff;">	
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		
		$(".subform").click(function(){
			var id = $(this).attr("data-value");
			$.get("fund/personal/pay/subform/"+id, function(data){
				$("#inline_example82").html("<div style='text-align: center; vertical-align: middle; width: 80%;' >กำลังโหลดข้อมูล...<br /><img src='images/ajax-loader.gif' /></div>");
				$("#inline_example82").html(data);
			})
		});
		
		$(".example82").colorbox({
			height	: "80%",
			width		: "80%",
			inline		: true,
			href		: "#inline_example82",
			onClosed : function(){
				$("#inline_example82").html("");
			}
		});
		
	})
</script>

<style type="text/css" >
	#datepick-div {
		z-index: 10000;
	}
</style>