<div id="keyer_div_<?=$month?>_<?=@$num?>">
    <?php echo form_dropdown("keyer_".@$month."[".$num."]",get_option('users_id','name','mds_set_permission permission left join users on permission.users_id = users.id where permission.mds_set_permit_type_id = 3'),@$keyer['keyer_users_id'],'','-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --') ?>
    <input type="text" name="activity_<?=@$month?>[<?=@$num?>]" id="activity_<?=$month?>[<?=@$num?>]" style="width:500px;" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" />
    <input type="button" class="bt_remove_keyer" style="width: 50px" ref_m="<?=@$month?>" ref="<?=@$num?>" value=" ลบ " />
</div>