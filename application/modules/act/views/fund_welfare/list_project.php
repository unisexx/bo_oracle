<link rel="stylesheet" type="text/css" media="screen" href="../../themes/bo/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../../themes/bo/css/template.css">
<link rel="stylesheet" type="text/css" media="screen" href="../../themes/bo/css/pagination.css">
<script type="text/javascript" src="../../themes/bo/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../themes/bo/js/cufon/cufon-yui.js"></script>
<script type="text/javascript" src="../../themes/bo/js/cufon/supermarket_400.font.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(".tblist tr:odd").addClass("odd");
    $(".tblist tr:not(.odd)").addClass("even");  
});

function ins_name(n,ngo) {
    opener.composeform_sub.org_id.value = n;
    opener.composeform_sub.org_name.value = ngo;
	window.close();
}

function fill_value (project_id,project_name,fund_name,org_name) {
	opener.composeform_sub.project_continue.value = project_id;
    opener.composeform_sub.project_continue_name.value = project_name;
    opener.composeform_sub.project_continue_fund.value = fund_name;
    opener.composeform_sub.project_continue_org.value = org_name;
    
	window.close();
}

Cufon.replace('h1, h3, h4, h5, ul#navmenu-h');
</script>

<h2 style="font-size: 24px; color: orange;">ค้นข้อมูลโครงการ</h2>

<form action="" method="get">
<div id="search">
<div id="searchBox">
  <select name="budget_year">
      <option value="">-- ปีงบประมาณ --</option>
      <?php for ($x=date("Y")+543; $x>=2546; $x--):?>
      <option value="<?php echo $x?>" <?php echo ($x == @$_GET['budget_year'])?'selected':'';?>><?php echo $x?></option>
      <?php endfor;?>
    </select>
    <select name="fund_id">
    	<option value="">-- เลือกกองทุน --</option>
    	<?foreach($funds as $row):?>
    	<option value="<?=$row['fund_id']?>" <?=($row['fund_id'] == $_GET['fund_id'])?'selected':'';?>><?=$row['fund_name']?></option>
    	<?endforeach;?>
    </select>
    <input type="text" name="org_name" size="30" value="<?=@$_GET['org_name']?>" placeholder="องค์การ">
    <input type="text" name="project_name" size="30" value="<?=@$_GET['project_name']?>" placeholder="โครงการ">
<input type="submit" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th align="left">ชื่อองค์การ</th>
  <th align="left">โครงการ</th>
  <th align="left">รอบพิจารณาที่</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($lists as $row):?>
<tr class="cursor" onclick="javascript:fill_value('<?php print @$row['project_id']?>','<?php print @$row['project_name'];?>','<?php print @act_get_fund_name($row['fund_id']);?>','<?php print @$row['organ_name'];?>');">
  <td><?=$row['organ_name']; ?></td>
  <td><?=$row['project_name']?></td>
  <td><?=$row['round_no']?></td>
</tr>
<?$i++;?> 
<?php endforeach;?>
</table>

<?php echo $pagination;?>