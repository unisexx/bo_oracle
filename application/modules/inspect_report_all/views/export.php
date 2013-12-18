<h3><?=$show_title?></h3>
<?php if(!empty($_GET['mt_year'])):?>
<table class="tblist" border="1">
	<tr>
		<th>จังหวัด</th>
		<?php 
			$type = '0'; 
			$number_tot = '0';
			$check_key = '0';
		?>
        <?php foreach ($risktype as $rt):?>
        	<?php if($type<>$rt['risktype']):?>
				<?php $key = '0'; ?>
			<?php endif ?>
        	<th>
        		<?php ++$key;?> <?php echo $type_id[$rt['risktype']]; ?><?php echo $key;?>
        	</th>
        	<?php $type = $rt['risktype']; ?>
        <?php endforeach;?>
	</tr>
	<?php foreach($province as $row):?>
	<tr>
		<td><?php echo $row['title']?></td>
		<?php
			$sql = "SELECT INSP_PROJECT_RISK_SAVE.*,cnf_province.title provincetitle FROM INSP_PROJECT_RISK_SAVE
left join cnf_province on INSP_PROJECT_RISK_SAVE.provinceid = cnf_province.id
where budgetyear = ".@$_GET['mt_year']." and projectid = ".@$_GET['project_id']." and roundno = ".@$_GET['insp_round_detail_id']." and provinceid = ".$row['id']." and status = 'ผ่านการตรวจสอบแล้ว'";
			$risk = $this->risk->get($sql,TRUE);
		?>
		<?php if(empty($risk)): ?>
			<?php foreach ($risktype as $key=>$rt):?>
	        	<td>-</td>
	        <?php endforeach;?>
		<?php else:?>
			<?php foreach($risk as $keyrisk=>$item):?>
				<?php if($keyrisk <= $key): //ป้องกัน record เกิน header?>
					<td class="col-<?php echo $keyrisk+1?>"><?php echo $item['chancelevel']*$item['effectlevel']?></td>
				<?php
				// รวมยอดแต่ละรายการ 
					$num_col = $keyrisk+1;
					switch ($num_col) {
						case '1':
							$summary_k1 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_k1 +=$summary_k1;
							break;
						
						case '2':
							$summary_k2 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_k2 +=$summary_k2;
							break;
							
						case '3':
							$summary_p1 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_p1 +=$summary_p1;
							break;
							
						case '4':
							$summary_p2 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_p2 +=$summary_p2;
							break;
						
						case '5':
							$summary_p3 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_p3 +=$summary_p3;
							break;
						
						case '6':
							$summary_p4 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_p4 +=$summary_p4;
							break;
							
						case '7':
							$summary_n1 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_n1 +=$summary_n1;
							break;
							
						case '8':
							$summary_n2 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_n2 +=$summary_n2;
							break;
							
						case '9':
							$summary_n3 = $item['chancelevel']*$item['effectlevel'];
							$summary_tot_n3 +=$summary_n3;
							break;
					}
						endif;?>
			<?php endforeach;
			$number_tot++;
			?>
		<?php endif;?>
	</tr>
	<?php endforeach;?>
	<tr class="odd">
		<th>ค่าเฉลี่ย (Average)</th>
		<?php foreach ($risktype as $key=>$rt):?>
        	<td id="colavg-<?php echo $key+1?>">
        		<?php
        		// คิดค่าเฉลี่ย
        				$num_colavg =$key+1;
        				switch ($num_colavg) {
						case '1':
							$avg_k1 = $summary_tot_k1/$number_tot;
							echo number_format($avg_k1,2);
							break;
						
						case '2':
							$avg_k2 = $summary_tot_k2/$number_tot;
							echo number_format($avg_k2,2);
							break;
							
						case '3':
							$avg_p1 = $summary_tot_p1/$number_tot;
							echo number_format($avg_p1,2);
							break;
							
						case '4':
							$avg_p2 = $summary_tot_p2/$number_tot;
							echo number_format($avg_p2,2);
							break;
						
						case '5':
							$avg_p3 = $summary_tot_p3/$number_tot;
							echo number_format($avg_p3,2);
							break;
						
						case '6':
							$avg_p4 = $summary_tot_p4/$number_tot;
							echo number_format($avg_p4,2);
							break;
							
						case '7':
							$avg_n1 = $summary_tot_n1/$number_tot;
							echo number_format($avg_n1,2);
							break;
							
						case '8':
							$avg_n2 = $summary_tot_n2/$number_tot;
							echo number_format($avg_n2,2);
							break;
							
						case '9':
							$avg_n3 = $summary_tot_n3/$number_tot;
							echo number_format($avg_n3,2);
							break;
					}
        		?>
        	</td>
        <?php endforeach;?>
	</tr>
</table>
<br>
<h3>คำอธิบายค่าความเสี่ยง</h3><br>
<table class="tblist">
	<tr>
		<th>ค่าความเสี่ยงระหว่าง</th>
		<th>คำอธิบาย</th>
	</tr>
	<?php foreach($level as $row):?>
		<tr>
			<td><?php echo $row['range_start']?> ~ <?php echo $row['range_end']?></td>
			<td><?php echo $row['color_detail']?></td>
		</tr>
	<?php endforeach;?>
</table>
<?php endif;?>