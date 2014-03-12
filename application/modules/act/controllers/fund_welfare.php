<?php
Class fund_welfare extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("fund_project_model","fund_project");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " and headline like '%".$_GET['search']."%'" : "";
		$condition .= @$_GET['rule_type']!='' ? " and rule_type = ".$_GET['rule_type'] : "" ;
		$data['fund_projects'] = $this->fund_project->where("1 = 1 ".$condition)->order_by('id','desc')->get(false,false);
		$data['pagination'] = $this->fund_project->pagination();
		$this->template->build('fund_welfare/index',$data);
	}
	
	function form($id=false){
		$data['project'] = $this->fund_project->get_row($id);
		$this->template->build('fund_welfare/form',$data);
	}
	
	function list_project(){
		// $qryStr = "var=$var&var1=1&budget_year=$budget_year&fund_id=$fund_id&org_name=$org_name&project_name=$project_name";
		
		// $this->db->debug = true;
		$sql = "SELECT * FROM ACT_MST_FUND_NAME ORDER BY FUND_NAME";
		$data['funds'] = $this->fund_project->get($sql);
		
		// to do ....
		$condition = " 1=1 ";
		$condition .= @$_GET['budget_year']!='' ? " and ACT_FUND_PROJECT.BUDGET_YEAR = ".$_GET['budget_year'] : "" ;
		$condition .= @$_GET['fund_id']!='' ? " and ACT_FUND_PROJECT.FUND_ID = ".$_GET['fund_id'] : "" ;
		$condition .= @$_GET['project_name']!='' ? " AND (ACT_FUND_PROJECT.PROJECT_NAME LIKE '%".$_GET['project_name']."%')" : "";
		$condition .= @$_GET['org_name']!='' ? " AND (ACT_ORGANIZATION_MAIN.ORGAN_NAME LIKE '%".$_GET['org_name']."%')" : "";
		
		$sql = "SELECT
			ACT_ORGANIZATION_MAIN.ORGAN_NAME,
			ACT_FUND_PROJECT.PROJECT_NAME,
			ACT_FUND_PROJECT.ROUND_NO,
			ACT_FUND_PROJECT.PROJECT_ID,
			ACT_FUND_PROJECT.FUND_ID
			FROM
			ACT_FUND_PROJECT
			INNER JOIN ACT_ORGANIZATION_MAIN ON ACT_FUND_PROJECT.ORG_ID = ACT_ORGANIZATION_MAIN.ORGAN_ID WHERE ".$condition;
		$data['lists'] = $this->fund_project->get($sql,FALSE);
		$data['pagination'] = $this->fund_project->pagination();
		
		$this->load->view('fund_welfare/list_project',$data);
	}

	function ajax_get_manage_welfare(){
		$sql = "SELECT * FROM ACT_MANAGE_WELFARE";
		$manages = $this->fund_project->get($sql,FALSE);
		echo "<select name='CHACT2'>";
		foreach($manages as $row){
			echo "<option value='".$row['wel_id']."'>".$row['wel_name']."</option>";
		}
		echo "</select>";
	}
	
	function ajax_get_action_welfare(){
		$sql = "SELECT * FROM ACT_ACTION_WELFARE";
		$manages = $this->fund_project->get($sql,FALSE);
		echo "<select name='CHACT2'>";
		foreach($manages as $row){
			echo "<option value='".$row['ac_id']."'>".$row['ac_name']."</option>";
		}
		echo "</select>";
	}
	
	function ajax_get_action_welfare(){
		$sql = "SELECT * FROM ACT_JOIN_PROJECT";
		$manages = $this->fund_project->get($sql,FALSE);
		echo "<select name='CHACT2'>";
		foreach($manages as $row){
			echo "<option value='".$row['jp_id']."'>".$row['jp_name']."</option>";
		}
		echo "</select>";
	}
	
	// function save(){
		// if($_POST){
			// $this->db->debug = true;
			// $_POST['create_date'] = date("Y-m-d H:i:s");
			// $this->orgmain->save($_POST);
			// set_notify('success', lang('save_data_complete'));
		// }
		// redirect('act/welfare');
	// }
// 	
	// function delete($id){
		// if($id){
			// $this->affiliate->delete($id);
			// set_notify('success', lang('delete_data_complete'));
		// }
		// redirect($_SERVER["HTTP_REFERER"]);
	// }
}
?>