<div id="keyer_div_<?=$month?>_<?=@$num?>">
    <?php echo form_dropdown("keyer_".@$month."[".$num."]",get_option('permission.users_id','users.name','mds_set_permission permission 
			    																													left join users on users.id = permission.users_id
			    																													where permission.mds_set_permit_type_id = 3 order by users.name asc'),@$keyer['keyer_users_id'],'class="chk_keyer" ref_id="'.$num.'" month="'.@$month.'"','-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --') ?>
    <input type="text" name="activity_<?=@$month?>[<?=@$num?>]" id="activity_<?=$month?>[<?=@$num?>]" style="width:500px;" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" />
    <input type="radio" name="keyer_score_<?=@$month?>[]" id="keyer_score_<?=@$month?>[]" value="<?=@$num?>" /> ผู้บันทึกคะแนน
    <button type="button" class="btn btn-danger bt_remove_keyer" ref_m="<?=@$month?>" ref="<?=@$num?>"> ลบ </button>
</div>