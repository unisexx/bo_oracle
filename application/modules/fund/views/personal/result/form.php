<h3>รายละเอียดการขอรับเงินสนับสนุน รายบุคคล</h3>
<form action="fund/personal/result/save/<?php echo $value["id"]?>" method="post"  enctype="multipart/form-data" >
	<table class="tbadd">
		<tr>
			<th>ปีงบประมาณ <span class="Txt_red_12">*</span></th>
			<td>กองทุนคุ้มครองเด็ก
			    <select name="year_budget" id="select">
					<option>2557</option>
					<option>2556</option>
			    </select>
		    </td>
		</tr>
		<tr>
			<th>จังหวัด <span class="Txt_red_12">*</span></th>
			<td>
				<?php echo form_dropdown("province_id",get_option("ID","TITLE","FUND_PROVINCE",NULL,"TITLE"),@$value["province_id"],"id=\"province_id\"","-- เลือกจังหวัด --",null)?>
			</td>
		</tr>
		<tr>
			<th>วันเดือนปี ที่รับเรื่อง<span class="Txt_red_12"> *</span></th>
			<td>
				<input type="text" id="date_request" class="datepicker" name="date_request" value="<?php echo mysql_to_date($value["date_request"],TRUE)?>" readonly style="width:80px;" />
			</td>
		</tr>
		<tr>
			<th>ข้อมูลเด็ก <span class="Txt_red_12">*</span></th>
			<td>
				<input type="text" name="child_name" id="child_name" value="<?php echo $value["fund_child_name"]?>" readonly style="width:350px;" />
				<a href="fund/personal/form/modal_child" class="example7" ><img src="images/see.png" width="24" height="24" /></a>
			</td>
		</tr>
		<tr>
			<th>ประเภทขอรับการช่วยเหลือ</th>
			<td>
				<span><label><input type="radio" name="request_type" id="radio" value="1" <?php if($value["request_type"]==1) echo "checked"?> />เด็กและครอบครัว</label></span>
				<span><label><input type="radio" name="request_type" id="radio2" value="2" <?php if($value["request_type"]==2) echo "checked"?> /> ครอบครัวอุปถัมภ์</label></span>
			</td>
		</tr>
		<tr>
			<th>สภาพปัญหาความเดือดร้อนโดยสรุป</th>
			<td><textarea name="abstract" id="textarea3" style="width:500px; height:80px;"><?php echo $value["abstract"]?></textarea></td>
		</tr>
		<tr>
			<th>ข้อมูลผู้ขอ <span class="Txt_red_12">*</span></th>
			<td>
				<input type="text" name="personal_name" id="personal_name" value="<?php echo $value["fund_reg_personal_name"]?>" readonly style="width:350px;" />
				<a href="fund/personal/form/modal_request" class="example7" ><img src="images/see.png" width="24" height="24" /></a>
			</td>
		</tr>
		<tr>
			<th>ความเกี่ยวข้องกับเด็ก</th>
			<td>
				<span><label><input type="radio" name="relation_type" id="radio3" value="1" <?php if($value["relation_type"]==1) echo "checked"?> /> บิดา/มารดา</label></span>
		    	<span><label><input type="radio" name="relation_type" id="radio4" value="2" <?php if($value["relation_type"]==2) echo "checked"?> />ญาติ</label></span>
				<span><label><input type="radio" name="relation_type" id="radio4" value="3" <?php if($value["relation_type"]==3) echo "checked"?> />ผู้ดูแล/ผู้อุปถัมภ์</label></span>
				<span><label><input type="radio" name="relation_type" id="radio4" value="4" <?php if($value["relation_type"]==4) echo "checked"?> />คนรู้จัก</label></span>
			</td>
		</tr>
	</table>
	
	<h3>ผลการพิจารณาของคณะอนุกรรมการ</h3>
	<table class="tbadd">
		<tr>
			<th>มติที่ประชุมครั้งที่ / ลงวันที่<span class="Txt_red_12"> *</span></th>
			<td>
				<input type="text" id="meeting_number" name="meeting_number" value="<?php echo $value["meeting_number"]?>" style="width:50px;"/> /
				<input type="text" class="datepicker" name="meeting_date" value="<?php echo mysql_to_date($value["meeting_date"],TRUE)?>" readonly style="width:80px;" />
			</td>
		</tr>
		<tr>
			<th>รายละเอียดการอนุมัติ <span class="Txt_red_12">*</span></th>
			<td>
				<span><label><input type="radio" name="status" value="0" <?php if($value["status"]==0) echo "checked"?> />ไม่อนุมัติ</label></span>
				<span><label><input type="radio" name="status" value="1" <?php if($value["status"]==1) echo "checked"?> />อนุมัติ</label></span>
			</td>
		</tr>
	</table>
	
	
	<div class="dvReject" style="display: none;" >
		<table class="tbadd" style="margin:0;">
			<tr>
				<th>&nbsp;</th>
				<td><textarea name="textarea" cols="" rows="" style="width:500px; height:100px;" placeholder="ระบุเหตุผล"></textarea></td>
			</tr>
		</table>
	</div>
	
	<!-- กรณีที่อนุมัติ -->
	<?php
		$status = "style=\"display: none;\"";
		if($value["status"]==2) {
			$status = null;
		}
	?>
	<div class="dvApprove" <?php echo $status?> >
	<!--<div id="tabs">
	<ul>
	      <li><a href="#tabs-1">ข้อ 4(1) </a></li>
	      <li><a href="#tabs-2">ข้อ 4(2) </a></li>
	      <li><a href="#tabs-3">ข้อ 4(3) </a></li>
	      <li><a href="#tabs-4">ข้อ 4(4) </a></li>
	      <li><a href="#tabs-5">ข้อ 4(5) </a></li>
	      <li><a href="#tabs-6">ข้อ 4(6) </a></li>
	      <li><a href="#tabs-7">ข้อ 4(7) </a></li>
	      <li><a href="#tabs-8">DNA </a></li>
	      
	    </ul>
	    <div id="tabs-1">
	ข้อ 4(1) 
	        
	</div>
	    
	    
	    <div id="tabs-2">
	     ข้อ 4(2) 
	    </div>
	
	</div>-->
	
	
	
		<table class="tbadd" style="margin:0;">
			<tr>
				<th>คำสั่งศาล  <span class="Txt_red_12">*</span></th>
				<td>
					<select name="command_status" id="command_status" >
						<option value="0" <?php if($value["command_status"]==0) echo "selected"?> >ไม่มีคำสั่งศาล</option>
						<option value="1" <?php if($value["command_status"]==1) echo "selected"?> >มีคำสั่งศาล</option>
					</select>
					
					<div id="commandFile" class="boxAttachfile" <?php if(@$value["command_status"]==0) echo "style=\"display: none;\""?> >
						<?php if($value["file_command"]):?>
							<p>
								<span style="width: auto;" >
									<a href="uploads/fund/<?php echo $value["id"]?>/result/<?php echo $value["file_command"]?>" title="คำสั่งศาล" >
										<img src="images/btn_saveform.png" />
									</a>
								</span>
								คำสั่งศาล
							</p>
						<?php else:?>
							<p><span>แนบคำสั่งศาล</span> <input name="file_command" type="file" accept="application/pdf,application/msword" /></p>
						<?php endif?>
						
						<?php if($value["file_command"]):?>
							<p>
								<span style="width: auto;" >
									<a href="uploads/fund/<?php echo $value["id"]?>/result/<?php echo $value["file_command"]?>" title="แนบสำเนาบัตรประจำตัวประชาชน (เด็ก)" >
										<img src="images/btn_saveform.png" />
									</a>
								</span>
								แนบสำเนาบัตรประจำตัวประชาชน (เด็ก)
							</p>
						<?php else:?>
							<p><span>แนบสำเนาบัตรประจำตัวประชาชน (เด็ก)</span> <input name="file_idcard_child" type="file" accept="application/pdf,application/msword" /></p>
						<?php endif?>
						
						<?php if($value["file_idcard_request"]):?>
							<p>
								<span style="width: auto;" >
									<a href="uploads/fund/<?php echo $value["id"]?>/result/<?php echo $value["file_idcard_request"]?>" title="แนบสำเนาบัตรประจำตัวประชาชน (ผู้ขอ)" >
										<img src="images/btn_saveform.png" />
									</a>
								</span>
								แนบสำเนาบัตรประจำตัวประชาชน (ผู้ขอ)
							</p>
						<?php else:?>
							<p><span>แนบสำเนาบัตรประจำตัวประชาชน (ผู้ขอ)</span> <input name="file_idcard_request" type="file" accept="application/pdf,application/msword" /></p>
						<?php endif?>
						
						
					</div>
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
			 
					<span style="display:block;">
						ข้อ 4(1) ค่าเลี้ยงดู/ค่าพาหนะ จำนวน <input name="4_1_number" type="text" id="4_1_number" readonly value="<?php echo $value["4_1_number"]?>" style="width:40px;" />
						ครั้ง/เดือน ครั้งละ <input name="4_1_permonth" type="text" id="4_1_permonth" class="calculate-total" data-target="1" value="<?php echo $value["4_1_permonth"]?>" style="width:100px;" /> บาท/เดือน  
				    	<span style="margin-left:20px;">รวมเป็นเงิน <input name="4_1_total" type="text" id="4_1_total" readonly value="<?php echo $value["4_1_total"]?>" style="width:120px;" /> บาท</span>
					</span>
				
					<span style="margin-left:20px; display:block;">
						ตั้งแต่เดือน 
							<?php echo form_dropdown("4_1_start_month",get_month(),$value["4_1_start_month"],"id=\"month41_start\" class=\"calculate-number\" data-target=\"1\" ","-- เลือกเดือน --")?>
						
						พ.ศ.
							<?php echo form_dropdown("4_1_start_year",get_year(),$value["4_1_start_year"],"id=\"year41_start\" class=\"calculate-number\" data-target=\"1\"","-- เลือกปี --")?>
							
						ถึง เดือน
							<?php echo form_dropdown("4_1_end_month",get_month(),$value["4_1_end_month"],"id=\"month41_end\" class=\"calculate-number\" data-target=\"1\"","-- เลือกเดือน --")?>
							
						พ.ศ.
							<?php echo form_dropdown("4_1_end_year",get_year(),$value["4_1_end_year"],"id=\"year41_end\" class=\"calculate-number\" data-target=\"1\"","-- เลือกปี --")?>
					</span>
				</td>
			</tr>
			<tr>
			  <th>&nbsp;</th>
			  <td>
			  		<span style="display:block; margin-bottom:20px;">
			  			ข้อ 4(2) ค่าใช้จ่ายทางการศึกษา 
			  			<span style="margin-left:333px;">
			  				รวมเป็นเงิน <input name="4_2_total" type="text" id="edu_total" style="width:120px;" readonly value="<?php echo $value["4_2_total"]?>" /> บาท
			  			</span>
		  			</span> 
		  			
			    	<span style="margin-left:50px; display:block;">ระดับ 
			    		<span style="margin-left:20px; display:inline-block; width:100px;">
			    			ประถมศึกษา
		    			</span>
		    			
			    		<span style="margin-right:20px;">
			    			จำนวน <input name="4_2_junior_year" type="text" id="junior_year" class="edu_fund" data-fund="junior" value="<?php echo $value["4_2_junior_year"]?>" style="width:20px;" /> ปี
		    			</span>
		    			
			     		ปีละ <input name="4_2_junior_peryear" type="text" id="junior_peryear" class="edu_fund" data-fund="junior" value="<?php echo $value["4_2_junior_peryear"]?>" style="width:100px;"  /> บาท 
			     		
			     		<span style="margin-left:20px;">
			     			รวม <input name="4_2_junior_total" type="text" id="junior_total" data-fund="junior" readonly value="<?php echo $value["4_2_junior_total"]?>" style="width:120px;" /> บาท
		     			</span>
	     			</span>
			     
					<span style="margin-left:82px; display:block;">
						
			     		<span style="margin-left:20px; display:inline-block; width:100px;">  
			     			มัธยมศึกษา
		     			</span>
		     			
						<span style="margin-right:20px;">
							จำนวน <input name="4_2_senior_year" type="text" id="senior_year" class="edu_fund" data-fund="senior" value="<?php echo $value["4_2_senior_year"]?>" style="width:20px;" /> ปี
						</span>
						
						ปีละ <input name="4_2_senior_peryear" type="text" id="senior_peryear" class="edu_fund" data-fund="senior" value="<?php echo $value["4_2_senior_peryear"]?>" style="width:100px;"  /> บาท 
						
						<span style="margin-left:20px;">
							รวม <input name="4_2_senior_total" type="text" id="senior_total" data-fund="senior" readonly value="<?php echo $value["4_2_senior_total"]?>" style="width:120px;" /> บาท
						</span>
						
			     	</span>
			     
					<span style="margin-left:82px; display:block;">
						
						<span style="margin-left:20px; display:inline-block; width:100px;">  
							อาชีวศึกษา
						</span>
		     			
						<span style="margin-right:20px;">
							จำนวน <input name="4_2_high_year" type="text" id="high_year" class="edu_fund" data-fund="high" value="<?php echo $value["4_2_high_year"]?>" style="width:20px;" /> ปี
						</span>
						
						ปีละ <input name="4_2_high_peryear" type="text" id="high_peryear" class="edu_fund" data-fund="high" value="<?php echo $value["4_2_high_peryear"]?>" style="width:100px;"  /> บาท 
						
						<span style="margin-left:20px;">
							รวม <input name="4_2_high_total" type="text" id="high_total" data-fund="high" readonly value="<?php echo $value["4_2_high_total"]?>" style="width:120px;" /> บาท
						</span>
				     	
				     </span>
			    </td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
					ข้อ 4(3) ทุนประกอบอาชีพ/ค่ารักษาพยาบาล
					<input name="4_3" type="text" id="4_3" value="<?php echo $value["4_3"]?>" style="width:100px;" />
			   		บาท
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>ข้อ 4(4) ค่าใช้จ่ายเกี่ยวกับกายอุปกรณ์
			    	<input name="4_4" type="text" id="4_4" value="<?php echo $value["4_4"]?>" style="width:100px;" /> บาท
					<p style="margin-left:20px;">ระบุประเภทกายอุปกรณ์ <input name="4_4_detail" type="text" id="4_4_detail" value="<?php echo $value["4_4_detail"]?>" style="width:400px;" /></p>
			    </td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
			 						
					<span style="display:block;">
						ข้อ 4(5) ค่าเครื่องอุปโภคบริโภค จำนวน <input name="4_5_number" type="text" id="4_5_number" value="<?php echo $value["4_5_number"]?>" style="width:40px;" readonly="readonly" /> เดือน 
						เดือนละ <input name="4_5_permonth" type="text" id="4_5_permonth" class="calculate-total" data-target="5" value="<?php echo $value["4_5_permonth"]?>" style="width:100px;" /> บาท  
						
				    	<span style="margin-left:20px;">
				    		รวมเป็นเงิน <input name="4_5_total" type="text" id="4_5_total" style="width:120px;" readonly value="<?php echo $value["4_5_total"]?>" /> บาท
			    		</span>
					</span>
			
					<span style="margin-left:20px; display:block;">
						ตั้งแต่เดือน
							<?php echo form_dropdown("4_5_start_month",get_month(),$value["4_5_start_month"],"id=\"month45_start\" class=\"calculate-number\" data-target=\"5\" ","-- เลือกเดือน --")?>
						
						พ.ศ.
							<?php echo form_dropdown("4_5_start_year",get_year(),$value["4_5_start_year"],"id=\"year45_start\" class=\"calculate-number\" data-target=\"5\"","-- เลือกปี --")?>
							
						ถึง เดือน
							<?php echo form_dropdown("4_5_end_month",get_month(),$value["4_5_end_month"],"id=\"month45_end\" class=\"calculate-number\" data-target=\"5\" ","-- เลือกเดือน --")?>
						
						พ.ศ.
							<?php echo form_dropdown("4_5_end_year",get_year(),$value["4_5_end_year"],"id=\"year45_end\" class=\"calculate-number\" data-target=\"5\"","-- เลือกปี --")?>
					</span>
					
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
			 
					<span style="display:block;">
						ข้อ 4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์ จำนวน <input name="4_6_number" type="text" id="4_6_number" value="<?php echo $value["4_6_number"]?>" style="width:40px;" readonly="readonly" /> เดือน 
						เดือนละ <input name="4_6_permonth" type="text" id="4_6_permonth" class="calculate-total" data-target="6" value="<?php echo $value["4_6_permonth"]?>" style="width:100px;" /> บาท  
						
				    	<span style="margin-left:20px;">
				    		รวมเป็นเงิน <input name="4_6_total" type="text" id="4_6_total" style="width:120px;" readonly value="<?php echo $value["4_6_total"]?>" /> บาท
			    		</span>
					</span>
			
					<span style="margin-left:20px; display:block;">
						ตั้งแต่เดือน
							<?php echo form_dropdown("4_6_start_month",get_month(),$value["4_6_start_month"],"id=\"month46_start\" class=\"calculate-number\" data-target=\"6\" ","-- เลือกเดือน --")?>
						
						พ.ศ.
							<?php echo form_dropdown("4_6_start_year",get_year(),$value["4_6_start_year"],"id=\"year46_start\" class=\"calculate-number\" data-target=\"6\"","-- เลือกปี --")?>
							
						ถึง เดือน
							<?php echo form_dropdown("4_6_end_month",get_month(),$value["4_6_end_month"],"id=\"month46_end\" class=\"calculate-number\" data-target=\"6\" ","-- เลือกเดือน --")?>
						
						พ.ศ.
							<?php echo form_dropdown("4_6_end_year",get_year(),$value["4_6_end_year"],"id=\"year46_end\" class=\"calculate-number\" data-target=\"6\"","-- เลือกปี --")?>
					</span>
					
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
					ข้อ 4(7) ค่าใช้จ่ายในการให้ความรู้/ฝึกอบรมเกี่ยวกับวิธีการอุปการะเลี้ยงดูเด็ก <input name="4_7" type="text" id="4_7" value="<?php echo $value["4_7"]?>" style="width:100px;" /> บาท
				</td>
			</tr>
			<tr>
				<th>&nbsp;</th>
				<td>
					(พิเศษ) ค่าตรวจ DNA <input name="dna_charges" type="text" id="dna_charges" value="<?php echo $value["dna_charges"]?>" style="width:100px;" /> บาท
				</td>
			</tr>
		</table>
	</div>
	
	<div id="btnBoxAdd">
		<button type="submit" class="btn_save" title="บันทึก" ></button>
		<button type="submit" class="btn_back" title="ย้อนกลับ" onclick="history.back(-1)" ></button>
	</div>
	
</form>

<script type="text/javascript" >
	$(document).ready(function(){
		
		$("#date_request").click(function(){
			$(this).val("");
		})
		
		<?php if($value["status"]==1):?>
			$(".dvReject").fadeOut();
			$(".dvApprove").fadeIn();
		<?php else:?>
			$(".dvReject").fadeIn();
			$(".dvApprove").fadeOut();
		<?php endif?>
		
		$("input[name=status]").click(function(){
			var status = $(this).val();
			
			if(status==1) {
				$(".dvReject").fadeOut();
				$(".dvApprove").fadeIn();
			} else {
				$(".dvApprove").fadeOut();
				$(".dvReject").fadeIn();
			}
			
		});
		
		$("#command_status").change(function(){
			var commandValue = $(this).val();
			if(commandValue==1) {
				$("#commandFile").fadeIn();
			} else {
				$("#commandFile").fadeOut();
				$("input[name=file_command]").val("");
				$("input[name=file_idcard_child]").val("");
				$("input[name=file_idcard_request]").val("");
			}
		})
		
		$(".calculate-number").live("change",function(){
			var target = $(this).attr("data-target");

			var sm = $("#month4"+target+"_start").val();
			var sy = $("#year4"+target+"_start").val();
			var em = $("#month4"+target+"_end").val();
			var ey = $("#year4"+target+"_end").val();
			
			if(sm<10) {
				sm = "0"+sm;
			}
			
			if(em<10) {
				em = "0"+em;
			}

			var sd = sy+"/"+sm+"/01";
			var ed = ey+"/"+em+"/01";

			var msg = sd+"\n"+ed;

			var diff = Math.abs(new Date(ed) - new Date(sd));
			var realDiff = Math.round(diff/(1000*60*60*24*30)+1);

			var pm = $("#4_"+target+"_permonth").val();
			var totalPm = realDiff*pm;

			$("#4_"+target+"_number").val(realDiff);
			$("#4_"+target+"_total").val(totalPm);
		})
		
		$(".calculate-total").keyup(function(){
			var target = $(this).attr("data-target");

			var sm = $("#month4"+target+"_start").val();
			var sy = $("#year4"+target+"_start").val();
			var em = $("#month4"+target+"_end").val();
			var ey = $("#year4"+target+"_end").val();
			
			if(sm<10) {
				sm = "0"+sm;
			}
			
			if(em<10) {
				em = "0"+em;
			}

			var sd = sy+"/"+sm+"/01";
			var ed = ey+"/"+em+"/01";

			var msg = sd+"\n"+ed;

			var diff = Math.abs(new Date(ed) - new Date(sd));
			var realDiff = Math.round(diff/(1000*60*60*24*30)+1);

			var pm = $("#4_"+target+"_permonth").val();
			var totalPm = realDiff*pm;

			$("#4_"+target+"_number").val(realDiff);
			$("#4_"+target+"_total").val(totalPm);
		})
		
		$(".edu_fund").keyup(function(){
			var type = $(this).attr("data-fund");
			
			var y = $("#"+type+"_year").val() ? $("#"+type+"_year").val() : 0;
			var py = $("#"+type+"_peryear").val() ? $("#"+type+"_peryear").val() : 0;
			var total_type = y*py;
			
			$("#"+type+"_total").val(total_type);
			
			var j = $("#junior_total").val() ? $("#junior_total").val() : 0;
			var s = $("#senior_total").val() ? $("#senior_total").val() : 0;
			var h = $("#high_total").val() ? $("#high_total").val() : 0;
			var total = parseInt(j)+parseInt(s)+parseInt(h);
			$("#edu_total").val(parseInt(total));
		})
		
	})
</script>