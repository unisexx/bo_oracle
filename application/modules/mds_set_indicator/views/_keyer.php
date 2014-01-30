<div id="keyer_div_<?=$month?>_<?=@$num?>">
    <?php echo form_dropdown("keyer_".@$month."[]",get_option('users_id','name','mds_set_permission permission left join users on permission.users_id = users.id where permission.mds_set_permit_type_id = 3'),@$keyer['users_id'],'','-- กำหนดผู้รับผิดชอบ (ผู้จัดเก็บข้อมูล) --') ?>
    <input type="text" name="activity_<?=@$month?>_name[]" id="activity_<?=$month?>_name[]" style="width:500px;" placeholder="ชื่อกิจกรรมที่รับผิดชอบ" />
    <input type="button" class="bt_remove_keyer" style="width: 50px" ref_m="<?=@$month?>" ref="<?=@$num?>" value=" ลบ " />
</div>