<table class="tblist">
<tr>
  <th align="left">ปี</th>
  <th align="left">โครงการ</th>
</tr>
<?php $i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;?>
<?php foreach($project as $key=>$item):?>
	<tr <?=cycle($key)?>>
	  <td><?=$item['budgetyear']+543?></td>
	  <td nowrap="nowrap" class="cursor pjlist"><?=$item['title']?></td>
	</tr>
	<?php $i++;?>
<?php endforeach;?>
</table>