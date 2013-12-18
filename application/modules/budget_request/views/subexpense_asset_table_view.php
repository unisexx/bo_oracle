<tr class="tr_sub_expense_head" >
  <th valign="top" colspan="2" style="padding-top:10px">
		<table class="tblist" style="background-color:#ccc">
			<tr>
			<td align="left" nowrap="nowrap" width="25%" ><span class="Txt_std14 b"><?=$subexpense['title'];?></span></td>
				<td width="100%%" align="left" >
				<span class="Txt_white14" >
				รวมเงิน <input name="summary_subexpense" type="text" disabled="disabled" class="summary_subexpense budget_expense_mode_<?=$subexpense['expensetypemode'];?>" id="summary_subexpense" value="" alt="decimal"  /> บาท 
				มี <input name="summary_subexpense_qty"  type="text" disabled="disabled" id="summary_subexpense_qty" value="" alt="integer"/> รายการ
				</span>
				</td>
				<td width="15%" align="right">
					<input type="button" name="btnAddAsset" id="btnAddAsset" value="" class="btn_add btn_add_asset" rel="<?=$subexpense['id'];?>" />
				</td>
			</tr>
		</table>
  </th>
</tr>
<tr class="tr_sub_expense_asset_list">
  <td colspan="2">
	<div id="dvassetlist<?=$subexpense['id'];?>" class="dvassetlist">

<?
	$sql = " select budget_type_detail.* from budget_type_detail left join cnf_asset on budget_type_detail.assetid = cnf_asset.id 
	where budgetid=".$projectid." and budgettypeid=".$subexpense['id']." and assetid > 0 order by assetname";
	$asset_list = $this->bg_type_detail->get($sql,TRUE);	
	foreach($asset_list as $item):		
		$sql =' select cnf_asset.*, cnf_count_unit.title unit_title, cnf_budget_type.title asset_type_title 
		from cnf_asset
		left join cnf_count_unit on cnf_asset.unittypeid = cnf_count_unit.id
		left join cnf_budget_type on cnf_asset.assettypeid = cnf_budget_type.id
		where cnf_asset.id='.$item['assetid'];			
		$asset = $this->db->getrow($sql);
		dbConvert($asset);				 	
		$subexpense_id = $subexpense['id'];
?>
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
        <td class="td_assetsummarytotalamount">
        	<input type="text" id="assetsummarytotalamount" name="assetsummarytotalamount" class="assetsummarytotalamount" value="<?=number_format(@$summaryTotalAmount,2);?>" disabled="disabled" alt="decimal" /> บาท
        </td>
    </tr>
    <tr>
    	<td>ทดแทน</td>
        <td><input type="text" id="AssetReplaceQTY" name="AssetReplaceQTY_<?=$subexpense_id;?>_<?=$asset['id'];?>" value="<?=number_format(@$item['rqty'],0);?>" class="AssetQTY Number bgFillData" alt="integer" /> <? echo $asset['unit_title'];?></td>
        <td>ซื้อใหม่</td>
        <td><input type="text" id="AssetNewQTY" name="AssetNewQTY_<?=$subexpense_id;?>_<?=$asset['id'];?>" value="<?=number_format(@$item['nqty'],0);?>"  class="AssetQTY Number bgFillData" alt="integer"   /> <? echo $asset['unit_title'];?></td>
    </tr>
    <tr>
      <td>ประมาณการล่วงหน้า</td>
      <td colspan="3"><? 
	  for($y=1;$y<=3;$y++)
	  {
	?>
        ปี <? echo $cyear = $bmaster['budgetyear'] + $y;?>
        <input name="AssetNextBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_<?=$y;?>" type="text" class="Number bgFillData" id="AssetNextBudget_<?=$subexpense_id;?>_<?=$y;?>" style="width:100px" alt="decimal" value="<?=number_format(@$item['budget_ny'.$y],2);?>" />
        <? } ?>
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
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M1" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M1" type="text"  class="budget_q1 budget Number bgFillData"  value="<?=number_format(@$item['budget_m1'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ม.ค.</td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M4" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M4" type="text"  class="budget_q2 budget Number bgFillData"  value="<?=number_format(@$item['budget_m4'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">เม.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M7" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M7" type="text"  class="budget_q3 budget Number bgFillData"  value="<?=number_format(@$item['budget_m7'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ก.ค. </td> 
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M10" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M10" type="text"  class="budget_q4 budget Number bgFillData"  value="<?=number_format(@$item['budget_m10'],2);?>" alt="decimal" />
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">พ.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M2" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M2" type="text"  class="budget_q1 budget Number bgFillData"  value="<?=number_format(@$item['budget_m2'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ก.พ. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M5" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M5" type="text"  class="budget_q2 budget Number bgFillData"  value="<?=number_format(@$item['budget_m5'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">พ.ค. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M8" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M8" type="text"  class="budget_q3 budget Number bgFillData"  value="<?=number_format(@$item['budget_m8'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ส.ค. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M11" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M11" type="text"  class="budget_q4 budget Number bgFillData"  value="<?=number_format(@$item['budget_m11'],2);?>" alt="decimal" />
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor="#FFFFFF">ธ.ค. </td>
                    <td bgcolor="#FFFFFF"> 
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M3" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M3" type="text"  class="budget_q1 budget Number bgFillData"  value="<?=number_format(@$item['budget_m3'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">มี.ค </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M6" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M6" type="text"  class="budget_q2 budget Number bgFillData"  value="<?=number_format(@$item['budget_m6'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">มิ.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M9" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M9" type="text"  class="budget_q3 budget Number bgFillData"  value="<?=number_format(@$item['budget_m9'],2);?>" alt="decimal" />
                    </td>
                    <td bgcolor="#FFFFFF">ก.ย. </td>
                    <td bgcolor="#FFFFFF">
                    <input name="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M12" id="AssetBudget_<?=$subexpense_id;?>_<?=$asset['id'];?>_M12" type="text"  class="budget_q4 budget Number bgFillData"  value="<?=number_format(@$item['budget_m12'],2);?>" alt="decimal" />
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
<? endforeach;?>











							
	</div>
  </td>
</tr>