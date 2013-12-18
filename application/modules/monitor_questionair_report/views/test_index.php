<script type="text/javascript">
$(document).ready(function(){
	//$('select[name=pprovince_id],select[name=pproductivity_id],select[name=mtyear],select[name=pdepartment_id],select[name=pdivision_id]').attr('class','mustChoose');
	$('select[name=pdepartment_id]').live('change',function(){
		var departmentid = ($(this).val());	
		if(departmentid != 0){
			$("select[name=pdivision_id]").removeAttr('disabled');	
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvpdivision_id");
			$.post('ajax/load_division_list',{
				'departmentid' : departmentid,
				'canaccessall' : '<?=login_data('mt_access_all');?>'
			},function(data){
				$("#dvpdivision_id").html(data);
				$("select[name=divisionid]").attr("id","pdivision_id");
				$("#pdivision_id").attr('name', 'pdivision_id');
				$("select[name=pdivision_id]").attr('class','mustChoose');										
			})
		}
	})
	
	$('select[name=mtyear]').live('change',function(){
		var mtyear = ($(this).val());
		var departmentid = $('select[name=pdepartment_id]').val();
		var divisionid = $('select[name=pdivision_id]').val();
		if(mtyear != 0){
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#dvProductivity");
			$.post('monitor_operation_withdraw/select_productivity_list',{
				'mtyear' : mtyear,
				'departmentid' : departmentid,
				'divisionid' : divisionid,
			},function(data){
				$("#dvProductivity").html(data);	
				$("select[name=pproductivity_id]").attr('class','mustChoose');												
			})	
		}
	})		
})
</script>
<h3>รายงานสรุป แบบสำรวจความพึงพอใจของผู้รับบริการ</h3>
<form>
<fieldset>
	<legend>กรองข้อมูล</legend>
	<div>
	จังหวัด : 
	<?php
		$can_access_all = login_data('mt_access_all');
		if($can_access_all!="off"){
			echo form_dropdown('pprovince_id',get_option('id','title','cnf_province','id <> 2'),@$_GET['pprovince_id'],'','-- ทั่วประเทศ --');
		}
		else{
			echo form_dropdown('pprovince_id',get_option('id','title','cnf_province',"id=".login_data('workgroup_provinceid')),'','');
		}				
	?>
           ตั้งแต่วันที่  
    <input type="text" class="datepicker" name="start_date" value="<?=@$_GET['start_date'];?>">
            ถึง
    <input type="text" class="datepicker" name="end_date" value="<?=@$_GET['end_date'];?>">
    <input type="submit" name="btnsubmit" value="" class="btn_search">
	</div>
</fieldset>
</form>
<? if($_GET){ 
		if($nrecord > 0){
?>		
	  <div style="clear: both"></div>	
	  <div style="float:right;padding-top: 10px;">
	  	<a href="monitor_questionair_report/print_page<?=$url_parameter;?>" target="_blank"><img src="images/printer_icon.gif" border="0" alt="พิมพ์หน้านี้" title="พิมพ์หน้านี้"></a>
	  	<a href="monitor_questionair_report/export<?=$url_parameter;?>" target="_blank"><img src="images/excel-button.png" border="0" alt="ส่งออกเป็น Excel" title="ส่งออกเป็น Excel"></a>
	  </div>
	  <div style="clear: both"></div>
      <fieldset>
	  <table width="100%" cellspacing="0" cellpadding="0" border="0"><tr><td>  	
	  <p align="center">
	  	<b>สรุปผลสำรวจความพึงพอใจของผุ้รับบริการต่อการให้บริการของ<br>
	   	<? if(@$_GET['pprovince_id'] > 0 ){
	   		echo "สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด".$province['title']."<br>";
		}else{ echo "สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด (สพจ.3)<br>";}
		 
		if(@$_GET['start_date']!="" && @$_GET['end_date'])
			echo "ตั้งแต่วันที่ ".$_GET['start_date']." - ".$_GET['end_date'];		
		?>
	  	</b>
	  </p>
	  <b><u>ส่วนที่ 1</u> ข้อมูลพื้นฐานส่วนบุคคล</b>                      
                  <table class="tblist2" >                  	
                  <tr height="25px" >
                  	<td width="34%" style="border-top:1px #CCC solid;"><center>ข้อมูลพื้นฐานของประชาชน</center></td>
                  	<td width="33%" style="border-top:1px #CCC solid;"><center>จำนวน (N=<?=$nrecord;?>)</center></td>
                  	<td width="33%" style="border-top:1px #CCC solid;"><center>ร้อยละ</center></td></tr>
                  <tr  class="evenrowbg"><td  colspan="3">1. เพศ</td></tr>
                  <tr class="oddrowbg">
                  	<td >&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;หญิง</td>
                  	<td align="right">
                  		<?
                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'sex','F');
						echo @$value['qty'];						
                  		?>
                  	</td>
                  	
                  	<td align="right">
                  		<?
                  		echo @$value['percent'];
						?>						
                  	</td>
                  </tr>
                  <tr  class="evenrowbg">
                  	<td >&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ชาย</td>
                  	<td align="right">
                  		<?
                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'sex','M');
						echo @$value['qty'];						
                  		?>
                  	</td>
                  	<td align="right">
                  		<?
                  		echo @$value['percent'];
						?>						
                  	</td>
                  </tr>
                  <tr class="oddrowbg">
                  	<td colspan="3">2. อายุ</td>
                  </tr>
                  <tr  class="evenrowbg">
                 	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;1-20</td>
                 	<td align="right">
                  		<?
                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'age','1-20');				
						echo @$value['qty'];			
                  		?>
                  	</td>
                  	<td align="right">
                  		<?
                  		echo @$value['percent'];
						?>						
                  	</td>
                  </tr>
                  <tr  class="oddrowbg">
                  	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;21-40</td>
                  	<td align="right">
                  		<?
                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'age','21-40');				
						echo @$value['qty'];		
                  		?>
                  	</td>
                  	<td align="right">
                  		<?
                  		echo @$value['percent'];
						?>						
                  	</td>
                  </tr>
                     <tr  class="evenrowbg">
                     	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;41-60</td>
                     	<td align="right">
                  		<?
                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'age','41-60');
						echo @$value['qty'];						
                  		?>
                  	</td>
                  	<td align="right">
                  		<?
                  		echo @$value['percent'];
						?>						
                  	</td>
                     </tr>
                     <tr class="oddrowbg">
                     	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;มากกว่า 60</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'age','>60');
							echo @$value['qty'];								
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="evenrowbg"><td colspan="3">3. การศึกษา</td></tr>
                     <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ประถมศึกษา</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'edu','ประถมศึกษา');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>

                     <tr class="evenrowbg">
                     	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;มัธยมศึกษา</td>
                     	<td align="right">
	                  		<?
	                  		$value =  GetQuestionairAnswer($provinceid,$start_date,$end_date,'edu','มัธยมศึกษา');
							echo @$value['qty'];								
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                     <tr class="oddrowbg">
                     	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ปวช. / ปวส.</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'edu','ปวช. / ปวส.');
							echo @$value['qty'];									
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                     <tr class="evenrowbg">
                     	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ปริญญาตรี</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'edu','ปริญญาตรี');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>

                     <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;สูงกว่าปริญญาตรี</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'edu','สูงกว่าปริญญาตรี');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?	                  	
							echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                     <tr class="evenrowbg">
                     	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;อื่นๆ</td>
                     	<td align="right">
	                  		<?
	                  		$value =  GetQuestionairAnswer($provinceid,$start_date,$end_date,'edu','อื่นๆ');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                  	<tr class="oddrowbg"><td colspan="3">4.อาชีพ</td></tr>
                     <tr class="evenrowbg">
                     	<td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;เกษตรกร</td>
                     	<td align="right">
	                  		<?
	                  		$value =  GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','เกษตรกร');
							echo @$value['qty'];						
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>

                     <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;รับจ้าง</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','รับจ้าง');
							echo @$value['qty'];						
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                     <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ค้าขาย</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','ค้าขาย');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                     <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;รับราชการ</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','รับราชการ');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>

                     <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ลูกจ้างบริษัท</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','ลูกจ้างบริษัท');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                     <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;นักเรียน / นักศึกษา</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','นักเรียน / นักศึกษา');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                     <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;แม่บ้าน</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','แม่บ้าน');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>

                     <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;อื่น ๆ</td>
                     	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','อื่น ๆ');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                     </tr>
                    <tr class="evenrowbg"><td colspan="3">5. บริการที่มาขอรับ</td></tr>
                    <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;เด็กและเยาวชน</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','เด็กและเยาวชน');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;สตรี</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','สตรี');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;คนพิการ</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','คนพิการ');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ผู้สูงอายุ</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','ผู้สูงอายุ');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ครอบครัวยากจน</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','ครอบครัวยากจน');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;คนไร้ที่พึ่ง</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','คนไร้ที่พึ่ง');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ภูมิคุ้มกันบกพร่อง</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','ภูมิคุ้มกันบกพร่อง');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;ขอข้อมูล / คำปรึกษา</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','ขอข้อมูล / คำปรึกษา');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="oddrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;การค้ามนุษย์</td>
                    	<td align="right">
	                  		<?
	                  		$value =  GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','การค้ามนุษย์');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    <tr class="evenrowbg"><td>&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;อื่น ๆ</td>
                    	<td align="right">
	                  		<?
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','อื่น ๆ');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    </table> 
                                      

                   <table border="0" cellspacing="0" cellpadding="0" width="80%" align="center">
                   <tr><td><br><br></td></tr>
                   <tr><td align="left"><font size="2"><b>หมายเหตุ</b></font></td></tr>
                   <tr><td><br>
                       <table border="0" cellspacing="0" cellpadding="0" width="90%" align="center">
                       <tr><td>1.&nbsp;&nbsp;การแปรผล</td></tr>

                       <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;-  ค่าเฉลี่ย 1.00 - 2.33  หมายถึง    มีความพึงพอใจในระดับน้อย</td></tr>   
                       <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;-  ค่าเฉลี่ย 2.34 - 3.66  หมายถึง    มีความพึงพอใจในระดับปานกลาง</td></tr>  
                       <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;-  ค่าเฉลี่ย 3.67 - 5.00  หมายถึง    มีความพึงพอใจในระดับมาก</td></tr>  
                       </table>
                   </td></tr>
                   </table>  
             
      </td></tr></table></fieldset>
<?
	}else{
		echo "<fieldset> ไม่มีข้อมูลการกรอกแบบสอบถาม</fieldset>";
	} 
} 
?>      