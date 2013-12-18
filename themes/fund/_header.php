<div id="headerFund">
<div id="home"><a href="fund/index"><img src="themes/bo/images/home.png" width="32" height="32" class="vtip" title="หน้าหลักระบบงานบริหารกองทุน"/></a></div>
<div id="menu">
<ul id="navmenu-h">
        <li><a href="#">บันทึก +</a>
          <ul style="width:220px;">
            <?php if(permission('fund_contract', 'canview')): ?><li><a href="fund_contract">สํญญารับเงินอุดหนุน</a></li><?php endif;?>
          </ul>
        </li>
        <li><a href="#">ตั้งค่า +</a>
          <ul style="width:260px;">
            <?php if(permission('fund_attorney', 'canview')): ?><li><a href="fund_attorney">ผู้รับมอบอำนาจ</a></li><?php endif;?>
            <?php if(permission('fund_organize', 'canview')): ?><li><a href="fund_organize">องค์กร/หน่วยงาน ผู้รับเงินอุดหนุน</a></li><?php endif;?>
            <?php if(permission('fund_command', 'canview')): ?><li><a href="fund_command/form">คำสั่งที่</a></li><?php endif;?>
          </ul>
        </li>
        <li><a href="#">รายงาน +</a>
            <ul style="width:110px;">
            	<?php if(permission('fund_log', 'canview')): ?><li><a href="fund_log" target="_blank">Log File</a></li><?php endif;?>
            </ul>
        </li>
		
</ul>
</div>
<div id="login">
วันที่ <? echo stamp_to_th_fulldate(en_to_stamp(date("Y-m-d"),FALSE));?><br />
<span>เข้าสู่ระบบโดย <a href="c_user/profile" class="link_login"><?php echo login_data('name'); ?></span>
<a href="logout"><img src="themes/bo/images/btn_logout.jpg" width="59" height="21" style="margin-bottom:-6px;" /></a>
</div>
</div>