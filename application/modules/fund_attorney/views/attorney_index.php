<script type="text/javascript">
$(document).ready(function(){
	$('.tblist tr:not(:first)').each(function(){
		$(this).find('td:not(:last)').addClass('cursor');
	});
	
	$('.btn_add').click(function(){
		$('#attorny-name').val("");
		$('#idEdit').remove();
		$(this).colorbox({inline:true, href:"#name", width:"490px;"});
	});
	
	$('.btn_save').livequery('click',function(){
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:bottom;'>").appendTo(".loadingicon");
		var name = $('#attorny-name').val();
		var id = $('#idEdit').val();
		$.get('fund_attorney/save_ajax',{
			'id':id,
			'name':name
		},function(data){
			$('#attorney-list').html(data);
			$('#attorny-name').val("");
			$('.loading,#idEdit').remove();
			$.colorbox.close();
		});
	});
	
	$('.btn_delete').livequery('click',function(){
		if(confirm('<?php echo NOTICE_CONFIRM_DELETE?>')){
			var contentId = $(this).prev('.content-id').val();
			window.location.href = 'fund_attorney/delete/'+contentId;
		}
	});
	
	$('.btn_search').click(function(){
		$("<img class='loading' src='themes/bo/images/loading.gif' style='vertical-align:middle;'>").appendTo(".loadingicon");
		var searchName = $('#searchName').val();
		$.get('fund_attorney/search',{
			'name':searchName
		},function(data){
			$('#attorney-list').html(data);
			$('.loading').remove();
		});
	});
	
	$('.cursor').livequery('click',function(){
		var name = $(this).closest('tr').find('td:eq(1)').text();
		var contentId = $(this).closest('tr').find('.content-id').val();
		$('#idEdit').remove();
		$(this).colorbox({inline:true, href:"#name", width:"490px;"});
		$('#attorny-name').val(name);
		$('<input id="idEdit" type="hidden" name="id" value="'+contentId+'">').appendTo('#name');
	});
});
</script>

<h3>ตั้งค่า ผู้รับมอบอำนาจ</h3>
<div id="search">
<div id="searchBox">ชื่อผู้รับมอบอำนาจ
  <input name="textfield" type="text" id="searchName" size="50" />
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search" />
  <div class="loadingicon" style="display:inline;"></div>
</div>
</div>

<?php if(permission('fund_attorney', 'canadd')):?>
<div id="btnBox"><input type="button" title="เพิ่มรายการ" value=" " class="btn_add"/></div><br clear="all">
<?php endif;?>

<div id="attorney-list">
	<?=@$pagination?>
		<table class="tblist">
		<tr>
		  <th align="left">ลำดับ</th>
		  <th align="left">ชื่อผู้รับมอบอำนาจ</th>
		  <?php if(permission('fund_attorney', 'candelete')):?>
		  <th align="left">ลบ</th>
		  <?php endif;?>
		</tr>
		<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
		<?php foreach($attorney as $key=>$item):?>
			<tr <?=cycle($key)?>>
			  <td><?=$i?></td>
			  <td nowrap="nowrap"><?=$item['name']?></td>
			  <?php if(permission('fund_attorney', 'candelete')):?>
			  <td>
			  	<input type="hidden" name="id" class="content-id" value="<?=$item['id']?>">
			  	<input type="submit" name="button" value=" " class="btn_delete" />
			  </td>
			  <?php endif;?>
			</tr>
			<?php $i++;?>
		<?php endforeach;?>
		</table>
	<?=@$pagination?>
</div>

<!------- colorbox form ------->
<div style="display: none;">
	<div id="name" style="border:1px dashed #FC7C0B; margin:10px 0; padding: 10px;">
		ชื่อผู้รับมอบอำนาจ <input type="text" id="attorny-name" value="" style="margin:5px 0; width: 310px;" /> <br>
		<input type="button" class="btn_save" value='' style="margin: 0 0 0 181px;"><div class="loadingicon" style="display:inline;"></div>
	</div>
</div>