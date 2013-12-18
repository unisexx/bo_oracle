<script type="text/javascript">
$(document).ready(function(){
	$('.tblist tr:not(:first)').each(function(){
		$(this).find('td:not(:last)').addClass('cursor');
	});
});
</script>

<?=@$pagination?>
<table class="tblist">
<tr>
  <th align="left">ลำดับ</th>
  <th align="left">ชื่อผู้รับมอบอำนาจ</th>
  <th align="left">ลบ</th>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
<?php foreach($attorney as $key=>$item):?>
	<tr <?=cycle($key)?>>
	  <td><?=$i?></td>
	  <td nowrap="nowrap"><?=$item['name']?></td>
	  <td>
	  	<input type="hidden" name="id" class="content-id" value="<?=$item['id']?>">
	  	<input type="submit" name="button" value=" " class="btn_delete" />
	  </td>
	</tr>
	<?php $i++;?>
<?php endforeach;?>
</table>
<?=@$pagination?>