<h3>ผลการพิจารณา</h3>
<?php echo form_open('fund/project/project_support_result/save', 'enctype="multipart/form-data"'); ?>
<input type="hidden" name="id" value="<?php echo @$rs['id'] ?>" />
<table class="tbadd">
	<tr>
		<th>รหัสโครงการ</th>
		<td style='font-size:18px; color:#F00;'> 
			<? echo @$rs['project_code']; ?>
			<? echo anchor('fund/project/project_support/form/'.@$rs['id'], "<img src='images/fund/list_info.png' style='margin-left:10px;'>", 'target="_blank"'); ?> 
		</td>
	</tr>
	<tr>
		<th>ระบบการจัดสรร</th>
		<td> 
			<span>
				<input type="radio" name="allocate_type" id="allocate_type" value="1" <?php if($rs['allocate_type']=='1'){echo 'checked="checked"';}?>/><lable>ปกติ (ส่งเข้าส่วนกลาง)</lable>
			</span>
			<span style='margin-left:20px;'>
				<input type="radio" name="allocate_type" id="allocate_type" value="2" <?php if($rs['allocate_type']=='2'){echo 'checked="checked"';}?>/><lable>กระจาย (พิจารณาในจังหวัด)</lable>
			</span>
			<span style='margin-left:20px;' class='note'>* ล็อกแสดงโดยอัตโนมัติ</span>
		</td>
	</tr>
	<tr>
		<th>ผลการพิจารณาของคณะอนุฯ จังหวัด</th>
		<td> 
			 <?php
			 	if ($rs['allocate_type'] == '1' && count($rs_result_3) > 0){
			 		foreach ($rs_result_3 as $key => $result_3) {
			 			switch ($result_3['appoved_id']) {
							case '1':
								$appoved_result = "อนุมัติ";
								break;
							case '2':
								$appoved_result = "อนุมัติในหลักการ ";
								break;
							case '3':
								$appoved_result = "ขอรายละเอียดเพิ่มเติม";
								break;
							case '4':
								$appoved_result = "ไม่อนุมัติ";
								break;
							case '5':
								$appoved_result = "ส่งเข้าพิจารณาในระบบปกติ (ส่วนกลาง)";
								break;
							default:
								$appoved_result = "รอการพิจารณา";
								break;
						} 
						 echo "<div>ครั้งที่ ".$result_3['time']." ".$appoved_result."</div>";
					}
			 	} 
			 ?>
		</td>
	</tr>
	<tr>
		<th>ขนาดโครงการ</th>
		<td>	
			<? 
				if($rs['budget_request'] < 300000) {
					echo 'ขนาดเล็ก (ต่ำกว่า 300,000 บาท)';
				} else if($rs['budget_request'] <= 1000000) {
					echo 'ขนาดกลาง (300,000 – 1,000,000 บาท)';
				} else {
					echo 'ขนาดใหญ่ (มากกว่า 1,000,000 บาท ขึ้นไป)';
				}
			?>
			<span class='note'>* ล็อกแสดงโดยอัตโนมัติ</span>
		</td>
	</tr>
</table>

<div style="margin-left:20%;" class="allocate_type_1">
<h4>ผลการพิจารณาของอนุกรรมการพิจารณากลั่นกรองโครงการที่ขอรับการสนับสนุนจากกองทุนคุ้มครองเด็ก</h4>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " data_type="1" data_id="<?php echo $rs['id'] ?>" class="btn_add subform"/></div>
<table class="tblist">
	<tr>
		<th style="width: 10%">ครั้งที่</th>
		<th style="width: 30%">ว-ด-ป</th>
		<th style="width: 30%">ผลพิจารณา</th>
		<th style="width: 20%">รายละเอียด</th>
		<th style="width: 10%">จัดการ</th>
	</tr>
	<?php 
		$data_add_sub_form_2 = "N";
		foreach ($rs_result_1 as $key => $result_1) { ?>
	<tr>
		<td><?php echo $result_1['time']; ?></td>
		<td><?php echo mysql_to_date($result_1['date_appoved']); ?></td>
		<td>
			<?php
				switch ($result_1['appoved_id']) {
					case '1':
						$data_add_sub_form_2 = "Y";
						echo "เห็นชอบ";
						break;
					case '2':
						echo "เห็นชอบในหลักการ";
						break;
					case '3':
						echo "ขอรายละเอียดเพิ่มเติม";
						break;
					case '4':
						echo "ไม่เห็นชอบ";
						break;
					default:
						echo "รอการพิจารณา";
						break;
				} 
			?>
		</td>
		<td>
			<?php
				if ($result_1['appoved_id'] == '4') {
					if ($result_1['sub_appoved_id'] != '4' ) {
						switch ($result_1['appoved_id']) {
							case '1':
								$title = "ไม่สอดคล้องกับวัตถุประสงค์ของกองทุนฯ";
								break;
							case '2':
								$title = "ซ้ำซ้อนกับภาระกิจองค์กร";
								break;
							case '3':
								$title = "โครงการไม่ได้แสดงให้เห็นโอกาสแห่งความสำเร็จ";
								break;
							default:
								$title = "อื่นๆ : ";
								break;
						} 
					} else {
						$title = "อื่นๆ : ".$result_1['note'];
					}
				} else if ($result_1['appoved_id'] == '1') {
					$title = "-"; 
				} else {
					$title = $result_1['note']; 
				}
			?>
			<img src="images/fund/info.png" width="32" height="32" class="vtip" title="<?php echo $title; ?>"/>
		</td>
		<td><a href="fund/project/project_support_result/delete/<?php echo $result_1['id']; ?>/<?php echo $rs['id']; ?>" onclick="return confirm('ท่านต้องการลบข้อมูล')" ><button type="button" class="btn_delete" ></button></a></td>
	</tr>
	<?php } ?>
</table>

<div style="margin-top: 20px">
<h4>ผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก</h4>
<?php if($data_add_sub_form_2 == 'Y'){ ?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " budget="<?php echo $rs['budget_request'] ?>" data_type="2" data_id="<?php echo $rs['id'] ?>" class="btn_add subform"/></div>
<?php } ?>
<table class="tblist">
	<tr>
		<th style="width: 10%">ครั้งที่</th>
		<th style="width: 30%">ว-ด-ป</th>
		<th style="width: 30%">ผลพิจารณา</th>
		<th style="width: 20%">รายละเอียด</th>
		<th style="width: 10%">จัดการ</th>
	</tr>
	<?php foreach ($rs_result_2 as $key => $result_2) { ?>
	<tr>
		<td><?php echo $result_2['time']; ?></td>
		<td><?php echo mysql_to_date($result_2['date_appoved']); ?></td>
		<td>
			<?php
				switch ($result_2['appoved_id']) {
					case '1':
						echo "อนุมัติ";
						break;
					case '2':
						echo "อนุมัติในหลักการ ";
						break;
					case '3':
						echo "ขอรายละเอียดเพิ่มเติม";
						break;
					case '4':
						echo "ไม่อนุมัติ";
						break;
					default:
						echo "รอการพิจารณา";
						break;
				} 
			?>
		</td>
		<td>
			<?php
				if ($result_2['appoved_id'] == '4') {
					if ($result_2['sub_appoved_id'] != '4' ) {
						switch ($result_2['appoved_id']) {
							case '1':
								$title = "ไม่สอดคล้องกับวัตถุประสงค์ของกองทุนฯ";
								break;
							case '2':
								$title = "ซ้ำซ้อนกับภาระกิจองค์กร";
								break;
							case '3':
								$title = "โครงการไม่ได้แสดงให้เห็นโอกาสแห่งความสำเร็จ";
								break;
							default:
								$title = "อื่นๆ : ";
								break;
						} 
					} else {
						$title = "อื่นๆ : ".$result_2['note'];
					}
				} else {
					if ($result_2['appoved_id'] != '1') {
						$title = $result_2['note']; 
					} else {
						$title = "จำนวนเงิน ".number_format($result_2['appoved_budget'],2)." บาท"; 
					}
				}
			?>
			<img src="images/fund/info.png" width="32" height="32" class="vtip" title="<?php echo $title; ?>"/>
		</td>
		<td><a href="fund/project/project_support_result/delete/<?php echo $result_2['id']; ?>/<?php echo $rs['id']; ?>" onclick="return confirm('ท่านต้องการลบข้อมูล')" ><button type="button" class="btn_delete" ></button></a></td>
	</tr>
	<?php } ?>
</table>
</div>
</div><!-- allocate_type_1 -->

<div style="margin-left:20%;" class="allocate_type_2">
<h4>ผลการพิจารณาของคณะกรรมการบริหารกองทุนคุ้มครองเด็ก / หรือ คณะอนุกรรมการบริหารกองทุนคุ้มครองเด็กจังหวัด</h4>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " budget="<?php echo $rs['budget_request'] ?>" data_type="3" data_id="<?php echo $rs['id'] ?>" class="btn_add subform"/></div>
<table class="tblist">
	<tr>
		<th style="width: 10%">ครั้งที่</th>
		<th style="width: 30%">ว-ด-ป</th>
		<th style="width: 30%">ผลพิจารณา</th>
		<th style="width: 20%">รายละเอียด</th>
		<th style="width: 10%">จัดการ</th>
	</tr>
	<?php foreach ($rs_result_3 as $key => $result_3) { ?>
	<tr>
		<td><?php echo $result_3['time']; ?></td>
		<td><?php echo mysql_to_date($result_3['date_appoved']); ?></td>
		<td>
			<?php
				switch ($result_3['appoved_id']) {
					case '1':
						echo "อนุมัติ";
						break;
					case '2':
						echo "อนุมัติในหลักการ ";
						break;
					case '3':
						echo "ขอรายละเอียดเพิ่มเติม";
						break;
					case '4':
						echo "ไม่อนุมัติ";
						break;
					case '5':
						echo "ส่งเข้าพิจารณาในระบบปกติ (ส่วนกลาง)";
						break;
					default:
						echo "รอการพิจารณา";
						break;
				} 
			?>
		</td>
		<td>
			<?php
				if ($result_3['appoved_id'] == '4') {
					if ($result_3['sub_appoved_id'] != '4' ) {
						switch ($result_3['sub_appoved_id']) {
							case '1':
								$title = "ไม่สอดคล้องกับวัตถุประสงค์ของกองทุนฯ";
								break;
							case '2':
								$title = "ซ้ำซ้อนกับภาระกิจองค์กร";
								break;
							case '3':
								$title = "โครงการไม่ได้แสดงให้เห็นโอกาสแห่งความสำเร็จ";
								break;
							default:
								$title = "อื่นๆ : ";
								break;
						} 
					} else {
						$title = "อื่นๆ : ".$result_2['note'];
					}
				} else if ($result_3['appoved_id'] == '1') {
					switch ($result_3['appoved_id']) {
							case '1':
								$title = "เกินกรอบวงเงินระบบกระจาย";
								break;
							case '2':
								$title = "ขนาดโครงการเกิน 150,000 บาท";
								break;
							default:
								$title = "อื่นๆ : ";
								break;
						} 
				} else {
					if ($result_3['appoved_id'] != '1') {
						$title = $result_3['note']; 
					} else {
						$title = "จำนวนเงิน ".number_format($result_3['appoved_budget'],2)." บาท"; 
					}
				}
			?>
			<img src="images/fund/info.png" width="32" height="32" class="vtip" title="<?php echo $title; ?>"/>
		</td>
		<td><a href="fund/project/project_support_result/delete/<?php echo $result_3['id']; ?>/<?php echo $rs['id']; ?>" onclick="return confirm('ท่านต้องการลบข้อมูล')" ><button type="button" class="btn_delete" ></button></a></td>
	</tr>
	<?php } ?>
</table>
</div>

<div id="btnBoxAdd">
	<input type="submit" value="" class="btn_save"/>
	<input type="button" onclick="history.back(-1)" class="btn_back"/>
</div>

<!-- This contains the hidden content for inline calls -->
<div style="display:none">
	<div id="inline_example82" style="padding:10px; background:#fff;">	
	</div>
</div>

<?php 
	echo form_close(); 
?>
<script type="text/javascript">
	$(document).ready(function(){
		function allocate_type(){
			var type = $("[name=allocate_type]:checked").val();
			if (type == '1') {
				$('.allocate_type_1').show();
				$('.allocate_type_2').hide();
			} else if (type == '2') {
				$('.allocate_type_1').hide();
				$('.allocate_type_2').show();
			} else {
				$('.allocate_type_1').hide();
				$('.allocate_type_2').hide();
			}
			
		}
		allocate_type();
		$('[name= allocate_type]').live('change',function(){
			allocate_type();
		});
		
		$(".subform").click(function(){
			var type = $(this).attr("data_type");
			var id = $(this).attr("data_id");
			var budget = $(this).attr("budget");
			$.get("fund/project/project_support_result/subform/"+id+"/"+type+"/"+budget, function(data){
				$("#inline_example82").html("<div style='text-align: center; vertical-align: middle; width: 80%;' >กำลังโหลดข้อมูล...<br /><img src='images/ajax-loader.gif' /></div>");
				$("#inline_example82").html(data);
			})
		});
		
		$(".subform").colorbox({
			height	: "80%",
			width		: "80%",
			inline		: true,
			href		: "#inline_example82",
			onClosed : function(){
				$("#inline_example82").html("");
			}
		});
	});
</script>
<style type="text/css" >
	#datepick-div {
		z-index: 10000;
	}
</style>