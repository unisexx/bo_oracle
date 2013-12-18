<script type="text/javascript">
$(document).ready(function(){
	selectChk('type','<?=@$_GET['type']?>');
	function selectChk(name,value){
		$('select[name='+name+'] option[value='+value+']').attr('selected', 'selected')
	}
	
	$('.tblist tr:not(:first)').each(function(){
		var $this = $(this).find('td:not(:last)');
		$this.css('cursor','pointer');
		$this.click(function(){
			var contentId = $(this).parent('tr').find('.contentId').val();
			window.location = 'fund_contract/form/'+contentId;
  			return false;
		});
	});
});
</script>
<h3>สัญญารับเงินอุดหนุน</h3>
<form method="get" action="fund_contract">
<div id="search">
	<div id="searchBox">
		ชื่อโครงการ
		<input type="text" name="project" style="width:250px;" />
		<!-- <select name="organization" class="mustChoose">
			<option>-- ทุกหน่วยงาน --</option>
		</select> -->
		<select name="type" class="mustChoose">
			<option value="">-- ทุกประเภทกองทุน --</option>
			<option value="กองทุนคุ้มครองเด็ก">กองทุนคุ้มครองเด็ก</option>
			<option value="กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์">กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์</option>
			<option value="กองทุนส่งเสริมการจัดสวัสดิการสังคม">กองทุนส่งเสริมการจัดสวัสดิการสังคม</option>
		</select><br>
		เมื่อวันที่
		<input name="start_date" type="text" size="10" class="datepicker" value="<?php if(@$_GET['start_date']!='0'){ echo @$_GET['start_date'];} ?>"/>
		  ถึง 
		<input name="end_date" type="text" size="10" class="datepicker" value="<?php if(@$_GET['end_date']!='0'){ echo @$_GET['end_date'];} ?>"/>
		<input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
	</div>
</div>
</form>

<?php if(permission('fund_contract', 'canadd')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>/form'" class="btn_add"/></div>
<?php endif?>

<?=$pagination?>

<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">สัญญาเลขที่</th>
  <th align="left">ทำขึ้น ณ</th>
  <th align="left">เมื่อวันที่</th>
  <th align="left">ชื่อโครงการ</th>
  <th align="left">จำนวนเงิน</th>
  <th align="left">ประเภท</th>
  <th align="left">ผู้รับเงินอุดหนุน</th>
  <th align="left">สถานะ</th>
  <th align="left">พิมพ์</th>
  <?php if(permission('fund_contract', 'candelete')):?>
  	<th>ลบ</th>
  <?php endif;?>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
 <?php foreach($contract as $key=>$item):?>
 	<tr <?=cycle($key)?>>
	  <td><?=$i?></td>
	  <td nowrap="nowrap"><?=$item['contract_number_1']?>/<?=$item['contract_number_2']?></td>
	  <td><?=$item['made_at']?></td>
	  <td><?=stamp_to_th_fulldate($item['made_date'])?></td>
	  <td><?=$item['project']?></td>
	  <td><?=($item['amount'])? number_format($item['amount'],2):"0.00";?></td>
	  <td>
	  	<?php switch ($item['type']){
	  		case 'กองทุนคุ้มครองเด็ก':
				echo '<img src="themes/fund/images/ico_child.png" width="32" height="32" class="vtip" title="กองทุนเด็ก" />';
			  	break;
			case 'กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์';
				echo '<img src="themes/fund/images/ico_prevent.png" width="32" height="32" class="vtip" title="กองทุนเพื่อการป้องกันและปราบปรามการค้ามนุษย์" />';
				break;
			case 'กองทุนส่งเสริมการจัดสวัสดิการสังคม';
				echo '<img src="themes/fund/images/ico_star.png" width="32" height="32" class="vtip" title="กองทุนส่งเสริมการจัดสวัสดิการสังคม" />';
				break;
		  }
		?>
	  </td>
	  <td><span class="vtip" title="พัฒนาสังคมและความมั่นคงของมนุษย์จังหวัดเชียงราย (๗๒๙/๒๕๔๙)"><?=$item['recipient']?></span></td>
	  <td>
	  	<?php switch ($item['status']){
	  		case 'สัญญาใหม่':
				echo '<img src="themes/fund/images/ico_new.png" width="32" height="32" class="vtip" title="สัญญาใหม่" />';
			  	break;
			case 'ตรวจสอบถูกต้องแล้ว';
				echo '<img src="themes/fund/images/ico_ok.png" width="32" height="32" class="vtip" title="ตรวจสอบถูกต้องแล้ว" />';
				break;
			case 'กลับไปแก้ไขสัญญา';
				echo '<img src="themes/fund/images/ico_warning.png" width="32" height="32" class="vtip" title="กลับไปแก้ไขสัญญา" />';
				break;
		  }
		?>
	  </td>
	  <td>
	  	<input type="hidden" class="contentId" value="<?=$item['id']?>">
	  	<img src="themes/fund/images/ico_print.png" width="24" height="24" class="vtip" title="พิมพ์สัญญา" onclick="window.open('fund_contract/printdoc/<?=$item['id']?>')" />
	  </td>
	  <?php if(permission('fund_contract', 'candelete')):?>
	  <td><a href="fund_contract/delete/<?=$item['id']?>"><button>ลบ</button></a></td>
	  <?php endif;?>
	</tr>
	<?php $i++;?>
 <?php endforeach;?>
</table>

<?=$pagination?>