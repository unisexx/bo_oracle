<h3>หมวดงบประมาณ</h3>
<div class="allstrategy"><img src="../images/tree/plan_ico.png"/> หมวดงบประมาณ   | <img src="../images/tree/asterisk.png" /> หมวดค่าใช้จ่าย   |  <img src="../images/tree/layout_sidebar.png" /> รายการ </div>

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
	<ul>
	<li><img src="../images/tree/plan_ico.png" /> งบบุคลากร
	  <input type="button" class="btn_addico vtip" title="เพิ่มรายการ"/>
	<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้" />
	<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" />
    
		<ul>
		<li><img src="../images/tree/asterisk.png" /> เงินเดือน
		  <ul>
          
            <li><img src="../images/tree/layout_sidebar.png" alt="" /></li>
       	  </ul>
                                    
           	</li>
            </ul>
		</li>
		</ul>
  	</li>
	</ul>     
</ul> 




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