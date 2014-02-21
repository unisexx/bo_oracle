<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">รายงานตารางแสดงคำของบประมาณระดับโครงการ/งบรายจ่าย ประจำปี	  <?=$thyear;?></td>
</tr>
<tr>
  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?=$productivityTitle;?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?=$mainactivityTitle;?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?=$subactivityTitle;?></td>
</tr>
<tr>
  <td align="left" style="padding-bottom:10px;">ภาค :
    <?
	  			if($pzone == '' )
					echo "ทั้งหมด";
				else
				{
  					$provinceZone = SelectData("CNF_PROVINCE_ZONE"," WHERE CODE='".$pzone."' ");
					echo $provinceZone['title'];
				}
  ?></td>
  <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :
    <?
	  			if($pgroup == '' )
					echo "ทั้งหมด";
				else
				{

				$provinceGroup = SelectData("CNF_PROVINCE_GROUP"," WHERE ID=".$pgroup." ");
				echo $provinceGroup['title'];
				}
		  ?></td>
  <td align="left">จังหวัด : <span style="padding-bottom:10px;">
    <?
	  			if($province == '' )
					echo "ทั้งหมด";
				else
				{
				$province = $this->province->get_one("title","id",$province);
				echo $province;
				}
		  ?>
  </span></td>
</tr>
<tr>
  <td align="left" style="padding-bottom:10px;">หน่วยงาน :
    <?
  		if($userSection == '' )
			echo "ทั้งหมด";
		else
		{
  		$section = SelectData("CNF_SECTION_CODE"," WHERE ID=".$userSection." ");
		echo $section['TITLE'];
		}
  ?></td>
  <td align="left" style="padding-bottom:10px;">กลุ่มงาน :
    <?
		if($userWorkgroup=='')
		{
			echo "ทุกกลุ่มงาน";
		}
		else
		{
  		$workgroup = SelectData("CNF_WORK_GROUP"," WHERE ID=".$userWorkgroup." ");
		echo $workgroup['TITLE'];
		}
  ?></td>
  <td align="left">จำนวนโครงการทั้งหมด : <?=db_num_rows($result);?> โครงการ</td>
</tr>
<tr>
  <td colspan="3" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?>
    &nbsp;</td>
</tr>
</table>