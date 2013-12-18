<script type="text/javascript">
//$("select:not(select[name=budgetmenu],select[name=budgetyear],select[name=other_page],select[name=projectid],select[name=rdepartment_id])").attr("disabled","disabled");
		$("select:(select[name=mtyear, name=mtdepartment])").live('change',function(){
          var mtyear = "";
          var mtdepartment = "";
          mtyear = $("select[name=mtyear]").val();
          mtdepartment = $("select[name=mtdepartment]").val();
          window.location='monitor_budget_plan/index?mtyear='+mtyear+'&mtdepartment='+mtdepartment;
        })  
</script>
<h3>แผนงบประมาณ กิจกรรมโครงการ และงบประมาณ</h3>
<div class="allstrategy"><img src="images/tree/department.png" /> กรม | <img src="images/tree/down.png" />  เป้าหมายการให้บริการกระทรวง | <img src="images/tree/cube.png"/> ยุทธศาสตร์กระทรวง  | <img src="images/tree/plan_ico.png"> เป้าประสงค์ 4 ปี | <img src="images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | <img src="images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน   | <img src="images/tree/asterisk.png" /> ผลผลิต  |  <img src="images/tree/layout_sidebar.png" /> กิจกรรมหลัก(กรม)  | <img src="images/tree/file.gif" /> กิจกรรมย่อย | <img src="images/tree/project_ico.png" /> โครงการ | <img src="images/tree/subproject_ico.png" /> โครงการย่อย </div>

<div id="btnBox"><input type="submit" title="ดึงข้อมูลแผนงบประมาณ" value="ดึงข้อมูล" class="btn_feed example8" style="margin-right:10px;"/><input type="button" title="เพิ่มรายการ" value=" " onclick="document.location='monitor_budget_plan/form/<?=$budget_level[1];?>';" class="btn_add"/></div>

เลือกแสดงปีงบประมาณ
<select name="mtyear" >
  <option value="" selected="selected">ปี</option>
  <?php  
  foreach($fnyear as $year):
  ?>
  <option value="<?=$year['fnyear'];?>" <? if(@$mtyear == $year['fnyear'])echo "selected";?>><?=($year['fnyear']+543);?></option>  
  <?php endforeach;?>
</select>
<select name="mtdepartment" >
	<option value="" selected="selected">ทั้งหมด</option>
  <?php  
  foreach($dept_opt as $item):
  ?>
  <option value="<?=$item['id'];?>" <? if(@$mtdepartment == $item['id'])echo "selected";?>><?=($item['title']);?></option>  
  <?php endforeach;?>
</select>
<? if($mtyear!=""){?>
<div id="sidetreecontrol" style="margin-top:10px;"><a href="#">Collapse All</a> | <a href="#">Expand All</a></div>

<ul id="tree" class="filetree">
<ul>
	<?php foreach($st_department as $rst_department){ ?>
	<li>
	<img src="images/tree/department.png" /> <?=$rst_department['title'];?><!-- กรม -->
		<ul>
			<?php
			$year_condition = " AND  MTYEAR=".@$_GET['mtyear'];
			$dept_service_result = $this->mt_strategy->where("PID=0 AND departmentid=".$rst_department['id'].$year_condition)->get(FALSE,TRUE); 
			
			foreach($dept_service_result as $dept_service){
			?>
			<li>
			<img src="images/tree/down.png" /> <?=$dept_service['title'];?><!-- เป้าหมายการให้บริการกระทรวง -->
			<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[2];?>/<?=$dept_service['id'];?>';"/>
			<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[1];?>/0/<?=$dept_service['id'];?>';"/>
			<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$dept_service['id'];?>';"/>
				<ul>
				<?php
					$dept_strate_result = $this->mt_strategy->where("PID=".$dept_service['id'].$year_condition)->get(FALSE,TRUE);
					foreach($dept_strate_result as $dept_strate){											
				?>				
					<li>
					<img src="images/tree/cube.png" /> <?=$dept_strate['title'];?><!-- ยุทธศาสตร์กระทรวง -->
					<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[3];?>/<?=$dept_strate['id'];?>';"/>
					<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[2];?>/<?=$dept_strate['pid'];?>/<?=$dept_strate['id'];?>';"/>
					<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$dept_strate['id'];?>';"/>
					<ul>
						<?php
						$dept_target_year_result = $this->mt_strategy->where("PID=".$dept_strate['id'].$year_condition)->get(FALSE,TRUE);
						foreach($dept_target_year_result as $dept_target_year){
						?>
						<li>
						<img src="images/tree/plan_ico.png" /> <?=$dept_target_year['title'];?><!-- เป้าประสงค์ 4 ปี -->
						<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[4];?>/<?=$dept_target_year['id'];?>';"/>
						<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[3];?>/<?=$dept_target_year['pid'];?>/<?=$dept_target_year['id'];?>';"/>
						<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$dept_target_year['id'];?>';"/>							
								<ul>
								<?php
									$section_target_result  = $this->mt_strategy->where("PID=".$dept_target_year['id'].$year_condition)->get(FALSE,TRUE);
									foreach($section_target_result as $section_target){								
								?>
									<li>
									<img src="images/tree/pro.png" /> <?=$section_target['title'];?>
									<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[5];?>/<?=$section_target['id'];?>';"/>
									<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[4];?>/<?=$section_target['pid'];?>/<?=$section_target['id'];?>';"/>
									<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$section_target['id'];?>';"/>
									<ul>
										<?php
											$section_strate_result  = $this->mt_strategy->where("PID=".$section_target['id'].$year_condition)->get(FALSE,TRUE);
											foreach($section_strate_result as $section_strate){									
										?>
											<li>
											<img src="images/tree/chart_bar.png" /> <?=$section_strate['title'];?>
											<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[6];?>/<?=$section_strate['id'];?>';"/>
											<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[5];?>/<?=$section_strate['pid'];?>/<?=$section_strate['id'];?>';"/>
											<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$section_strate['id'];?>';"/>
											<ul>
												<?php
													$prod_result  = $this->mt_strategy->where("PID=".$section_strate['id'].$year_condition)->get(FALSE,TRUE);
													foreach($prod_result as $prod){											
												?>
													<li>
													<img src="images/tree/asterisk.png" /> <?=$prod['title'];?>
													<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[7];?>/<?=$prod['id'];?>';"/>
													<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[6];?>/<?=$prod['pid'];?>/<?=$prod['id'];?>';"/>
													<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$prod['id'];?>';"/>
													<ul>
														<?php
															$mainact_result  = $this->mt_strategy->where("PID=".$prod['id'].$year_condition)->get(FALSE,TRUE);
															foreach($mainact_result as $mainact){									
														?>
															<li>
															<img src="images/tree/layout_sidebar.png" /> <?=$mainact['title'];?>
															<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[8];?>/<?=$mainact['id'];?>';"/>
															<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[7];?>/<?=$mainact['pid'];?>/<?=$mainact['id'];?>';"/>
															<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$mainact['id'];?>';"/>
															<ul>
																<?php
																	$subact_result  = $this->mt_strategy->where("PID=".$mainact['id'].$year_condition)->get(FALSE,TRUE);
																	foreach($subact_result as $subact){										
																?>
																	<li>
																	<img src="images/tree/file.gif" /> <?=$subact['title'];?>
																	<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/form/<?=$budget_level[9];?>/<?=$subact['id'];?>';"/>
																	<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/form/<?=$budget_level[8];?>/<?=$subact['pid'];?>/<?=$subact['id'];?>';"/>
																	<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$subact['id'];?>';"/>
																	<ul>
																		<?php
																			$project_result  = $this->mt_project->where("PID=0 AND SUBACTID=".$subact['id'])->get(FALSE,TRUE);
																			foreach($project_result as $project){											
																		?>
																			<li>
																			<img src="images/tree/project_ico.png" /> <?=$project['title'];?>
																			<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='monitor_budget_plan/sub_project_form/<?=$budget_level[10];?>/<?=$project['id'];?>';"/>
																			<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/project_form/<?=$budget_level[9];?>/<?=$subact['id'];?>/<?=$project['id'];?>';"/>
																			<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$project['id'];?>/project';"/>
																			<ul>
																				<?php
																					$subproject_result  = $this->mt_project->where("PID=".$project['id']." AND SUBACTID=".$subact['id'])->get(FALSE,TRUE);
																					foreach($subproject_result as $subproject){										
																				?>
																					<li>
																					<img src="images/tree/subproject_ico.png" /> <?=$subproject['title'];?>																			
																					<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='monitor_budget_plan/sub_project_form/<?=$budget_level[10];?>/<?=$project['id'];?>/<?=$subproject['id'];?>';"/>
																					<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='monitor_budget_plan/delete/<?=$subproject['id'];?>/project';"/>
																					</li>
																				<?  } ?>	
																			</ul>															
																			</li>
																		<? } ?>	
																	</ul>															
																	</li>
																<? } ?>	
															</ul>
															</li>
														<? } ?>	
													</ul>
													</li>
												<? } ?>	
											</ul>									
											</li>
										<? } ?>	
									</ul>
									</li>
								<?  } ?>	
							</ul>								
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

<? } ?>



<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
		<div id='inline_example1' style='padding:10px; background:#fff;'>
		<form name="fmbudgetfeed" method="post" action="monitor_budget_plan/feed">
        <h3>แผนงบประมาณ (ดึงข้อมูล)</h3>
        <table class="tbadd">
        <tr>
          <th>ปีงบประมาณ </th>
          <td>
          	<select name="budgetfeed">
            <option>ปี</option>
         	<?php echo $option;?>
          </select>
          </td>
        </tr>
        </table>

        <div id="btnBoxAdd"><input name="input" type="submit" title="บันทึก" value=" " class="btn_save" style="display:block;"/></div>
       </form>
  </div>
</div>