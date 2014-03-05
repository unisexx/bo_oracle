<div id="keyer_div_<?=$month?>_<?=@$num?>">
    <?php echo form_dropdown("keyer_".@$month."[".$num."]",get_option('permission.users_id','permission_dtl.name','mds_set_permission permission 
			    																													left join mds_set_permission_type on permission.id = mds_set_permission_type.mds_set_permission_id 
			    																													left join mds_set_permission_dtl permission_dtl on permission.id = permission_dtl.mds_set_permission_id 
			    																													where mds_set_permission_type.mds_set_permit_type_id = 3'),@$keyer['keyer_users_id'],'class="chk_keyer" ref_id="'.$num.'" month="'.@$month.'"','-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --') ?>
    <input type="text" name="activity_<?=@$month?>[<?=@$num?>]" id="activity_<?=$month?>[<?=@$num?>]" style="width:500px;" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" />
    <input type="radio" name="keyer_score_<?=@$month?>[]" id="keyer_score_<?=@$month?>[]" value="<?=@$num?>" /> ผู้บันทึกคะแนน
    <input type="button" class="bt_remove_keyer" style="width: 50px" ref_m="<?=@$month?>" ref="<?=@$num?>" value=" ลบ " />
</div>