<div id="list">
<h3>ความเชื่อมโยงแผนงบประมาณ</h3>
	<div class="allstrategy" style="margin-bottom:10px;">
	  <img src="images/tree/folder.gif" /> ยุทธศาสตร์การจัดสรรงบประมาณ  | 
	  <img src="images/tree/plan_ico.png" width="16" height="16" /> แผนงาน | 
	  <img src="images/tree/binocular.png" /> เป้าหมายเชิงยุทธศาสตร์ | 
	  <img src="images/tree/down.png" /> เป้าหมายการให้บริการกระทรวง |  
	  <img src="images/tree/cube.png" /> ยุทธศาสตร์กระทรวง <br />
	  <img src="images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | 
	  <img src="images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน | 
	  <img src="images/tree/asterisk.png" /> ผลผลิต | 
	  <img src="images/tree/peace.png" /> นโยบายการจัดสรรงบประมาณ |  
	  <img src="images/tree/layout_sidebar.png" /> กิจกรรมหลัก  | 
	  <img src="images/tree/file.gif" /> กิจกรรมย่อย 
	 </div>
<div class="addProject right1">
<input type="button" value=""  onclick="window.location='budget_plan/form/<?=@$budgetyear;?>/1'" class="btn_add tip" title="เพิ่ม ยุทธศาสตร์การจัดสรรงบประมาณ "/>
</div>	 
เลือกแสดงปีงบประมาณ
<select name="budgetyear" id="budgetyear" onchange="window.location='budget_plan/index?budgetyear='+this.value;">
  <option value="">ปี</option>
  <?
  $sql = "SELECT * FROM CNF_SET_TIME ORDER BY BYEAR ";
  $result = $this->db->getarray($sql);
  foreach($result as $ryear)
  {
  ?>
  <option value="<?=$ryear['BYEAR']-543;?>" <? if(($ryear['BYEAR']-543)==@$_GET['budgetyear'])echo "selected";?>><?=$ryear['BYEAR'];?></option>
  <?
  }
  ?>
</select>
<? if(@$_GET['budgetyear']>0){ ?>
<div id="sidetreecontrol" style="margin-top:10px;"><a href="#">Collapse All</a> | <a href="#">Expand All</a></div>

<ul id="tree" class="filetree">	
			<?php
			$condition = @$_GET['budgetyear']!='' ? " AND syear=".$_GET['budgetyear'] : "";
			$strategy_result = $this->budget_plan->where("PID=0".$condition)->get(FALSE,TRUE); 
			foreach($strategy_result as $strategy){
			?>
			<li>
			<img src="images/tree/folder.gif" /> <?=$strategy['title'];?><!-- เป้าหมายการให้บริการกระทรวง -->
			<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/2/<?=$strategy['id'];?>';"/>
			<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/1/0/<?=$strategy['id'];?>';"/>
			<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$strategy['id'];?>';"/>
				<ul>
				<?php
					$plan_result = $this->budget_plan->where("PID=".$strategy['id'])->get(FALSE,TRUE);
					foreach($plan_result as $plan){											
				?>				
					<li>
					<img src="images/tree/plan_ico.png" /> <?=$plan['title'];?><!-- ยุทธศาสตร์กระทรวง -->
					<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/3/<?=$plan['id'];?>';"/>
					<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/2/<?=$plan['pid'];?>/<?=$plan['id'];?>';"/>
					<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$plan['id'];?>';"/>
					<ul>
						<?php
						$strategy_target_result = $this->budget_plan->where("PID=".$plan['id'])->get(FALSE,TRUE);
						foreach($strategy_target_result as $strategy_target){
						?>
						<li>
						<img src="images/tree/binocular.png" /> <?=$strategy_target['title'];?><!-- เป้าประสงค์ 4 ปี -->
						<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/4/<?=$strategy_target['id'];?>';"/>
						<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/3/<?=$strategy_target['pid'];?>/<?=$strategy_target['id'];?>';"/>
						<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$strategy_target['id'];?>';"/>							
								<ul>
								<?php
									$department_service_target_result  = $this->budget_plan->where("PID=".$strategy_target['id'])->get(FALSE,TRUE);
									foreach($department_service_target_result as $department_service_target){								
								?>
									<li>
									<img src="images/tree/down.png" /> <?=$department_service_target['title'];?>
									<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/5/<?=$department_service_target['id'];?>';"/>
									<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/4/<?=$department_service_target['pid'];?>/<?=$department_service_target['id'];?>';"/>
									<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$department_service_target['id'];?>';"/>
									<ul>
										<?php
											$department_strategy_result  = $this->budget_plan->where("PID=".$department_service_target['id'])->get(FALSE,TRUE);
											foreach($department_strategy_result as $department_strategy){									
										?>
											<li>
											<img src="images/tree/cube.png" /> <?=$department_strategy['title'];?>
											<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/6/<?=$department_strategy['id'];?>';"/>
											<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/5/<?=$department_strategy['pid'];?>/<?=$department_strategy['id'];?>';"/>
											<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$department_strategy['id'];?>';"/>
											<ul>
												<?php
													$division_service_target_result  = $this->budget_plan->where("PID=".$department_strategy['id'])->get(FALSE,TRUE);
													foreach($division_service_target_result as $division_service_target){											
												?>
													<li>
													<img src="images/tree/pro.png" /> <?=$division_service_target['title'];?>
													<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/7/<?=$division_service_target['id'];?>';"/>
													<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/6/<?=$division_service_target['pid'];?>/<?=$division_service_target['id'];?>';"/>
													<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$division_service_target['id'];?>';"/>
													<ul>
														<?php
															$division_strategy_result  = $this->budget_plan->where("PID=".$division_service_target['id'])->get(FALSE,TRUE);
															foreach($division_strategy_result as $division_strategy){									
														?>
															<li>
															<img src="images/tree/chart_bar.png" /> <?=$division_strategy['title'];?>
															<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/8/<?=$division_strategy['id'];?>';"/>
															<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/7/<?=$division_strategy['pid'];?>/<?=$division_strategy['id'];?>';"/>
															<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$division_strategy['id'];?>';"/>
																<ul>
																	<?php
																		$productivity_result  = $this->budget_plan->where("PID=".$division_strategy['id'])->get(FALSE,TRUE);
																		foreach($productivity_result as $productivity){										
																	?>
																		<li>
																		<img src="images/tree/asterisk.png" /> <?=$productivity['title'];?>
																		<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/9/<?=$productivity['id'];?>';"/>
																		<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/8/<?=$productivity['pid'];?>/<?=$productivity['id'];?>';"/>
																		<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$productivity['id'];?>';"/>
																		<ul>
																			<?php
																				$budget_policy_result  = $this->budget_plan->where("PID=".$productivity['id'])->get(FALSE,TRUE);
																				foreach($budget_policy_result as $budget_policy){											
																			?>
																				<li>
																				<img src="images/tree/peace.png" /> <?=$budget_policy['title'];?>
																				<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/10/<?=$budget_policy['id'];?>';"/>
																				<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/9/<?=$budget_policy['pid'];?>/<?=$budget_policy['id'];?>';"/>
																				<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$budget_policy['id'];?>';"/>
																				<ul>
																					<?php
																						$main_activity_result  = $this->budget_plan->where("PID=".$budget_policy['id'])->get(FALSE,TRUE);
																						foreach($main_activity_result as $main_activity){										
																					?>
																						<li>
																						<img src="images/tree/layout_sidebar.png" /> <?=$main_activity['title'];?>																			
																						<input type="button" class="btn_addico vtip" title="เพิ่มรายการ" onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/11/<?=$main_activity['id'];?>';"/>
																						<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/10/<?=$main_activity['pid'];?>/<?=$main_activity['id'];?>';"/>
																						<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$main_activity['id'];?>';"/>
																						<ul>
																							<?php
																								$sub_activity_result  = $this->budget_plan->where("PID=".$main_activity['id'])->get(FALSE,TRUE);
																								foreach($sub_activity_result as $sub_activity){										
																							?>
																								<li>
																								<img src="images/tree/file.png" /> <?=$sub_activity['title'];?>																			
																								<input type="button" class="btn_editico vtip" title="แก้ไขรายการนี้"  onclick="window.location='budget_plan/form/<?=@$_GET['budgetyear'];?>/11/<?=$sub_activity['pid'];?>/<?=$sub_activity['id'];?>';"/>
																								<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" onclick="window.location='budget_plan/delete/<?=$sub_activity['id'];?>';"/>
																								</li>
																							<?  } ?>	
																						</ul>
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
</ul><!--lv1-->
<? } ?>