<link rel='stylesheet' type='text/css' href='css/report.css'>

<h3>สรุปผลการจัดสรรเงิน คคด.01 (ค)</h3>
<form action='' method='get' id="search">
<div id="search">
<div id="searchBox">
  <? echo form_dropdown('budget_year', get_option('budget_year as a', 'budget_year as b', 'fund_project_support group by budget_year order by budget_year desc'), @$_GET['budget_year'], '', '-- ระบุปีงบประมาณ --'); ?>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" /></div>
</div>
</form>

<div id="report">

 <div style="float:right; font-size:20px;">แบบรายงาน คคด.01 (ค)</div><div style="clear:both;"></div>
    <div style="text-align:center; font-weight:bold; font-size:20px;">รายงานสรุปผลการจัดสรรเงินกองทุนคุ้มครองเด็ก : รายโครงการ<br>
        ตามกรอบทิศทางการจัดสรรเงินกองทุน ประจำปีงบประมาณ  <?php if (!empty($_GET['budget_year'])) { echo @$_GET['budget_year']; }else { echo "................................"; }?></div>
	<div class="textform3">วัน/เดือน/ปี ที่พิมพ์ : ........./................./.......................</div>
    <div style="clear:both;"></div><br>
 
    <table class="tbReport">
  <tr>
    <th rowspan="2" align="center" valign="middle"><strong><br />
      ลำดับ<br />
      ที่</strong></th>
    <th rowspan="2" align="center" valign="middle"><strong>จังหวัด</strong></th>
    <th colspan="6" align="center"><strong>ผลการจัดสรร (%)</strong></th>
    </tr>
  <tr>
    <th align="center" valign="top"><strong>การป้องกันและแก้ไข<br />ปัญหาเด็กและเยาวชน</strong></th>
    <th align="center" valign="top"><strong>การพัฒนาเด็ก<br />
      และเยาวชน</strong></th>
    <th align="center" valign="top"><strong>การพัฒนาระบบ<br />
      การคุ้มครองเด็ก</strong></th>
    <th align="center" valign="top"><strong>การส่งเสริมศักยภาพครอบครัว<br />
      เพื่อการเลี้ยงดูบุตรอย่างเหมาะสม</strong></th>
    <th align="center" valign="top"><strong>การส่งเสริมศักยภาพองค์กรปกครองส่วนท้องถิ่น<br />
      ในการคุ้มครองเด็ก</strong></th>
    <th align="center" valign="top"><strong>การประชาสัมพันธ์เผยแพร่ความรู้<br />
      เกี่ยวกับการคุ้มครองเด็ก</strong></th>
  </tr>
  <tr>
    <th colspan="2" align="center"><strong>เกณฑ์การจัดสรร (%)</strong></th>
    <th align="center">30</th>
    <th align="center">25</th>
    <th align="center">20</th>
    <th align="center">15</th>
    <th align="center">5</th>
    <th align="center">5</th>
  </tr>
  <?php foreach ($data_province as $key => $province) { ?>
	      <tr>
		    <td class='text-center'><?php echo $province['province_id']; ?></td>
		    <td><?php echo $province['province_name']; ?></td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		    <td>&nbsp;</td>
		  </tr>
  <?php } ?>
</table>


</div></div><!--page-->
