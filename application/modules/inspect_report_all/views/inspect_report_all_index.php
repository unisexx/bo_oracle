<script type="text/javascript">
	$(document).ready(function(){
		var mt_year;
		$("select[name=year]").change(function(){
			$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:bottom'>").appendTo(".loading-icon");
			
			var round_id = $(this).val();
			mt_year = parseInt($(this + "option:selected").text()) - 543;
			$("input[name=mt_year]").val(mt_year);
			
			$.post('inspect_report_all/select_project_round_ajax',{
				'round_id':round_id,
				'mt_year':mt_year
			},function(data){
				$(".loading").remove();
				$("#xxx").html(data);
			});
		});
		
		mt_year = parseInt($(this + "option:selected").text()) - 543;
		$("input[name=mt_year]").val(mt_year);
		
		var tbCol = $(".tblist tr:eq(1)").find("td:not(:first)").size();
		var i=0;
		for (i=0;i<=tbCol;i++)
		{
			var dataSize = $(".col-"+i).size();
			var summary = 0;
			$('.col-'+i).each(function (j) {
				summary += Number($(this).text().replace(/,/g,""));
			});
			avg = summary/dataSize;
			$("#colavg-"+i).text(new NumberFormat(avg).toFormatted());
		}
		
		$(".tblist:first tr:not(:first)").find("td:first").css("background-color","#FFF3FC");
		$(".tblist th").css("background-color","#FFF3FC");
		
	});
	$(document).ready(function(){
		$(".a_export").click(function(){
			var mt_year = $("input[name=mt_year]").val();
			var project_id = $("select[name=project_id]").val();
			var insp_round_detail_id = $("select[name=insp_round_detail_id]").val();
 window.location.href ='inspect_report_all/index?action=export&mt_year='+mt_year+'&project_id='+project_id+'&insp_round_detail_id='+insp_round_detail_id;
		})
	});
</script>

<h3>รายงานค่าความเสี่ยง</h3>

<div id="search">
<div id="searchBox">
<form method="get" action="inspect_report_all/index">
<?php echo form_dropdown('year',get_option("id","mt_year+543 as year","insp_round"),@$_GET['year'],'','-- เลือกปีงบประมาณ --','0')?>
<input type="hidden" name="mt_year" value="">
<span id="xxx">
	<?php echo form_dropdown('project_id',get_option("id","title","insp_project where budgetyear = ".@$_GET['mt_year']),@$_GET['project_id'],'','-- เลือกโครงการ --','0');?> 
	<?php echo form_dropdown('insp_round_detail_id',get_option("id","round_name","insp_round_detail where round_id = ".@$_GET['year']),@$_GET['insp_round_detail_id'],'','-- เลือกรอบการบันทึก --','0');?>
</span><span class="loading-icon"></span>
  <input type="submit" name="button9" id="button9" value="ค้นหา" class="btn_search" />
</form>
</div>

<div style="text-align:right;" id="tool-info">
<a class="a_export"><img src="media/images/download.png" width="32" height="32" style="margin:0 20px -5px 10px;" class="vtip" title="ดาวน์โหลด"></a>
</div>

</div>

<?php if(!empty($_GET['mt_year'])):?>
<table class="tblist">
	<tr>
		<th>จังหวัด</th>
		<?php $type = '0'; ?>
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
				<?php endif;?>
			<?php endforeach;?>
		<?php endif;?>
	</tr>
	<?php endforeach;?>
	<tr class="odd">
		<th>ค่าเฉลี่ย (Average)</th>
		<?php foreach ($risktype as $key=>$rt):?>
        	<td id="colavg-<?php echo $key+1?>"></td>
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