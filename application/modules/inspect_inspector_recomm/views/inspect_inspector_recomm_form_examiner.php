<!-- Load TinyMCE -->
<script type="text/javascript" src="media/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="media/tiny_mce/config.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var suggesionCount = $("textarea[name='suggestion[]']").size();
		//alert (suggesionCount);
		for( i=1; i <= suggesionCount; i++){
		  tiny("suggestion-"+i);
		  tiny("counsel-"+i);
		}
		/*
		var operationCount = $("textarea[name='operationresult[]']").size();
		for( j=1; j <= operationCount; j++){
		  tiny("operationresult-"+j);
		}
		*/
	});
</script>
<script type="text/javascript">
function DeleteAttach(pItemID){
		if(confirm('ต้องการลบไฟล์เอกสารแนบนี้'))
		{
			$.post('inspect_inspector_recomm/delete_attach',{
				'id' : pItemID,				
			},function(data){
				$(".dvAttach"+pItemID).html("");																	
			})
		}
}
</script>
<form method="post" enctype="multipart/form-data" action="inspect_inspector_recomm/save/<?=$budgetyear;?>/<?=$provincearea;?>/<?=$provinceid;?><?=$url_parameter;?>">
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
  <th style="width:300px;">ผลการดำเนินงาน</th>
  <!-- <th style="width:200px;">ข้อเสนอแนะ</th> -->
</tr>
<?php $i = 1?>
<? foreach($province_data as $item):?>
<tr>
  <td><?=$item['provincetitle'];?></td>
  <td>
  	<?php
  		$provinceid = $item['provinceid'];
		$sql = "SELECT INSP_INSPECTOR_RECOMM.*,cnf_workgroup.title workgroup_title FROM INSP_INSPECTOR_RECOMM left join cnf_workgroup on INSP_INSPECTOR_RECOMM.workgroup_id = cnf_workgroup.id where budgetyear = $budgetyear and provinceid = $provinceid and provincearea_id = $provincearea";
  		$recomm = $this->recomm->get($sql);
  	?>
  	<?php if(is_inspector($this->uri->segment(4))): ?>
  	<textarea name="suggestion[]" rows="5" id="suggestion-<?php echo $i?>"><?php echo @$recomm[0]['suggestion']?></textarea>
  	<input type="hidden" id="provinceid" name="provinceid[]" value="<?php echo @$recomm[0]['provinceid']?>">
  	<?php else:?>
  		<?php echo @$recomm[0]['suggestion']?>
  	<?php endif;?>
  </td>
  <td>
  	<?php @$j = ($j > 1) ? $j : "1" ; ?>
    <?php foreach($recomm as $row): ?>
    	<div style="background:#E6E6E6; padding: 8px;">หน่วยงาน  : <?php echo $row['workgroup_title']?></div>
	    	<!--<textarea name="operationresult[]" rows="5" id="operationresult-<?php echo $j?>" style="width:100%;" disabled><?=$row['operationresult'];?></textarea>-->
	    	<div style="padding:5px 10px;"><?=$row['operationresult'];?>
	    	<input type="hidden" name="id[]" value="<?=$row['id'];?>">
	    	<input type="hidden" name="hdattachdocument[]" value="<?=$row['attachdocument'];?>">
		    <? if($row['attachdocument']!=''){?>
				<div style="margin: 5px 0 0 0;" class="dvAttach<?=$row['id'];?>">
						<ul class="show_file">		
							<li>						
								<? echo anchor(base_url().'inspect_inspector_recomm/download/'.$row['attachdocument'], 'ดูเอกสาร');?>  	
								<span>
									<input type="button" title="ลบเอกสาร" class="btn_delete" onclick="DeleteAttach('<?=$row['id'];?>')" name="del" style="vertical-align: text-bottom; display:none;">							
								</span>
							</li>
						</ul>
					</div>
					<input type="file" name="attachdocument[]" id="attachdocument" style="display:none;"/>
					<br clear="all">
		    <? }else{ ?>
				<input type="file" name="attachdocument[]" id="attachdocument" style="display:none;"/>
		    <?php }?>
	    </div>
	    <hr>
	<?php $j++?>
    <?php endforeach;?>
    </td>
    <!-- <td>
    <textarea name="counsel[]" id="counsel-<?php echo $i?>"><?php echo $recomm[0]['counsel']?></textarea>
    </td> -->
</tr>
<?php $i++?>
<? endforeach;?>
</table>


<div id="btnBoxAdd">
  <?php if(is_inspector($this->uri->segment(4))): ?>
  <input name="input" type="submit" title="บันทึก" value=" " class="btn_save"/>
  <?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="window.location='inspect_inspector_recomm/index?budgetyear=<?=$budgetyear;?>&provincearea=<?=$provincearea;?>&provinceid=<?=$provinceid;?>';" class="btn_back"/>
</div>
</form>