<?php
class Finance_budget_related extends Finance_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('finance_budget_id/fn_strategy_model','fn_strategy');
		$this->load->model('fn_budget_related_model','fn_budget_related');
		$this->load->model('fn_budget_related_detail_model','fn_budget_related_detail');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('finance_budget_plan/fn_budget_master_model','fn_budget_master');
		$this->load->model('finance_budget_plan/fn_budget_type_model','fn_budget_type');
		$this->load->model('finance_cost_related/fn_cost_related_model','fn_cost_related');
		$this->load->model('finance_percent/fn_percent_model','fn_percent');
	}
	
	function index()
	{		
		$data['url_parameter'] = GetCurrentUrlGetParameter();		
		/* search */
		
		$book_id=(@$_GET['book_id']!="")? " and book_id LIKE '%".@$_GET['book_id']."%'": "";
		$budgetyear=(@$_GET['budgetyear']!="")? " and budgetyear=".@$_GET['budgetyear']:"";
		$budgetplantype=(@$_GET['budgetplantype']!="" )? " and budgetplantype=".@$_GET['budgetplantype']:"";
		$budgetyeartype=(@$_GET['budgetyeartype']!="")? " and budgetyeartype=".@$_GET['budgetyeartype']:"";
		$departmentid=(@$_GET['departmentid']!="")? " and departmentid=".@$_GET['departmentid']:"";
		$divisionid=(@$_GET['divisionid']!="")? " and divisionid=".@$_GET['divisionid']:"";
		$workgroupid=(@$_GET['workgroupid']!="")? " and workgroupid=".@$_GET['workgroupid']:"";
		
						
		$related_date1=(@$_GET['related_date1'])?strtotime((date_to_mysql(@$_GET['related_date1'],TRUE))." 23:59:59"):"";	  
		$related_date2=(@$_GET['related_date2'])?strtotime((date_to_mysql(@$_GET['related_date2'],TRUE))." 23:59:59"):""; 
		
		
		$related_date="";
		if(@$_GET['related_date1']!="" && @$_GET['related_date2']!="")
		{
			$related_date=" AND(related_date BETWEEN ".$related_date1." AND ".$related_date2.") ";
		}
		else
		{
			if(@$_GET['related_date1']!="")
			{
				$related_date=" AND(related_date >= ".$related_date1.") ";
			}else if(@$_GET['related_date2']!=""){
				$related_date=" AND(related_date <= ".$related_date2.") ";
			}
		}
		
		$where=" 1=1 ".$book_id.$budgetyear.$budgetplantype.$budgetyeartype.$departmentid.$divisionid.$workgroupid.$related_date; 
		//$this->db->debug=true;
		$data['result'] =$this->fn_budget_related->where($where)->get();		
		$data['pagination']=$this->fn_budget_related->pagination();
		$this->template->build('finance_budget_related_index',$data);
	}
	
	function form($id=FALSE)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['rs'] =$this->fn_budget_related->get_row($id);		
		if($id)
		{			
			$data['budgetdata']=$this->show_table($data['rs']['budget_type'],$data['rs']['projectid'],$id);			
		    $data['budget_all']=$this->fn_budget_related_detail->get_one("sum(budget) as budget_all","budget_related_id",$id);
		}		
		$this->template->build('finance_budget_related_form',$data);
	}
	function  get_related($id,$budget_related_id)
	{
		$sql="SELECT budget FROM fn_budget_related_detail WHERE budgettype_id=".$id." and budget_related_id=".$budget_related_id;	
		$budget=$this->fn_budget_related_detail->get($sql);
		//var_dump($budget[0]);exit;
		return $budget[0];
	}
	
	function show_table($budget_type=FALSE,$projectid=FALSE,$id=FALSE)
	{
		//$this->db->debug=true;					
		$projectid = @$_POST['projectid']> 0 ? @$_POST['projectid'] : $projectid;
		
		$sql = 'SELECT FN_BUDGET_MASTER.*,DIVISIONID, CNF_WORKGROUP.TITLE WORKGROUP_NAME, CNF_DIVISION.TITLE DIVISION_NAME
		FROM FN_BUDGET_MASTER
		left join CNF_WORKGROUP on FN_BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
		left join CNF_DIVISION on CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
		WHERE FN_BUDGET_MASTER.ID='.$projectid;
		$project = $this->db->getrow($sql);				
		$data='<h3>รายการยอดผูกพันงบประมาณ </h3>';
		$data .='<table id="tblist2" class="tblist2">';
				$data .='<tr>';
			  		$data .='<th style="text-align:left">หมวดงบประมาณ</th>';
					switch($budget_type):
						case 1:
						$data .='<th style="text-align:right">งบจัดสรร</th>';
						break;
						case 2:
						$data .='<th style="text-align:right">งบจัดสรรจากหน่วยงานอื่น</th>';
						break;
						case 3:
						$data .='<th style="text-align:right">เงินกันเหลื่อมปี</th>';
						break;
						case 4:
						$data .='<th style="text-align:right">งบประมาณระหว่างปี</th>';
						break;					
					endswitch;
			  		$data .='<th style="text-align:right">จำนวนเงินผูกพันทั้งหมด </th>';
			  		$data .='<th style="text-align:right">คงเหลือ</th>';
			  		$data .='<th style="text-align:right">ขอผูกพันงบประมาณจำนวน</th>';
			  	$data .='</tr>';
		$budgettype = $this->fn_budget_type->where("PID=0")->get(FALSE,TRUE);								
		foreach($budgettype as $b):		
			switch($budget_type):
				case 2:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_RECEIVE_FOR_WITHDRAW_REPLACE FM 
					LEFT JOIN FN_RECEIVE_FOR_WITHDRAW_REPLACE_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectid." AND BUDGETTYPE_ID =".$b['id'];
					$budget_alloc = $this->db->getone($sql);//ยอดจัดสรร ของโครงการ (ตามประเภทงบ)										
				break;
				case 3:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_RECEIVE_YEAR_OVERLAP FM 
					LEFT JOIN FN_RECEIVE_YEAR_OVERLAP_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectid." AND BUDGETTYPE_ID =".$b['id'];		
					$budget_alloc = $this->db->getone($sql);//ยอดจัดสรร ของโครงการ (ตามประเภทงบ)
				break;
				case 4:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_MONEY_DURING_YEAR FM 
					LEFT JOIN FN_MONEY_DURING_YEAR_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectid." AND BUDGETTYPE_ID =".$b['id'];		
					$budget_alloc = $this->db->getone($sql);//ยอดจัดสรร ของโครงการ (ตามประเภทงบ)
				break;
				default:
					$budget_alloc=0;
					$sql = "SELECT BUDGETTYPEID,BUDGET FROM FN_BUDGET_TYPE_DETAIL 
					WHERE BUDGETID=".$projectid." AND 
					BUDGETTYPEID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=".$b['id']." AND EXPENSETYPEID=0)";
					$b_result = $this->db->getarray($sql);//ยอดจัดสรร ของโครงการ (ตามประเภทงบ)		
					foreach($b_result as $item):
						$percent = $this->fn_percent->where("budget_year=".$project['BUDGETYEAR']." AND division_id=".$project['DIVISIONID']."  AND expense_type_id=".$item['BUDGETTYPEID'])->get_row();						
						$budget_alloc+= @$percent['percent_value']>0 ?  $item['BUDGET']-($item['BUDGET']*(($percent['percent_value']/100))) :  $item['BUDGET'];
					endforeach;												
				break;			
			endswitch;			
			
			
			$with_id_condition = "";
			$budget_relate_net=0;
			if($id > 0 )
			{
				$sql_relate_net = " SELECT BUDGET FROM  FN_BUDGET_RELATED FBR 
						LEFT JOIN FN_BUDGET_RELATED_DETAIL FBRD ON FBR.ID = FBRD.BUDGET_RELATED_ID 
						WHERE FBR.ID=".$id." AND BUDGETTYPE_ID=".$b['id'];
				$budget_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)
				$with_id_condition = " AND FBR.ID <>".$id;
			}
			
			$sql_b_relate = " SELECT SUM(BUDGET) FROM FN_BUDGET_RELATED FBR 
					LEFT JOIN FN_BUDGET_RELATED_DETAIL FBRD ON FBR.ID = FBRD.BUDGET_RELATED_ID 
					WHERE PROJECTID=".$projectid." AND BUDGET_TYPE=".$budget_type." AND BUDGETTYPE_ID=".$b['id'];
			$b_related = $this->db->getone($sql_b_relate); //ยอดผูกพันหลักการ (กรณีเป็นการแก้ไข จะไม่รวมตัวมันเอง )		
					
			
			$sql_c_relate = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED FCR
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE PROJECTID=".$projectid." AND BUDGET_TYPE=".$budget_type." AND BOOK_ID < 1  AND BUDGETTYPE_ID=".$b['id'];			
			$c_related = $this->db->getone($sql_c_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ
			
			$sql_b_return = " SELECT SUM(BUDGET_COMMIT) FROM FN_BUDGET_RETURN FBR 
			LEFT JOIN FN_BUDGET_RETURN_DETAIL FBRD ON FBR.ID = FBRD.FN_BOOK_RETURN_ID
			LEFT JOIN FN_BUDGET_RELATED FB ON FBR.BUDGET_RELATED_ID = FB.ID
			LEFT JOIN FN_COST_RELATED FC ON FBR.COST_RELATED_ID = FC.ID
			WHERE BUDGETTYPE_ID=".$b['id']." AND FC.BUDGET_TYPE=".$budget_type." AND (FB.PROJECTID=".$projectid." OR FC.PROJECTID=".$projectid.")";
			$b_return = $this->db->getone($sql_b_return); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ 
			
			$total_relate = ($b_related + $c_related) - $b_return; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)
			$budget_total = $budget_alloc - $total_relate; //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			$tmp_budget_total = $budget_total - $budget_relate_net;
			$tmp_budget_total = $id > 0 ? $budget_relate_net : $tmp_budget_total;
			//
			#2 $budget_alloc			
			#3 $total_relate
			#4 $budget_total
			#5 $budget_relate_net
			
		$data .='<tr class="trbudget">';
		$data .='<td>'.$b['title'].'<input type="hidden" name="budgettype_id[]" value="'.$b['id'].'"></td>';#1
		$data .='<td align="right" class="td_budget_alloc">';#2
		$data .='<input type="hidden" name="budget_alloc[]" class="budget_alloc" value="'.number_format(@$budget_alloc,2).'">'.number_format(@$budget_alloc,2);
		$data .='</td>';
		$data .='<td align="right" class="td_budget_related">';#3
		$data .='<input type="hidden" name="total_relate[]" class="total_relate" value="'.number_format(@$total_relate,2).'">'.number_format(@$total_relate,2);
		$data .='</td>';
		$data .='<td align="right" class="td_budget_net">';#4
		$data .=number_format(@$budget_total,2);
		$data .='</td>';
		$data .='<td align="right" class="td_budget_related_net">';#5
		$data .='<input type="hidden" name="tmp_budget_total[]" class="tmp_budget_total" value="'.@number_format($tmp_budget_total,2).'">';
		$data .='<input type="hidden" name="tmp_last_related[]" class="tmp_last_related" value="'.@number_format($budget_relate_net,2).'">';				
		$data .='<input name="budget_related[]" type="text" class="text_related" alt="decimal"  value="'.@$budget_relate_net.'" style="text-align:right"/>';
		$data .='</td>';
		$data .='</tr>';
		endforeach;
		$data .='</table>';
		if($id>0)
		{						
			return $data;
		}			
		else
		{
			echo $data;
		}
					
	}


	function save(){
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){			
			$_POST['book_id']=implode('/',$_POST['book_id']);			
			$_POST['book_date']=($_POST['book_date']!="")? th_to_stamp($_POST['book_date']):0;
			$_POST['finance_date']=($_POST['finance_date']!="")? th_to_stamp($_POST['finance_date']):0;
			$_POST['related_date']=($_POST['related_date']!="")? th_to_stamp($_POST['related_date']):0;
		
			$id=$this->fn_budget_related->save($_POST);
			$i=0;
			
			$this->fn_budget_related_detail->delete("budget_related_id",$id);					
			foreach($_POST['budgettype_id'] as $item) {
				$data=array('budget_related_id'=>$id,'budgettype_id'=>$item,'budget'=>str_replace(",","",$_POST['budget_related'][$i]),'budget_alloc'=>str_replace(",","",$_POST['budget_alloc'][$i]));			
				$this->fn_budget_related_detail->save($data);
				$i++;
							
			}
			
			set_notify('success', lang('save_data_complete'));
			
			/*if($_POST['checkbox'] == 1){
				redirect('finance_cost_related/form_budget_related/'.$id);
			}*/
		}
		
		
		redirect('finance_budget_related/index'.$url_parameter);
	}
	
	function delete($id=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if($id){
			$this->fn_budget_related->delete($id);
			$this->fn_budget_related_detail->delete("BUDGET_RELATED_ID",$id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('finance_budget_related/index'.$url_parameter);
	}
	
	function select_fnyear_2_find_bgplantype(){
		if($_POST['fnyear']){
			$fnyear = $_POST['fnyear'];
			
			$bgplantypes = $this->fn_strategy->where("fnyear = ".$fnyear." and budgetplantype =0")->get();
			
			echo"<select name='budgetplantype' id='budgetplantype'>";
			echo"<option value=''>-- เลือกช่วงแผนงบประมาณ --</option>";
				foreach($bgplantypes as $bgplantype){
					echo "<option value='".$bgplantype['id']."'>".$bgplantype['title']."</option>";
				}
			echo "</select>";
			}
	}
	function select_bgplantype_find_bgyeartype(){
		if($_POST['budgetplantype']){
			$budgetplantype = $_POST['budgetplantype'];
			
			$budgetplantype = $this->fn_strategy->where("budgetyeartype <1 and budgetplantype=".$budgetplantype)->get();
			
			echo"<select name='budgetyeartype' id='budgetyeartype'>";
			echo"<option value=''>-- เลือกประเภทงบประมาณ --</option>";
				foreach($budgetplantype as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_department_find_division()
	{
		if($_POST['departmentid']){
			$department = $_POST['departmentid'];			
			$division = $this->division->where("departmentid=".$department)->get(FALSE,TRUE);		
			echo"<select name='divisionid' id='divisionid'>";
			echo"<option value=''>-- เลือกหน่วยงาน (กลุ่ม/ฝ่าย) --</option>";
				foreach($division as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_department()
	{
			$department = $this->department->where(" financeuse='on' ")->get(FALSE,TRUE);		
			echo"<select name='departmentid' id='departmentid'>";
			echo"<option value=''>-- เลือกกรมที่รับผิดชอบ --</option>";
				foreach($department as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
	}	
	function select_division_find_workgroup()
	{			
		if($_POST['divisionid']){
			$division = $_POST['divisionid'];			
			$workgroup = $this->workgroup->where("divisionid=".$division)->get(FALSE,TRUE);		
			echo"<select name='workgroupid' id='workgroupid'>";
			echo"<option value=''>-- เลือกกลุ่มงาน --</option>";
				foreach($workgroup as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_workgroup_find_plan()
	{
		
		if($_POST['budgetplantype']){
			$budgetplantype = $_POST['budgetplantype'];	
			$workgroupid=$_POST['workgroupid'];	
			$sql="select * from fn_strategy where id in(select planid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype;
					
			$planid = $this->fn_strategy->get($sql,TRUE);		
			echo"<select name='planid' id='planid'>";
			echo"<option value=''>-- เลือกแผนงาน --</option>";
				foreach($planid as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_plan_find_product()
	{			
		if($_POST['planid']){
			$planid = $_POST['planid'];	
			$workgroupid=$_POST['workgroupid'];	
			$budgetplantype=$_POST['budgetplantype'];		
		
			
			$sql="select * from fn_strategy where id in(select productivityid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype." and pid=".$planid;			
			$product = $this->fn_strategy->get($sql,TRUE);		
			
			echo"<select name='productivityid' id='productivityid'>";
			echo"<option value=''>-- เลือกผลผลิต --</option>";
				foreach($product as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_product_find_mainact()
	{
						
		if($_POST['productivityid']){
			$productivityid= $_POST['productivityid'];
			$workgroupid=$_POST['workgroupid'];	
			$budgetplantype=$_POST['budgetplantype'];			
			
			$sql="select * from fn_strategy where id in(select mainactid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype." and pid=".$productivityid;			
			$mainact = $this->fn_strategy->get($sql,TRUE);		
			echo"<select name='mainactid' id='mainactid'>";
			echo"<option value=''>-- เลือกกิจกกรรมหลัก --</option>";
				foreach($mainact as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_mainact_find_subact()
	{			
		if($_POST['mainactid']){
			$mainactid= $_POST['mainactid'];
			$workgroupid=$_POST['workgroupid'];	
			$budgetplantype=$_POST['budgetplantype'];									
			$sql="select * from fn_strategy where id in(select id from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype." and pid=".$mainactid;	
							
			$subact = $this->fn_strategy->get($sql,TRUE);
			
			echo"<select name='subactivityid' id='subactivityid'>";
			echo"<option value=''>-- เลือกกิจกกรรมย่อย --</option>";
				foreach($subact as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_subact_find_project()
	{
					
		if($_POST['subactivityid']){
			$subactivityid= $_POST['subactivityid'];
			$workgroupid=$_POST['workgroupid'];			
			
			$sql="SELECT projecttitle,id  from fn_budget_master 
				WHERE workgroup_id=$workgroupid and subactivityid =".$subactivityid;				
							
			$projectid = $this->fn_strategy->get($sql,TRUE);
			echo"<select name='projectid' id='projectid'>";
			echo"<option value=''>-- เลือกโครงการ --</option>";
				foreach($projectid as $rs){
					echo "<option value='".$rs['id']."'>".$rs['projecttitle']."</option>";
				}
			echo "</select>";
		}
	}
	
}
?>