<table class="tblist tbassetlist" style="border:1px solid #ccc">
	<tr>
    	<td>ชื่อรายการ </td>
        <td colspan="3">
        <input type="text" id="assetname" name="assetname" style="width:450px"  value="<?=$asset['assetname'];?>" readonly="readonly" />
        <input type="hidden" id="assetid" name="assetid_<?=$subexpense_id;?>[]" value="<?=$asset['id'];?>">
        <input type="button" id="btnRemoveAsset" name="btnRemoveAsset" value="ลบรายการ"  />
        </td>
    </tr>
    <tr>
      <td>ราคากลาง</td>
      <td>
        <input type="text" id="assetunitprice" name="assetunitprice" value="<?=number_format($asset['price'],2);?>" disabled="disabled" alt="decimal"  />                                      
        <input type="hidden" id="hdassetunitprice_<?=$subexpense_id;?>_<?=$asset['id'];?>" name="hdassetunitprice_<?=$subexpense_id;?>_<?=$asset['id'];?>" value="<?=number_format($asset['price'],2);?>"   />                                      
      </td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>                                    
    <tr>
    	<td>จำนวน</td>
        <td>
        <input name="assetsummaryqty" type="text" disabled="disabled" id="assetsummaryqty" value="" readonly="readonly" alt="integer" />
        <? echo $asset['unit_title'];?>        
        <td>ราคารวม</td>
        <td class="td_assetsummarytotalamount"><input type="text" id="assetsummarytotalamount" name="assetsummarytotalamount" class="assetsummarytotalamount" value="<?=number_format(@$summaryTotalAmount,2);?>" disabled="disabled" alt="decimal" />
          &nbsp;</td>
    </tr>
    <tr>
    	<td>ทดแทน</td>
        <td><input type="text" id="AssetReplaceQTY" name="AssetReplaceQTY_<?=$subexpense_id;?>_<?=$asset['id'];?>" value="" class="AssetQTY Number bgFillData" alt="integer" /><? echo $asset['unit_title'];?></td>
        <td>ซื้อใหม่</td>
        <td><input type="text" id="AssetNewQTY" name="AssetNewQTY_<?=$subexpense_id;?>_<?=$asset['id'];?>" value=""  class="AssetQTY Number bgFillData" alt="integer"   /><? echo $asset['unit_title'];?></td>
    </tr>
    <tr>
      <td>ประมาณการล่วงหน้า</td>
      <td colspan="3">
      <? for($y=1;$y<=3;$y++): ?>
                    ปี <? echo $cyear = $bmaster['budgetyear'] + $y;?>
        <input name="AssetNextBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_<?=$y;?>" type="text" class="Number bgFillData" id="AssetNextBudget_<?=$subexpense_id;?>_<?=$y;?>" style="width:100px" alt="decimal" value="" />
     <? endfor;?>
        &nbsp;</td>
    </tr>
    <tr>
    	<td colspan="4">
			<table class="type1 table_budget">
                  <tr>
                    <th colspan="2" bgcolor="#FFFFFF">ไตรมาส 1 </th>
                    <th colspan="2" bgcolor="#FFFFFF">ไตรมาส 2</th>
                    <th colspan="2" bgcolor="#FFFFFF">ไตรมาส 3</th>
                    <th colspan="2" bgcolor="#FFFFFF">ไตรมาส 4</th>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">ต.ค. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M1" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M1" type="text"  class="budget_q1 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ม.ค.</td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M4" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M4" type="text"  class="budget_q2 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">เม.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M7" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M7" type="text"  class="budget_q3 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ก.ค. </td> 
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M10" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M10" type="text"  class="budget_q4 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">พ.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M2" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M2" type="text"  class="budget_q1 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ก.พ. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M5" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M5" type="text"  class="budget_q2 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">พ.ค. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M8" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M8" type="text"  class="budget_q3 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ส.ค. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M11" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M11" type="text"  class="budget_q4 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">ธ.ค. </td>
                    <td bgcolor="#FFFFFF"> 
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M3" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M3" type="text"  class="budget_q1 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">มี.ค </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M6" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M6" type="text"  class="budget_q2 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">มิ.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M9" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M9" type="text"  class="budget_q3 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ก.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M12" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M12" type="text"  class="budget_q4 budget Number bgFillData"  value="" alt="decimal" />
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">รวม </td>
                    <td bgcolor="#FFFFFF">
                    	<input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_Q1" id="summarybudget_q1"  type="text" readonly="readonly"  value=""  class="summarybudget_q1 Number" alt="decimal"  />
                    </td>
                    <td bgcolor="#FFFFFF">รวม </td>
                    <td bgcolor="#FFFFFF">
                    	<input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_Q2" id="summarybudget_q2"  type="text" readonly="readonly"  value=""  class="summarybudget_q2 Number" alt="decimal"  />
                    </td>
                    <td bgcolor="#FFFFFF">รวม </td>
                    <td bgcolor="#FFFFFF">
                    	<input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_Q3" id="summarybudget_q3"  type="text" readonly="readonly"  value=""  class="summarybudget_q3 Number" alt="decimal"  />
                    </td>
                    <td bgcolor="#FFFFFF">รวม</td>
                    <td bgcolor="#FFFFFF">
                    	<input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_Q4" id="summarybudget_q4" type="text" readonly="readonly"  value=""  class="summarybudget_q4 Number" alt="decimal"  />
                    </td>                    
                  </tr>
          </table>
		<table class="type1">
        <tr>            
            <td>
            <h4>คำชี้แจ้ง</h4>                                         
            <textarea name="GeneralRemark_<?=$subexpense_id;?>_<?=$asset['id'];?>"  id="GeneralRemark_<?=$subexpense_id;?>_<?=$asset['id'];?>" cols="100" rows="3" type="text"   class="bgFillData"></textarea>
          </td>
       </tr>
       </table>                                          
        </td>
    </tr>      
</table>