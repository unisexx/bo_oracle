<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/config.js"></script>
<script type="text/javascript">
	tiny('suggestion,operationresult');
</script>
<script type="text/javascript">
$(document).ready(function(){
	$(".btn_delete").click(function(){
		if(confirm('ต้องการลบไฟล์เอกสารแนบนี้'))
		{
			var id = $(this).siblings("input[type=hidden][name=attid]").val();
			$.post('inspect_inspector_recomm/delete_attach',{
				'id' : id
			},function(data){
				$(".dvAttach"+id).html("");
				$("<input type='file' name='attachdocument' id='attachdocument' style='margin-top:5px;'/>").insertBefore(".dvAttach"+id);																	
			})
		}
	});
});
</script>
<form method="post" enctype="multipart/form-data" action="inspect_inspector_recomm/workgroup_save/<?=$budgetyear;?>/<?=$provincearea;?>/<?=$provinceid;?><?=$url_parameter;?>">
<h3>บันทึก ข้อเสนอแนะผู้ตรวจ (เพิ่ม / แก้ไข)</h3>
<h5>รายละเอียดข้อมูลเงินงบประมาณระหว่างปี</h5>
<table class="tbadd">
<tr>
  <th><label for="fid-7111_id">ปี <span class="Txt_red_12"> *</span></label></th>
  <td><?=$budgetyear+543;?></td>
</tr>
<tr>
  <th>เขตตรวจที่ </th>
  <td>
  	<?=$provinceareatitle;?>
    </td>
</tr>
<tr>
  <th>จังหวัด</th>
  <td>
  <?=$provincetitle;?>
  </td>
</tr>
</table>

<div class="paddT20"></div>
<table width="100%" class="tblist4">
<tr class="topic">
  <th colspan="4"><?=$provinceareatitle;?></th>
  </tr>
<tr>
  <th>จังหวัด</th>
  <th style="width:300px;">ข้อเสนอแนะ (ผู้ตรวจราชการ)</th>
  <th style="width:300px;">ผลการดำเนินงาน (<?php echo $workgroup['title'] ?>)</th>
  <!-- <th style="width:200px;">ข้อเสนอแนะ</th> -->
</tr>

<tr>
  <td><?php echo $provincetitle?></td>
  <td>
  	<!--<textarea name="suggestion" rows="5" id="suggestion" style="width:100%;" disabled><?php echo $province_data['suggestion']?></textarea>-->
  	<?php echo $province_data['suggestion']?>
  </td>
  <td>
    <textarea name="operationresult" rows="5" id="operationresult" style="width:100%;"><?=$province_data['operationresult'];?></textarea>
    <? if($province_data['attachdocument']!=''){?>
    	<br />
		<div class="dvAttach<?=$province_data['id'];?>">
				<ul class="show_file">		
					<li>
						<? echo anchor(base_url().'inspect_inspector_recomm/download/'.$province_data['attachdocument'], 'ดูเอกสาร');?>  	
						<span>
							<input type="hidden" name="attid" value="<?php echo $province_data['id']?>">
							<input type="button" title="ลบเอกสาร" class="btn_delete" name="del" style="vertical-align:text-bottom;">							
						</span>
					</li>
		
				</ul>
			</div>			    
    <? }else{ ?>
    <br clear="all">
    <input type="file" name="attachdocument" id="attachdocument" style="margin-top:5px;"/>    
    <? } ?>
    </td>
    <!-- <td><?php echo $province_data['counsel']?></td> -->
</tr>

</table>


<div id="btnBoxAdd">
  <input type="hidden" name="budgetyear" value="<?php echo $budgetyear?>">
  <input type="hidden" name="provincearea_id" value="<?php echo $provincearea?>">
  <input type="hidden" name="provinceid" value="<?php echo $provinceid?>">
  <input type="hidden" name="workgroup_id" value="<?php echo login_data('workgroupid')?>">
  <input type="hidden" name="id" value="<?php echo $province_data['id']?>">
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="window.location='inspect_inspector_recomm/index?budgetyear=<?=$budgetyear;?>&provincearea=<?=$provincearea;?>&provinceid=<?=$provinceid;?>';" class="btn_back"/>
</div>
</form>