<?php
class Log extends Admin_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_logfile_model','logs');
	}
	public function index()
	{//$this->db->debug = true;
 	   $condition = " WHERE 1=1  ";
 	   if(!empty($_GET['ordername'])){
			$ordername =  $_GET['ordername'];
	   		if($_GET['ordername']=='Title')$ordername = "Title";
	   }
	   else{
	   		$ordername = "PROCESS_DATE";
	   }
	   $condition .=(!empty($_GET['actiontype'])) ? " and actiontype='".$_GET['actiontype']."'":'';
	   if(!empty($_GET['orderby'])){$orderby=$_GET['orderby'];}else{$orderby="asc";}
		$orderby = "desc";

	 	$command = "SELECT  * FROM  USER_LOGFILE  $condition ORDER BY $ordername $orderby ";
		//echo $command;
		$data['result'] = $this->logs->get($command);
		$data['pagination'] = $this->logs->pagination();
		$this->template->build('index',$data);
	}

}
?>
