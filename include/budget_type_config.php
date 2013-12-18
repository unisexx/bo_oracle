<?
$haveQTY = array(3,12,19,26);//มีจำนวนอัตรา
$isFoodOverTime = array('');//ค่าอาหารนอกเวลาราชการ

$haveAllowanceRemark = array(57); //คำชี้แจงค่าเบี้ยเลี้ยง
$haveAccomodationRemark = array(57); //คำชี้แจงค่าเช่าที่พัก
$haveVehicleRemark = array(57); //คำชี้แจงค่าเช่าพาหนะ
$haveDocumentRemark = array(60);//คำชี้แจงค่าเช่าเหมาเอกสารสื่อสิ่งพิมพ์
$haveHumanRemark = array(60);//คำชี้แจ้งค่าเช่าเหมาบุคคล
$haveServiceRemark = array(60);// คำชี้แจงบริการอื่น ๆ
$haveRemark = array();
$sql = "SELECT ID FROM CNF_BUDGET_TYPE WHERE LV=3 ";
$iresult = $this->db->getarray($sql);
foreach($iresult as $iitem)
{
	array_push($haveRemark, $iitem['ID']);
}
$haveRemark = array_diff($haveRemark,$haveAllowanceRemark);
$haveRemark = array_diff($haveRemark,$haveDocumentRemark);

$budgetType1 = 21;
$budgetType2 = 56;
$budgetType3 = 65;
$budgetType4 = 69;
?>