<h3>แผนงบประมาณรายจ่ายประจำปีงบประมาณ </h3>



<script type="text/javascript">
function LoadProvinceZone(pZone)
{
	document.getElementById('pgroup').value = '';
	url = 'ajax_province_list.php?zone='+pZone;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvProvinceList');
	
	url = 'ajax_section_list.php?zone='+pZone;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvSectionList');	
	
	url = 'ajax_workgroup_list.php?zone='+pZone;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');	
}
function LoadProvinceGroup(pGroup)
{
	document.getElementById('pzone').value = '';
	url = 'ajax_province_list.php?group='+pGroup;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvProvinceList');	

	url = 'ajax_section_list.php?group='+pGroup;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvSectionList');	
	
	url = 'ajax_workgroup_list.php?group='+pGroup;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');	
	
}
function LoadSection(pProvince)
{
	url = 'ajax_section_list.php?province='+pProvince;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvSectionList');	
	
	url = 'ajax_workgroup_list.php?province='+pProvince;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');		
}
function LoadWorkgroup(pSection)
{
	url = 'ajax_workgroup_list.php?section='+pSection;
	url = urlEncode(url,false);
	//alert(url);
	ajaxpage(url,'dvWorkgroupList');	
}
function LoadProductivity(pYear,pControl)
{
	url = 'ajax_budget_type_list.php?year='+pYear+'&type=productivity';
	url = urlEncode(url,false);
	ajaxpage(url,pControl);

}
function LoadMainActivity(pYear,pProductivity,pControl)
{
	url = 'ajax_budget_type_list.php?year='+pYear+'&type=main&productivity='+pProductivity;
	url = urlEncode(url,false);
	ajaxpage(url,pControl);
}
function LoadSubActivity(pYear,pProductivity,pMainActivity,pControl)
{
	url = 'ajax_budget_type_list.php?year='+pYear+'&type=sub&productivity='+pProductivity+'&mainactivity='+pMainActivity;
	url = urlEncode(url,false);
	ajaxpage(url,pControl);	
}
</script>