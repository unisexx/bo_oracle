function LoadProvinceZone(pZone)
{
	document.getElementById('pgroup').value = '';
	$.get('ajax/ajax_province_list',{
		zone:pZone
	},function(data){
		$("#dvProvinceList").html(data);
	});

	$.get('ajax/ajax_division_list',{
		zone:pZone
	},function(data){
		$("#dvSectionList").html(data);
	});

	$.get('ajax/ajax_workgroup_list',{
		zone:pZone
	},function(data){
		$("#dvWorkgroupList").html(data);
	});
}
function LoadProvinceGroup(pGroup)
{
	document.getElementById('pzone').value = '';
	$.get('ajax/ajax_province_list',{
		group:pGroup
	},function(data){
		$("#dvProvinceList").html(data);
	});

	$.get('ajax/ajax_section_list',{
		group:pGroup
	},function(data){
		$("#dvSectionList").html(data);
	});

	$.get('ajax/ajax_workgroup_list',{
		group:pGroup
	},function(data){
		$("#dvWorkgroupList").html(data);
	});
}
function LoadSection(pProvince)
{
	$.get('ajax/ajax_division_list',{
		province:pProvince
	},function(data){
		$("#dvSectionList").html(data);
	});

	$.get('ajax/ajax_workgroup_list',{
		province:pProvince
	},function(data){
		$("#dvWorkgroupList").html(data);
	});
}
function LoadWorkgroup(pSection)
{
	$.get('ajax/ajax_workgroup_list.php',{
		section:pSection
	},function(data){
		$("#dvWorkgroupList").html(data);
	});

}
function LoadProductivity(pYear,pControl)
{
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':'productivity'
	},function(data){
		$("#"+pControl).html(data);
	});
}
function LoadMainActivity(pYear,pProductivity,pControl)
{
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':'main',
		'productivity':pProductivity
	},function(data){
		$("#"+pControl).html(data);
	});
}
function LoadSubActivity(pYear,pProductivity,pMainActivity,pControl)
{	var pMissionType ='';
	pProductivity = (pProductivity.lenght==0) ? $('#productivity option:selected').val():pProductivity;
	pMainActivity = (pMainActivity.lenght==0) ? $('#mainactivity option:selected').val():pMainActivity;
	pMissionType = $('#missiontype option:selected').val();
	$.get('ajax/ajax_productivity_list',{
		'year':pYear,
		'type':'sub',
		'productivity':pProductivity,
		'mainactivity':pMainActivity,
		'missiontype' :pMissionType
	},function(data){
		$("#"+pControl).html(data);
	});

}
