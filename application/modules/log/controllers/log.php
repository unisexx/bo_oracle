<?php
class Log extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_log/c_log_model','clogs');
	}
	public function index()
	{//$this->db->debug = true;

 	   $condition = " 1=1  ";
 	   if(!empty($_GET['ordername'])){
			$ordername =  $_GET['ordername'];
	   		if($_GET['ordername']=='title')$ordername = "title";
	   }
	   else{
	   		$ordername = "process_date";
	   }
	   $condition .=(!empty($_GET['actiontype'])) ? " and actiontype='".$_GET['actiontype']."'":'';
	   if(!empty($_GET['orderby'])){$orderby=$_GET['orderby'];}else{$orderby="asc";}
		$orderby = "desc";
		if(!empty($_GET['start_date']) && !empty($_GET['end_date']))
		{
			$s_date= strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:01");
			$e_date= strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59");
			$condition .= " AND process_date BETWEEN ".$s_date." AND ".$e_date;
		}
		$data['result']= $this->clogs->where($condition)->order_by($ordername,$orderby)->get();
		$data['pagination'] = $this->clogs->pagination();
		$this->template->build('index',$data);
	}


}
?>
