<script type="text/javascript">
	$(document).ready(function(){
		// jquery row count -------------------------
		(function($){
		  $.fn.extend({
		    addCount: function() {
		      return $(this).each(function(){
		        if($(this).is('table')){
		          $('thead th:first, thead td:first', this).each(function(){
		            if($(this).is('td'))
		              $(this).before('<td rowspan="'+$('thead tr').length+'">#</td>');
		        else if($(this).is('th'))
		              $(this).before('<th rowspan="'+$('thead tr').length+'">#</th>');
		          });
		          $('tbody td:first-child', this).each(function(i){
		        $(this).before('<td>'+(i+1)+'</td>');
		          });
		      }
		      });
		    }
		  });
		})(jQuery);
		// ------------------------------------------
		$('.tblist2').addCount();
		
		$(".subactivity").colorbox({width:"50%", inline:true, href:"#subactivity_form",title: function(){
    		$("input[type=submit]").removeAttr("disabled");
}});
		$(".example82").colorbox({width:"92%",height:"92%", inline:true, href:"#inline_example82",title: function(){
    		$("input[type=submit]").removeAttr("disabled");
}});
		
		$('.add_upload').click(function(){
			var clone = $('.uploadtb').find("tr.uploadform").clone().appendTo('.uploadtb')
			clone.removeAttr('class','uploadform');
			clone.find("input[type=file]").replaceWith("<input type='file' size='16' name='filename[]'>");
			clone.find("textarea").val("");
		});
		
		$('.file_del').click(function(){
			var answer = confirm("ยินยันการลบข้อมูล");
		    if(answer){
				var fileid = $(this).prev("input").val();
				$.post('inspect_save/file_del',{
			    	'fileid':fileid
			    });
			    
			    $(this).closest('tr').remove();
			    $('.tblist2 tr td:first-child').remove();
			    $('.tblist2').addCount();
			}
		});
		
		$('.upload_save').click(function(){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#btnBoxAdd2").delay(3000).fadeOut();
		});
		
		$('.subactivity_save').click(function(){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#btnBoxAdd");
			
			var txt = $(this).closest("#subacfrm").find("textarea").val();
			var str = $("#subacfrm").serialize();
			
			if(txt == ""){
				$("#btnBoxAdd img").remove();
				alert("กรุณากรอกข้อมูลให้ครบถ้วน");
				return false;
			}
			
			$.post("inspect_save/subact_save", str,
				function(data){
					$("<tr><td></td><td>"+txt+"<input type=hidden name=subid value=1></td><td><input type='hidden' name='subacid' value="+data.id+"><input type='submit' name='button' id='button' value='' class='btn_delete subact_del' /></td></tr>").appendTo("table.subactb");
					$('.tblist2 tr td:first-child').remove();
					$('.tblist2').addCount();
					$.colorbox.close();
					
					$("#subacfrm").find("textarea").val("");
					$("#subac_dropdown").html(data.dropdown_frm);
					$("#btnBoxAdd img").remove();
				}, "json"
			);
		});
		
		$(".subact_del").live("click",function(){
			var answer = confirm("ยืนยันการลบข้อมูล");
			if(answer){
				var id = $(this).prev("input[name=subacid]").val();
				$.post("inspect_save/subactivity_del",{
					'id':id
				},function(data){
					$("#subac_dropdown").html(data);
				});
				
				$(this).closest("tr").remove();
				$('.tblist2 tr td:first-child').remove();
			    $('.tblist2').addCount();
			}
		});
		
		$("#upload_frm").validate({
			rules: {
				subactid:"required",
				follow:"required"
			},
			messages:{
				subactid:"กรุณาระบุข้อมูลด้วย",
				follow:"กรุณาระบุข้อมูลด้วย"
			}
		});
		
		$('.submit').click(function() {
		  $('#main-form').submit();
		});
		
		$('.submitUploadFrm').click(function() {
		  $('#upload_frm').submit();
		});
		
	});
</script>

<h3>บันทึกความคืบหน้าการดำเนินงานโครงการ (บันทึกการดำเนินการ)</h3>
<h4 style="margin-top:20px;"><?php echo $provincearea?> > <?php echo $province?> > <?php echo $budgetyear?> > <?php echo $projectname?></h4>

<form method="post" action="inspect_save/progress_save" id="main-form">
	
<table class="tblist">
<tr>
  <th align="left" width="25%">รายงานกิจกรรมหลัก / กิจกรรมย่อย</th>
  <th align="left" width="15%">ดำเนินการแล้ว</th>
  <th align="left" width="20%">ปัญหาและอุปสรรค</th>
  <th align="left" width="20%">แนวทางการแก้ไข</th>
  <th align="left" width="20%">ข้อเสนอแนะของหน่วยรับตรวจ</th>
  </tr>
<tr id="progress_main_frm" class="odd">
  <td valign="top"><?php echo @$main_activity_title?><strong> (กิจกรรมหลัก)</td>
  <td valign="top"><input type="checkbox" name="status" value="1" <?php echo @$main_activity['status'] == 1 ? "checked" : "";?>/></td>
  <td><textarea name="problem" rows="10" style="width:100%"><?php echo @$main_activity['problem']?></textarea></td>
  <td><textarea name="solution" rows="10" style="width:100%"><?php echo @$main_activity['solution']?></textarea></td>
  <td><textarea name="suggestion" rows="10" style="width:100%"><?php echo @$main_activity['suggestion']?></textarea></td>
</tr>
</table>


<h3>กิจกรรมย่อย</h3>

<?php if(permission('inspect_save', 'canadd')):?>
<div id="btnBox" style="width: 110px;"><input type="" title="เพิ่มรายการ" value=" " class="btn_add subactivity"/></div>
<?php endif;?>
<table class="tblist2 subactb">
	<tr>
	  <th>ลำดับที่</th>
	  <th>ชื่อกิจกรรมย่อย</th>
	  <?php if(permission('inspect_save', 'candelete')):?><th>ลบ</th><?php endif;?>
	</tr>
	<?php $i=1;?>
	<?php foreach($sub_activities as $sub_activity):?>
	<tr>
		<td><?php echo $sub_activity['title']?><input type='hidden' name='subid' value='<?php echo $sub_activity['id']?>'></td>
		<?php if(permission('inspect_save', 'candelete')):?>
		<td>
			<input type="hidden" name='subacid' value="<?php echo $sub_activity['id']?>">
			<input type='' name='button' id='button' value='' class='btn_delete subact_del'/>
		</td>
		<?php endif;?>
	</tr>
	<?php $i++;?>
	<?php endforeach;?>
</table>

<h3>เอกสาร</h3>
<?php if(permission('inspect_save', 'canadd')):?>
<div id="btnBox" style="width: 110px;"><input type="" title="เพิ่มรายการ" value=" " class="btn_add example82"/></div>
<?php endif;?>
<table class="tblist2 subuploadtb">
        <tr>
          <th align="left">ลำดับที่</th>
          <th align="left">กิจกรรมโครงการย่อย</th>
          <th align="left">หัวข้อรายละเอียดแบบติดตาม</th>
          <th align="left">รายละเอียด </th>
          <th align="left">ไฟล์เอกสารที่แนบ</th>
          <?php if(permission('inspect_save', 'candelete')):?><th align="left">ลบ</th><?php endif;?>
		</tr>
		<?php $i=1;?>
		<?php foreach($files as $file):?>
			<tr>
	          <td><?php echo $file['title']?></td>
	          <td><?php echo $file['follow']?></td>
	          <td><?php echo $file['detail']?></td>
	          <td><span class="show_file"><a href="inspect_save/download_file/<?php echo $file['id']?>"><?php echo $file['filename']?></a></span></td>
	          <?php if(permission('inspect_save', 'candelete')):?><td><input type="hidden" value="<?php echo $file['id']?>"><input type='' name='button' id='button' value='' class='btn_delete file_del' /></td><?php endif;?>
			</tr>
		<?php $i++;?>
		<?php endforeach?>
</table>

<div class="paddT20" style="clear: both;"></div>
<div id="btnBoxAdd">
  <?php if(permission('inspect_save', 'canedit')):?><input type="" title="บันทึก" value="" class="btn_save submit"/><?php endif;?>
  <input type="" title="ย้อนกลับ" value="" onclick="document.location='<?php echo base_url();?>inspect_save?budgetyear=<?php echo $this->uri->segment(3)?>&provincearea=<?php echo $this->uri->segment(5)?>&provinceid=<?php echo $this->uri->segment(6)?>&projectid=<?php echo $this->uri->segment(4)?>#tabs-2'" class="btn_back"/>
  <input type="hidden" name="budgetyear" value="<?php echo $this->uri->segment(3)?>">
  <input type="hidden" name="projectid" value="<?php echo $this->uri->segment(4)?>">
  <input type="hidden" name="provincearea" value="<?php echo $this->uri->segment(5)?>">
  <input type="hidden" name="province" value="<?php echo $this->uri->segment(6)?>">
  <input type="hidden" name="mainacid" value="<?php echo $this->uri->segment(7)?>">
  <input type="hidden" name="id" value="<?php echo @$main_activity['progress_id']?>">
  <input type="hidden" name="url" value="<?php echo uri_string()?>">
</div>

</form>


<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='subactivity_form' style='padding:10px; background:#fff;'>
        <form id="subacfrm" method="post" action="inspect_save/subactivity_save">
        <h3>กิจกรรมย่อย (เพิ่ม / แก้ไข)</h3>
		<table class="tbadd">
        	<tr><th>กิจกรรมหลัก</th><td><?php echo @$main_activity_title?></td></tr>
          <tr>
          <th>กิจกรรมย่อย <span class="Txt_red_12"> *</span></th>
          <td><textarea name="title" rows="5" style="width:100%"></textarea></td>
        </tr>
        </table>
        <div id="btnBoxAdd">
        	<input type="hidden" name="budgetyear" value="<?php echo $this->uri->segment(3)?>">
		    <input type="hidden" name="projectid" value="<?php echo $this->uri->segment(4)?>">
		    <input type="hidden" name="provincearea" value="<?php echo $this->uri->segment(5)?>">
		    <input type="hidden" name="provinceid" value="<?php echo $this->uri->segment(6)?>">
        	<input type="hidden" name="mainacid" value="<?php echo $this->uri->segment(7)?>">
        	<input type="hidden" name="url" value="<?php echo uri_string()?>">
        	<input name="input" type="" title="บันทึก" value=" " class="btn_save subactivity_save"/>
        </div>
        </form>
		</div>
</div>


<!-- This contains the hidden content for inline calls -->
<script type="text/javascript">
$(document).ready(function(){
	$("#upload_frm").submit(function(){
		$("#progress_main_frm input[type=checkbox]").clone().appendTo("#progressplace");
		$("#progress_problem").val($("textarea[name=problem]").val());
		$("#progress_solution").val($("textarea[name=solution]").val());
	});
});
</script>
<div style='display:none;'>
<div id='inline_example82' style='padding:10px; background:#fff;'>
<form id="upload_frm" method="post" action="inspect_save/upload_save" enctype="multipart/form-data">
<h3>เอกสารประกอบ การทำกิจกรรม/โครงการ(เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>กิจกรรมโครงการ</th>
  <td><?php echo @$main_activity_title?></td>
</tr>
<tr>
  <th>กิจกรรมโครงการย่อย<span class="Txt_red_12">  *</span></th>
  <td id="subac_dropdown">
  	<?php echo form_dropdown('subactid',get_option("id","title","insp_project_sub_activity where mainacid = ".$mainacid." and budgetyear = ".$this->uri->segment(3)." and projectid = ".$this->uri->segment(4)." and provincearea = ".$this->uri->segment(5)." and provinceid = ".$this->uri->segment(6)),'','','-- เลือกกิจกรรมโครงการย่อย --','0')?>
  </td>
</tr>
<tr>
  <th>รายการย่อย<br />
    <br />
    <input type="" title="เพิ่มรายการ" value=" " class="btn_addmore add_upload" />
  </th>
  <td>
  <table width="100%" class="uploadtb">
  <tr class="uploadform">
  <td class="follow" style="width:33%">หัวข้อรายละเอียดแบบติดตาม<br />
    <textarea name="follow[]" cols="35" rows="4"></textarea></td>
  <td class="detail" style="width:33%"> รายละเอียด<br />
    <textarea name="detail[]" cols="35" rows="4"></textarea></td>
  <td style="width:33%" valign="top">แนบไฟล์เอกสารอ้างอิง / หลักฐาน<br />
    <input name="filename[]" type="file" size="16" /></td>
  </tr>
  </table>
  
   </td>
</tr>
</table>
        <div id="btnBoxAdd2">
        	<!-- insp progress -->
        	<div id="progressplace" style="display:none;"></div>
        	<input id="progress_problem" type="hidden" name="problem" value="">
        	<input id="progress_solution" type="hidden" name="solution" value="">
        	<input type="hidden" name="budgetyear" value="<?php echo $this->uri->segment(3)?>">
		    <input type="hidden" name="provincearea" value="<?php echo $this->uri->segment(5)?>">
		    <input type="hidden" name="province" value="<?php echo $this->uri->segment(6)?>">
		    <input type="hidden" name="id" value="<?php echo @$main_activity['progress_id']?>">
		    <input type="hidden" name="url" value="<?php echo uri_string()?>">
        	<!-- insp progress -->
        	
        	<input type="hidden" name="projectid" value="<?php echo $this->uri->segment(4)?>">
        	<input type="hidden" name="mainacid" value="<?php echo $this->uri->segment(7)?>">
        	<input type="hidden" name="url" value="<?php echo uri_string()?>">
        	<input type="" title="บันทึก" value=" " class="btn_save upload_save submitUploadFrm"/>
        </div>
</form>
</div>
</div>

<?php
	// --- เช็คผู้ตรวจถ้าเป็น all area (ถ้า return = 0 ดูได้อย่างเดียว) ---
	if(login_data('INSP_ACCESS_ALL') == 'on' && isset($provinceareaid)){
		$inspuser = $this->insp_group->get_row('users_id',login_data('id'));
		$pa = explode(",",@$inspuser['province_area']);
		$return = in_array(@$provinceareaid , $pa);
	}
?>

<script type="text/javascript">
$(document).ready(function(){
	var user = "<?php echo login_data('is_inspector')?>";
	var access_all = "<?php echo login_data('INSP_ACCESS_ALL')?>";
	var chk_inspect_area_in_access_all = "<?php echo @$return?>";

	if(user == 'on'){ //--- ถ้าเป็นผู้ตรวจ ---
		if(access_all == 'on' && chk_inspect_area_in_access_all == 0){ //--- ถ้าไม่ได้อยู่ใน area ที่ตรวจ  ให้เอาปุ่ม submit ออก ---
			$("input:button,input:submit").remove();
		}
	}
});
</script>
