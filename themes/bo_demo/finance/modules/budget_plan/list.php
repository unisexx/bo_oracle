<h3>แผนงบประมาณ</h3>
<div class="allstrategy"><img src="../images/tree/budget_plan.png" /> ช่วงแผนงบประมาณ | <img src="../images/tree/budget_type.png" /> ประเภทงบประมาณ | <img src="../images/tree/plan_ico.png"/> แผนงาน | <img src="../images/tree/asterisk.png" /> ผลผลิต  |  <img src="../images/tree/layout_sidebar.png" /> กิจกรรมหลัก  | <img src="../images/tree/file.gif" /> กิจกรรมย่อย | <img src="../images/tree/department.png" /> กรม | <img src="../images/tree/division.gif" /> หน่วยงาน</div>

<div id="btnBox"><input type="submit" title="ดึงข้อมูลแผนงบประมาณ" value="ดึงข้อมูล" class="btn_feed example8" style="margin-right:10px;"/><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=form'" class="btn_add"/></div>

เลือกแสดงปีงบประมาณ
<select name="select">
  <option>ปี</option>
  <option>2554</option>
  <option selected="selected">2555</option>
  <option>2556</option>
</select>

<div id="sidetreecontrol" style="margin-top:10px;"><a href="#">Collapse All</a> | <a href="#">Expand All</a></div>

<ul id="tree" class="filetree">
<ul><li><img src="../images/tree/budget_plan.png" /> แผนงบประมาณต้นปี 
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/budget_type.png" /> งบประมาณต้นปี 
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/plan_ico.png" /> การเสริมสร้างสวัสดิการสังคมและความมั่นคงของมนุษย์ 
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/asterisk.png" /> ประชากรเป้าหมายที่ได้รับการป้องกันและคุ้มครองจากปัญหาการค้ามนุษย์
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/layout_sidebar.png" alt="" /> พัฒนากลไกและบริหารจัดการเพื่อการป้องกันและคุ้มครองผู้เสียหายจากการค้ามนุษย์
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/file.gif" /> การคุ้มครองช่วยเหลือผู้เสียหายจากการค้ามนุษย์เบื้องต้น
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
</li></ul><!--lv6-->

<ul><li><img src="../images/tree/file.gif" /> การบริหารงานตาม พ.ร.บ.ป้องกันและปราบปรามการค้ามนุษย์ พ.ศ. 2551
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/department.png" /> สำนักงานปลัดกระทรวง (สป.)
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

<ul><li><img src="../images/tree/division.gif" /> กองนิติการ <span title="เงินงบประมาณ" class="vtip">10,951,700.00 บาท </span><span title="เงินคงเหลือ" class="vtip gray132">(10,951,700.00)</span>
<input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />

</li></ul><!--lv8-->

</li></ul><!--lv7-->

</li></ul><!--lv6-->

</li></ul><!--lv5-->

</li></ul><!--lv4-->

</li></ul><!--lv3-->

</li></ul><!--lv2-->

</li></ul><!--lv1-->




<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
        <h3>แผนงบประมาณ (ดึงข้อมูล)</h3>
        <table class="tbadd">
        <tr>
          <th>ปีงบประมาณ </th>
          <td><select name="select2">
            <option>ปี</option>
            <option>2554</option>
            <option selected="selected">2555</option>
            <option>2556</option>
          </select></td>
        </tr>
        </table>

        <div id="btnBoxAdd"><input name="input" type="button" title="บันทึก" value=" " class="btn_save" style="display:block;"/></div>
  </div>
</div>