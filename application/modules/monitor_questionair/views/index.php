<style type="text/css">
div.container {
	background-color: #eee;
	border: 1px solid red;
	margin: 5px;
	padding: 5px;
}
div.container ol li {
	list-style-type: disc;
	margin-left: 20px;
}
div.container { display: none }
.container label.error {
	display: inline;
}

</style>
<script type="text/javascript">
$(document).ready(function(){
$(".number").keydown(function(event) {
        // Allow: backspace, delete, tab and escape
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || 
             // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) || 
             // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault(); 
            }   
        }
    });
	
	var container = $('div.container');
	// validate the form when it is submitted
	var validator = $("form").validate({
		errorContainer: container,
		errorLabelContainer: $("ol", container),
		wrapper: 'li',
		meta: "validate",
	});
	
	$.validator.addMethod('minage', function (value, el, param) {
    return value > param;
	});

	
	var settings = $('form').validate().settings;
	settings.rules.age = {minage: 1};
	settings.messages.age = "กรุณากรอกอายุ";
	/*
	
	$("form").validate({
		errorContainer: container,
		errorLabelContainer: $("ol", container),
		wrapper: 'li',
		meta: "validate",
		rules: {
			
			sex:"required",
			age:"required",
			edu:"required",
			occ:"required",
			service:"required",			
			will:"required",
			
			pol:"required",
			fast:"required",
			clean:"required",
			contact:"required",
			easy:"required",
			
			toilet:"required",
			fairly:"required",
			time:"required",
			
			clear:"required",			
			help:"required",			
			pcon:"required",
			pclear:"required",
			
			
		},
		messages:{
			
			sex:"กรุณาระบุ",
			age:"กรุณาระบุ",
			edu:"กรุณาระบุ",
			occ:"กรุณาระบุ",
			service:"กรุณาระบุ",			
			will:"กรุณาระบุ",			
			pol:"กรุณาระบุ",
			fast:"กรุณาระบุ",
			clean:"กรุณาระบุ",
			contact:"กรุณาระบุ",
			easy:"กรุณาระบุ",
			
			toilet:"กรุณาระบุ",
			fairly:"กรุณาระบุ",
			time:"กรุณาระบุ",
						
			clear:"กรุณาระบุ",
					
			help:"กรุณาระบุ",			
			pcon:"กรุณาระบุ",
			pclear:"กรุณาระบุ",
			
		
		}
	});*/
	
});
				
	
</script>
<form action="monitor_questionair/save" method="post" id="form1" name="form1" >
                  <h3 align="center"><strong>แบบสำรวจความพึงพอใจของผู้รับบริการต่อการให้บริการของ<br>สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด</strong> </h3><br>
              	  <p align="center">&nbsp;</p>
<div class="container">
<h4>กรุณาระบุหัวข้อเหล่านี้ในแบบฟอร์มให้ครบถ้วน ขอบคุณค่ะ.</h4>
	<ol>
		<li><label for="sex" class="error">กรุณาระบุเพศ</label></li>
		<li><label for="age" class="error">กรุณาระบุอายุ</label></li>
		<li><label for="edu" class="error">กรุณาระบุการศึกษา</label></li>
		<li><label for="occ" class="error">กรุณาระบุอาชีพ</label></li>
		<li><label for="service" class="error">กรุณาระบุการบริการที่ท่านมาใช้บริการ</label></li>
		<li><label for="will" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน เจ้าหน้าที่มีความกระตือรือร้นในการให้บริการอย่างเต็มใจ</label></li>
		<li><label for="pol" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน เจ้าหน้าให้บริการด้วยความสุภาพ</label></li>
		<li><label for="fast" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน เจ้าหน้าให้บริการด้วยความรวดเร็ว สามารถให้คำแนะนำ / ตอบข้อซักถามได้ชัดเจน</label></li>
		<li><label for="clean" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน สถานที่มีความสะอาดและเป็นระเบียบ</label></li>
		<li><label for="contact" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน สถานที่ตั้งหาง่ายและเดินทางมาติดต่อได้สะดวก</label></li>		
		<li><label for="easy" class="error">ภายในสถานที่ให้บริการ มีการจัดสิ่งอำนวยความสะดวกให้แก่ผู้มาติดต่อ เช่น เก้าอี้ / ที่พัก น้ำดื่ม เป็นต้น</label></li>
		<li><label for="toilet" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน มีห้องน้ำสะอาดและเพียงพอแก่ผู้มาติดต่อ</label></li>
		<li><label for="fairly" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน มีการให้บริการตามลำดับก่อน - หลัง อย่างยุติธรรม </label></li>
		<li><label for="time" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน ระยะเวลาในการรอคอยการให้บริการมีความเหมาะสม</label></li>
		<li><label for="clear" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน ขั้นตอนการให้บริการมีความชัดเจนและรวดเร็ว</label></li>
		<li><label for="help" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน ท่านได้รับความช่วยเหลือตรงตามความต้องการอย่างครบถ้วน</label></li>
		<li><label for="pcon" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน มีการประชาสัมพันธ์ข้อมูลข่าวสารเกี่ยวกับการให้บริการ / การช่วยเหลือต่าง ๆ อย่างต่อเนื่องและทั่วถึง</label></li>
		<li><label for="pclear" class="error">กรุณาระบุระดับความพึงพอใจ ด้าน การประชาสัมพันธ์ผ่านสื่อต่าง ๆ เช่น โปสเตอร์แผ่นพับ ป้ายประกาศ ฯลฯ มีความเหมาะสม ชัดเจน และเข้าใจง่าย</label></li>		
		<!--
			sex:"กรุณาระบุ",
			age:"กรุณาระบุ",
			edu:"กรุณาระบุ",
			occ:"กรุณาระบุ",
			service:"กรุณาระบุ",			
			will:"กรุณาระบุ",			
			pol:"กรุณาระบุ",
			fast:"กรุณาระบุ",
			clean:"กรุณาระบุ",
			contact:"กรุณาระบุ",
			easy:"กรุณาระบุ",
			
			toilet:"กรุณาระบุ",
			fairly:"กรุณาระบุ",
			time:"กรุณาระบุ",
						
			clear:"กรุณาระบุ",
					
			help:"กรุณาระบุ",			
			pcon:"กรุณาระบุ",
			pclear:"กรุณาระบุ",		  
		-->
	</ol>  	
</div>
              	  <fieldset>
              	  	<legend><b><u>ส่วนที่ 1</u> ข้อมูลพื้นฐานส่วนบุคคล</b></legend>        
              	  	<table border="0" cellspacing="0" cellpadding="0" width="95%" align="center">                 
					  <tr>
					  	<td align="left">
						  <table border="0" cellspacing="0" cellpadding="0" width="95%"  >
						  <tr><td colspan="2" >1.เพศ</td></tr>
						  <tr>
						  <td  width="35%">
						  	<input name="sex" id="sex" type="radio" value="M" class="{validate:{required:true}}"  >1) ชาย
						  </td>
						  <td width="55%">
						  		<input name="sex" id="sex"  type="radio" value="F" class="{validate:{required:true}}">2) หญิง						  		
						  </td>
						  </tr>
						  <tr><td colspan="2"><br></td></tr>
						    <tr>
						    	<td colspan="2">2.อายุ &nbsp;&nbsp;
						    	<input name="age" type="text" id="age" size="2" maxlength="2" class="{validate:{required:true}} number" >&nbsp;&nbsp;ปี
						    	</td>
						    </tr>	
							 <tr><td colspan="2"><br></td></tr>
							<tr><td colspan="2">3.การศึกษา</td></tr>
						  <tr>
						  	<td>
						  		<input name="edu" type="radio" value="ประถมศึกษา"  onclick="if(this.checked){ document.getElementById('eduother').style.display='none'}" class="{validate:{required:true}}">1) ประถมศึกษา
						  	</td>
						  	<td>
						  		<input name="edu" type="radio" value="ปริญญาตรี" onclick="if(this.checked){ document.getElementById('eduother').style.display='none'}" class="{validate:{required:true}}">4) ปริญญาตรี
						  	</td>
						  </tr>
						  <tr>
						  	<td>
						  		<input name="edu" type="radio" value="มัธยมศึกษา" onclick="if(this.checked){ document.getElementById('eduother').style.display='none'}" class="{validate:{required:true}}">2) มัธยมศึกษา
						  	</td>
						  	<td>
						  		<input name="edu" type="radio" value="สูงกว่าปริญญาตรี" onclick="if(this.checked){ document.getElementById('eduother').style.display='none'}" class="{validate:{required:true}}">5) สูงกว่าปริญญาตรี
						  	</td>
						  </tr>
						  <tr>
						  	<td>
						  		<input name="edu" type="radio" value="ปวช. / ปวส." onclick="if(this.checked){ document.getElementById('eduother').style.display='none'}" class="{validate:{required:true}}">3) ปวช. / ปวส.
						  	</td>
						  	<td>
						  		<input name="edu" type="radio" value="อื่นๆ" onclick="if(this.checked){ document.getElementById('eduother').style.display='';document.getElementById('eduother').focus(); }" class="{validate:{required:true}}">6) อื่น ๆ (โปรดระบุ)
						  		<input name="eduother" type="text" id="eduother" size="50" style="display:none" >
						  	</td>
						  </tr>
		  			      <tr><td colspan="2"><br></td></tr>
						  <tr><td colspan="2">4.อาชีพ</td></tr>
						  <tr><td><input name="occ" type="radio" value="เกษตรกร" onclick="if(this.checked){ document.getElementById('occother').display='none'}" class="{validate:{required:true}}">1) เกษตรกร</td>
						  	<td><input name="occ" type="radio" value="ลูกจ้างบริษัท" onclick="if(this.checked){ document.getElementById('occother').display='none'}" class="{validate:{required:true}}">5) ลูกจ้างบริษัท</td></tr>
						  <tr><td><input name="occ" type="radio" value="รับจ้าง"  onclick="if(this.checked){ document.getElementById('occother').display='none'}" class="{validate:{required:true}}">2) รับจ้าง</td>
						  	<td><input name="occ" type="radio" value="นักเรียน / นักศึกษา" onclick="if(this.checked){ document.getElementById('occother').display='none'}" class="{validate:{required:true}}">6) นักเรียน / นักศึกษา</td></tr>
						  <tr><td><input name="occ" type="radio" value="ค้าขาย" onclick="if(this.checked){ document.getElementById('occother').display='none'}" class="{validate:{required:true}}">3) ค้าขาย</td>
						  	<td><input name="occ" type="radio" value="แม่บ้าน" onclick="if(this.checked){ document.getElementById('occother').display='none'}" class="{validate:{required:true}}">7) แม่บ้าน</td></tr>
		
						  <tr><td><input name="occ" type="radio" value="รับราชการ"  onclick="if(this.checked){ document.getElementById('occother').display='none'}" class="{validate:{required:true}}">4) รับราชการ</td>
						  	<td><input name="occ" type="radio" value="อื่นๆ" onclick="if(this.checked){ document.getElementById('occother').style.display='';document.getElementById('occother').focus(); }" class="{validate:{required:true}}">8) อื่น ๆ (โปรดระบุ)<input name="occother" type="text" id="occother" size="50" style="display:none"></td></tr>
						  <tr><td colspan="2"><br></td></tr>
						   <tr><td colspan="2">5.ท่านมาขอรับบริการทางด้านใด</td></tr>
						  <tr><td><input name="service" type="radio" value="เด็กและเยาวชน"  onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">1) เด็กและเยาวชน</td>
						  	<td><input name="service" type="radio" value="คนไร้ที่พึ่ง" onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">6) คนไร้ที่พึ่ง</td></tr>
						  <tr><td><input name="service" type="radio" value="สตรี"  onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">2) สตรี</td>
						  	<td><input name="service" type="radio" value="ภูมิคุ้มกันบกพร่อง" onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">7) ภูมิคุ้มกันบกพร่อง</td></tr>
		
						  <tr><td><input name="service" type="radio" value="คนพิการ" onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">3) คนพิการ</td>
						  	<td><input name="service" type="radio" value="ขอข้อมูล / คำปรึกษา" onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">8) ขอข้อมูล / คำปรึกษา</td></tr>
						    <tr><td><input name="service" type="radio" value="ผู้สูงอายุ" onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">4) ผู้สูงอายุ</td>
						    	<td><input name="service" type="radio" value="การค้ามนุษย์" onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">9) การค้ามนุษย</td></tr>
						  <tr><td><input name="service" type="radio" value="ครอบครัวยากจน" onclick="if(this.checked){ document.getElementById('serviceother').style.display='none'}" class="{validate:{required:true}}">5) ครอบครัวยากจน</td>
						  	<td><input name="service" type="radio" value="อื่นๆ" onclick="if(this.checked){ document.getElementById('serviceother').style.display='';document.getElementById('serviceother').focus(); }" class="{validate:{required:true}}">10) อื่น ๆ (โปรดระบุ)<input name="serviceother" type="text" id="serviceother" size="50" style="display:none"></td></tr>
						  </table>					  
					   </td>
					  </tr>
				  </table>      	  	
              	  </fieldset>
                  
			<fieldset>
               <legend><b><u>ส่วนที่ 2 </u>ข้อมูลความพึงพอใจของผู้รับบริการต่อการให้บริการของสำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด</b></legend>       				  
				 <table border="1" cellspacing="0" cellpadding="0" width="95%"  align="center">
				 <tr height="20px"  >
					 <th rowspan="2" width="55%"  ><center>ประเด็นคำถาม</center></th>
					 <th colspan="5" width="35%"  ><center>ระดับความพึงพอใจ</center></th>
					 <th rowspan="2" width="10%"><center>ไม่แสดงความคิดเห็น</center></th>
				 </tr>

				 <tr height="20px">
				 	<th width="7%"><center>มากที่สุด</center></th>
				 	<th width="7%"><center>มาก</center></th>
				 	<th width="7%"><center>ปานกลาง</center></th>
				 	<th width="7%"><center>น้อย</center></th>
				 	<th width="7%"><center>น้อยที่สุด</center></th>
				 </tr>
				 <tr height="50px">
				 	<td><b>ด้านการให้บริการของเจ้าหน้าที่</b><br><br>&nbsp;&nbsp;
				 		1) เจ้าหน้าที่มีความกระตือรือร้นในการให้บริการอย่างเต็มใจ
				 	</td>
				 	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="will" id="will" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>     				
     			  </tr>
				  <tr height="25px">
				  	<td>&nbsp;&nbsp;2) เจ้าหน้าให้บริการด้วยความสุภาพ</td>
				  	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="pol" id="pol" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="25px"><td>&nbsp;&nbsp;3) เจ้าหน้าให้บริการด้วยความรวดเร็ว สามารถให้คำแนะนำ / ตอบข้อซักถามได้ชัดเจน</td>
				  	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="fast" id="fast" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="50px">
				  	<td><b>ด้านสถานที่ให้บริการ  </b>(ในกรณีที่ให้บริการนอกสถานที่ ไม่ต้องกรอกข้อมูลในส่วนนี้)<br><br>&nbsp;&nbsp;1) สถานที่มีความสะอาดและเป็นระเบียบ</td>
				 	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="clean" id="clean" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="25px"><td>&nbsp;&nbsp;2)สถานที่ตั้งหาง่ายและเดินทางมาติดต่อได้สะดวก</td>
				    <? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="contact" id="cantact" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="25px"><td>&nbsp;&nbsp;3) ภายในสถานที่ให้บริการ มีการจัดสิ่งอำนวยความสะดวกให้แก่ผู้มาติดต่อ เช่น เก้าอี้ / ที่พัก น้ำดื่ม เป็นต้น</td>
				    <? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="easy" id="easy" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				   <tr height="25px"><td>&nbsp;&nbsp;4) มีห้องน้ำสะอาดและเพียงพอแก่ผู้มาติดต่อ</td>
				    <? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="toilet" id="toilet" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="50px"><td><b>ด้านกระบวนการให้บริการ</b><br><br>&nbsp;&nbsp;1) มีการให้บริการตามลำดับก่อน - หลัง อย่างยุติธรรม </td>
   				  	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="fairly" id="fairly" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="25px"><td>&nbsp;&nbsp;2) ระยะเวลาในการรอคอยการให้บริการมีความเหมาะสม </td>
				  <? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="time" id="time" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				  <? endfor;?>
				  </tr>
				  <tr height="25px"><td>&nbsp;&nbsp;3) ขั้นตอนการให้บริการมีความชัดเจนและรวดเร็ว </td>
				  	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="clear" id="clear" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="25px"><td>&nbsp;&nbsp;4) ท่านได้รับความช่วยเหลือตรงตามความต้องการอย่างครบถ้วน </td>
				  	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="help" id="help" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?> 				  
				  </tr>
				  <tr height="50px"><td><b>ด้านการประชาสัมพันธ์</b><br><br>&nbsp;&nbsp;1) มีการประชาสัมพันธ์ข้อมูลข่าวสารเกี่ยวกับการให้บริการ / การช่วยเหลือต่าง ๆ  อย่างต่อเนื่องและทั่วถึง</td>
					<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="pcon" id="pcon" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
				  <tr height="25px"><td>&nbsp;&nbsp;2) การประชาสัมพันธ์ผ่านสื่อต่าง ๆ เช่น โปสเตอร์แผ่นพับ ป้ายประกาศ ฯลฯ มีความเหมาะสม ชัดเจน และเข้าใจง่าย</td>
				 	<? for($i=5;$i>=0;$i--): ?>
   				    <td align="center"><input name="pclear" id="pclear" type="radio" value="<?=$i;?>" class="{validate:{required:true}}" ></td>
   				    <? endfor;?>
				  </tr>
      		     </table>
      		     </fieldset>
      		    <fieldset>
               		<legend><b><u>ส่วนที่ 3</u>ข้อเสนอแนะต่อการให้บริการของสำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด</b></legend>  				
				   <table border="0" cellspacing="0" cellpadding="0" width="95%" align="center">
				    <tr><td><textarea name="guide" style="width:650px;height:200px;"></textarea></td></tr>
      		      </table>
      		    </fieldset>
                               

<div id="btnBoxAdd">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
</div>
</form>                               
 </form>