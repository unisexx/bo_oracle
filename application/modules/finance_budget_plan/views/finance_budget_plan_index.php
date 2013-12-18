<script type="text/javascript">
$(document).ready(function(){
	$('.btn_deleteico').hide();
	$('li').not(':has(ul > li)').find('.btn_deleteico').show();
	
	$('.bg_source').click(function(){
			$(".bg_source").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
			$("select[name=budgetfeed]").val();
	})
	
	
});

function redirect(url) {
  if (confirm('<?php echo NOTICE_CONFIRM_DELETE?>'))
    window.location.href=url;
  return false;
}
</script>
<h3>แผนงบประมาณ</h3>
<div class="allstrategy"><img src="images/tree/budget_plan.png" /> ช่วงแผนงบประมาณ | <img src="images/tree/budget_type.png" /> ประเภทงบประมาณ | <img src="images/tree/plan_ico.png"/> แผนงาน | <img src="images/tree/asterisk.png" /> ผลผลิต  |  <img src="images/tree/layout_sidebar.png" /> กิจกรรมหลัก  | <img src="images/tree/file.gif" /> กิจกรรมย่อย | <img src="images/tree/department.png" /> กรม | <img src="images/tree/division.gif" /> หน่วยงาน</div>

<div id="btnBox"><input type="button" title="ดึงข้อมูลแผนงบประมาณ" value="ดึงข้อมูล" class="btn_feed bg_source" style="margin-right:10px;"/>

<?php if(permission('finance_budget_plan', 'canadd')):?>
<input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='finance_budget_plan/form/budgetplantype/0'" class="btn_add"/>
<?php endif;?>

</div>

เลือกแสดงปีงบประมาณ
<select name="fnyear" onchange="window.location='finance_budget_plan/index/'+this.value">
  <option value="">ปี</option>
  <?php  
  foreach($fnyear as $year):
  ?>
  <option value="<?=$year['fnyear'];?>" <? if($budgetyear == $year['fnyear'])echo "selected";?>><?=($year['fnyear']+543);?></option>  
  <?php endforeach;?>
</select>
<?php if($budgetyear>0){ ?>
<div id="sidetreecontrol" style="margin-top:10px;"><a href="#">Collapse All</a> | <a href="#">Expand All</a></div>
<ul id="tree" class="filetree">
    <? echo $dataList;?>
<? } ?>	
<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
		<form name="fmbudgetfeed" method="post" action="finance_budget_plan/feed">
        <h3>แผนงบประมาณ (ดึงข้อมูล)</h3>
        <table class="tbadd">
        <tr>
          <th>ปีงบประมาณ </th>
          <td>
          	<select name="budgetfeed">
            <option value=''>ปี</option>
         	<?php echo $option;?>
          </select>
          </td>
        </tr>
        </table>

        <div id="btnBoxAdd"><input name="input" type="submit" title="บันทึก" value=" " class="btn_save" style="display:block;"/></div>
       </form>
  </div>
</div>
</form>