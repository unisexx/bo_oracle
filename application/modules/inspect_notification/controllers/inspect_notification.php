<?php
class Inspect_notification extends Inspect_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inspect_save/insp_project_risk_save_model','risk_save');
		$this->load->model('inspect_round/insp_round_detail_model','round_detail');
	}
	
	function index(){
		$condition = " WHERE  1=1 ";
		$condition .= @$_GET['budgetyear'] > 0 ? " and insp_project_risk_save.budgetyear = ". @$_GET['budgetyear'] : "";
		$condition .= @$_GET['provinceid'] > 0 ? " and insp_project_risk_save.provinceid = ". @$_GET['provinceid'] : "";
		$condition .= @$_GET['roundno'] > 0 ? " and insp_project_risk_save.roundno = ". @$_GET['roundno'] : "";
		$condition .= @$_GET['status'] != "" ? " and insp_project_risk_save.status = '". @$_GET['status']."'" : "";
		
		if(login_data('insp_access_all') != 'on'){
			$condition .= " and provinceareaid in (select province_area from insp_group where users_id = ".login_data('id').") ";
		}
		
		$sql = "SELECT distinct insp_project_risk_save.budgetyear,insp_project_risk_save.projectid,insp_project_risk_save.provinceareaid,insp_project_risk_save.provinceid,insp_project_risk_save.roundno,insp_project_risk_save.updatedate,insp_project_risk_save.status,cnf_province.title province,cnf_province_area.title provincearea,insp_project.title project
FROM insp_project_risk_save
left join cnf_province on insp_project_risk_save.provinceid = cnf_province.id
left join cnf_province_area on insp_project_risk_save.provinceareaid = cnf_province_area.id
left join insp_project on insp_project_risk_save.projectid = insp_project.id ".$condition." order by insp_project_risk_save.updatedate desc";
		$data['notice'] = $this->risk_save->get($sql,'FALSE');
		$data['pagination'] = $this->risk_save->pagination();
		$this->template->build('inspect_notification_index',$data);
	}

	function get_round(){
		if($_POST){
			$sql = "select insp_round_detail.* from insp_round_detail left join insp_round on insp_round_detail.round_id = insp_round.id where insp_round.mt_year = ".$_POST['mt_year'];
			// echo $sql;
			$roundnos = $this->risk_save->get($sql,'FALSE');
			
			// echo'<pre>';
			// print_r($roundnos);
			// echo'</pre>';
			
			echo '<select name="roundno">';
				foreach($roundnos as $key=>$roundno){
					$select = $roundno['id'] == $_POST['roundno'] ?'selected':'';
					echo '<option value="'.$roundno['id'].'" '.$select.'>'.$roundno['round_name'].'</option>';
				}
			echo '</select>';
		}
	}
}
?>