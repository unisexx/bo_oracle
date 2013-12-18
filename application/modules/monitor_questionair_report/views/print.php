<html class="cufon-active cufon-ready" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body>
<? if($_GET){ 
		if($nrecord > 0){
?>
	  <style>
	  	.tblist2
{
	font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
	font-size: 14px;
	background: #fff;
	margin:0;
	margin-bottom:10px;
	width: 100%;
	border-collapse: collapse;
}
.tblist2 th
{
	font-size: 16px;
	font-weight: normal;
	padding: 10px 5px 3px 5px;
	border-top: 0px solid #ccc;
	border-bottom: 2px solid #ccc;
	border-left: 0px solid #ccc;
	border-right: 0px solid #ccc;
	text-align:left;
	background-color:#fff;
	color:#65358f;
}
.tblist2 td
{
	color:#333;
	padding:5px;
	height:30px;
	border-top: 0px solid #ccc;
	border-bottom: 1px solid #ccc;
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
}

.tblist2 td.B, .tblist2 td strong { font-weight:700;}
.tblist2 tr.total {  background:url(../images/bg_total.gif) repeat-x;}


	  </style>			  
	  <div style="clear: both"></div>      
	  <table width="650" cellspacing="0" cellpadding="0" border="0"><tr><td>  	
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
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','อื่นๆ');
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
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','อื่นๆ');
							echo @$value['qty'];							
	                  		?>
	                  	</td>
	                  	<td align="right">
	                  		<?
	                  		echo @$value['percent'];
							?>						
	                  	</td>
                    </tr>
                    </table> <table class="tblist2" >                  	
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
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'occ','อื่นๆ');
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
	                  		$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,'service','อื่นๆ');
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
                                      
                   <table class="tblist2">
                   <tbody>
                   	<tr><td style="border-top: solid 1px; #CCCCCC;" colspan="9" align="left"><b><u>ส่วนที่ 2 </u>ข้อมูลความพึงพอใจของผู้รับบริการ</b></td></tr>
                   	<tr>
                   		<td width="30%" rowspan="2"><center>ประเด็นคำถาม</center></td>
                   		<td width="54%" colspan="6"><center>ระดับความพึงพอใจ</center></td>
                   		<td width="8%" rowspan="2"><center><img border="0" width="17" height="22" src="images/x.gif"></center></td>
                   		<td width="8%" rowspan="2"><center>แปลผล</center></td>
                   	</tr>
                   <tr>
                   	<td width="9%"><center>มากที่สุด(5)</center></td><td width="9%"><center>มาก(4)</center></td>
                   	<td width="9%"><center>ปานกลาง(3)</center></td><td width="9%"><center>น้อย(2)</center></td>
                   	<td width="9%"><center>น้อยที่สุด(1)</center></td><td width="9%"><center>ไม่ระบุ</center></td>
                   </tr>
                   <tr valign="middle" height="25px" class="oddrowbg">
                   	<td colspan="9"><b>ด้านการให้บริการของเจ้าหน้าที่</b></td>
                   </tr>
               	   <tr class="oddrowbg"><td>&nbsp;&nbsp;1) เจ้าหน้าที่มีความกระตือรือร้นในการให้บริการอย่างเต็มใจ</td>
						<?
						$summary_total=0;
						$total_most_pop = array(0,0,0,0,0,0); 
						$total_most_point = 0;
						$total_most_percent = 0;
						$level = array('ไม่ระบุ','น้อยที่สุด','น้อย','ปานกลาง','มาก','มากที่สุด');
						$most_pop = array(0,0,0,0,0,0);
						
						$avg_point =0;
						$avg_percent=0;
						$choice = "will";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						//GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i,'percent');
						$max[$i]=$value['qty']; 
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ?  $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                       
                    <tr class="oddrowbg"><td>&nbsp;&nbsp;2) เจ้าหน้าให้บริการด้วยความสุภาพ</td>
                        <?
						$choice = "pol";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                     
                  <tr class="oddrowbg" ><td>&nbsp;&nbsp;3) เจ้าหน้าให้บริการด้วยความรวดเร็ว สามารถให้คำแนะนำ / ตอบข้อซักถามได้ชัดเจน</td>
                        <?
						$choice = "fast";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;						
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                  </tr>
                  <tr class="evenrowbg" height="25"><td colspan="7"><center><b>รวมค่าเฉลี่ยความพึงพอใจในด้านนี้</b></center></td>
                        <td align="right"><?=number_format($avg_point/3,2);$summary_total+=number_format($avg_point/3,2);?><br>&nbsp;(<?=number_format($avg_percent/3,2);?>) </td>
                        <td align="center">&nbsp;<?=$level[GetQuestionairMostAnswerLevel($most_pop)];?></td>
                   </tr> 
                   <?
                   		$total_most_pop[GetQuestionairMostAnswerLevel($most_pop)] =  $total_most_pop[GetQuestionairMostAnswerLevel($most_pop)]+1;
						$total_most_point += number_format($avg_point/3,2);
						$total_most_percent += number_format($avg_percent/3,2); ;
                   ?>
                   <tr class="oddrowbg" height="25px" ><td colspan="9"><b>ด้านสถานที่ให้บริการ </b>(ในกรณีที่ให้บริการนอกสถานที่ ไม่ต้องกรอกข้อมูลในส่วนนี้)</td></tr>
                    <tr class="oddrowbg"><td>&nbsp;&nbsp;1) สถานที่มีความสะอาดและเป็นระเบียบ</td>
                        <?
						$level = array('ไม่ระบุ','น้อยที่สุด','น้อย','ปานกลาง','มาก','มากที่สุด');
						$most_pop = array(0,0,0,0,0,0);
						$avg_point =0;
						$avg_percent=0;
						$choice = "clean";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                     
                    <tr class="oddrowbg" ><td>&nbsp;&nbsp;2)สถานที่ตั้งหาง่ายและเดินทางมาติดต่อได้สะดวก</td>
						<?
						$choice = "contact";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                    <tr class="oddrowbg" ><td>&nbsp;&nbsp;3) ภายในสถานที่ให้บริการ มีการจัดสิ่งอำนวยความสะดวกให้แก่ผู้มาติดต่อ เช่น เก้าอี้ / ที่พัก น้ำดื่ม เป็นต้น</td>
                        <?
						$choice = "easy";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                     </tr> 
         			<tr class="oddrowbg" ><td>&nbsp;&nbsp;4) มีห้องน้ำสะอาดและเพียงพอแก่ผู้มาติดต่อ</td>
                        <?
						$choice = "toilet";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                    <tr class="evenrowbg" height="25"><td colspan="7"><center><b>รวมค่าเฉลี่ยความพึงพอใจในด้านนี้</b></center></td>
                        <td align="right"><?=number_format($avg_point/4,2);$summary_total+=number_format($avg_point/4,2);?><br>&nbsp;(<?=number_format($avg_percent/4,2);?>) </td>
                        <td align="center">&nbsp;<?=$level[GetQuestionairMostAnswerLevel($most_pop)];?></td>
                   </tr> 
                   <?
                   		$total_most_pop[GetQuestionairMostAnswerLevel($most_pop)] =  $total_most_pop[GetQuestionairMostAnswerLevel($most_pop)]+1;
						$total_most_point += number_format($avg_point/4,2);
						$total_most_percent += number_format($avg_percent/4,2); ;
                   ?>
                    <tr class="oddrowbg" height="25"><td colspan="9"><b>ด้านกระบวนการให้บริการ</b></td></tr> 
                    <tr class="oddrowbg" ><td>&nbsp;&nbsp;1) มีการให้บริการตามลำดับก่อน - หลัง อย่างยุติธรรม </td>
                        <?
						$level = array('ไม่ระบุ','น้อยที่สุด','น้อย','ปานกลาง','มาก','มากที่สุด');
						$most_pop = array(0,0,0,0,0,0);						
						$avg_point =0;
						$avg_percent=0;
						$choice = "fairly";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                     
                    <tr class="oddrowbg" ><td>&nbsp;&nbsp;2) ระยะเวลาในการรอคอยการให้บริการมีความเหมาะสม  </td>
                       <?
						$choice = "time";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
            		<tr class="oddrowbg"><td>&nbsp;&nbsp;3) ขั้นตอนการให้บริการมีความชัดเจนและรวดเร็ว  </td>
                        <?
						$choice = "clear";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                   <tr class="oddrowbg" ><td>&nbsp;&nbsp;4) ท่านได้รับความช่วยเหลือตรงตามความต้องการอย่างครบถ้วน  </td>
						<?
						$choice = "help";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                   </tr>
                  <tr class="evenrowbg" height="25"><td colspan="7"><center><b>รวมค่าเฉลี่ยความพึงพอใจในด้านนี้</b></center></td>
                        <td align="right"><?=number_format($avg_point/4,2);$summary_total+=number_format($avg_point/4,2);?><br>&nbsp;(<?=number_format($avg_percent/4,2);?>) </td>
                        <td align="center">&nbsp;<?=$level[GetQuestionairMostAnswerLevel($most_pop)];?></td>
                   </tr> 
                   <?
                   		$total_most_pop[GetQuestionairMostAnswerLevel($most_pop)] =  $total_most_pop[GetQuestionairMostAnswerLevel($most_pop)]+1;
						$total_most_point += number_format($avg_point/4,2);
						$total_most_percent += number_format($avg_percent/4,2); ;
                   ?>
                	<tr class="oddrowbg" height="25"><td colspan="9"><b>ด้านการประชาสัมพันธ์</b></td></tr>  
                    <tr class="oddrowbg" ><td>&nbsp;&nbsp;1) มีการประชาสัมพันธ์ข้อมูลข่าวสารเกี่ยวกับการให้บริการ / การช่วยเหลือต่าง ๆ  อย่างต่อเนื่องและทั่วถึง</td>
                        <?
						$level = array('ไม่ระบุ','น้อยที่สุด','น้อย','ปานกลาง','มาก','มากที่สุด');
						$most_pop = array(0,0,0,0,0,0);
						$avg_point =0;
						$avg_percent=0;
						$choice = "pcon";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                    </tr>
                   <tr class="oddrowbg" ><td>&nbsp;&nbsp;2) การประชาสัมพันธ์ผ่านสื่อต่าง ๆ เช่น โปสเตอร์แผ่นพับ ป้ายประกาศ ฯลฯ มีความเหมาะสม ชัดเจน และเข้าใจง่าย</td>
                        <?
						$choice = "pclear";
						$maxpoint= 0;
						for($i=0;$i<=5;$i++){
						$value = GetQuestionairAnswer($provinceid,$start_date,$end_date,$choice,$i);
						$max[$i]=  $value['qty'];
						$percentmax[$i]= $value['percent'];
						$maxpoint+= $max[$i]*$i;
						}
						$xbarpoint = $nrecord > 0 ? $maxpoint/$nrecord : 0;
						$xbarpercent = (number_format($xbarpoint,2)/5)*100;
						$most_answer = GetQuestionairMostAnswer($max);
						$avg_point +=$xbarpoint;
						$avg_percent +=$xbarpercent;
						$most_pop[$most_answer]=$most_pop[$most_answer]+1;
						for($i=5;$i>=0;$i--){
						?>                        
                        <td align="right">&nbsp;						          
                        N = <?=$max[$i];?>              	
                        <br>&nbsp;
                        (ร้อยละ <?=$percentmax[$i];?>)
                        </td>
                        <? } ?>
                        <td align="right">&nbsp;N = <?=number_format($xbarpoint,2);?><br>&nbsp;(ร้อยละ <?=$xbarpercent;?>) </td>                         
                        <td align="center">&nbsp;<?=$level[$most_answer];?></td>
                   </tr>
                   <tr class="evenrowbg" height="25"><td colspan="7"><center><b>รวมค่าเฉลี่ยความพึงพอใจในด้านนี้</b></center></td>
                        <td align="right"><?=number_format($avg_point/2,2);$summary_total+=number_format($avg_point/2,2);?><br>&nbsp;(<?=number_format($avg_percent/2,2);?>) </td>
                        <td align="center">&nbsp;<?=$level[GetQuestionairMostAnswerLevel($most_pop)];?></td>
                   </tr> 
                   <?
                   		$total_most_pop[GetQuestionairMostAnswerLevel($most_pop)] =  $total_most_pop[GetQuestionairMostAnswerLevel($most_pop)]+1;
						$total_most_point += number_format($avg_point/3,2);
						$total_most_percent += number_format($avg_percent/3,2); ;
                   ?>
                  <tr class="footrowbg" height="25px"><td colspan="7"><center><b>รวมค่าเฉลี่ยความพึงพอใจ</b></center></td>
                        <td align="right"><?=number_format($summary_total/4,2);?><br>&nbsp;(<?=number_format((($summary_total/20)*100),2);?>)</td>
                        <td align="center"> <?=$level[GetQuestionairMostAnswerLevel($total_most_pop)];?></td>
                   </tr>
                   </table> 
                   
                   <table border="0" cellspacing="0" cellpadding="0" width="80%" align="center">

                   <tr><td><br><br></td></tr>
                   <tr><td align="left"><font size="2"><b><u>ส่วนที่ 3</u> ข้อเสนอแนะ</b></font></td></tr>
                   <tr><td><br>
                   <table border="0" cellspacing="0" cellpadding="0" width="90%" align="center">
                   <tr>
                   	<td>
					</td>
						<?
							$i=0;
							foreach($remark as $item){
								
								if(trim($item['guide'])!="" || trim($item['guide'])!="-")
								{
									$i++;
									echo $i.". ".$item['guide']."<BR>";
								}
							}
						?>
					</tr>                   
				   </table>
                   </td></tr>
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
             
      </td></tr></table>
      <script type="text/javascript">window.print();</script>
<?
	}else{
		echo "<fieldset> ไม่มีข้อมูลการกรอกแบบสอบถาม</fieldset>";
	} 
} 
?>      
</body>
</html>