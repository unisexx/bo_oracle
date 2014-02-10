<h3>ตั้งค่า มิติและตัวชี้วัด</h3>
<!--<div class="allstrategy"><img src="../images/tree/department.png" /> กรม | <img src="../images/tree/down.png" />  เป้าหมายการให้บริการกระทรวง | <img src="../images/tree/cube.png"/> ยุทธศาสตร์กระทรวง  | <img src="../images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | <img src="../images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน   | <img src="../images/tree/asterisk.png" /> ผลผลิต  |  <img src="../images/tree/layout_sidebar.png" /> กิจกรรมหลัก(กรม)  | <img src="../images/tree/file.gif" /> กิจกรรมย่อย | <img src="../images/tree/project_ico.png" /> โครงการ | <img src="../images/tree/subproject_ico.png" /> โครงการย่อย </div>-->
<style>
.btn_upico{
width:16px;
height:16px;
border: none;
background: transparent url(images/tree/moveup.png) no-repeat center;
overflow: hidden;
line-height: 0px;
display:inline;
color: #a63606;
cursor: pointer; /* hand-shaped cursor */
cursor: hand; /* for IE 5.x */
margin-left:20px;
}

.btn_downico{
width:16px;
height:16px;
border: none;
background: transparent url(images/tree/movedown.png) no-repeat center;
overflow: hidden;
line-height: 0px;
display:inline;
color: #a63606;
cursor: pointer; /* hand-shaped cursor */
cursor: hand; /* for IE 5.x */
margin-left:5px;
}
</style>

<script language='javascript'>
$(function(){
	function budget_year(){
		
			sch_budget_year = $('[name=sch_budget_year]').val();
			sch_indicator_id = '<?=@$_GET['sch_indicatorn']?>';
			
			$('[name=sch_indicatorn]').attr('disabled', 'disabled');
			$.get('<? echo site_url(); ?>mds_set_indicator/chain_indicator', {
				sch_budget_year:sch_budget_year,
				sch_indicator_id:sch_indicator_id
			}, function(data){
				$('[name=sch_indicatorn]').html(data);
				$('[name=sch_indicatorn]').removeAttr('disabled');
			});
		
	}	
	$('[NAME=sch_budget_year]').live('change', function(){budget_year()});
	budget_year();
	
	$('.btn_downico').live('click', function(){
		var id = $(this).attr('ref_id');
		var parent_id = $(this).attr('ref_parent');
		var indicator_id = $(this).attr('indicator_id');
		var metrics_on = parseInt($(this).attr('metrics_on'))+parseInt(1);
		var year = '<?=@$_GET['sch_budget_year']?>';
		if(confirm('ท่านต้องการเปลี่ยนลำดับตัวชี้วัด')) {
			document.location = 'mds_set_indicator/move_metrics/?id='+id+'&parent_id='+parent_id+"&indicator_id="+indicator_id+"&metrics_on="+metrics_on+"&year="+year+"&act=down";
		}
	});
	
	$('.btn_upico').live('click', function(){
		var id = $(this).attr('ref_id');
		var parent_id = $(this).attr('ref_parent');
		var indicator_id = $(this).attr('indicator_id');
		var metrics_on = parseInt($(this).attr('metrics_on'))-parseInt(1);
		var year = '<?=@$_GET['sch_budget_year']?>';
		if(confirm('ท่านต้องการเปลี่ยนลำดับตัวชี้วัด')) {
			document.location = 'mds_set_indicator/move_metrics/?id='+id+'&parent_id='+parent_id+"&indicator_id="+indicator_id+"&metrics_on="+metrics_on+"&year="+year+"&act=up";
		}
	});
	
	$('.btn_deleteico').live('click', function(){
		if(confirm('ท่านต้องการที่จะลบข้อมูล')) {
			document.location = $(this).attr('link');
		}
	});
	
});
</script>
เลือกแสดง
<form method="GET">
<div id="search">
<div id="searchBox">
ปีงบประมาณ <?php echo form_dropdown('sch_budget_year',get_year_option('2556'),@$_GET['sch_budget_year'],'','-- เลือกปีงบประมาณ --'); ?>
 มิติที่  <?php echo form_dropdown('sch_indicatorn',get_option('id','indicator_name',"mds_set_indicator where budget_year = '".@$_GET['sch_budget_year']."' "),@$_GET['sch_indicatorn'],'','-- เลือกชื่อมิติ --'); ?> 
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</div>
</form> 
<? if(@$_GET['sch_budget_year'] != ''){ ?>
<div id="btnBox"><input type="button" title="เพิ่มมิติ" value=" " onclick="document.location='<?=$urlpage?>/form/<?=@$_GET['sch_budget_year']?>'" class="btn_add vtip"/></div>
<div id="sidetreecontrol" style="margin-top:10px;"><a href="#">Collapse All</a> | <a href="#">Expand All</a></div>

<ul id="tree" class="filetree">
<?
	foreach ($rs as $key => $indicator) { ?>
		<ul><li><img src="images/tree/plan_ico.png" /> มิติที่ <?php echo @$indicator['indicator_on']; ?> : <?php echo @$indicator['indicator_name']; ?>
		<input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดในมิตินี้"  onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>'"/>
		<input type="button" class="btn_editico vtip" title="แก้ไขมิตินี้"  onclick="document.location='<?=$urlpage?>/form/<?=@$_GET['sch_budget_year']?>/<?=@$indicator['id']?>'" />
		<input type="button" class="btn_deleteico vtip" link="<?=$urlpage?>/delete/<?=@$_GET['sch_budget_year']?>/<?=@$indicator['id']?>" title="ลบมิตินี้" />
		
		<? 
			$sql_sub_1 = "select id,metrics_name,metrics_on,parent_id from mds_set_metrics where mds_set_indicator_id = '".@$indicator['id']."' and parent_id = '0' order by metrics_on asc  ";
			$result_sub_1 = $this->metrics->get($sql_sub_1);
			$sub_1_all = count($result_sub_1);
			foreach ($result_sub_1 as $key_sub_1 => $sub_1) {	
		?>
			<ul><li><img src="images/tree/page.png" /> <?=@$sub_1['metrics_on']?>. <?=@$sub_1['metrics_name']?>    
			<? 
				if(($key_sub_1+1) < $sub_1_all && $key_sub_1 == 0){ ?>
				<input type="button" class="btn_downico vtip" title="เลื่อนลง" ref_id = "<?=@$sub_1['id']?>" ref_parent = "0" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_1['metrics_on']?>"  style="margin-left:20px" />
			<? }else if(($key_sub_1+1) < $sub_1_all && $key_sub_1 > 0){ ?>
				<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น"  ref_id = "<?=@$sub_1['id']?>" ref_parent = "0" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_1['metrics_on']?>" />
				<input type="button" class="btn_downico vtip" title="เลื่อนลง"  ref_id = "<?=@$sub_1['id']?>" ref_parent = "0" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_1['metrics_on']?>"  />
			<? }else if(($key_sub_1+1) == $sub_1_all && $key_sub_1 > 0){ ?>
				<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "<?=@$sub_1['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_1['metrics_on']?>" ref_parent = "0"/>
			<? } ?>
			<input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดย่อย" onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>/<?=@$sub_1['id']?>/add'" />
			<input type="button" class="btn_editico vtip" title="แก้ไขตัวชี้วัดนี้" onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>/<?=@$sub_1['id']?>'" />
			<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" link="<?=$urlpage?>/delete_metrics/<?=@$_GET['sch_budget_year']?>/<?=@$sub_1['id']?>" />
			
				<? 
					$sql_sub_2 = "select id,metrics_name,metrics_on,parent_id from mds_set_metrics where mds_set_indicator_id = '".@$indicator['id']."' and parent_id = '".@$sub_1['id']."' order by metrics_on asc  ";
					$result_sub_2 = $this->metrics->get($sql_sub_2);
					$sub_2_all = count($result_sub_2);
					foreach ($result_sub_2 as $key_sub_2 => $sub_2) {	
				?>
					<ul><li><img src="images/tree/page.png" /> <?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?> <?=@$sub_2['metrics_name']?>    
					<? 
						if(($key_sub_2+1) < $sub_2_all && $key_sub_2 == 0){ ?>
						<input type="button" class="btn_downico vtip" title="เลื่อนลง" ref_id = "<?=@$sub_2['id']?>" ref_parent = "<?=@$sub_1['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_2['metrics_on']?>" style="margin-left:20px" />
					<? }else if(($key_sub_2+1) < $sub_2_all && $key_sub_2 > 0){ ?>
						<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "<?=@$sub_2['id']?>" ref_parent = "<?=@$sub_1['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_2['metrics_on']?>"/>
						<input type="button" class="btn_downico vtip" title="เลื่อนลง"  ref_id = "<?=@$sub_2['id']?>" ref_parent = "<?=@$sub_1['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_2['metrics_on']?>" />
					<? }else if(($key_sub_2+1) == $sub_2_all && $key_sub_2 > 0){ ?>
						<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "<?=@$sub_2['id']?>" ref_parent = "<?=@$sub_1['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_2['metrics_on']?>" />
					<? } ?>
					<input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดย่อย" onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>/<?=@$sub_2['id']?>/add'" />
					<input type="button" class="btn_editico vtip" title="แก้ไขตัวชี้วัดนี้" onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>/<?=@$sub_2['id']?>'" />
					<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" link="<?=$urlpage?>/delete_metrics/<?=@$_GET['sch_budget_year']?>/<?=@$sub_2['id']?>" />
					
					<? 
						$sql_sub_3 = "select id,metrics_name,metrics_on,parent_id from mds_set_metrics where mds_set_indicator_id = '".@$indicator['id']."' and parent_id = '".@$sub_2['id']."' order by metrics_on asc  ";
						$result_sub_3 = $this->metrics->get($sql_sub_3);
						$sub_3_all = count($result_sub_3);
						foreach ($result_sub_3 as $key_sub_3 => $sub_3) {	
					?>
						<ul><li><img src="images/tree/page.png" /> <?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?> <?=@$sub_3['metrics_name']?>    
						<? 
							if(($key_sub_3+1) < $sub_3_all && $key_sub_3 == 0){ ?>
							<input type="button" class="btn_downico vtip" title="เลื่อนลง" ref_id = "<?=@$sub_3['id']?>" ref_parent = "<?=@$sub_2['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_3['metrics_on']?>" style="margin-left:20px" />
						<? }else if(($key_sub_3+1) < $sub_3_all && $key_sub_3 > 0){ ?>
							<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "<?=@$sub_3['id']?>" ref_parent = "<?=@$sub_2['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_3['metrics_on']?>" />
							<input type="button" class="btn_downico vtip" title="เลื่อนลง" ref_id = "<?=@$sub_3['id']?>" ref_parent = "<?=@$sub_2['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_3['metrics_on']?>" />
						<? }else if(($key_sub_3+1) == $sub_3_all && $key_sub_3 > 0){ ?>
							<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "<?=@$sub_3['id']?>" ref_parent = "<?=@$sub_2['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_3['metrics_on']?>" />
						<? } ?>
						<input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดย่อย" onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>/<?=@$sub_3['id']?>/add'" />
						<input type="button" class="btn_editico vtip" title="แก้ไขตัวชี้วัดนี้" onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>/<?=@$sub_3['id']?>'" />
						<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" link="<?=$urlpage?>/delete_metrics/<?=@$_GET['sch_budget_year']?>/<?=@$sub_3['id']?>" />
						
							<? 
								$sql_sub_4 = "select id,metrics_name,metrics_on,parent_id from mds_set_metrics where mds_set_indicator_id = '".@$indicator['id']."' and parent_id = '".@$sub_3['id']."' order by metrics_on asc  ";
								$result_sub_4 = $this->metrics->get($sql_sub_4);
								$sub_4_all = count($result_sub_4);
								foreach ($result_sub_4 as $key_sub_4 => $sub_4) {	
							?>
								<ul><li><img src="images/tree/page.png" /> <?=@$sub_1['metrics_on']?>.<?=@$sub_2['metrics_on']?>.<?=@$sub_3['metrics_on']?>.<?=@$sub_4['metrics_on']?> <?=@$sub_4['metrics_name']?>    
								<? 
									if(($key_sub_4+1) < $sub_4_all && $key_sub_4 == 0){ ?>
									<input type="button" class="btn_downico vtip" title="เลื่อนลง" ref_id = "<?=@$sub_4['id']?>" ref_parent = "<?=@$sub_2['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_4['metrics_on']?>" style="margin-left:20px" />
								<? }else if(($key_sub_4+1) < $sub_3_all && $key_sub_4 > 0){ ?>
									<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "<?=@$sub_4['id']?>" ref_parent = "<?=@$sub_2['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_4['metrics_on']?>"/>
									<input type="button" class="btn_downico vtip" title="เลื่อนลง" ref_id = "<?=@$sub_4['id']?>" ref_parent = "<?=@$sub_2['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_4['metrics_on']?>" />
								<? }else if(($key_sub_4+1) == $sub_4_all && $key_sub_4 > 0){ ?>
									<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "<?=@$sub_4['id']?>" ref_parent = "<?=@$sub_3['id']?>" indicator_id="<?=@$indicator['id']?>" metrics_on="<?=@$sub_4['metrics_on']?>" />
								<? } ?>
								<input type="button" class="btn_editico vtip" title="แก้ไขตัวชี้วัดนี้" onclick="document.location='<?=$urlpage?>/form_2/<?=@$indicator['id']?>/<?=@$sub_4['id']?>'" />
								<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" link="<?=$urlpage?>/delete_metrics/<?=@$_GET['sch_budget_year']?>/<?=@$sub_4['id']?>" />
								</li></ul>
							<? } ?>
						
						</li></ul>
					<? } ?>
					
					</li></ul>
				<? } ?>
			
			</li></ul>
		<? } ?>
		</li></ul>
<?
	}
?>

</ul>
</div>
</div>
<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ</div>";
} ?>