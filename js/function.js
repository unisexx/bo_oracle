function LoadProvinceZone(pZone)
{
	document.getElementById('pgroup').value = '';
	$("#dvProvinceList").html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_province_list',{
		zone:pZone
	},function(data){
		$("#dvProvinceList").html(data);
	});
	$("#dvSectionList").html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_division_list',{
		zone:pZone
	},function(data){
		$("#dvSectionList").html(data);
	});
	$("#dvWorkgroupList").html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_workgroup_list',{
		zone:pZone
	},function(data){
		$("#dvWorkgroupList").html(data);
	});
}

function LoadSection(pProvince)
{
	$("#dvSectionList").html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_section_list',{
		province:pProvince
	},function(data){
		$("#dvSectionList").html(data);
	});
	$("#dvWorkgroupList").html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_workgroup_list',{
		province:pProvince
	},function(data){
		$("#dvWorkgroupList").html(data);
	});
}
function LoadWorkgroup(pSection)
{
	$("#dvWorkgroupList").html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_workgroup_list',{
		section:pSection
	},function(data){
		$("#dvWorkgroupList").html(data);
	});

}
function LoadProductivity(pYear,pControl,pType)
{
	if(pType==undefined){
		pType = 'productivity';
	}
	$("#"+pControl).html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':pType
	},function(data){
		$("#"+pControl).html(data);
	});
}
function LoadMainActivity(pYear,pProductivity,pControl,pType)
{
	if(pType==undefined){
		pType = 'main';
	}
	$("#"+pControl).html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':pType,
		'productivity':pProductivity
	},function(data){
		$("#"+pControl).html(data);
	});
}
function LoadSubActivity(pYear,pProductivity,pMainActivity,pControl,pType)
{	var pMissionType ='';
	pProductivity = (pProductivity.lenght==0) ? $('#productivity option:selected').val():pProductivity;
	pMainActivity = (pMainActivity.lenght==0) ? $('#mainactivity option:selected').val():pMainActivity;
	pMissionType = $('#missiontype option:selected').val();
	if(pType==undefined){
		pType = 'sub';
	}
	$("#"+pControl).html('<img src="themes/bo/images/loading.gif" width="16px" height="16px"/>');
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':pType,
		'productivity':pProductivity,
		'mainactivity':pMainActivity,
		'missiontype' :pMissionType
	},function(data){
		$("#"+pControl).html(data);
	});

}
