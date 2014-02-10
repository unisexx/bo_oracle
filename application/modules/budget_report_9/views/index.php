<h3 id="topic"><br />แผนงบประมาณรายจ่ายประจำปีงบประมาณ <?php echo $thyear;?></h3>
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="" method="get">
<fieldset>
    <legend> ค้นหา </legend>
<table id="tbsearch">
<tr>
	<th>ปีงบประมาณ</th>
    <td>
        <?php echo form_dropdown('year',get_option('(byear-543) as byear_id','byear','cnf_set_time',' 1=1 order by byear'),$year,'','เลือกปีงบประมาณ'); ?>
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
        <?php echo form_dropdown('productivity',get_option('id','title','cnf_strategy','productivityid = 0 AND sectionstrategyid > 0 AND syear='.$year),$productivity,'','เลือกผลผลิต'); ?>
      </div>
    &nbsp;</td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td>
    <div id="dvMainActivity">
        <?php
        $condition = $productivity != '' ? " AND PRODUCTIVITYID=".$productivity : "";
        echo form_dropdown('mainactivity',get_option('id','title','cnf_strategy','MAINACTID = 0 AND BUDGETPOLICYID > 0 AND SYEAR='.$year.$condition),$mainactivity,'','เลือกกิจกรรมหลัก') ?>
      </div>
    &nbsp;</td>
</tr>
<tr>
  <th>ภาค</th>
  <td><?php echo form_dropdown('pzone',get_option('id','title','cnf_province_zone'),@$_GET['zone'],'id="pzone"','ภาคทั้งหมด') ?></td>
</tr>
<tr>
  <th>กลุ่มจังหวัด</th>
  <td><?php echo form_dropdown('pgroup',get_option('id','description','cnf_province_group','1=1 order by description'),@$_GET['group'],'','กลุ่มจังหวัดทั้งหมด') ?></td>
</tr>
<tr>
  <th>จังหวัด</th>
  <td><div id="dvProvinceList">
    <?php echo form_dropdown('province',get_option('id','title','cnf_province','1=1 order by title'),@$_GET['province'],'','เลือกจังหวัด','0'); ?>
  </div></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><div id="dvSectionList">
  	<?php echo form_dropdown('division',get_option('id','title','cnf_division','1=1 order by title'),@$_GET['division'],'','เลือกหน่วยงาน','0') ?>
  </div></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><div id="dvWorkgroupList">
    <?php
     $scondition = (!empty($_GET['division'])) ? " divisionid=".$_GET['division']." " : "";
     echo form_dropdown('workgroup',get_option('id','title','cnf_workgroup',$condition),@$_GET['workgroup'],'','เลือกทุกกลุ่ม','0') ?>
  </div></td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td>
    <input type="submit" id="btnSubmit" name="btnSubmit" value="ค้นหา" class="btn_search" />
    </td>
</tr>
</table>
</fieldset>
</form>
</div>
<script type="text/javascript">
function LoadProvinceZone(pZone)
{
	document.getElementById('pgroup').value = '';
	url = 'include/admin/ajax_province_list.php?zone='+pZone;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvProvinceList');

	url = 'include/admin/ajax_section_list.php?zone='+pZone;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvSectionList');

	url = 'include/admin/ajax_workgroup_list.php?zone='+pZone;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');
}
function LoadProvinceGroup(pGroup)
{
	document.getElementById('pzone').value = '';
	url = 'include/admin/ajax_province_list.php?group='+pGroup;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvProvinceList');

	url = 'include/admin/ajax_section_list.php?group='+pGroup;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvSectionList');

	url = 'include/admin/ajax_workgroup_list.php?group='+pGroup;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');

}
function LoadSection(pProvince)
{
	url = 'include/admin/ajax_section_list.php?province='+pProvince;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvSectionList');

	url = 'include/admin/ajax_workgroup_list.php?province='+pProvince;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');
}
function LoadWorkgroup(pSection)
{
	url = 'include/admin/ajax_workgroup_list.php?section='+pSection;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');

}
function LoadProductivity(pYear,pControl)
{
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':'productivity'
	},function(data){
		$("#"+pControl).html(data);
	})
}
function LoadMainActivity(pYear,pProductivity,pControl)
{
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':'main',
		'productivity':pProductivity
	},function(data){
		$("#"+pControl).html(data);
	})
}
function LoadSubActivity(pYear,pProductivity,pMainActivity,pControl)
{
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':'sub',
		'productivity':pProductivity,
		'mainactivity':pMainActivity
	},function(data){
		$("#"+pControl).html(data);
	})

}
<script>

$(document).ready(function(){
  $('select[name=productivity]').chainedSelect({parent: 'select[name=year]',url: 'ajax/ajax_productivity_list',value: 'id',label: 'text'});



})
</script>
