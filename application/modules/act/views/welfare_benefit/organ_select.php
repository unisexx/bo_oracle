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
    opener.composeform_sub.organ_id.value = n
    opener.composeform_sub.organ_name.value = ngo
	window.close();
}

Cufon.replace('h1, h3, h4, h5, ul#navmenu-h');
</script>

<?php 
	$under_type_sub_arr = array('1'=>'ส่วนราชการ','2'=>'องค์กรปกครองส่วนท้องถิ่น','3'=>'มูลนิธิ','4'=>'สมาคม','5'=>'องค์กรภาคเอกชน','6'=>'(ถ้ามี)','7'=>'กลุ่มออมทรัพย์','8'=>'สหกรณ์','9'=>'ศูนย์พัฒนาครอบครัว','10'=>'องค์กรสวัสดิการชุมชน','11'=>'เครือข่ายองค์กรสวัสดิการชุมชน');
?>

<h2 style="font-size: 24px; color: orange;">องค์การสวัสดิการสังคม</h2>
<div id="search">
<div id="searchBox">
  <input type="text" name="textfield" placeholder="ชื่อหน่วยงาน" style="width:300px; height: auto;" />
  <select name="select">
    <option>-- ประเภทหน่วยงาน --</option>
    <option selected="selected">หน่วยงานของรัฐ</option>
    <option>องค์กรสาธารณประโยชน์</option>
    <option>องค์กรสวัสดิการชุมชน</option>
  </select>
  <select name="select2">
    <option>-- จังหวัด --</option>
  </select>
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>

<?php echo $pagination;?>

<table class="tblist">
<tr>
  <th align="left">รหัส</th>
  <th align="left">ชื่อหน่วยงาน</th>
  <th align="left">ที่อยู่</th>
</tr>
<?php $i=(isset($_GET['page']))? (($_GET['page'] -1)* 10)+1:1; ?>
<?php foreach($orgmains as $row):?>
<tr class="cursor" onclick="javascript:ins_name('<?php print $row['organ_id'] ?>','<?php print $row['organ_name']; ?>');">
  <td nowrap="nowrap"><?php echo $row['organ_id']?></td>
  <td><?php echo $row['organ_name']?></td>
  <td>
  	<?php echo ($row['o_name'])?$row['o_name']:"";?>
  	<?php echo ($row['home_no'])?" เลขที่ ".$row['home_no']:"";?>
  	<?php echo ($row['moo'])?" หมู่ที่ ".$row['moo']:"";?>
  	<?php echo ($row['soi'])?" ซ. ".$row['soi']:"";?>
  	<?php echo ($row['road'])?" ถ. ".$row['road']:"";?>
  	<?php echo ($row['tumbon_code'])?" &nbsp;ต. ".act_get_tumbon($row['province_code'],$row['ampor_code'],$row['tumbon_code']):"";?>
	<?php echo ($row['ampor_code'])?" &nbsp;อ. ".act_get_ampor($row['province_code'],$row['ampor_code']):"";?>
	<?php echo ($row['province_code'])?" &nbsp;จ. ".act_get_province($row['province_code']):"";?>
  </td>
</tr>
<?$i++;?> 
<?php endforeach;?>
</table>

<?php echo $pagination;?>