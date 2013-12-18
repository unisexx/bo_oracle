<style type="text/css">
table.tblist3 tbody tr td.td-header{
    background: url("themes/bo/images/bg_topic.gif") repeat scroll 0 0 transparent;
    <!-- height: 62px; -->
}
select[disabled="disabled"],[disabled]{
	border: 1px solid #ABADB3;
	color: #000 !important;
	cursor: inherit;
	background-color: #fff;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
	
	// หา area_list สำหรับผู้ตรวจ
	$('select[id=budgetyear_inspect]').livequery('change',function(){
		$('.loading').show();
		$('select[name=provinceid],select[name=projectid],select[name=provincearea]').remove();
		$.post('inspect_save/get_arealist_for_is_inspector',{
			'year' : $(this).val()
		},function(data){
			$("#dvAreaID").html(data);
			$('.loading').hide();
		});
	});
	// ------------------
	
	$("select[name=provincearea]").livequery("change",function(){
		$('.loading').show();
		$('select[name=provinceid],select[name=projectid]').remove();
		var provincearea = ($(this).val());			
		$.post('c_province/select_province_from_area',{
				'provincearea' : provincearea
			},function(data){
				$("#dvProvinceID").html(data);	
				$('.loading').hide();
			});
	});
	
	
	// หา project_list สำหรับผู้ตรวจ
	$("select[name=provinceid]").livequery("change",function(){
		$('.loading').show();
		$('select[name=projectid]').remove();
		var budgetyear = $('select[name=budgetyear]').val();
		var provincearea = $('select[name=provincearea]').val();
		if(provincearea == ''){
			$('.loading').hide();
			return false;
		}
		if(budgetyear == ''){
			alert("กรุณาเลือกปีงบประมาณ");
			return false;
		}
		
		var provinceid = $('select[name=provinceid]').val();
		
		$.post('inspect_save/projectlist',{
				'provinceid' : provinceid,
				'budgetyear' : budgetyear
			},function(data){
				$("#projectlist").html(data);
				$('.loading').hide();
			});
	});
	
	// กรณีกดค้นหาแล้วให้โชว์เมื่อมีค่า get มาจาก url
	<?php if(@$_GET['provincearea']):?> //กรณีกดค้นหาแล้วให้โชว์เมื่อมีค่า get มาจาก url
		$.post('inspect_save/get_arealist_for_is_inspector',{
			'year' : '<?php echo @$_GET['budgetyear']?>',
			'provincearea' : <?php echo @$_GET['provincearea']?>
		},function(data){
			$("#dvAreaID").html(data);
		});
	<?php endif;?>
	
	<?php if(@$_GET['projectid']):?> //กรณีกดค้นหาแล้วให้โชว์เมื่อมีค่า get มาจาก url
		$('.loading').show();
		$.post('inspect_save/projectlist',{
			'provinceid' : '<?php echo @$_GET['provinceid']?>',
			'budgetyear' : '<?php echo @$_GET['budgetyear']?>',
			'projectid' : '<?php echo @$_GET['projectid']?>'
		},function(data){
			$("#projectlist").html(data);
			$('.loading').hide();
		});
	<?php endif;?>
	// ------------------
	
	// user เลือกปีก็ให้หา projectlist เลยเพราะ user มี เขตกับจังหวัดของตัวเองแล้ว
	$("select[id=budgetyear_user]").livequery("change",function(){
		$('.loading').show();
		$('select[name=projectid]').remove();
		var budgetyear = $('select[name=budgetyear]').val();
		var provincearea = $('select[name=provincearea]').val();
		if(provincearea == ''){
			$('.loading').hide();
			return false;
		}
		if(budgetyear == ''){
			alert("กรุณาเลือกปีงบประมาณ");
			return false;
		}
		
		var provinceid = $('select[name=provinceid]').val();
		
		$.post('inspect_save/projectlist',{
				'provinceid' : provinceid,
				'budgetyear' : budgetyear
			},function(data){
				$("#projectlist").html(data);
				$('.loading').hide();
			});
	});
	
	// ------------------
	
	$(".btn_save").click(function(){
		$("select,textarea,input").removeAttr("disabled");
		$("input[name='status']").val("บันทึกข้อมูล");
	});
	
	$(".btn_chk_frm").click(function(){
		$("select,textarea,input").removeAttr("disabled");
		$("input[name='status']").val("ระหว่างการตรวจสอบ");
	});
	
	$(".btn_pass").click(function(){
		$("select,textarea,input").removeAttr("disabled");
		$("input[name='status']").val("ผ่านการตรวจสอบแล้ว");
	});
	
	$(".btn_notpass").click(function(){
		$("select,textarea,input").removeAttr("disabled");
		$("input[name='status']").val("ไม่ผ่านการตรวจสอบ");
	});
	
	$('.btn_search').click(function(){
		var budgetyear = $("select[name='budgetyear']").val();
		var provincearea = $("select[name='provincearea']").val();
		var provinceid = $("select[name='provinceid']").val();
		var projectid = $("select[name='projectid']").val();
		
		if(budgetyear == ""){
			alert("กรุณาเลือกปีงบประมาณ");
			return false;
		}
		if(provincearea == ""){
			alert("กรุณาเลือกเขต");
			return false;
		}
		if(provinceid == ""){
			alert("กรุณาเลือกจังหวัด");
			return false;
		}
		if(projectid == ""){
			alert("กรุณาเลือกโครงการ");
			return false;
		}
	});
	
});
</script>

<!-- is_inspector <?php echo login_data('is_inspector')?><br>
divisionid <?php echo login_data('divisionid')?> -->


<form method="get" >
<h3>บันทึก ผลการดำเนินงาน</h3>
<div id="search">
<div id="searchBox">
  <?php if(login_data('is_inspector') == 'on'): // ถ้าเป็นผู้ตรวจ ?>
  	<select name="budgetyear" id="budgetyear_inspect">
	    <option value="">-- เลือกปีงบประมาณ --</option>
	    <?php foreach($byear as $item){
	    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
	    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
	    }
	    ?>
	</select>
	<div id="dvAreaID" style="display:inline"></div>
		
	<div id="dvProvinceID" style="display:inline">
    	<?php
	   		// ถ้ามีค่า get มาจาก url
	   		if(@$_GET['provinceid']){
	   			echo form_dropdown('provinceid',get_option('id', 'title', 'CNF_PROVINCE where area = '.$_GET['provincearea']),@$_GET['provinceid']);
	   		}
	   ?>
    </div>
    <br />
		    
	<div id="projectlist" style="display: inline;"></div> 
		
  <?php else: //ถ้าไม่ใช่่ผู้ตรวจ ?>
  	<select name="budgetyear" id="budgetyear_user">
	    <option value="">-- เลือกปีงบประมาณ --</option>
	    <?php foreach($byear as $item){
	    	$selected = @$_GET['budgetyear'] == $item['byear'] ? " selected=selected" :  "";
	    	echo '<option value="'.$item['byear'].'" '.$selected.' >'.($item['byear']+543).'</option>';
	    }
	    ?>
	</select>
   <?php echo form_dropdown('provincearea',get_option('id', 'title', 'cnf_province_area where id = '.$_GET['provincearea']),$_GET['provincearea']) // เขตของ user?>
   	<?php echo form_dropdown('provinceid',get_option('id', 'title', 'cnf_province where id = '.$_GET['provinceid']),$_GET['provinceid']) // จังหวัดของ user?>
   <br />
	  <div id="projectlist" style="display: inline;">
	  	<?php if(@$_GET['budgetyear'] != ""):?>
		<select name="projectid" id="projectid">
		    <option value="">-- เลือกรายชื่อโครงการ --</option>
		    <?php foreach($projectlist as $item){
		    	$selected = @$_GET['projectid'] == $item['id'] ? " selected=selected" :  "";
				$item['projecttitle'] = $item['projecttitle'] == "" ?"":" (".$item['projecttitle'].")";
		    	echo '<option value="'.$item['id'].'" '.$selected.' >'.$item['title'].$item['projecttitle'].'</option>';
		    }
		    ?>
		</select>
		<?php endif;?>
	 </div> 
  <?php endif;?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  <img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:sub; display: none;'>
</div>
</div>
</form>

<? if(@$_GET['budgetyear'] > 0 && @$_GET['projectid'] > 0 && @$_GET['provincearea'] > 0 ){ ?>
<form name="fmsave" enctype="multipart/form-data" method="post" action="inspect_save/save?budgetyear=<?=$_GET['budgetyear'];?>&projectid=<?=$_GET['projectid'];?>&provincearea=<?=$_GET['provincearea'];?>&provinceid=<?=$_GET['provinceid'];?>">
<div style="padding-bottom:10px;">	
<? 
	if($roundresult){
		foreach($roundresult as $round):
		echo '<a href="inspect_report/index/'.$_GET['budgetyear'].'/'.@$_GET['projectid'].'/'.@$_GET['provincearea'].'/'.@$_GET['provinceid'].'/'.$round['roundno'].'" target="_parent">'.$round['round_name'].'</a>';
			
			$sql = "SELECT distinct status FROM INSP_PROJECT_RISK_SAVE where roundno = ".$round['roundno']." and provinceid = ".@$_GET['provinceid']." and budgetyear = ".$_GET['budgetyear']." and projectid = ".@$_GET['projectid']." and provinceareaid = ".@$_GET['provincearea'];
			$status = $this->db->getOne($sql);
			dbConvert($status);
			echo " <span style='color:red; font-size:11px;' >(สถานะ : ".$status.")</span> | ";
		endforeach;
	}
?> 	
</div>
<div id="tabs">
<ul>
  <li><a href="#tabs-1">ประเมินความเสี่ยง</a></li>
  <li><a href="#tabs-2">ความคืบหน้าการดำเนินงานโครงการ</a></li>
</ul>

<div id="tabs-1">
<table class="tblist3">
<tr>
  <th>วัตถุประสงค์ของโครงการ <br />
    (A) </th>
  <th>ประเภทความเสี่ยงที่พบ<br />
    (หน่วยรับตรวจรายงานผล)<br />
    (B)</th>
  <th>วิธีการจัดการความเสี่ยง<br />
    (หน่วยรับตรวจรายงานผล)<br />
    (C)</th>
</tr>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B1 ) Key Risk area</strong></td>
	  <td><strong>( C1 ) Key Risk area</strong></td>
</tr>
<?php echo $keyRiskDataList;?>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B2 ) Political Risk</strong></td>
	  <td><strong>( C2 ) Political Risk</strong></td>
</tr>
<?php echo $politicalRiskDataList;?>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B3 ) Negotiation Risk</strong></td>
	  <td><strong>( C3 ) Negotiation Risk</strong></td>
</tr>
<?php echo $negotiationRiskDataList;?>
<tr class="topic">
	  <td>&nbsp;</td>
	  <td><strong>( B4 ) Other (อื่นๆ)</strong></td>
	  <td><strong>( C4 ) Other (อื่นๆ)</strong></td>
</tr>
<?php echo $otherRiskDataList;?>
<tr>
	<td class="td-header"><strong>เหตุผลผู้ตรวจ</strong></td>
	<td colspan="2">
		<div id="reason_area"><textarea name="reason" style="width:100%; height: 60px;"><?php echo @$reason?></textarea></div>
		<div id="reason"><?php echo @$reason?></div>
	</td>
</tr>
</table>
<?php if(permission('inspect_save', 'canadd')):?>
<div id="btnBoxAdd">
  <?php if(login_data('is_inspector') == 'on'):?> 
  <input name="input" type="submit" title="ผ่านการตรวจสอบ" value=" " class="btn_pass">
  <input name="input" type="submit" title="ไม่ผ่านการตรวจสอบ" value=" " class="btn_notpass">
  <?php else:?>
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input" type="submit" title="ส่ง สตป." value=" " class="btn_chk_frm">
  <?php endif;?>
  <input type="hidden" name="status" value="บันทึกข้อมูล">
</div>
<?php endif;?>
<?php if(permission('inspect_save', 'canadd')):?>
	<?php if(login_data('insp_access_all') == 'on'):?> 
		<input class="return_status" name="input" type="submit" title="ย้อนกลับขั้นตอนก่อนหน้า" value="ย้อนกลับขั้นตอนก่อนหน้า" class="">
	<?php endif;?>
<?php endif;?>
</div>

    
    <div id="tabs-2">
        <table class="tblist">
        <tr>
          <th align="left">ลำดับ</th>
          <th align="left">รายงานกิจกรรมหลัก / กิจกรรมย่อย</th>
          <th align="left">สถานะการดำเนินงาน</th>
         </tr>
        <?php $i = 1;?> 
        <?php foreach($mainactivity as $key=>$m_act):?>
		  <tr class="cursor odd" onclick="document.location='inspect_save/progress_form/<?php echo $_GET['budgetyear']?>/<?php echo $_GET['projectid']?>/<?php echo $_GET['provincearea']?>/<?php echo $_GET['provinceid'] == "" ? 0 : $_GET['provinceid']?>/<?php echo $m_act['id']?>'">
          <td><?php echo $i?></td>
          <td nowrap="nowrap"><?php echo $m_act['actitle']?></td>
          <td>
          	<?php
          		$progress_status = $this->progress->select("status")->where("mainacid = ".$m_act['id']." and budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provincearea = ".$_GET['provincearea']." and province = ".$_GET['provinceid'])->get_one();
				echo @$progress_status == 1 ? "ดำเนินการแล้ว" : "ยังไม่ดำเนินการ" ;
          	?>
          </td>
          </tr>
          <?php
          	$subacs = $this->sub_activity->where("budgetyear = ".$_GET['budgetyear']." and projectid = ".$_GET['projectid']." and provincearea = ".$_GET['provincearea']." and provinceid = ".$_GET['provinceid']." and mainacid = ".$m_act['id'])->get();
			foreach($subacs as $subac):
          ?>
          	<tr>
	          <td>&nbsp;</td>
	          <td><?php echo $subac['title']?></td>
	          <td>&nbsp;</td>
	        </tr>
          <?php endforeach?>
        <?php $i++;?>
		<?php endforeach;?>
        </table>
        <div class="clear"></div>
    </div>

</div>

</form>
<? } ?>

<?php
	// หา ไอดี ที่มากที่สุด ของจำนวนรอบในปีที่กำหนด
	$sql = "SELECT max(insp_round_detail.id) FROM INSP_ROUND
			left join insp_round_detail on INSP_ROUND.id = insp_round_detail.round_id where mt_year = ".@$_GET['budgetyear'];
	$count = $this->db->getOne($sql);
	// echo $sql."<br><br>";
	
	// เอา max ไอดีของรอบที่ได้มาเทียบกับ INSP_PROJECT_RISK_SAVE ถ้า roundno = max ไอดี ของรอบแสดงว่าวนครบรอบสุดท้ายแล้ว (จบโครงการ ซ่อนปุ่มบันทึกกับปุ่มส่งต่อสตป)
	$sql = "SELECT count(distinct status) FROM INSP_PROJECT_RISK_SAVE where roundno = ".$count." and budgetyear = ".@$_GET['budgetyear']." and projectid = ".@$_GET['projectid']." and provinceid = ".@$_GET['provinceid']." and status = 'ผ่านการตรวจสอบแล้ว'";
	$sql = iconv('UTF-8','TIS-620',$sql);
	$count = $this->db->getOne($sql);
	// echo $sql;
	// echo $count;
?>

<?php
	// --- เช็คผู้ตรวจถ้าเป็น all area (ถ้า return = 0 ดูได้อย่างเดียว) ---
	if(login_data('INSP_ACCESS_ALL') == 'on' && isset($_GET['provincearea'])){
		$inspuser = $this->insp_group->get_row('users_id',login_data('id'));
		$pa = explode(",",@$inspuser['province_area']);
		$return = in_array(@$_GET['provincearea'] , $pa);
	}
?>

<script type="text/javascript">
$(document).ready(function(){
	var status = "<?php echo @$status?>";
	var user = "<?php echo login_data('is_inspector')?>";
	var access_all = "<?php echo login_data('INSP_ACCESS_ALL')?>";
	var chk_inspect_area_in_access_all = "<?php echo @$return?>";
	
	if(user == 'on'){ //--- ถ้าเป็นผู้ตรวจ ---
		$("#reason").hide();
		switch (status) {			
		   case 'ระหว่างการตรวจสอบ':
		   		$("#btnBoxAdd").show();
				$("form[name=fmsave] textarea").not("textarea[name='reason']").attr("readonly",true);
		   		$("form[name=fmsave] select").attr("disabled",true);
		   break;
		   case 'บันทึกข้อมูล':
		   case 'ผ่านการตรวจสอบแล้ว':
		   case 'ไม่ผ่านการตรวจสอบ':
			$("#btnBoxAdd").hide();
		   	$("form[name=fmsave] textarea").attr("readonly",true);
		   	$("form[name=fmsave] select").attr("disabled",true);
		      break;
		   default:
		    $("#btnBoxAdd").hide();
		    $("form[name=fmsave] textarea").attr("readonly",true);
		   	$("form[name=fmsave] select").attr("disabled",true);
		}
		if(status != 'ระหว่างการตรวจสอบ'){
			if(access_all == 'on' && chk_inspect_area_in_access_all == 0){
				$("#btnBoxAdd").hide();
			   	$("form[name=fmsave] textarea").attr("readonly",true);
		   		$("form[name=fmsave] select").attr("disabled",true);
			}
		}
	}else{
		$("#reason_area").hide();
		switch (status) {
		   case 'ระหว่างการตรวจสอบ':
			$("#btnBoxAdd").hide();
			$("form[name=fmsave] textarea").attr("readonly",true);
		   	$("form[name=fmsave] select").attr("disabled",true);
		      break;
		   case 'ผ่านการตรวจสอบแล้ว':
			var count = "<?php echo @$count?>";
			// alert(count);
			if(count > 0){
				$("#btnBoxAdd").hide();
			}
			  break;
		  //default:
		  	//$(".fright textarea").attr("readonly",true);
		}
	}
});
</script>

<script type="text/javascript">
$(document).ready(function(){
	$(".return_status").click(function(){
		if(confirm("ยืนยันการย้อนกลับขั้นตอนก่อนหน้า สถานะของขั้นตอนก่อนหน้าจะถูกเปลี่ยนสถานะเป็น ระหว่างการตรวจสอบ")){
			var budgetyear = "<?=@$_GET['budgetyear']?>";
			var projectid = "<?=@$_GET['projectid']?>";
			var provincearea = "<?=@$_GET['provincearea']?>";
			var provinceid = "<?=@$_GET['provinceid']?>";
			
			$.get('inspect_save/return_data',{
				'budgetyear':budgetyear,
				'projectid':projectid,
				'provincearea':provincearea,
				'provinceid':provinceid
			},function(data){
				location.reload();
			});
		}
		return false;
	});
	
	var lastRound = '<?=$round['roundno']?>';
	if(lastRound == 1){
		$('.return_status').hide();
	}
	
	// alert('ขอความร่วมมือจังหวัดพิจารณา (โปรดอ่าน!!!)\n\n1. ในแถบการประเมินความเสี่ยงช่อง B  ขอให้หน่วยรับตรวจให้เหตุผล (ประเด็นความเสี่ยง) ในแต่ละประเภทความเสี่ยง (K P N ) เพื่อจะได้วิเคราะห์ว่าวิธีการจัดการความเสี่ยงมีความเหมาะสมหรือไม่ จึงขอให้หน่วยรับตรวจกรอกข้อมูลให้ครบทุกข้อ \n\n2. ในแถบการประเมินความเสี่ยงช่อง C ขอให้หน่วยรับตรวจให้มาตรการจัดการความเสี่ยงให้ด้วย \n\n3. ในแถบความคืบหน้าการดำเนินงาน ขอให้หน่วยรับตรวจบันทึกผลการดำเนินงานลงในช่องกิจกรรมย่อยด้วย และสามารถแนบเอกสารอ้างอิง เข่น รายงานการประชุม ภาพถ่าย หนังสือ ฯลฯ \n\n4. ขอให้หน่วยรับตรวจบันทึกผลการเบิกจ่ายงบประมาณในเมนูผลการเบิกจ่ายงบประมาณ จึงขอให้ดำเนินการให้ครบถ้วน \n\n5. เมื่อดำเนินการเรียบร้อย บันทึกข้อมูลลงในระบบแล้ว ขอให้หน่วยรับตรวจคลิ๊กที่ เมนู ส่งให้สตป.');
});
</script>