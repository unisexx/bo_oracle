<script type="text/javascript">
 $(document).ready(function(){
 	$(".btn_output").click(function(){
 		$(post)
 	})
 })		
</script>
<h3>ประวัติการใช้งาน</h3>
<form name="frmSearch" method="get" enctype="multipart/form-data" >
<div id="search">
<div id="searchBox">
ประวัติการใช้งาน
  <input name="txtsearch" type="text" size="40" value="<? echo @$_GET['txtsearch'];?>" />
  <select name="actiontype" id="actiontype">
	<option value="" selected="selected">ประเภทการใช้งาน</option>
	<option value="LOGIN" <? if(@$_GET['actiontype']=='LOGIN')echo 'selected="selected"';?>>เข้าสู่ระบบ</option>
	<option value="LOGOUT" <? if(@$_GET['actiontype']=='LOGOUT')echo 'selected="selected"';?>>ออกจากระบบ</option>
	<option value="VIEW" <? if(@$_GET['actiontype']=='VIEW')echo 'selected="selected"';?>>ดูรายละเอียดข้อมูล</option>
	<option value="ADD" <? if(@$_GET['actiontype']=='ADD')echo 'selected="selected"';?>>เพิ่มข้อมูล</option>
	<option value="EDIT" <? if(@$_GET['actiontype']=='EDIT')echo 'selected="selected"';?>>แก้ไขข้อมูล</option>
	<option value="DELETE" <? if(@$_GET['actiontype']=='DELETE')echo 'selected="selected"';?>>ลบข้อมูล</option>
  </select>  
  	<select name="system" id="system">
  		<option value="" selected="selected">ทุกระบบ</option>
		<option value="c" <? if(@$_GET['system']=='c')echo 'selected="selected"';?>>ข้อมูล Back office</option>
		<option value="budget" <? if(@$_GET['system']=='budget')echo 'selected="selected"';?>>ข้อมูลระบบจัดทำคำของบประมาณ</option>
		<option value="finance" <? if(@$_GET['system']=='finance')echo 'selected="selected"';?>>ข้อมูลระบบคลัง</option>
		<option value="monitor" <? if(@$_GET['system']=='monitor')echo 'selected="selected"';?>>ข้อมูลระบบติดตามและประเมินผล</option>
		<option value="inspect" <? if(@$_GET['system']=='inspect')echo 'selected="selected"';?>>ข้อมูลระบบตรวจราชการ</option>
    </select>  
วันที่ <input type="text" class="datepicker" name="start_date" id="start_date" style="width:90px;" value="<?=@$_GET['start_date'];?>"> 
ถึง <input type="text" class="datepicker" name="end_date" id="end_date" style="width:90px;" value="<?=@$_GET['end_date'];?>">    
<input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" /></div>
</div>
</form>


<div id="btnBox">  
  <input type="button" value="Export" > 
</div><br><br>

<table class="tblist">
<tr>
  <th>ลำดับ</th>
  <th align="left">จังหวัด</th>
  <th align="left">จำนวนการเข้าใช้</th>  
  </tr>
  <?php 
  $i=0;
  $rowStyle = '';  
  foreach($province as $row):
	  $i++;	  
  ?>  
<tr <? if($rowStyle =='')$rowStyle = 'class="odd"';else $rowStyle = "";echo $rowStyle;?> >
  <td><?=$i;?></td>
  <td ><?=$row['title'];?></td>
  <td id="td_output" ><input type="button" class="btn_output" id="btn_output" value="show"></td>             
</tr>
<? 		
  endforeach;
?>
</table>

<?
function calculate($province_id){
	$CI=& get_instance();
	$nuser = 0;
	$i=0;
	$start_date = '2012-07-01';
	$end_date = '2012-07-31';
	for($i=0;$i<=30;$i++){
		$date = strtotime(date("Y-m-d", strtotime($start_date)) . " +".$i." day");
		$sql = " select count(*) from (
		select distinct userid from
			(select user_logfile.id,date((timestamp('1970-01-01-00.00.00.0') + process_date seconds))c_process_date
			,userid, module_name,action, actiontype, users.name, cnf_workgroup.title as workgroup_title, 
			cnf_division.title as division_title, cnf_department.title as department_title,
			cpw.id cpw_id,cpw.title wprovince_name,cpd.id cpd_id, cpd.title dprovince_name
			from 
			user_logfile
			LEFT JOIN users ON user_logfile.userid=users.id
			LEFT JOIN cnf_department ON users.departmentid = cnf_department.id
			LEFT JOIN cnf_division ON users.divisionid = cnf_division.id
			LEFT JOIN cnf_workgroup ON users.workgroupid = cnf_workgroup.id 
			LEFT JOIN cnf_province cpw ON cnf_workgroup.wprovinceid = cpw.id
			LEFT JOIN cnf_province cpd ON cnf_division.provinceid = cpd.id
			)log_user
			where c_process_date in 
			(
				select distinct bc_process_date from (
					select date((timestamp('1970-01-01-00.00.00.0') + process_date seconds))bc_process_date	from user_logfile
				)
			)
		    and	module_name like '".$_GET['system']."%' 
			and c_process_date = '".date('Y-m-d', $date)."'
			and cpw_id = ".$province_id."
		) ";
		$nuser += $CI->db->getone($sql);
	}
	return $nuser;
}
?>
