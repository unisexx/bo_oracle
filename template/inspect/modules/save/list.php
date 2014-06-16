<h3>บันทึก ผลการดำเนินงาน</h3>
<div id="search">
<div id="searchBox">
  <select name="select" id="select" class="mustChoose">
    <option>-- เลือกปีงบประมาณ --</option>
    <option>2555</option>
    <option>2554</option>
  </select>
  <select name="select3" id="select3" class="mustChoose">
    <option>-- เลือกรายชื่อโครงการ --</option>
  </select>
  <br />
  <select name="select2" id="select2" class="mustChoose">
    <option selected="selected">-- เลือกเขต --</option>
    <option>เขตตรวจราชการส่วนกลาง</option>
    <option>เขตที่ 1</option>
  </select>
  <select name="select5" id="select5">
    <option>-- เลือกจังหวัดทั้งหมด --</option>
  </select>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
</div>
</div>
<div style="padding-bottom:10px;"><a href="project.php?act=view" target="_parent">รอบที่ 1 (Project Review)</a> | รอบที่ 2 (Progress Review) | รอบที่ 3 (Evaluation)</div>

<div id="tabs">
<ul>
      <li><a href="#tabs-1">ประเมินความเสี่ยง</a></li>
      <li><a href="#tabs-2">ความคืบหน้าการดำเนินงานโครงการ</a></li>
    </ul>
    <div id="tabs-1">
        <table class="tblist3">
<tr>
  <th>วัตถุประสงค์ของโครงการ <br />
    (A) </th>
  <th>ประเภทความเสี่ยงที่พบ<br />
    (หน่วยรับตรวจรายงานผล)<br />
    (B)</th>
  <th>วิธีการจัดการความเสี่ยง<br />
    (หน่วยรับตรวจรายงานผล)<br />
    (C)</th>
</tr>
<tr class="topic">
  <td>&nbsp;</td>
  <td><strong>( B1 ) Key Risk area</strong></td>
  <td><strong>( C1 ) Key Risk area</strong></td>
</tr>
<tr>
  <td>ข้อความวัตถุประสงค์ตามระบบคำขอ ถ้าไม่มีอยู่ใน เมนูตั้งค่าจัดการโครงการ และวัตถุประสงค์ (1 วัตถุประสงค์ / 1 โครงการ)</td>
  <td>1.1 ทรัพยากรในการสนับสนุนการดำเนินกิจกรรม / แผนงาน / โครงการมีทรัพยากร (ทุกด้าน) สนับสนุนไม่เพียงพอ
  <fieldset>
  <legend>รอบที่ 1 (Project Review)</legend>
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select7" id="select7">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select8" id="select8">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea" id="textarea" style="width:100%;"></textarea>
  </fieldset>
  
  <fieldset>
  <legend>รอบที่ 2 (Progress Review)</legend>
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  
    ผลกระทบ
  <select name="select8" id="select8">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <select name="select4" id="select4">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <textarea name="textarea" id="textarea" style="width:100%;"></textarea>
  </fieldset>
  
  <fieldset>
  <legend>รอบที่ 3 (Evaluation)</legend>
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select7" id="select7">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select8" id="select8">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea" id="textarea" style="width:100%;"></textarea>
  </fieldset>
  </td>
  <td>1.1 ทรัพยากรในการสนับสนุนการดำเนินกิจกรรม / แผนงาน / โครงการมีทรัพยากร (ทุกด้าน) สนับสนุนไม่เพียงพอ<br />
  <fieldset>
  <legend>รอบที่ 1</legend>
    <textarea name="textarea" rows="6" id="textarea" style="width:100%;"></textarea>
    </fieldset>
    <fieldset>
  <legend>รอบที่ 2</legend>
    <textarea name="textarea" rows="6" id="textarea" style="width:100%;"></textarea>
    </fieldset>
    <fieldset>
  <legend>รอบที่ 3</legend>
    <textarea name="textarea" rows="6" id="textarea" style="width:100%;"></textarea>
    </fieldset>
    </td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.2 การประสานการดำเนินงานระหว่างภาคีเครือข่ายที่เกี่ยวข้องไม่ส่งผลสำเร็จอย่างยั่งยืนของแผนงาน / โครงการ <br />
   <fieldset>
  <legend>รอบที่ 1</legend>
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select7" id="select7">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select8" id="select8">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea" id="textarea" style="width:100%;"></textarea>
  </fieldset>
  
  <fieldset>
  <legend>รอบที่ 2</legend>
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select7" id="select7">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select8" id="select8">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea" id="textarea" style="width:100%;"></textarea>
  </fieldset>
  
  <fieldset>
  <legend>รอบที่ 3</legend>
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select7" id="select7">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select8" id="select8">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea" id="textarea" style="width:100%;"></textarea>
  </fieldset>
   </td>
  <td>1.2 การประสานการดำเนินงานระหว่างภาคีเครือข่ายที่เกี่ยวข้องไม่ส่งผลสำเร็จอย่างยั่งยืนของแผนงาน / โครงการ <br />
  <fieldset>
  <legend>รอบที่ 1</legend>
    <textarea name="textarea10" rows="6" id="textarea10" style="width:100%;"></textarea>
    </fieldset>
     <fieldset>
  <legend>รอบที่ 2</legend>
    <textarea name="textarea10" rows="6" id="textarea10" style="width:100%;"></textarea>
    </fieldset>
     <fieldset>
  <legend>รอบที่ 3</legend>
    <textarea name="textarea10" rows="6" id="textarea10" style="width:100%;"></textarea>
    </fieldset>
    </td>
</tr>
<tr class="topic">
  <td>&nbsp;</td>
  <td><strong>( B2 ) Political Risk</strong></td>
  <td><strong>( C2 ) Political Risk</strong></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.3 การใช้จ่ายงบประมาณมีโอกาสไม่ตรงตามความต้องการของกลุ่มเป้าหมาย <br />
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select11" id="select11">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select11" id="select12">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea3" id="textarea3" style="width:100%;"></textarea></td>
  <td>1.3 การใช้จ่ายงบประมาณมีโอกาสไม่ตรงตามความต้องการของกลุ่มเป้าหมาย <br />
    <textarea name="textarea11" rows="5" id="textarea11" style="width:100%;"></textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.4 การใช้งบประมาณไม่มีการตรวจสอบความโปร่งใสเพียงพอ<br />
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select12" id="select13">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select12" id="select14">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea4" id="textarea4" style="width:100%;"></textarea></td>
  <td>1.4 การใช้งบประมาณไม่มีการตรวจสอบความโปร่งใสเพียงพอ<br />
    <textarea name="textarea12" rows="5" id="textarea12" style="width:100%;"></textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.5 การใช้จ่ายงบประมาณไม่กระจายสู่กลุ่มเป้าหมายของโครงการ <br />
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select13" id="select15">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select13" id="select16">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea5" id="textarea5" style="width:100%;"></textarea></td>
  <td>1.5 การใช้จ่ายงบประมาณไม่กระจายสู่กลุ่มเป้าหมายของโครงการ <br />
    <textarea name="textarea13" rows="5" id="textarea13" style="width:100%;"></textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.6 การใช้จ่ายงบประมาณไม่ตรงตามวัตถุประสงค์ของโครงการ <br />
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select14" id="select17">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select14" id="select18">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea6" id="textarea6" style="width:100%;"></textarea></td>
  <td>1.6 การใช้จ่ายงบประมาณไม่ตรงตามวัตถุประสงค์ของโครงการ <br />
    <textarea name="textarea14" rows="5" id="textarea14" style="width:100%;"></textarea></td>
</tr>
<tr class="topic">
  <td>&nbsp;</td>
  <td><strong>( B3 ) Negotiation Risk</strong></td>
  <td><strong>( C3 ) Negotiation Risk</strong></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.7 กลุ่มเป้าหมายของโครงการมีส่วนร่วมในกิจกรรมไม่ต่อเนื่อง <br />
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select15" id="select19">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select15" id="select20">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea7" id="textarea7" style="width:100%;"></textarea></td>
  <td>1.7 กลุ่มเป้าหมายของโครงการมีส่วนร่วมในกิจกรรมไม่ต่อเนื่อง <br />
    <textarea name="textarea15" rows="5" id="textarea15" style="width:100%;"></textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.8 ประชาชนทั่วไปในพื้นที่มีโอกาสไม่ได้รับผลประโยชน์จากโครงการ <br />
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select16" id="select21">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select16" id="select22">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea8" id="textarea8" style="width:100%;"></textarea></td>
  <td>1.8 ประชาชนทั่วไปในพื้นที่มีโอกาสไม่ได้รับผลประโยชน์จากโครงการ <br />
    <textarea name="textarea16" rows="5" id="textarea16" style="width:100%;"></textarea></td>
</tr>
<tr class="topic">
  <td>&nbsp;</td>
  <td><strong>( B4 ) Ohter (อื่นๆ)</strong></td>
  <td><strong>( C4 ) Ohter (อื่นๆ)</strong></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>1.9 อื่นๆ <br />
    <span>ระดับความเสี่ยง : </span> <br />
    โอกาส
  <select name="select17" id="select23">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
    ผลกระทบ
  <select name="select17" id="select24">
    <option selected="selected">-</option>
    <option>1</option>
    <option>2</option>
    <option>3</option>
    <option>4</option>
    <option>5</option>
  </select>
  <br />
  <span>เนื่องจาก :</span> <br />
  <textarea name="textarea9" id="textarea9" style="width:100%;"></textarea></td>
  <td>1.9 อื่นๆ <br />
    <textarea name="textarea17" rows="5" id="textarea17" style="width:100%;"></textarea></td>
</tr>
</table>
        
</div>
    
    
    <div id="tabs-2">
        <table class="tblist">
        <tr>
          <th align="left">ลำดับ</th>
          <th align="left">รายงานกิจกรรมหลัก / กิจกรรมย่อย</th>
          <th align="left">สถานะการดำเนินงาน</th>
          </tr>
        <tr class="odd cursor" onclick="document.location='<?=basename($_SERVER['PHP_SELF'])?>?act=progress_form'">
          <td>1</td>
          <td nowrap="nowrap">ส่งเสริมและสนับสนุนการจัดกิจกรรมของสภาเด็กและเยาวชนทุกระดับ</td>
          <td>ดำเนินการแล้ว</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>กิจกรรมย่อย ปัญหาและอุปสรรค แนวทางการแก้ไข</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="odd">
          <td>2</td>
          <td>เสริมสร้างและพัฒนาศักยภาพสภาเด็กและเยาวชนให้สามารถเป็นศูนย์กลางการดำเนินกิจกรรม</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td>กิจกรรมย่อย 2.1</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>กิจกรรมย่อย 2.2</td>
          <td>&nbsp;</td>
        </tr>
        <tr class="odd">
          <td>3</td>
          <td>ส่งเสริมการจัดตั้งสภาเด็กและเยาวชนระดับตำบล</td>
          <td>&nbsp;</td>
          </tr>
        <tr>
          <td>4</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        <tr class="odd">
          <td>5</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>
        </table>
        <div class="clear"></div>
    </div>

</div>

<div id="btnBoxAdd">
  <input name="input" type="button" title="บันทึก" value=" " class="btn_save"/>
</div>