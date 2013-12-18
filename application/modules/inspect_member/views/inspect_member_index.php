<script type="text/javascript">
$(document).ready(function(){
		$('.boxSub').hide();
   		
   		$(".showSub").click(function(){
			$(this).closest("tr").next("tr.boxSub").toggle();
			if($(this).closest("tr").next("tr.boxSub").is(':hidden')){
				$(this).html("<img src='themes/bo/images/tree/add.jpg' width='16' height='15' />");
			}else{
				$(this).html("<img src='themes/bo/images/tree/minimize.png' width='16' height='15' />");
			}
			return false;
		});
		
		$("select[name=budgetyear] option:not(:first)").each(function(){
			var engYear = $(this).text();
			var thaiYear = parseInt(engYear)+543;
			$(this).text(thaiYear);
		});
		
		$("select[name=areaid]").livequery("change",function(){
			var provincearea = $(this).val();
				
			$.post('c_province/select_province_from_area',{
					'provincearea' : provincearea
				},function(data){
					$("#dvProvinceID").html(data);																	
			});
		});
		
		$(".btn_delete").click(function(){
			var answer = confirm ("ยืนยันการลบข้อมูล?");		
			if (answer) {
				var roundno = $(this).parent("td").find("input[name=roundno]").val();
				var projectid = $(this).parent("td").find("input[name=projectid]").val();
				var budgetyear = $(this).parent("td").find("input[name=budgetyear]").val();
				var provinceid = $(this).parent("td").find("input[name=provinceid]").val();
				var createuser = $(this).parent("td").find("input[name=createuser]").val();
				
				$.post('inspect_member/delete_projectround',{
					'roundno' : roundno,
					'projectid' : projectid,
					'budgetyear' : budgetyear,
					'provinceid' : provinceid,
					'createuser' : createuser
				},function(data){
					//$("#bgpt").html(data);
				})
				
				$(this).closest("tr").fadeOut("normal",function(){$(this).remove();});
				
				return false;
			}
		});
		
		$(".tblistSub:not(:has(tr>td))").each(function(){
			$(this).closest("tr").prev("tr").find("a.showSub").hide();
		});
});
</script>

<h3>ผู้ดูแล ผู้ตรวจราชการ และสมาชิก</h3>
<div id="search">
<form method="get" action="inspect_member">
<div id="searchBox">
  <?php echo form_dropdown("budgetyear",get_option('mtyear','mtyear y2','mt_strategy'),@$_GET['budgetyear'],'','-- เลือกปีงบประมาณ --','0')?>
  
  <?php echo form_dropdown("projectid",get_option('id', "title", "insp_project"),@$_GET['projectid'],'','-- เลือกรายชื่อโครงการ --','0')?><br />

  <?php echo form_dropdown("areaid",get_option('id','title','cnf_province_area'),@$_GET['areaid'],'','-- เลือกเขต --','0')?>
  
  <div id="dvProvinceID" name="dvProvinceID" style="display:inline">
  	<?php echo form_dropdown("provinceid",get_option('id','title','cnf_province'),@$_GET['provinceid'],'','-- เลือกจังหวัด --','0')?>
  </div>
  <!-- <?php echo form_dropdown("createuser",get_option('createuser','name','insp_project_risk_save risk
left join users on risk.createuser = users.id group by risk.createuser,users.name '),@$_GET['createuser'],'class="mustChoose"','-- เลือกผู้ใช้งาน --')?> -->

  <?php echo form_dropdown("usertype",get_option('id','title','user_type_title'),@$_GET['usertype'],'','-- เลือกประเภทผู้ใช้งาน --','0')?> 
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</form>
</div>

<?php echo $pagination?>

<table class="tblist">
<tr>
  <th align="left">&nbsp;</th>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อผู้ใช้งาน</th>
  <th align="left">เขต</th>
  <th align="left">จังหวัด</th>
  <th colspan="2" align="left">กลุ่มสมาชิก</th>
  </tr>
  <?php foreach($users as $key=>$user):?>
  	<tr <?php echo cycle($key)?>>
	  <td><a href="#" class="showSub"><img src="themes/bo/images/tree/add.jpg" width="16" height="15" /></a></td>
	  <td><?php echo $key+1?></td>
	  <td nowrap="nowrap"><?php echo @$user['name']?> (<?php echo @$user['workgroup']?>)</td>
	  <td><?php echo @$user['area']?></td>
	  <td><?php echo @$user['province']?></td>
	  <td colspan="2"><?php echo @$user['usertype']?></td>
	</tr>
	
	<tr class="boxSub" style="display:none;">
	  <td colspan="6">
	  <table class="tblistSub">
		<tr>
		  <th width="60%">รายชื่อโครงการ</th>
		  <th>รอบ</th>
		  <th>ปีที่บันทึก</th>
		  <th>สถานะ</th>
		  <!--<th>จัดการ</th>-->
		</tr>
		<?php
			$sql = "SELECT M1.*,round_name FROM(SELECT DISTINCT ROUNDNO ,projectid,T2.title,T1.budgetyear,T1.approveuser,T1.status,createdate,createuser,provinceid,provinceareaid 
FROM INSP_PROJECT_RISK_SAVE T1
LEFT JOIN INSP_PROJECT T2 ON T1.projectid = T2.ID)M1
LEFT JOIN insp_round_detail on M1.roundno = insp_round_detail.id 
where (createuser = ".$user['id']." or approveuser = ".$user['id'].")";
			
			$projects = $this->memberlist->get($sql);
		?>
		<?php foreach($projects as $key=>$project):?>
			<tr class="odd cursor" onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>/form?budgetyear=<?php echo $project['budgetyear']?>&projectid=<?php echo $project['projectid']?>&provincearea=<?php echo $project['provinceareaid']?>&provinceid=<?php echo $project['provinceid']?>'" >
			  <td><?php echo $project['title']?> <?php echo "(".stamp_to_th_fulldate($project['createdate']).")"?></td>
			  <td><?php echo $project['round_name']?></td>
			  <td><?php echo $project['budgetyear']+543?></td>
			  <td><?php echo $project['status']?></td>
			</tr>
		<?php endforeach;?>
		</table>
	  </td>
	</tr>
  <?php endforeach;?>
</table>

<?php echo $pagination?>
