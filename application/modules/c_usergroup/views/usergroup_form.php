<script ype="text/javascript">
$(document).ready(function(){
	$("#btn_search").colorbox({width:"50%", inline:true, href:"#bg_source_form"});
	$("#show_result").click(function(){
		var txt_search = $("#tb_search").val();
		$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#rbgpt");
		$.post('c_user/search_users',{
			'txt_search' : txt_search
		},function(data){
			$("#dv_result").html(data);			
		})				
	})
	$(".tb_user_list td").live('click',function(){
		var user_id = $(this).closest("tr").find("#hd_user_id").val();
		var user_name = $(this).closest("tr").find("#hd_user_name").val();
		var exist = $(this).closest("tr").find("#hd_user_exist").val();
		if(exist=='exist')
		{
			alert('มีสิทธิ์ user นี้อยู่แล้ว');	
		}else{
		$("#user_id").val(user_id);
		$("#title").val(user_name);
		$().colorbox.close();
		}
	})	
})
function CheckAll(pSystemID, pMenuID,pValue)
{
	document.getElementById('View_'+pSystemID+'_'+pMenuID).checked = pValue;
	document.getElementById('Add_'+pSystemID+'_'+pMenuID).checked = pValue;	
	document.getElementById('Edit_'+pSystemID+'_'+pMenuID).checked = pValue;
	document.getElementById('Delete_'+pSystemID+'_'+pMenuID).checked = pValue;			
}
</script>
<form name="frmUsergroup" id="frmUsergroup" enctype="multipart/form-data" method="post" action="c_usergroup/save<?=$url_parameter;?>">
<h3>ตั้งค่า สิทธิ์การใช้งาน (เพิ่ม / แก้ไข)</h3>
<table class="tbadd">
<tr>
  <th>ชื่อสิทธิ์การใช้งาน  <span class="Txt_red_12">*</span></th>
  <td>  	  	
  	<input name="title" type="text" id="title" readonly="readonly" value="<?=$result['title'];?>" size="60" /><input type="button" name="btn_search" id="btn_search" value="เลือกผู้ใช้">
  	<input type="hidden" name="user_id" id="user_id" value="<?=@$result['user_id'];?>">
  	<input type="hidden" name="id" id="id" value="<?=$result['id'];?>">
  </td>
</tr>
<tr>
  <th>ระดับ</th>
  <td>
  	<? $result['lv'] = @$result['lv'] == '' ? 1 : @$result['lv'];?>
  	<input name="lv" type="text" id="lv" size="3" value="<?=$result['lv'];?>" />
  </td>
</tr>
<tr>
  <th colspan="2"><div id="tabs">
    <ul>
      <li><a href="#tabs-1">Back Office</a></li>
      <li><a href="#tabs-2">ระบบจัดทำคำของบประมาณ</a></li>
      <li><a href="#tabs-3">ระบบงานการคลัง</a></li>
      <li><a href="#tabs-4">ระบบติดตามและประเมินผล</a></li>
      <li><a href="#tabs-5">ระบบงานตรวจราชการ</a></li>
      <li><a href="#tabs-6">ระบบบริหารกองทุน</a></li>
    </ul>
    <div id="tabs-1">
      <table class="tbadd">
      <? $menu_id=1; $system_id=1;?>
	  <? $srow=null; if(@$result['id']!='')$srow = GetPermission(@$result['id']);?>      
        <tr>
          <th><?=$menu_id;?> สิทธิ์ผู้ใช้งาน</th>
          <td style="width:250px;"><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> ผู้ใช้งาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> อัพโหลดเอกสาร</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> กรม</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> หน่วยงาน (กอง/สำนัก)</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> กลุ่มงาน (กลุ่ม/ฝ่าย)</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> ประเภทภาค</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> ภาค</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> เขตจังหวัด</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> จังหวัด</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> หน่วยนับ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> จัดทำคำของบประมาณ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> งานการคลัง</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> ติดตามและประเมินผล</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> ตรวจราชการ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th><?=$menu_id;?> ประวัติการใช้งาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
      </table>
    </div>
    <div id="tabs-2">
    <? $system_id=2;?>
      <table class="tbadd">
        <tr>
          <th>ความสามารถ</th>
          <td> <input type="checkbox" name="budgetadmin" id="budgetadmin"  <? if(@$result['budgetadmin']=='on')echo "checked";?>/>
            IsAdmin 
              <input type="checkbox" name="budgetcanaccessall" id="budgetcanaccessall" <? if(@$result['budgetcanaccessall']=='on')echo "checked";?> />
              ดูทุกกลุ่มในหน่วยงานตนเอง (ส่งตรวจสอบ)</td>
        </tr>
        <? $menu_id=1;?>
        <tr>
          <th>รายการคำของบ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        <?  $menu_id=2;?>
        <tr>
          <th>แผนงานตามยุทธศาสตร์ (สป)</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        <? $menu_id=3;?>
        <tr>
          <th>ประเภทงบประมาณ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=4;?>
        <tr>
          <th>ครุภัณฑ์</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=5;?>
        <tr>
          <th>หน่วยนับ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=6;?>
        <tr>
          <th>ตั้งเวลา</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=7;?>
        <tr>
          <th>จังหวัด</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=8;?>
        <tr>
          <th>รายงาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
		</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>

        </tr>
        <? $menu_id=9;?>
        <tr>
          <th>ประวัติการใช้งาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
		</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        
        </tr>
      </table>
    </div>
    <div id="tabs-3"> 
    <? $system_id=3;?>
    	<table class="tbadd">
         <tr>
          <th>ความสามารถ</th>
          <td>
          	<input type="checkbox" name="fn_access_all" value="1" <? if($result['fn_access_all']=='on')echo 'checked="checked"';?>>เข้าถึงข้อมูลทุกหน่วยงาน
          	&nbsp;
          </td>
        </tr>
        <? $menu_id=1;?>
        <tr>
          <th>แผนงบประมาณ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=2;?>
        <tr>
          <th>รหัสงบประมาณ</th>        
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=3;?>
        <tr>
          <th>เงินงบประมาณระหว่างปี</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=4;?>
        <tr>
          <th>ผูกพันธ์งบประมาณ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=5;?>
        <tr>
          <th>อนุมัติเบิกเงิน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=6;?>
        <tr>
          <th>คืนเงินงบประมาณ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=7;?>
        <tr>
          <th>อนุมัติเบิกเงินเบิกแทน</th>
         <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=8;?>
        <tr>
          <th>หักเงินตามนโยบาย %</th>
         <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=9;?>
        <tr>
          <th>รายงาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        
        </tr>
        
        <? $menu_id=10;?>
        <tr>
          <th>ประวัติการใช้งาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        
        </tr>
      </table>
    </div>
    <div id="tabs-4">
    <? $system_id=4;?>
      <table class="tbadd">
        <tr>
          <th>ความสามารถ</th>
          <td>
          	<input type="checkbox" name="mt_access_all" value="1" <? if($result['mt_access_all']=='on')echo 'checked="checked"';?>>เข้าถึงข้อมูลทุกหน่วยงาน
          	&nbsp;
          </td>
        </tr>
        <? $menu_id=1;?>
        <tr>
          <th>ผลการดำเนินงานและเบิกจ่าย</th>
          <td>
          <input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>  
        <? $menu_id++;?>
        <tr>
          <th>แบบสำรวจความพึงพอใจของผู้รับบริการ</th>
          <td>
          <input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>        
        <? $menu_id++;?>
        <tr>
          <th>การกรอกข้อมูล</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>รายงานสรุป ผลการปฏิบัติงานและเบิกจ่าย</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
          </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>รายงานสรุป แบบสำรวจความพึงพอใจของผู้รับบริการ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
          </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>        
        <? $menu_id++;?>
        <tr>
          <th>การกรอกข้อมูลแต่ละจังหวัด</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>ประวัติการแก้ไขข้อมูลของจังหวัด</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>การกรอกข้อมูลส่วนกลางแต่ละหน่วยงาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>ความเชื่อมโยงแผนงบประมาณ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>รายงาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>ประวัติการใช้งาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
        <? $menu_id++;?>
        <tr>
          <th>แบบฟอร์ม สตป.06</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
        </tr>
      </table>
    </div>
    
    <div id="tabs-5">
      <? $system_id=5;?>
      <table class="tbadd">
        <tr>
          <th>ความสามารถ</th>
          <td>
          	<input type="checkbox" name="is_inspector" value="1" <? if($result['is_inspector']=='on')echo 'checked="checked"';?>>ผู้ตรวจราชการ
          	<input type="checkbox" name="insp_access_all" value="1" <? if($result['insp_access_all']=='on')echo 'checked="checked"';?>>เข้าถึงข้อมูลทุกหน่วยงาน
          	&nbsp;
          </td>
        </tr>        
        <? $menu_id=1;?>
        <tr>
          <th>บันทึก ผลการดำเนินงาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=2;?>
        <tr>
          <th>บันทึก ข้อเสนอแนะผู้ตรวจ </th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=12;?>
        <tr>
          <th>บันทึก ผลการเบิกจ่ายงบประมาณ </th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        
        <? $menu_id=3;?>
        <tr>
          <th>ผู้ดูแล บันทึกโครงการ(KPN)</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        
        <? $menu_id=4;?>
        <tr>
          <th>ผู้ดูแล ผู้ตรวจราชการและสมาชิก</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        <? $menu_id=13;?>
        <tr>
          <th>ผู้ดูแล แจ้งเตือนผลการดำเนินงาน </th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        <? $menu_id=5;?>        
        <tr>
          <th>ตั้งค่า กลุ่มผู้ตรวจ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=6;?>
        <tr>
          <th>ตั้งค่า หัวข้อความเสี่ยง</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=7;?>
        <tr>
          <th>ตั้งค่า จัดการโครงการและวัตถุประสงค์</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=8;?>
        <tr>
          <th>ตั้งค่า กำหนดรอบ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
		<? $menu_id=9;?>
        <tr>
          <th>ตั้งค่า กำหนดระดับความเสี่ยง</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        <tr>
        <? $menu_id=10;?>
        <tr>
          <th>รายงาน ความเสี่ยง</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        <? $menu_id=14;?>
        <tr>
          <th>รายงาน ข้อเสนอแนะผู้ตรวจ</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        <? $menu_id=11;?>
        <tr>
          <th>ประวัติการใช้งาน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            </td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
      </table>
    </div>
    
    
    <div id="tabs-6">
      <? $system_id=6;?>
      <table class="tbadd">
        <tr>
          <th>ความสามารถ</th>
          <td>
          	<!-- <input type="checkbox" name="is_fund" value="1" <? if($result['is_fund']=='on')echo 'checked="checked"';?>>ผู้ตรวจราชการ -->
          	<input type="checkbox" name="fn_access_all" value="1" <? if($result['fn_access_all']=='on')echo 'checked="checked"';?>>เข้าถึงข้อมูลทุกหน่วยงาน
          	&nbsp;
          </td>
        </tr>        
        <? $menu_id=1;?>
        <tr>
          <th>สัญญารับเงินอุดหนุน</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=2;?>
        <tr>
          <th>ผู้รับมอบอำนาจ </th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete</td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>
            
        </tr>
        <? $menu_id=3;?>
        <tr>
          <th>องค์กร</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <!-- <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if(@$srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete --></td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        
        <? $menu_id=4;?>
        <tr>
          <th>log file</th>
          <td><input type="checkbox" name="View_<?=$system_id;?>_<?=$menu_id;?>" id="View_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANVIEW"]=='on')echo "checked";?> />
            View
            <!-- <input type="checkbox" name="Add_<?=$system_id;?>_<?=$menu_id;?>" id="Add_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANADD"]=='on')echo "checked";?> />
            Add
            <input type="checkbox" name="Edit_<?=$system_id;?>_<?=$menu_id;?>" id="Edit_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANEDIT"]=='on')echo "checked";?> />
            Edit
            <input type="checkbox" name="Delete_<?=$system_id;?>_<?=$menu_id;?>" id="Delete_<?=$system_id;?>_<?=$menu_id;?>" <? if($srow[$system_id][$menu_id]["CANDELETE"]=='on')echo "checked";?> />
            Delete --></td>
          <td  align="left" nowrap="nowrap">
          <input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',true);" style="cursor:pointer;" value="เลือกทั้งหมด"><input type="button" onclick="CheckAll('<?=$system_id;?>','<?=$menu_id;?>',false);" style="cursor:pointer;" value="ไม่เลือกทั้งหมด">
          </td>            
        </tr>
        
      </table>
    </div>
    
    
  </div></th>
  </tr>
</table>
<div id="btnBoxAdd">
  <?php if(permission('c_usergroup', 'canedit')): ?>
  	<input name="btn_save" id="btn_save" type="submit" title="บันทึก" value=" " class="btn_save"/>
  	<?php endif;?>
  <input name="input2" type="button" title="ย้อนกลับ" value=" "  onclick="history.back(-1)" class="btn_back"/>
</div>
</form>
<div style='display:none'>
		<div id='bg_source_form' style='padding:10px; background:#fff;'>
        <h3>เลือกผู้ใช้</h3>
        <div class="paddT20"></div>        
                      กรอกชื่อ - นามสกุล / อีเมล์ ผู้ใช้
        <input type="text" id="tb_search" name="tb_search" value="">
        <input type="button" name="show_result" id="show_result" value=" ค้นหา "> 
        <div id="dv_result" style="height: 550px;">
        	
        </div>
		</div>
</div>
