<tr>
	<td class="td_subexpense_detail" colspan="2" height="25">
		<table class="tblist" style="background-color:#ccc">
    	<tr>
        	<td align="left" valign="top" nowrap="nowrap"  ><span class="Txt_white14" >
              <input type="checkbox" name="chkcalculatedetail<?=$subexpense['id'];?>" id="chkcalculatedetail<?=$subexpense['id'];?>" rel="DV<?=$subexpense['id'];?>" class="ChkBox"  value="DV<?=$subexpense['id'];?>" <? if(@$bbudgetDetail[$subexpense['id']]['chkcalculatedetail']=='on')echo "checked";?> />              
			  <?=$subexpense['title'];?></span>
            </td>                                      
            <td nowrap="nowrap" width="100%" align="right" ><span class="Txt_white14" >                                      	 
             <?  if(@in_array($subexpense['id'],@$haveQTY)){ ?>
			 จำนวนอัตรา <input name="summaryqtylv3<?=$subexpense['id'];?>" type="text" id="summaryqtylv3<?=$subexpense['id'];?>" size="10" value="<?=@$bbudgetDetail[$subexpense['id']]['qty'];?>" class="Number bgFillData" alt="integer" /> 
			 อัตรา                           
			 <? } ?>
			 &nbsp;รวมเงิน ปี
		<?=$budgetyear;?>         
        <input name="summary_subexpense" id="summary_subexpense" type="text"  disabled="disabled"  class="summary_subexpense budget_expense_mode_<?=$subexpense['expensetypemode'];?>" value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['summarybudget'],2);?>" alt="decimal" style="width:100px" />
        <? 
		  for($y=1;$y<=3;$y++)
		  {
		?>
          	ปี <? echo $cyear = $budgetyear+$y;?>
            <input name="summarynextbudgetlv3<?=$subexpense['id'];?>_<?=$y;?>" type="text" class="Number bgFillData" id="summarynextbudgetlv3<?=$subexpense['id'];?>_<?=$y;?>" style="width:100px" alt="decimal" value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['budget_ny'.$y],2);?>" />
          <? } ?>
            </span>
            </td>
          </tr>
          
          <? 
		if(@in_array(@$subexpense['id'],@$isFoodOverTime))
		 {		 
		 ?>
          <tr>
		    	<td align="left" valign="top" nowrap="nowrap" style="padding:10px;">
		    		<?=$subexpense['id'];?>
				 จำนวน 
		         <input type="text" id="QTYFoodOverTime<?=$subexpense['id'];?>" name="QTYFoodOverTime<?=$subexpense['id'];?>" value="<?=@$bbudgetDetail[$subexpense['id']]['fotnhuman'];?>"  class="Number bgFillData"  alt="integer" />
		          คน 
		        <input type="text" id="NDayFoodOverTime<?=$subexpense['id'];?>" name="NDayFoodOverTime<?=$subexpense['id'];?>" value="<?=@$bbudgetDetail[$subexpense['id']]['fotnday'];?>" class="Number bgFillData"  alt="integer"  />  วัน
		        <input type="text" id="PerDayFoodOverTime<?=$subexpense['id'];?>" name="PerDayFoodOverTime<?=$subexpense['id'];?>" value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['fodperday'],2);?>" class="Number bgFillData"  alt="decimal" />  
		        บาท/ต่อวัน 
		         รวมเงิน 
		         <input name="SummaryFoodOverTime<?=$subexpense['id'];?>" id="SummaryFoodOverTime<?=$subexpense['id'];?>" type="text"  disabled="disabled" value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['sumfod'],2);?>" alt="decimal"  />
		    	</td>
		    </tr>
          <? } ?>
          
       </table>
	<div style="clear:both"></div>
	            
	
                   <div id="DV<?=$subexpense['id'];?>">                                   
                                <table class="type1 table_budget" id="tb_budget<?=$subexpense['id'];?>"  name="tb_budget<?=$subexpense['id'];?>">
                                      <tr>
                                        <th colspan="2">ไตรมาส 1 </th>
                                        <th colspan="2">ไตรมาส 2</th>
                                        <th colspan="2">ไตรมาส 3</th>
                                        <th colspan="2">ไตรมาส 4</th>
                                      </tr>
                                      <tr>
                                        <td>ต.ค. </td>
                                        <td class="td_budget_q1">
                                        	<input name="budget<?=$subexpense['id'];?>_M1" type="text"   class="budget_q1 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M1'],2);?>" alt="decimal" />
                                        </td>
                                        <td>ม.ค.</td>
                                        <td class="td_budget_q2">
                                        	<input name="budget<?=$subexpense['id'];?>_M4" type="text"   class="budget_q2 budget Number bgFillData"  value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M4'],2);?>" alt="decimal"   />
                                        </td>
                                        <td>เม.ย. </td>
                                        <td class="td_budget_q3">
                                        	<input name="budget<?=$subexpense['id'];?>_M7" type="text"   class="budget_q3 budget Number bgFillData"  value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M7'],2);?>" alt="decimal"   />
                                        </td>
                                        <td>ก.ค. </td>
                                        <td class="td_budget_q4">
                                        	<input name="budget<?=$subexpense['id'];?>_M10" type="text"  class="budget_q4 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M10'],2);?>" alt="decimal"  />
                                         </td>
                                      </tr>
                                      <tr>
                                        <td>พ.ย. </td>
                                        <td class="td_budget_q1"><input name="budget<?=$subexpense['id'];?>_M2" type="text"   class="budget_q1 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M2'],2);?>" alt="decimal" /></td>
                                        <td>ก.พ. </td> 
                                        <td class="td_budget_q2"><input name="budget<?=$subexpense['id'];?>_M5" type="text"  class="budget_q2 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M5'],2);?>" alt="decimal"   /></td>
                                        <td>พ.ค. </td>
                                        <td class="td_budget_q3"><input name="budget<?=$subexpense['id'];?>_M8" type="text"   class="budget_q3 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M8'],2);?>" alt="decimal"  /></td>
                                        <td>ส.ค. </td>
                                        <td class="td_budget_q4"><input name="budget<?=$subexpense['id'];?>_M11" type="text"  class="budget_q4 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M11'],2);?>" alt="decimal" /></td>
                                      </tr>
                                      <tr>
                                        <td>ธ.ค. </td>
                                        <td class="td_budget_q1"><input name="budget<?=$subexpense['id'];?>_M3" type="text"  class="budget_q1 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M3'],2);?>" alt="decimal" /></td>
                                        <td>มี.ค </td>
                                        <td class="td_budget_q2"><input name="budget<?=$subexpense['id'];?>_M6" type="text" class="budget_q2 budget Number bgFillData"  value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M6'],2);?>" alt="decimal"   /></td>
                                        <td>มิ.ย. </td>
                                        <td class="td_budget_q3"><input name="budget<?=$subexpense['id'];?>_M9" type="text" class="budget_q3 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M9'],2);?>" alt="decimal" /></td>
                                        <td>ก.ย. </td>
                                        <td class="td_budget_q4"><input name="budget<?=$subexpense['id'];?>_M12" type="text" class="budget_q4 budget Number bgFillData"   value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['M12'],2);?>" alt="decimal"  /></td>
                                      </tr>
                                      <tr>
                                        <td>รวม </td>
                                        <td><input name="summarybudget_q1" id="summarybudget_q1" type="text" disabled="disabled"  value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['Q1'],2);?>" class="summarybudget_q1" alt="decimal" /></td>
                                        <td>รวม </td>
                                        <td><input name="summarybudget_q2" id="summarybudget_q2" type="text" disabled="disabled"  value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['Q2'],2);?>" class="summarybudget_q2" alt="decimal"></td>
                                        <td>รวม </td>
                                        <td><input name="summarybudget_q3" id="summarybudget_q3" type="text" disabled="disabled"  value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['Q3'],2);?>" class="summarybudget_q3" alt="decimal"></td>
                                        <td>รวม</td>
                                        <td><input name="summarybudget_q4" id="summarybudget_q4" type="text" disabled="disabled"  value="<?=number_format(@$bbudgetDetail[$subexpense['id']]['Q4'],2);?>" class="summarybudget_q4" alt="decimal"></td>
                                      </tr>
                                    </table>
			<? 
			if(@in_array($subexpense['id'],@$haveRemark)):									
			?>
		 	<table class="type1">
        	<tr>                
              <td>          
                <h4>คำชี้แจง</h4>                               
                <textarea name="GeneralRemark<?=$subexpense['id'];?>" cols="100" rows="3" id="GeneralRemark<?=$subexpense['id'];?>" type="text" class="bgFillData"  ><?=@$bbudgetDetail[$subexpense['id']]['REMARK'];?></textarea>
              </td>
           </tr>
           </table>
           <? endif; ?>
           <? if(@in_array($subexpense['id'],@$haveAllowanceRemark)):?>
            <table class="type1">
        	<tr>                
              <td >         
                <h4>คำชี้แจงค่าเบี้ยเลี้ยง</h4>                                
                <textarea name="AllowanceRemark<?=$subexpense['id'];?>" cols="100" rows="3" id="AllowanceRemark<?=$subexpense['id'];?>" type="text" class="bgFillData"  ><?=@$bbudgetDetail[$subexpense['id']]['ALLOWANCEREMARK'];?></textarea>
              </td>
           </tr>
           </table>
           <? endif; ?> 
           <? if(@in_array($subexpense['id'],@$haveAllowanceRemark)):	?>
		  <table class="type1">
        	<tr>                
              <td >     
                <h4>คำชี้แจงค่าเช่าที่พัก</h4>                                       
                <textarea name="AccomodationRemark<?=$subexpense['id'];?>" cols="100" rows="3" id="AccomodationRemark<?=$subexpense['id'];?>" type="text" class="bgFillData"  ><?=@$bbudgetDetail[$subexpense['id']]['ACCOMODATIONREMARK'];?></textarea>
              </td>
           </tr>
           </table>
          <? endif;?> 
		  <? if(@in_array($subexpense['id'],@$haveVehicleRemark)): ?>
		  <table class="type1">
        	<tr>                
                <td >               
                <h4>คำชี้แจงค่าเช่าพาหนะ</h4>                          
                <textarea name="VehicleRemark<?=$subexpense['id'];?>" cols="100" rows="3" id="VehicleRemark<?=$subexpense['id'];?>" type="text" class="bgFillData"  ><?=@$bbudgetDetail[$subexpense['id']]['VEHICLEREMARK'];?></textarea>
              </td>
           </tr>
           </table>
          <? endif; ?>  
		  <? if(@in_array($subexpense['id'],@$haveDocumentRemark)):?>
		  <table class="type1">
        	<tr>                
              <td >          
                <h4>คำชี้แจงค่าจ้างเหมาเอกสารสื่อสิ่งพิมพ์</h4>                               
                <textarea name="DocumentRemark<?=$subexpense['id'];?>" cols="100" rows="3" id="DocumentRemark<?=$subexpense['id'];?>" type="text" class="bgFillData"  ><?=@$bbudgetDetail[$subexpense['id']]['DOCUMENTREMARK'];?></textarea>
              </td>
           </tr>
           </table>
          <? endif;?>
		   <? if(@in_array($subexpense['id'],@$haveHumanRemark)):?>
		  <table class="type1">
        	<tr>                
                <td >            
                <h4>คำชี้แจ้งค่าจ้างเหมาบุคคล</h4>                             
                <textarea name="HumanRemark<?=$subexpense['id'];?>" cols="100" rows="3" id="HumanRemark<?=$subexpense['id'];?>" type="text" class="bgFillData" ><?=@$bbudgetDetail[$subexpense['id']]['HUMANREMARK'];?></textarea>
              </td>
           </tr>
           </table>
          <? endif; ?> 
		   <? if(@in_array($subexpense['id'],@$haveServiceRemark)):?>
		  <table class="type1">
        	<tr>                
              <td >                     
                <h4>คำชี้แจงบริการอื่น ๆ</h4>                    
                <textarea name="ServiceRemark<?=$subexpense['id'];?>" cols="100" rows="3" id="ServiceRemark<?=$subexpense['id'];?>" type="text" class="bgFillData"  ><?=@$bbudgetDetail[$subexpense['id']]['SERVICEREMARK'];?></textarea>
              </td>
           </tr>
           </table>                          
          <? endif ?>                                                                                                                                   
          </div>                 
	</td>
</tr>