<h3>ตั้งค่า มิติและตัวชี้วัด</h3>
<!--<div class="allstrategy"><img src="../images/tree/department.png" /> กรม | <img src="../images/tree/down.png" />  เป้าหมายการให้บริการกระทรวง | <img src="../images/tree/cube.png"/> ยุทธศาสตร์กระทรวง  | <img src="../images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | <img src="../images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน   | <img src="../images/tree/asterisk.png" /> ผลผลิต  |  <img src="../images/tree/layout_sidebar.png" /> กิจกรรมหลัก(กรม)  | <img src="../images/tree/file.gif" /> กิจกรรมย่อย | <img src="../images/tree/project_ico.png" /> โครงการ | <img src="../images/tree/subproject_ico.png" /> โครงการย่อย </div>-->

<div id="btnBox"><input type="button" title="เพิ่มมิติ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add vtip"/></div>

เลือกแสดง
<select name="select">
<option>2555</option>
<option selected="selected">2556</option>
  <option>2557</option>
</select>
<select name="select3">
  <option selected="selected">-- ทุกมิติ --</option>
  <option>มิติที่ 1 : ด้านประสิทธิผลตามยุทธศาสตร์</option>
  <option>มิติที่ 2 : ด้านคุณภาพการให้บริการ</option>
  <option>มิติที่ 3 : ด้านประสิทธิภาพของการปฏิบัติราชการ</option>
  <option>มิติที่ 4 : การพัฒนาองค์การ</option>
</select>
<div id="sidetreecontrol" style="margin-top:10px;"><a href="#">Collapse All</a> | <a href="#">Expand All</a></div>

<ul id="tree" class="filetree">
<ul><li><img src="../images/tree/plan_ico.png" /> มิติที่ 1 : ด้านประสิทธิผลตามยุทธศาสตร์ 
<input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดในมิตินี้"  onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form2'"/>
<input type="button" class="btn_editico vtip" title="แก้ไขมิตินี้"  onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" />
<input type="button" class="btn_deleteico vtip"  title="ลบมิตินี้" />

<ul><li><img src="../images/tree/page.png" /> 1. ระดับความสำเร็จของร้อยละเฉลี่ยถ่วงน้ำหนักในการบรรลุเป้าหมายตามแผนปฏิบัติราชการกระทรวงและนโยบายสำคัญ/พิเศษของรัฐบาล    
<input type="button" class="btn_downico vtip" title="เลื่อนลง" style="margin-left:20px" />
<input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดย่อย"/>
<input type="button" class="btn_editico vtip" title="แก้ไขตัวชี้วัดนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/page.png" /> 1.1 ระดับความสำเร็จของร้อยละเฉลี่ยถ่วงน้ำหนักในการบรรลุเป้าหมายตามแผนปฏิบัติราชการของกระทรวงและนโยบายสำคัญพิเศษของรัฐบาล
<input type="button" class="btn_downico vtip" title="เลื่อนลง" style="margin-left:20px" />
<input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดย่อย"/>
<input type="button" class="btn_editico vtip" title="แก้ไขตัวชี้วัดนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/page.png" /> 1.1.1 ระดับความสำเร็จในการดำเนินงานเพื่อให้กลุ่มเป้าหมายมีโอกาสเข้าถึงการคุ้มครองและสวัสดิการ    
<input type="button" class="btn_downico vtip" title="เลื่อนลง" style="margin-left:20px" /> 
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/page.png" /> 1.1.1.1 ร้อยละของกลุ่มเป้าหมายที่ได้รับการคุ้มครองและเข้าถึงสวัสดิการ    
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv5-->

<ul><li><img src="../images/tree/page.png" /> 1.1.1.2 ร้อยละของกลุ่มเป้าหมายที่ได้รับการคุ้มครองและเข้าถึงสวัสดิการ    
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv5-->

</li></ul><!--lv4-->

<ul><li><img src="../images/tree/page.png" /> 1.1.2 ระดับความสำเร็จในการพัฒนาระบบเฝ้าระวังและเตือนภัยทางสังคม 
<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น"/>
<input type="button" class="btn_downico vtip" title="เลื่อนลง" />
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv4-->

<ul><li><img src="../images/tree/page.png" /> 1.1.3 ระดับความสำเร็จเฉลี่ยของการพัฒนาดัชนีทุนทางสังคมของไทย 
<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น"/>
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/page.png" /> 1.1.3.1 ร้อยละของศูนย์พัฒนาครอบครัวชุมชน 
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv5-->

<ul><li><img src="../images/tree/page.png" /> 1.1.3.2 อัตราสมาชิกสภาเด็กและเยาวชน (ต่อ 100,000 คน) 
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv5-->


</li></ul><!--lv4-->

</li></ul><!--lv3-->

<ul><li><img src="../images/tree/page.png" /> 1.2 ระดับความสำเร็จของการพัฒนาศูนย์บริการร่วมหรือเคาน์เตอร์บริการประชาชน
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv3-->

</li></ul><!--lv2-->

<ul><li><img src="../images/tree/page.png" /> 2. ระดับความสำเร็จของร้อยละเฉลี่ยถ่วงน้ำหนักในการบรรลุเป้าหมายตามแผนปฏิบัติราชการ/ภารกิจ/เอกสารงบประมาณรายจ่ายฯของส่วนราชการระดับกรม
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv2-->

</li></ul><!--lv1-->

<ul><li><img src="../images/tree/plan_ico.png" /> มิติที่ 2 : ด้านคุณภาพการให้บริการ
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv1-->




</div>
</div>