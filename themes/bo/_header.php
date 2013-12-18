<div id="header">
<div id="home"><a href="c_front"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบ Back Office"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">ตั้งค่า +</a>
          <ul style="width:190px;">
            <?php if(permission('c_usergroup', 'canview')): ?><li><a href="c_usergroup">สิทธิ์การใช้งาน</a></li><?php endif;?>
            <?php if(permission('c_user', 'canview')): ?><li><a href="c_user">ผู้ใช้งาน</a></li><?php endif;?>
            <?php if(permission('c_document', 'canview')): ?><li><a href="c_document">อัพโหลดเอกสาร</a></li><?php endif;?>
            <?php if(permission('c_department', 'canview')): ?><li><a href="c_department">กรม</a></li><?php endif;?>
            <?php if(permission('c_division', 'canview')): ?><li><a href="c_division">หน่วยงาน (กอง/สำนัก)</a></li><?php endif;?>
            <?php if(permission('c_workgroup', 'canview')): ?><li><a href="c_workgroup">กลุ่มงาน (กลุ่ม/ฝ่าย)</a></li><?php endif;?>
            <?php if(permission('c_qty', 'canview')): ?><li><a href="c_qty">หน่วยนับ</a></li><?php endif;?>
            <?php if(permission('c_province_zone_type','canview')):?><li><a href="c_province_zone_type">ประเภทภาค</a></li><?php endif;?>
            <?php if(permission('c_province_zone','canview')):?><li><a href="c_province_zone">ภาค</a></li><?php endif;?>
            <?php if(permission('c_province_area', 'canview')): ?><li><a href="c_province_area">เขตจังหวัด</a></li><?php endif;?>
            <?php if(permission('c_province', 'canview')): ?><li><a href="c_province">จังหวัด</a></li><?php endif;?>
          </ul>
        </li>
        <li><a href="#">ระบบงาน +</a>
            <ul style="width:210px;">
            	<?php if(permission('budget', 'canview')): ?><li><a href="http://budget.m-society.go.th" target="_blank">ระบบจัดทำคำของบประมาณ</a></li><?php endif;?>
                <?php if(permission('finance', 'canview')): ?><li><a href="finance" target="_blank">ระบบงานคลัง</a></li><?php endif;?>
        		<?php if(permission('monitor', 'canview')): ?><li><a href="monitor" target="_blank">ระบบติดตามและประเมินผล</a></li><?php endif;?>
        		<?php if(permission('inspect', 'canview')): ?><li><a href="inspect" target="_blank">ระบบตรวจราชการ</a></li><?php endif;?>
				<?php if(permission('fund_contract', 'canview')): ?><li><a href="fund" target="_blank">ระบบบริหารกองทุน</a></li><?php endif;?>
            </ul>
        </li>
        <?php
        if(permission('c_log','canview')){
        ?>
        <li><a href="#">รายงาน +</a>
            <ul style="width:110px;">
            	<li><a href="c_log">Log File</a></li>
            </ul>
        </li>
        <? } ?>
</ul>
</div>
<div id="login">
วันที่ <? echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?> <br />
<span>เข้าสู่ระบบโดย <a href="c_user/profile" class="link_login"><?php echo login_data('name'); ?></a> (<?php echo login_data('usertype_title'); ?>)</span>
<a href="logout"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>