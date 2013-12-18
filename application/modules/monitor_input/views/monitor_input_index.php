<script type="text/javascript">
$(document).ready(function(){
	$("select[name=departmentid]").attr("class","mustChoose");
	
	<? if(@login_data("user_province_id")!=2){ ?>
		$("select[name=departmentid]").hide();
	<? } ?>	
})
</script>
<h3>สอบถาม การกรอกข้อมูลแต่ละจังหวัด หรือ หน่วยงาน</h3>
<form name="fsearch" enctype="multipart/form-data" method="get">
<div id="search">
<div id="searchBox">
  <select name="mode" class="mustChoose">
  	<option value="">-- เลือกประเภทการกรอกข้อมูล --</option>
  	<?
  		if(login_data('mt_access_all')=='on'){
  	?>
  	<option value="province" <? if(@$_GET['mode']=='province')echo "selected";?>>จังหวัด</option>
  	<option value="division" <? if(@$_GET['mode']=='division')echo "selected";?>>หน่วยงาน</option>
  	<? } ?>
  	<?
  		if(login_data('mt_access_all')=='off' && login_data('user_province_id')==2){
  	?>  	
  	<option value="division" selected="selected">>หน่วยงาน</option>
  	<? } ?>
  	<?
  		if(login_data('mt_access_all')=='off' && login_data('user_province_id')!=2){
  	?>
  	<option value="province"  selected="selected">จังหวัด</option>  	
  	<? } ?>
  </select>   
  <?php 
  $can_access_all = login_data('mt_access_all');
  $condition = $can_access_all != "off" ? "" : "id=".login_data('departmentid');
  $select_department = login_data('mt_access_all')=="on" ? @$_GET['departmentid'] : login_data("departmentid"); 
  echo form_dropdown('departmentid',get_option('id','title','cnf_department',$condition),$select_department,'','-- เลือกกรม --')
  ?>
  <select name="mtyear" id="mtyear" class="mustChoose">
    <option value="">-- เลือกปีงบประมาณ --</option>
    <?php foreach($mtyear as $item){
    	$selected =$_GET['mtyear']==$item['mtyear'] ? " selected=selected" :  "";
    	echo "<option value=\"".$item['mtyear']."\" $selected >".($item['mtyear']+543)."</option>";
    };?>
  </select>  
  <? $month_list = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'); ?>
    <select name="month" id="month" class="mustChoose">
      <option>-- เลือกเดือน --</option>
      <? 
      for($i=1;$i<count($month_list);$i++)
      {
      	$selected = @$_GET['month'] == $i ?  "selected" : "";	
      	echo '<option value="'.$i.'" '.$selected.'>'.$month_list[$i].'</option>';
	  }
      ?>      
    </select>
  <select name="status" id="status">
    <option selected="selected">-- ทุกสถานะ --</option>
    <option value="yes" <? if(@$_GET['status']=='yes')echo "selected";?>>กรอกข้อมูลแล้ว</option>
    <option value="no" <? if(@$_GET['status']=='no')echo "selected";?>>ยังไม่ได้กรอกข้อมูล</option>
  </select>
<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>
<? if(@$_GET['mode']!='' && @$_GET['mtyear']>0 && @$_GET['month']>0 && @$_GET['departmentid'] > 0){ ?>


<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left"><? if(@$_GET['mode']=="province")echo "จังหวัด";else echo "หน่วยงาน";?></th>
  <th align="left">สถานะ</th>
  <th align="left">เมื่อวันที่</th>
</tr>
  <? 
  $i=0;
  foreach($result as $item):
  $i++;
  $status = GetWithdrawStatus($_GET['mode'],$item['id'],$_GET['mtyear'],$_GET['month']);
  ?>
<tr>
	<td><?=$i;?></td>
	<td><?=$item['title'];?></td>
	<td>
		<? 
		if($status['status']>0){
			$url = "monitor_input/detail?mode=".@$_GET['mode']."&mtyear=".@$_GET['mtyear']."&month=".@$_GET['month']."&status=".@$_GET['status']."&departmentid=".@$_GET['departmentid']."&itemid=".$item['id']; 
		?>
			<a href='<?=$url;?>'>
			<img width="24" height="24" class="vtip" title="กรอกข้อมูลแล้ว" src="images/ico_input_ok.png">
			</a>
		<? }else{ ?>
			<img width="24" height="24" class="vtip" title="ยังไม่ได้กรอกข้อมูล" src="images/ico_input_no.png">
		<? } ?>
	</td>
	<td>
		<? if(@$status['savedate']>0)echo stamp_to_th($status['savedate']);?>
	</td>	
</tr>  
  <? endforeach;?>
</table>

<? } ?>