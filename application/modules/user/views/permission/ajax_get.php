<div id="tabs2" style="margin-top: 20px;">
	<ul>
		<?php foreach($system as $key => $sys): ?>
		<li><a href="#tabb-<?php echo $key + 1; ?>"><?php echo $sys['system_name']; ?></a></li>
		<?php endforeach; ?>
	</ul>
	
	<?php foreach($system as $key => $sys): ?>
	<div id="tabb-<?php echo $key + 1; ?>">
		<table class="tblist">
			<tr>
				<td colspan="3">
					<button type="button" class="select-all">เลือกทั้งหมด</button>
					<button type="button" class="unselect-all">ไม่เลือกทั้งหมด</button>
				</td>
			</tr>
			<?php foreach(Perm::system_permission($sys['id']) as $perm): ?>
			<tr>
				<td><?php echo $perm['permission_name']; ?></td>
				<td>
					<?php if($perm['action_view']): ?><input type="checkbox" name="action_view[<?php echo $perm['system_id'].']['.$perm['id'] ?>]" value="1" <?php echo Perm::is_checked($pds, $perm['id'], 'action_view'); ?> /> ดู&nbsp;&nbsp;&nbsp;<?php endif; ?>
					<?php if($perm['action_add']): ?><input type="checkbox" name="action_add[<?php echo $sys['id'].']['.$perm['id'] ?>]" value="1" <?php echo Perm::is_checked($pds, $perm['id'], 'action_add'); ?> /> เพิ่ม&nbsp;&nbsp;&nbsp;<?php endif; ?>
					<?php if($perm['action_edit']): ?><input type="checkbox" name="action_edit[<?php echo $sys['id'].']['.$perm['id'] ?>]" value="1" <?php echo Perm::is_checked($pds, $perm['id'], 'action_edit'); ?> /> แก้ไข&nbsp;&nbsp;&nbsp;<?php endif; ?>
					<?php if($perm['action_delete']): ?><input type="checkbox" name="action_delete[<?php echo $sys['id'].']['.$perm['id'] ?>]" value="1" <?php echo Perm::is_checked($pds, $perm['id'], 'action_delete'); ?> /> ลบ&nbsp;&nbsp;&nbsp;<?php endif; ?>
					<?php if($perm['action_extra1']): ?>
						<input type="checkbox" name="action_extra1[<?php echo $sys['id'].']['.$perm['id'] ?>]" value="1" <?php echo Perm::is_checked($pds, $perm['id'], 'action_extra1'); ?> /> 
						<?php echo $extras[$perm['id']]['action_extra1']; ?>&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
					<?php if($perm['action_extra2']): ?>
						<input type="checkbox" name="action_extra2[<?php echo $sys['id'].']['.$perm['id'] ?>]" value="1" <?php echo Perm::is_checked($pds, $perm['id'], 'action_extra2'); ?> /> 
						<?php echo $extras[$perm['id']]['action_extra2']; ?>
					<?php endif; ?>
				</td>
				<td>
					<button type="button" class="select-row">เลือกทั้งหมด</button>
					<button type="button" class="unselect-row">ไม่เลือกทั้งหมด</button>
				</td>
			</tr>
			<?php endforeach; ?>
		</table>
	</div>
	<?php endforeach; ?>
	
</div>


<script type="text/javascript" charset="utf-8">
	$(function(){
		$('#tabs2').tabs();
		$('.select-row').click(function(){
			$(this).parent().parent().find('[type=checkbox]').attr('checked', true);
			return false;
		});
		$('.unselect-row').click(function(){
			$(this).parent().parent().find('[type=checkbox]').attr('checked', false);
			return false;
		});
		$('.select-all').click(function(){
			$(this).parent().parent().parent().find('[type=checkbox]').attr('checked', true);
			return false;
		});
		$('.unselect-all').click(function(){
			$(this).parent().parent().parent().find('[type=checkbox]').attr('checked', false);
			return false;
		});
	});
</script>