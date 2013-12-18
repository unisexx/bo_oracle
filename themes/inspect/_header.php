<script type="text/javascript">
$(document).ready(function(){
	$('.pagination').wrap('<div class="frame_page" />');	
	$('.frame_page:first').before($('<br clear=all>'));
});
</script>

<div id="headerInspect">
<div id="home"><a href="inspect"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบตรวจราชการ"/></a></div>
<div id="home"><a href="inspect"><img src="images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบตรวจราชการ"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">บันทึก +</a>
          <ul style="width:160px;">
            <?php if(permission('inspect_save', 'canview')): ?><li><a href="inspect_save">ผลการดำเนินงาน</a></li><?php endif;?>
            <?php if(permission('inspect_inspector_recomm', 'canview')): ?><li><a href="inspect_inspector_recomm">ข้อเสนอแนะผู้ตรวจ</a></li><?php endif;?>
             <?php if(permission('inspect_budget', 'canview')): ?><li><a href="inspect_disbursement">ผลการเบิกจ่ายงบประมาณ</a></li><?php endif;?>
          </ul>
        </li>
		<li><a href="#">ผู้ดูแล +</a>
          <ul style="width:200px;">
            <?php if(permission('inspect_project_admin', 'canview')): ?><li><a href="inspect_project_admin">โครงการ</a></li><?php endif;?>
            <?php if(permission('inspect_member', 'canview')): ?><li><a href="inspect_member">ผู้ตรวจราชการ และสมาชิก</a></li><?php endif;?>
            	
            <?php if(permission('inspect_alert','canview')):?><li><a href="inspect_notification">แจ้งเตือนผลการดำเนินงาน</a></li><?php endif;?>
          </ul>
        </li>
        <li><a href="#">ตั้งค่า +</a>
            <ul style="width:240px;">

            	<?php if(permission('inspector_group', 'canview')): ?><li><a href="inspector_group">กลุ่มผู้ตรวจ</a></li><?php endif;?>
                <?php if(permission('inspect_risk_subject', 'canview')): ?><li><a href="inspect_risk_subject">หัวข้อความเสี่ยง</a></li><?php endif;?>
                <?php if(permission('inspect_project_management', 'canview')): ?><li><a href="inspect_project_management">จัดการโครงการและวัตถุประสงค์</a></li><?php endif;?>
                <?php if(permission('inspect_round', 'canview')): ?><li><a href="inspect_round">กำหนดรอบ</a></li><?php endif;?>
                 <?php if(permission('inspect_level', 'canview')): ?><li><a href="inspect_level">ระดับความเสี่ยง</a></li><?php endif;?>
            </ul>
        </li>
        <li><a href="#">รายงาน +</a>
        	<? if(
        	(permission('inspect_report_risk', 'canview'))
			|| (permission('inspect_report_recomm', 'canview'))
			)
			:
			?>			
            <ul style="width:110px;">            	
            	<? if(permission('inspect_report_risk', 'canview')):?><li><a href="inspect_report_all">รายงานความเสี่ยง</a></li><? endif;?>
            	<? if(permission('inspect_report_recomm', 'canview')):?><li><a href="inspect_report_all/recomm">รายงานข้อเสนอแนะผู้ตรวจ</a></li><? endif;?>
            	<?php if(permission('inspect_log', 'canview')): ?><li><a href="inspect_log">ประวัติการใช้งาน</a></li><?php endif;?>
            </ul>            
            <?php endif;?>
        </li>
		
</ul>
</div>
<div id="login">
วันที่ <? echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?> <br />
<span>เข้าสู่ระบบโดย <a href="c_user/profile" class="link_login"><?php echo login_data('name'); ?></a></span>
<a href="logout"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>