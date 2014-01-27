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
	$('[NAME=sch_budget_year]').live('change', function(){
		sch_budget_year = $('[name=sch_budget_year]').val();
		sch_indicatorn_id = $('[name=sch_indicatorn]').val();
		
		$('[name=sch_indicatorn]').attr('disabled', 'disabled');
		$.get('<? echo site_url(); ?>mds_set_indicator/chain_indicator', {
			sch_budget_year:sch_budget_year,
			sch_indicatorn_id:sch_indicatorn_id
		}, function(data){
			$('[name=sch_indicatorn]').html(data);
			$('[name=sch_indicatorn]').removeAttr('disabled');
		});
	});	
});
</script>
เลือกแสดง
<form method="GET">
<div id="search">
<div id="searchBox">
ปีงบประมาณ <?php echo form_dropdown('sch_budget_year',get_year_option('2556'),@$_GET['sch_budget_year'],'','-- เลือกปีงบประมาณ --'); ?>
 มิติที่  <?php echo form_dropdown('sch_indicatorn',get_option('id','indicator_name','mds_set_indicator'),@$_GET['sch_indicatorn_name'],'','-- เลือกมิติ --'); ?> 
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
		<input type="button" class="btn_deleteico vtip" onclick="document.location='<?=$urlpage?>/delete/<?=@$_GET['sch_budget_year']?>/<?=@$indicator['id']?>'" title="ลบมิตินี้" />
		</ul></li>
<?
	}
?>

</ul>
</div>
</div>
<? }else{
	echo "<div align='center'>กรุณณาเลือกปีงบประมาณ</div>";
} ?>