<h3>หมวดงบประมาณ</h3>
<div id="list">
<div class="allstrategy" style="margin-bottom:10px;">
<img src="images/tree/folder3.png" /> หมวดงบประมาณ  | 
<img src="images/tree/star.png" width="16" height="16" /> หมวดค่าใช้จ่าย | 
<img src="images/tree/circle.png" /> รายการ | 
<img src="images/tree/file.png" /> รายการครุภัณฑ์
</div>
<div id="btnBox">
	<input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='budget_type/budgettype_form';" class="btn_add"/>
</div>
<div id="sidetreecontrol" style="margin-top:10px;"><a href="#">Collapse All</a> | <a href="#">Expand All</a></div>
<ul id="tree" class="filetree">
<ul>
	<?php 
		$result_1 = $this->budget_type->where("LV=1")->order_by("orderno","asc")->get(FALSE,TRUE);
		foreach($result_1 as $lv1_data){ 
	?>
	<li>
		<img src="images/tree/folder3.png" /> <?=$lv1_data['title'];?><!-- หมวดงบประมาณ-->
		<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_type/expensetype_form/<?=$lv1_data['id'];?>';"/>
		<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_type/budgettype_form/0/<?=$lv1_data['id'];?>';"/>
		<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_type/delete/<?=$lv1_data['id'];?>';"/>
		<ul>
			<?php
			$result_2 = $this->budget_type->where("LV=2 AND PID=".$lv1_data['id'])->order_by("orderno","asc")->get(FALSE,TRUE);
			foreach($result_2 as $lv2_data){
			?>
			<li>
			<img src="images/tree/star.png" /> <?=$lv2_data['title'];?><!-- เป้าหมายการให้บริการกระทรวง -->
			<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_type/form/<?=$lv2_data['id'];?>';"/>
			<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_type/expensetype_form/<?=$lv2_data['pid'];?>/<?=$lv2_data['id'];?>';"/>
			<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_type/delete/<?=$lv2_data['id'];?>';"/>
				<ul>
				<?php
					$result_3 = $this->budget_type->where("LV=3 AND PID=".$lv2_data['id'])->order_by("orderno","asc")->get(FALSE,TRUE);
					foreach($result_3 as $lv3_data){											
				?>				
					<li>
					<img src="images/tree/circle.png" /> <?=$lv3_data['title'];?><!-- ยุทธศาสตร์กระทรวง -->
					<? if($lv3_data['isasset'] > 0){?><input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_type/asset_form/<?=$lv3_data['id'];?>';"/><? } ?>
					<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_type/form/<?=$lv3_data['pid'];?>/<?=$lv3_data['id'];?>';"/>
					<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_type/delete/<?=$lv3_data['id'];?>';"/>
					<ul>
						<?php
						$result_4 = $this->budget_type->where("LV=4 AND PID=".$lv3_data['id'])->order_by("orderno","asc")->get(FALSE,TRUE);
						foreach($result_4 as $lv4_data){	
						?>
						<li>
						<img src="images/tree/file.png" /> <?=$lv4_data['title'];?><!-- เป้าประสงค์ 4 ปี -->						
						<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_type/asset_form/<?=$lv4_data['pid'];?>/<?=$lv4_data['id'];?>';"/>
						<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_type/delete/<?=$lv4_data['id'];?>';"/>																			
						</li>								
						<?
						}
						?>
					</ul>
					</li>				
				<? } ?>
				</ul>
			</li>
			<? } ?>
		</ul> 
	</li>
	<?php } ?>
</ul><!--lv1-->