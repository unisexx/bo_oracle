<h3 id="topic">แผนงบประมาณรายจ่ายประจำปีงบประมาณ <?php echo $thyear;?></h3>
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="budget_report_9/index" method="get">
<fieldset>
    <legend> ค้นหา </legend>
<table id="tbsearch">
<tr>
	<th>ปีงบประมาณ</th>
    <td>
        <?php echo form_dropdown('year',get_option('(byear-543) as byear_id','byear','cnf_set_time',' 1=1 order by byear'),$year,'id="year"','เลือกปีงบประมาณ'); ?>
    </td>
</tr>
<tr>
	<th>ขั้นตอน </th>
    <td>
        <select name="step" id="step">
             <option value="1" <? if($step=='1')echo "selected";?>>ขั้นตอนที่ 1 : เสนอคำของงบประมาณ  </option>
             <option value="2" <? if($step=='2')echo "selected";?>>ขั้นตอนที่ 2 : ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ</option>
             <option value="3" <? if($step=='3')echo "selected";?>>ขั้นตอนที่ 3 : ปรับปรุงคำของบประมาณตามมติ ครม.</option>
             <option value="4" <? if($step=='4')echo "selected";?>>ขั้นตอนที่ 4 : ปรับปรุงคำของบประมาณตามมติ กระทรวง</option>
             <option value="5" <? if($step=='5')echo "selected";?>>ขั้นตอนที่ 5 : แปรญัตติเพิ่ม</option>
             <option value="6" <? if($step=='6')echo "selected";?>>ขั้นตอนที่ 6 : ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ</option>
             <option value="7" <? if($step=='7')echo "selected";?>>ขั้นตอนที่ 7 : รายละเอียดงบประมาณตาม พรบ.</option>
             <option value="8" <? if($step=='8')echo "selected";?>>ขั้นตอนที่ 8 : ปรับปรุงงบประมาณเพื่อการบริหาร</option>
          </select>
    </td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td>
    <div id="dvProductivity" >
        <?php echo form_dropdown('productivity',get_option1('id','title','cnf_strategy','PRODUCTIVITYID = 0 AND SECTIONSTRATEGYID > 0 AND SYEAR='.$year),$productivity,'id="productivity"','เลือกผลผลิต','0'); ?>
      </div>
	</td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td>
    <div id="dvMainActivity">
        <?php
        $condition = $productivity != '' ? " AND PRODUCTIVITYID=".$productivity : "";
        echo form_dropdown('mainactivity',get_option1('id','title','cnf_strategy','MAINACTID = 0 AND BUDGETPOLICYID > 0 AND SYEAR='.$year.$condition),$mainactivity,'id="mainactivity"','เลือกกิจกรรมหลัก','0') ?>
      </div>
    </td>
</tr>
<tr>
  <th>ภาค</th>
  <td><?php echo form_dropdown('pzone',get_option1('id','title ','cnf_province_zone','zone_type_id=2','id'),$pzone,'id="pzone"','ภาคทั้งหมด') ?></td>
</tr>
<tr>
  <th>กลุ่มจังหวัด</th>
  <td><?php echo form_dropdown('pgroup',get_option1('id','description','cnf_province_group','',' description'),@$_GET['group'],'id="pgroup"','กลุ่มจังหวัดทั้งหมด') ?></td>
</tr>
<tr>
  <th>จังหวัด</th>
  <td><div id="dvProvinceList">
    <?php echo form_dropdown('province',get_option1('id','title','cnf_province','','title'),@$_GET['province'],'id="province"','เลือกจังหวัด'); ?>
  </div></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><div id="dvSectionList">
  	<?php echo form_dropdown('division',get_option1('id','title','cnf_division','','title'),$division,'id="division"','เลือกหน่วยงาน'); ?>
  </div></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><div id="dvWorkgroupList">
    <?php
     $condition = (!empty($_GET['division'])) ? " divisionid=".$_GET['division']: "";
     echo form_dropdown('workgroup',get_option1('id','title','cnf_workgroup',$condition),$workgroup,'id="workgroup"','เลือกทุกกลุ่ม','0'); ?>
  </div></td>
</tr>
<tr>
  <th></th>
  <td><input type="submit" id="btnSubmit" name="btnSubmit" value="ค้นหา" class="btn_search" /></td>
</tr>
</table>
</fieldset>
</form>
</div>
<?php include('report.php') ?>
<script type="text/javascript">
<?php include('js/function.js'); ?>
$(document).ready(function(){
	$('#year').change(function(){
		LoadMainActivity(<?=$year;?>,$('#year option:selected').val(),'dvMainActivity');
		LoadSubActivity(<?=$year;?>,$('#year option:selected').val(),'','dvSubActivity');
	})
	$('#productivity').live('change',function(){
		pProductivity = $(this).val();
		//alert(pProductivity);
		LoadMainActivity(<?=$year;?>,$('#productivity option:selected').val(),'dvMainActivity');
		LoadSubActivity(<?=$year;?>,$('#productivity option:selected').val(),'','dvSubActivity');
	});
	$('#province').live('change',function(){
		var pProvince = $('#province option:selected').val();
		if(pProvince.length>0){
			LoadSection(pProvince);
		};
	});
	$('#division').live('change',function(){
		var pSection = $('#division option:selected').val();
		if(pSection.length>0){
			LoadWorkgroup(pSection);
		};
	})
});
</script>


