<?php
class budget_request extends Budget_Controller
{
	public $step_title = array('','เสนอคำของบประมาณ','ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ','ปรับปรุงคำของบประมาณตามมติ ครม.','ปรับปรุงคำของบประมาณตามมติ กระทรวง','แปรญิตติเพิ่ม'
	,'ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ','รายละเอียดงบประมาณตาม พรบ.','ปรับปรุงงบประมาณเพื่อการบริหาร');
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('c_division/division_model','division');												
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('budget_plan/budget_plan_model','budget_plan');
		$this->load->model('budget_time/budget_time_model','budget_time');
		$this->load->model('budget_plan/budget_plan_detail_model','budget_plan_detail');
		$this->load->model('c_province/province_model','province');
		$this->load->model('budget_master_model','bg_master');
		$this->load->model('budget_process_model','bg_process');	
		$this->load->model('budget_operation_area_model','bg_operation_area');		
		$this->load->model('budget_current_target_model','bg_current_target');
		$this->load->model('budget_area_model','bg_area');
		$this->load->model('budget_expense_type_model','bg_expense_type');
		$this->load->model('budget_asset/budget_asset_model','asset');
		$this->load->model('budget_type_detail_model','bg_type_detail');
		$this->load->model('workgroup_send_confirm_model','workgroup_send_confirm');
	}
	/*
	<li><a href="#tabs-1" title="เสนอคำของบประมาณ" alt="เสนอคำของบประมาณ" class="tip">ขั้นตอนที่ 1</a></li>
      <li><a href="#tabs-2" title="ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ" alt="ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ" class="tip">ขั้นตอนที่ 2</a></li>
      <li><a href="#tabs-3" title="ปรับปรุงคำของบประมาณตามมติ ครม." alt="ปรับปรุงคำของบประมาณตามมติ ครม." class="tip">ขั้นตอนที่ 3</a></li>
      <li><a href="#tabs-4" title="ปรับปรุงคำของบประมาณตามมติ กระทรวง" alt="ปรับปรุงคำของบประมาณตามมติ กระทรวง" class="tip">ขั้นตอนที่ 4</a></li>
      <li><a href="#tabs-5" title="แปรญิตติเพิ่ม" alt="แปรญิตติเพิ่ม" class="tip">ขั้นตอนที่ 5</a></li>
      <li><a href="#tabs-6" title="ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ" alt="ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ" class="tip">ขั้นตอนที่ 6</a></li>
      <li><a href="#tabs-7" title="รายละเอียดงบประมาณตาม พรบ." alt="รายละเอียดงบประมาณตาม พรบ." class="tip">ขั้นตอนที่ 7</a></li>
    <li><a href="#tabs-8" title="ปรับปรุงงบประมาณเพื่อการบริหาร" alt="ปรับปรุงงบประมาณเพื่อการบริหาร" class="tip">ขั้นตอนที่ 8</a></li>	 
	 */	
	public function index()
	{
		//$this->db->debug = true;
		if(!is_login())redirect("home.php");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['step_title'] = $this->step_title;		
		if(@$_GET['budgetyear']>0){
			//$condition = @$_GET['txtsearch']!='' ? " assetname LIKE '%".$_GET['txtsearch']."%' " : "1=1";
			//$data['result'] = $this->bg_master->where($condition)->get();
			//$data['pagination'] = $this->bg_master->pagination();
			$tcondition  =login_data('budgetcanaccessall') != 'on' ? " AND WORKGROUP_ID=".login_data('workgroupid') : '';
	  		$sql = "SELECT MAX(STEP)STEP FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".@$_GET['budgetyear'].$tcondition;
			$data['maxround'] = $this->db->getone($sql);		
			$data['budgetyear'] = @$_GET['budgetyear'];
			$data['divisionid'] = @$_GET['divisionid'];
			$data['workgroupid'] = @$_GET['workgroupid'];										
		}
		if(login_data('budgetcanaccessall')=='on')
			$this->template->build('lead_index',$data);
		else
			$this->template->build('index',$data);
	}
		
	public function form1($act=FALSE,$projectid=FALSE)
	{
		if(!is_login())redirect("home.php");			
		$data['act'] = $act;
		$data['budgetyear'] = @$_GET['budgetyear'];
		$data['workgroupid'] = @$_GET['workgroupid'];		
		$data['projectid'] = $projectid;
		$data['step'] = @$_GET['step'];
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($projectid > 0 ){
		$data['bmaster'] = $this->bg_master->get_row($projectid);
		$data['sprocess_result'] = $this->bg_process->where('budgetid='.$projectid)->get(FALSE,TRUE);		
		$data['operation_province'] = $this->bg_operation_area->where('budgetid='.$projectid)->get(FALSE,TRUE);
		$data['bcurrenttarget'] = $this->bg_current_target->where('budgetid='.$projectid)->get_row();
		$exp_result = $this->bg_expense_type->where('budgetid='.$projectid)->get(FALSE,TRUE);
		foreach($exp_result as $exp):
			$data['bexpensetype'][$exp['expensetypeid']]='on';
		endforeach; 		
		}
		$this->template->build('form1',$data);
	}
	
	public function form2($act=FALSE,$projectid=FALSE){
		//$this->db->debug = true;
		if(!is_login())redirect("home.php");			
		$data['act'] = $act;
		$data['budgetyear'] = @$_GET['budgetyear'];
		$data['workgroupid'] = @$_GET['workgroupid'];		
		$data['projectid'] = $projectid;
		$data['step'] = @$_GET['step'];
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		
		$data['bmaster'] = $this->bg_master->get_row($projectid);
		$data['sprocess_result'] = $this->bg_process->where('budgetid='.$projectid)->get(FALSE,TRUE);		
		$data['operation_province'] = $this->bg_operation_area->where('budgetid='.$projectid)->get(FALSE,TRUE);
		$data['bcurrenttarget'] = $this->bg_current_target->where('budgetid='.$projectid)->get_row();
		$data['budget_area'] = $this->bg_area->where("budgetid=".$projectid)->get(FALSE,TRUE);
		$sql = " select * from cnf_budget_type where id in (SELECT distinct pid FROM budget_expense_type
		left join cnf_budget_type on budget_expense_type.expensetypeid = cnf_budget_type.id
		where budgetid=".$projectid.")";
		$data['budget_type_result'] = $this->bg_expense_type->get($sql,TRUE);	
		
		$expense_id = '';
		$expense_result =  $this->bg_expense_type->where("budgetid=".$projectid)->get(FALSE,TRUE);
		foreach($expense_result as $expense):
			$expense_id .= $expense_id == '' ? $expense['expensetypeid'] : ",".$expense['expensetypeid'];
		endforeach;				
		$data['expenseid'] = $expense_id;
		
		$bbudgetDetail=array();;
		$bg_type_detail = $this->bg_type_detail->where('budgetid='.$projectid)->get(FALSE,TRUE);		
		foreach($bg_type_detail as $bg_type_item):
			for($i=1;$i<=12;$i++)$bbudgetDetail[$bg_type_item['budgettypeid']]['M'.$i] = $bg_type_item['budget_m'.$i];
			for($i=1;$i<=3;$i++)$bbudgetDetail[$bg_type_item['budgettypeid']]['budget_ny'.$i] = $bg_type_item['budget_ny'.$i];
			$bbudgetDetail[$bg_type_item['budgettypeid']]['chkcalculatedetail'] = $bg_type_item['chkcalculatedetail'];
			$bbudgetDetail[$bg_type_item['budgettypeid']]['qty'] = $bg_type_item['qty'];			
		endforeach;		
		$data['bbudgetDetail'] = $bbudgetDetail;		
		
		
		
		$this->template->build('form2',$data);
	}
	public function view_adjust($step,$divisionid,$budgetyear){
		$data['step'] = $step;
		$data['budgetyear'] = $budgetyear;
		$data['divisionid'] = $divisionid;
		$data['division'] = $this->division->get_row($divisionid);
		$budgetMonth = '';
		 for($m=1;$m<=12;$m++)
		 {
			 	if($budgetMonth != '') $budgetMonth .=" + ";
			 	$budgetMonth .=" BUDGET_M".$m;
		 }
		$i = 0;
		$ColID = array(-1);
		$ColTitle = array(-1);
	    $ColParent = array(-1);
	    $ColParent2 = array(-1);
		
		$condition  = "SELECT DISTINCT CNF_BUDGET_TYPE.BUDGETTYPEID FROM BUDGET_MASTER 
		LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID 
		LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID 
		WHERE BUDGET_MASTER.BUDGETYEAR=".$budgetyear." AND BUDGET_MASTER.WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.") ";
			
		$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY TITLE ";
		$result = $this->db->getarray($sql);
		dbConvert($result);
		foreach($result as $BudgetType_1)	
		{		
				 array_push($ColID,$BudgetType_1['id']);
				 array_push($ColTitle,$BudgetType_1['title']);
				 array_push($ColParent,0);
				 array_push($ColParent2,-1);							 
	
						$ncolumn1 = 0;
						$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['id']." AND (SELECT COUNT(*) FROM CNF_BUDGET_TYPE S3 WHERE PID = CNF_BUDGET_TYPE.ID)>0 ORDER BY TITLE ";
						$sresult = $this->db->getarray($sql);
						dbConvert($sresult);
						foreach($sresult as $BudgetType_2)					
						{
								 array_push($ColID,$BudgetType_2['id']);
								 array_push($ColTitle,$BudgetType_2['title']);
								 array_push($ColParent,$BudgetType_1['id']);
								 array_push($ColParent2,-1);						
	
								$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['id']." ORDER BY TITLE ";
	                            $ssresult = $this->db->getarray($sql);
	                            dbConvert($ssresult);
	                            foreach($ssresult as $BudgetType_3)                            
	                            {
									 array_push($ColID,$BudgetType_3['id']);
									 array_push($ColTitle,$BudgetType_3['title']);
									 array_push($ColParent,$BudgetType_1['id']);
									 array_push($ColParent2,$BudgetType_2['id']);
								 }
	
						}							
		}
		 
		$data['totalColumn'] = 0;
		$data['nextstep'] = $step+1;
		$data['steptitle'] = array('',	'เสนอคำของบประมาณ','ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ','ปรับปรุงคำของบประมาณตามมติ ครม.','ปรับปรุงคำของบประมาณตามมติ กระทรวง','แปรญิตติเพิ่ม','ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ','รายละเอียดงบประมาณตาม พรบ.','ปรับปรุงงบประมาณเพื่อการบริหาร');	

		$data['ColID'] = $ColID;
		$data['ColTitle'] = $ColTitle;
		$data['ColParent']= $ColParent;
		$data['ColParent2'] = $ColParent2;	
		$data['budgetMonth'] = $budgetMonth;	
		$this->template->build('adjust_view',$data);
	}
	public function reload_subactivity_list(){
		$budgetyear = @$_POST['budgetyear'];
		$condition = @$budgetyear > 0 ? " and syear = ".$budgetyear : "";
  		echo form_dropdown("subactivityid",get_option("id","title","cnf_strategy","mainactid > 0 ".$condition." order by title"),@$budgetyear,'','-- เลือกกิจกรรมย่อย --');
	}
	public function reload_keydetail_list(){
		//$this->db->debug = true;
		$subactivityid = $_POST['subactivityid'];		
		if(@$subactivityid!='')
		{		
	        $message='<table class="type1">
	        	<tr>
				  <th width="70%">ตัวชี้วัดผลผลิต</th>
				  <th>ประเภทตัวชี้วัด</th>
				  <th>หน่วยนับ</th>
				  <th>ส่งผลต่อตัวชี้วัดผลผลิต</th>
				</tr>';	         
	         $sql = "SELECT * FROM CNF_STRATEGY WHERE ID=".$subactivityid;
			 $strategy = $this->budget_plan->get_row($subactivityid);
			 $sql = "SELECT 
				 CNF_STRATEGY_DETAIL.*,
				 CNF_COUNT_UNIT.TITLE UNIT 
				 FROM CNF_STRATEGY_DETAIL 
				 LEFT JOIN CNF_COUNT_UNIT ON CNF_STRATEGY_DETAIL.UNITTYPEID = CNF_COUNT_UNIT.ID
				 WHERE PID=".$strategy['productivityid']."  ORDER  BY KEYTYPE ";				  	         			 
			 $result = $this->budget_plan_detail->get($sql,TRUE);			 
			 $i=0;
			 foreach($result as $productivity):										
			 $i++;
			 	if(@$bcurrenttarget['productivitykeyid'] != '') 
				{
					$pkey = explode(',',$bcurrenttarget['productivitykeyid']);
				}
				        
	        $message .='<tr>
	         <td >'.$i.'. '.$productivity['title'].'</td>
	          <td >'.@$productivity['keytype'].'</td>
	          <td >'.@$productivity['unit'].'</td>
			  <td >';
			 if($productivity['keytype']=='เชิงปริมาณ'){
			 $message.='<input type="checkbox" class="ChkKey bgFillData" name="chkworkplan[]" id="chk_workplan" value="'.@$productivity['id'].'"';
			 if(@$pkey != ''):  
	         	if(in_array(@$productivity['id'],@$pkey))$message.=' "checked" ';	         		         				 	
			 endif;
			 $message .=' />  ใช่';
			 }	         
	          	$message .='<Input type="hidden" id="unittypeid" name="unittypeid" value="'.@$productivity['unittypeid'].'">';  
	                                                   
			  $message.='</td>
	        </tr>';        
			endforeach;		 
	        $message.='</table>';
        }
        else
        {
        	$message= '';
        } 
		echo $message;
	}
	public function reload_strategy_chart($subactivityid=FALSE){
		//$this->db->debug=true;
		$message = '';		
		$subactivityid = @$_POST['subactivityid'] > 0 ? $_POST['subactivityid'] : $subactivityid;
		if($subactivityid < 1){
			$message.='<h3 id="topic">กรุณาเลือกกิจกรรมย่อยก่อน</h3>';
		}else{
			$picname = array('','folder.gif','plan_ico.png','binocular.png','down.png','cube.png','pro.png','chart_bar.png','asterisk.png','peace.png','layout_sidebar.png','file.gif');
			$LVColumn = array('','BUDGETSTRATEGYID','PLANID','STRATEGYTARGETID','MINISTRYTARGETID','MINISTRYSTRATEGYID','SECTIONTARGETID','SECTIONSTRATEGYID','PRODUCTIVITYID','BUDGETPOLICYID','MAINACTID','ID');
			$message .='<h3 id="topic">แผนงานตามยุทธศาสตร์</h3>
				<div class="allstrategy" style="margin-bottom:10px;">
				<img src="images/tree/folder.gif" /> ยุทธศาสตร์การจัดสรรงบประมาณ  | 
				<img src="images/tree/plan_ico.png" width="16" height="16" /> แผนงาน | 
				<img src="images/tree/binocular.png" /> เป้าหมายเชิงยุทธศาสตร์ | 
				<img src="images/tree/down.png" /> เป้าหมายการให้บริการกระทรวง |  
				<img src="images/tree/cube.png" /> ยุทธศาสตร์กระทรวง <br />
				  <img src="images/tree/pro.png" /> เป้าหมายการให้บริการหน่วยงาน | 
				  <img src="images/tree/chart_bar.png" /> กลยุทธ์หน่วยงาน | 
				  <img src="images/tree/asterisk.png" /> ผลผลิต | 
				  <img src="images/tree/peace.png" /> นโยบายการจัดสรรงบประมาณ |  
				  <img src="images/tree/layout_sidebar.png" /> กิจกรรมหลัก  | 
				  <img src="images/tree/file.gif" /> กิจกรรมย่อย </div>                    
			        <div style="width:100%; height:420px; overflow:scroll;float:left; background-color:White" >   
			            <ul id="browser" class="filetree">
			    ';		
			$row = $this->budget_plan->get_row($subactivityid);							
			for($lv=1;$lv<=11;$lv++)
			{
				$strategy = $this->budget_plan->get_row($row[strtolower($LVColumn[$lv])]);
				$message.= "<ul>";
				$message.=	"<li><img src=\"images/tree/".$picname[$lv]."\" />".$strategy['title'];
			}
			for($lv=1;$lv<=11;$lv++)
			{
				$message.= "</li>";
			$message.= "</ul>";
			}
		     $message.='</ul></div>';
	   }
		 echo $message;
	}	

	public function reload_operation_province(){
		$zone_id = $_POST['zone_id'] == 'ALL' ? 0 : $_POST['zone_id'];		
		$table = " cnf_province_detail_zone 
		left join cnf_province on cnf_province_detail_zone.provinceid = cnf_province.id 
		left join cnf_province_zone on cnf_province_detail_zone.zoneid=cnf_province_zone.id ";
		$condition = " cnf_province.id <> 2 and zone_type_id=2 ";
		$condition .= $zone_id > 0 ? " and zoneid=".$zone_id : "";
		echo form_dropdown("operationareaprovince",get_option("cnf_province.id","cnf_province.title",$table,$condition." order by title"),"",' class="bgFillData"','--เลือกทุกจังหวัด--','ALL'); 
	}
	
	public function reload_operation_province_table(){
		$province_id = $_POST['province_id'];
		$province_id = str_replace('|',',',$province_id);
		
		$message ='';
		$message.='<table class="type1 tb_operation_area_province">
	    <tr>	      
	      <th>จังหวัด</th>
	      <th><input type="button" id="btn_delete_all_operation_province" name="btn_delete_all_operation_province" value="ลบทุกรายการ" /></th>      
	    </tr>
	    ';
		$i=0;
		$result = $this->province->where("id in (".$province_id.")")->get(FALSE,TRUE);
		foreach($result as $item):
			$i++;
		$message.='<tr class="tr_operation_province">';
		//$message.='<td>'.$i.'</td>';
		$message.='<td>'.$item['title'].'</td>';
		$message.='<td>
			<input type="hidden" id="hd_operation_province_id" name="hd_operation_province_id[]" value="'.$item['id'].'">
			<input type="button" id="btn_delete_operation_province" name="btn_delete_operation_province" value="" class="btn_deleteico btn_delete_operation_province" />
		</td>
		</tr>';
		endforeach;
		$message.='
	    <tr id="tr_operation_area_province_footer">
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>      
	    </tr>
	  </table>';
	  echo $message;
	}
	public function reload_budget_province_table(){
		$province_post = $_POST['province_id'];
		$province_id = str_replace('|',',',$province_post);
		$budget = str_replace(',','',$_POST['budget']);
		$province_post = explode('|',$province_post);
		$budget = explode('|',$budget);
		
		
		
		$message ='';
		$message.='<table class="type1 tb_operation_area_province">
	    <tr>	      
	      <th>จังหวัด</th>
	      <th>งบประมาณ</th>
	      <th><input type="button" id="btn_delete_all_operation_province" name="btn_delete_all_operation_province" value="ลบทุกรายการ" /></th>      
	    </tr>
	    ';
		$i=0;
		$result = $this->province->where("id in (".$province_id.")")->get(FALSE,TRUE);
		foreach($result as $item):
		$budget_cursor = array_search($item['id'],$province_post);
		$i++;
		$message.='<tr class="tr_operation_province">';
		//$message.='<td>'.$i.'</td>';
		$message.='<td>'.$item['title'].'</td>';
		$message.='<td><input type="text" class="Number bgFillData" id="operation_province_budget" name="operation_province_budget[]" value="'.number_format(@$budget[$budget_cursor],2).'" alt="decimal"></td>';
		$message.='<td>
			<input type="hidden" id="hd_operation_province_id" name="hd_operation_province_id[]" value="'.$item['id'].'">			
			<input type="button" id="btn_delete_operation_province" name="btn_delete_operation_province" value="" class="btn_deleteico btn_delete_operation_province" />
		</td>
		</tr>';
		endforeach;
		$message.='
	    <tr id="tr_operation_area_province_footer">
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>
	      <td>&nbsp;</td>      
	    </tr>
	  </table>';
	  echo $message;
	}
	public function search_asset(){		
		$condition = $_POST['search']!='' ? " assetname like '%".$_POST['search']."%' " : " 1=1 ";
		$asset = $this->asset->where($condition)->order_by('assetname','asc')->get(FALSE,TRUE);
		$message='<table class="type1 clear tb_asset_result">	      
        <tr>
            <th align="left" width="5%">ลำดับ</th>
            <th align="left" width="35%">ชื่อรายการ</th>
            <th align="left" width="7%">หน่วยนับ</th>
            <th align="left" width="11%">ราคา</th>
            <th align="left" width="11%">ประเภท</th>
            <th align="left" width="8%">วันที่เริ่มต้น</th>
            <th align="left" width="8%">วันที่สิ้นสุด</th>                                    
        </tr>';
        $i=0;
		foreach($asset as $item):
		$i++;
    	$message.='
    	<tr class="cursor">
          <td>'.$i.'</td>
          <td>'.$item['assetname'].'</td>
          <td>'.$item['unit_title'].'</td>							  
          <td>'.number_format($item['price'],2).'</td>
          <td>'.$item['asset_type_title'].'</td>												
          <td><input type="hidden" name="hd_asset_result_id" id="hd_asset_result_id" value="'.$item['id'].'"</td>
		  <td></td>                                              
        </tr>
	    ';
			
		endforeach;
		$message.='</table>';	
		echo $message;
	}
	public function append_asset_table(){
		$data['subexpense_id'] = $_POST['subexpense_id'];
		$asset_id = $_POST['asset_id'];
		$data['bmaster'] = $this->bg_master->get_row($_POST['budgetid']);
		$data['asset'] = $this->asset->get_row($asset_id);
		$this->load->view('ajax_subexpense_asset_table',$data);
	}
	public function save1(){
		//$this->db->debug=true;
		$url_parameter = GetCurrentUrlGetParameter();
		$act = $_POST['act'];		
		if($act=='view'){
			$budget_id = $_POST['id'];
		}else{
		$_POST['createdate'] = @$_POST['id']=='' ? en_to_stamp(date("Y-m-d H:i:s"),TRUE) : $_POST['createdate'];
		$_POST['createby'] = @$_POST['id'] == '' ? login_data('id') : $_POST['createby'];
		$_POST['lastmodify'] = en_to_stamp(date("Y-m-d H:i:s"),TRUE);
		$_POST['lastmodifyby'] = login_data('id');
		$_POST['workgroup_id'] = login_data('workgroupid');		
		$_POST['chkoperationcentral'] = @$_POST['chkoperationcentral']=='' ? 'off' : 'on';
		$_POST['chkoperationregion'] = @$_POST['chkoperationregion']=='' ? 'off' : 'on';
		if(@$_POST['id'] > 0) $data['id'] = $_POST['id']; 
		$data['budgetyear'] = $_POST['budgetyear'];
		$data['subactivityid'] = $_POST['subactivityid'];
		$data['projecttitle'] = $_POST['projecttitle'];
		$data['createdate'] = $_POST['createdate'];
		$data['createby'] = $_POST['createby'];
		$budget_id = $this->bg_master->save($data);
		$_POST['id'] = $budget_id;
		$this->bg_master->save($_POST);
		
		$this->bg_process->delete('budgetid',$budget_id);
			if(isset($_POST['hd_processtitle'])){
				foreach($_POST['hd_processtitle'] as $key=>$item){
					if($_POST['hd_processtitle'][$key]){
						$this->bg_process->save(array(							
							'budgetid'=>$budget_id,
							'description'=>$_POST['hd_processtitle'][$key]												
						));
					}
				}	
		}
				
		$this->bg_operation_area->delete('budgetid',$budget_id);
		if(isset($_POST['hd_operation_province_id'])){
			foreach($_POST['hd_operation_province_id'] as $key=>$item){
				if($_POST['hd_operation_province_id'][$key]){
					$this->bg_operation_area->save(array(							
						'budgetid'=>$budget_id,
						'provinceid'=>$_POST['hd_operation_province_id'][$key]												
					));
				}
			}	
		}
		$this->bg_expense_type->delete('budgetid',$budget_id);
		if(isset($_POST['budgetexpensetype'])){
			foreach($_POST['budgetexpensetype'] as $key=>$item){
				if($_POST['budgetexpensetype'][$key]){
					$this->bg_expense_type->save(array(							
						'budgetid'=>$budget_id,
						'expensetypeid'=>$_POST['budgetexpensetype'][$key]												
					));
				}
			}	
		}		
		
		
		$budget_current_target['id'] = $this->bg_current_target->get_one('id','budgetid',$budget_id);
		$budget_current_target['budgetid']  = $budget_id;
		for($i=1;$i<=12;$i++){
			$budget_current_target['m'.$i] = $_POST['current_target_m'.$i];
		}
		for($i=1;$i<=4;$i++){
			$budget_current_target['q'.$i] = $_POST['current_target_q'.$i];
		}
		$budget_current_target['summaryunit'] = $_POST['summaryunit'];
		$budget_current_target['unitid'] = $_POST['summarycurrentyeartargetunit'];
		$budget_current_target['productivitykeyid'] = '';
		if(isset($_POST['chkworkplan'])){
			foreach($_POST['chkworkplan'] as $key=>$item){
				if($_POST['chkworkplan'][$key]){						
						$budget_current_target['productivitykeyid'].=$_POST['chkworkplan'][$key].','; 																			
				}
			}	
		}
		
		
		$this->bg_current_target->save($budget_current_target);
		
		}
		redirect('budget_request/form2/'.$act.'/'.$budget_id.$url_parameter);
	}	
	public function save2(){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		$budgetid = $_POST['budgetid'];	
		$act = $_POST['act'];		
		$chksummarycentralbudget = @$_POST['chkoperationcentral']=='' ? 'off' : 'on';
		$chksummaryregionbudget = @$_POST['chkoperationregion'] == '' ? 'off' : 'on';
		$this->bg_master->save(array('id'=>$budgetid,'summarycentralbudget'=>$_POST['summarycentralbudget'],'chksummarycentralbudget'=>$chksummarycentralbudget, 'chksummaryregionbudget'=>$chksummaryregionbudget));
		$project =  $this->bg_master->get_row($budgetid);				
		$this->db->Execute("Delete from budget_type_detail where budgetid=".$budgetid);
		$bg_sub_expense = $this->budget_type->where("pid in (select expensetypeid from budget_expense_type where budgetid=".$budgetid.") and isasset < 1 ")->order_by("pid","asc")->get(FALSE,TRUE);		
		foreach($bg_sub_expense as $subexpense):
			for($i=1;$i<=12;$i++)$data['budget_m'.$i] = @$_POST['budget'.$subexpense['id'].'_M'.$i];
			for($i=1;$i<=3;$i++)$data['budget_ny'.$i] = @$_POST['summarynextbudgetlv3'.$subexpense['id'].'_'.$i];			
			$data['budgetid'] = $budgetid;
			$data['budgetyear'] = $project['budgetyear'];
			$data['budgettypeid'] = $subexpense['id'];						
			$data['qty'] = @$_POST['summaryqtylv3'.$subexpense['id']] > 0 ? @$_POST['summaryqtylv3'.$subexpense['id']] : 0;
			$data['chkcalculatedetail'] = @$_POST['chkcalculatedetail'.$subexpense['id']]== "" ? 'off' : 'on';
			$id = $this->bg_type_detail->save($data);
			$update['id'] = $id;
			$update['remark'] = @$_POST['GeneralRemark'.$subexpense['id']];
			$update['allowanceremark'] = @$_POST['AllowanceRemark'.$subexpense['id']];
			$update['accomodationremark'] = @$_POST['AccomodationRemark'.$subexpense['id']];
			$update['vehicleremark'] = @$_POST['VehicleRemark'.$subexpense['id']];
			$update['documentremark'] = @$_POST['DocumentRemark'.$subexpense['id']];
			$update['humanremark'] = @$_POST['HumanRemark'.$subexpense['id']];
			$update['serviceremark'] = @$_POST['ServiceRemark'.$subexpense['id']];
			$this->bg_type_detail->save($update);
		endforeach;
		
		
		
		$bg_sub_expense = $this->budget_type->where("pid in (select expensetypeid from budget_expense_type where budgetid=".$budgetid.") and isasset = 1 ")->order_by("pid","asc")->get(FALSE,TRUE);		
		foreach($bg_sub_expense as $subexpense):
			$subexpense_id = $subexpense['id'];
			if(isset($_POST['assetid_'.$subexpense['id']])){
				foreach($_POST['assetid_'.$subexpense['id']] as $key=>$item){
					if($_POST['assetid_'.$subexpense['id']][$key]){
						$asset_id = $_POST['assetid_'.$subexpense['id']][$key];
						for($i=1;$i<=12;$i++)$data['budget_m'.$i] = @$_POST['AssetBudget_'.$subexpense_id.'_'.$asset_id.'_M'.$i];
						for($i=1;$i<=3;$i++)$data['budget_ny'.$i] = @$_POST['AssetNextBudget_'.$subexpense_id.'_'.$asset_id.'_'.$i];
						$data['budgetid'] = $budgetid;
						$data['assetid'] = $asset_id;
						$data['assetvalue'] = @$_POST['hdassetunitprice_'.$subexpense_id.'_'.$asset_id];
						$data['budgetyear'] = $project['budgetyear'];
						$data['budgettypeid'] = $subexpense_id;		
										
						$data['qty'] = @$_POST['summaryqtylv3'.$subexpense['id']] > 0 ? @$_POST['summaryqtylv3'.$subexpense['id']] : 0;
						$data['rqty'] = @$_POST['AssetReplaceQTY_'.$subexpense['id'].'_'.$asset_id] > 0 ? @$_POST['AssetReplaceQTY_'.$subexpense['id'].'_'.$asset_id] : 0; 
						$data['nqty'] = @$_POST['AssetNewQTY_'.$subexpense['id'].'_'.$asset_id] > 0 ? @$_POST['AssetNewQTY_'.$subexpense['id'].'_'.$asset_id] : 0;
						$data['chkcalculatedetail'] = @$_POST['chkcalculatedetail'.$subexpense['id']]== "" ? 'off' : 'on';
						$id = $this->bg_type_detail->save($data);								
						
						$update['id'] = $id;
						$update['remark'] = @$_POST['GeneralRemark'.$subexpense['id']];
						$update['allowanceremark'] = @$_POST['AllowanceRemark'.$subexpense['id']];
						$update['accomodationremark'] = @$_POST['AccomodationRemark'.$subexpense['id']];
						$update['vehicleremark'] = @$_POST['VehicleRemark'.$subexpense['id']];
						$update['documentremark'] = @$_POST['DocumentRemark'.$subexpense['id']];
						$update['humanremark'] = @$_POST['HumanRemark'.$subexpense['id']];
						$update['serviceremark'] = @$_POST['ServiceRemark'.$subexpense['id']];
						$this->bg_type_detail->save($update);
					}
				}	
			}						
		endforeach;
		
		$this->db->Execute("DELETE FROM BUDGET_AREA WHERE BUDGETID=".$budgetid);
		if(isset($_POST['hd_operation_province_id'])):
				foreach($_POST['hd_operation_province_id'] as $key=>$item):
					if($_POST['hd_operation_province_id'][$key]):
						$data['budgetid'] = $budgetid;
						$data['provinceid'] = $_POST['hd_operation_province_id'][$key];
						$data['budget'] = @$_POST['operation_province_budget'][$key] > 0 ? $_POST['operation_province_budget'][$key] : 0;
						$this->bg_area->save($data);
					endif;
				endforeach;
		endif;
		
		
		if(isset($_POST['btnSave']))redirect('budget_request/index'.$url_parameter);
		if(isset($_POST['btnBack']))redirect('budget_request/form1/'.$act.'/'.$budgetid.$url_parameter);
	}
	public function delete($id=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if($id>0){
			$this->bg_master->delete($id);
			$this->bg_type_detail->delete('budgetid',$id);
			$this->bg_area->delete('budgetid',$id);
			$this->bg_current_target->delete('budgetid',$id);
			$this->bg_expense_type->delete('budgetid',$id);
			$this->bg_process->delete('budgetid',$id);
			$this->bg_operation_area->delete('budgetid',$id);			
		}
		redirect('budget_request/index'.$url_parameter);
	}
	public function sendbudget($budgetyear,$divisionid,$workgroupid,$step,$method)
	{
			echo '<meta content="text/html; charset=utf-8" http-equiv="Content-Type">';
			$adjustTotal = 0;
			$sendTotal = 0;
			if($step > 1 )
			{
					$sql = "SELECT SUM(BUDGET_VALUE)BUDGET FROM BUDGET_ADJUST WHERE  BUDGET_YEAR=".$budgetyear." 
					AND ADJUST_STEP=".($step-1)	." AND  SECTION_ID=".$divisionid." ";
					$adjustTotal = $this->db->getone($sql);						
			
					$sql = "SELECT SUM((BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12))BUDGET ";
					$sql .=" FROM BUDGET_TYPE_DETAIL  LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID ";
					$sql .=" WHERE BUDGET_MASTER.STEP=".$step." AND BUDGET_MASTER.BUDGETYEAR=".$budgetyear." 
					AND BUDGET_MASTER.WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.") ";
					$sendTotal = $this->db->getone($sql);						
			}
			
			
			$currentDate = date("Y-m-d H:i:s");
			$currentDate = strtotime($currentDate);
			
			
			$setTime = $this->budget_time->get_row('byear',$budgetyear);
			/*$sql = " SELECT * FROM CNF_SET_TIME WHERE BYEAR=".($year);
			$result = db_query($sql);
			$setTime = db_fetch_array($result,0);*/
			//echo strtotime($setTime['bdate_'.$step]."+1 Day")."_____".$currentDate;
			
			if(strtotime($setTime['bdate_'.$step]."+1 Day") < $currentDate)
			{
					echo "<script>
					alert('ไม่สามารถส่งตรวจสอบได้ เนื่องจากเลยกำหนด');
					window.location='".JS_FIX_URLPATH."/budget_request/index/?budgetyear=".$budgetyear."&divisionid=".$divisionid."&workgroupid=".$workgroupid."'
					</script>";
					redirect('budget_request/index/?budgetyear='.$budgetyear."&divisionid=".$divisionid."&workgroupid=".$workgroupid);
			}
			else
			{
				switch($method)
				{
					case 'sendtolead':
						$sql = "DELETE FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".$budgetyear." AND WORKGROUP_ID=".$workgroupid." AND STEP=".$step;
						$this->db->Execute($sql);
						$this->workgroup_send_confirm->save(array('budget_year'=>$budgetyear,'workgroup_id'=>$workgroupid,'step'=>$step,'status'=>4));					
						$sql = " UPDATE BUDGET_MASTER SET STATUS =4 WHERE BUDGETYEAR=".$budgetyear." AND WORKGROUP_ID=".$workgroupid." AND STEP=".$step;
						$this->db->Execute($sql);																				
						echo "<script>alert('ระบบทำการส่งงบประมาณ ให้กับทาง ผอ. เพื่อทำการตรวจสอบเรียบร้อยแล้ว');
						window.location='".JS_FIX_URLPATH."/budget_request/index/?budgetyear=".$budgetyear."&divisionid=".$divisionid."&workgroupid=".$workgroupid."'
						</script>";
					break;
					case 'sendtowork':
						$sql = "DELETE FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".$budgetyear." AND WORKGROUP_ID=".$workgroupid." AND STEP=".$step;
						$this->db->Execute($sql);
						$this->workgroup_send_confirm->save(array('budget_year'=>$budgetyear,'workgroup_id'=>$workgroupid,'step'=>$step,'status'=>1));
						$sql = " UPDATE BUDGET_MASTER SET STATUS =1 WHERE BUDGETYEAR=".$budgetyear." AND WORKGROUP_ID=".$workgroupid." AND STEP=".$step;
						$this->db->Execute($sql);
						echo "<script>
							alert('ระบบทำการส่งงบประมาณ ให้กับทางกลุ่มงานเพื่อทำการแก้ไขเรียบร้อยแล้ว');
							window.location='".JS_FIX_URLPATH."/budget_request/index/?budgetyear=".$budgetyear."&divisionid=".$divisionid."'
						</script>";
					break;
					case 'sendtoadmin':
						if($adjustTotal == $sendTotal)
						{	
															
							$sql = " UPDATE BUDGET_MASTER SET STATUS =2 WHERE BUDGETYEAR=".$budgetyear."  AND STEP=".$step." AND WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.")";
							$this->db->Execute($sql);						
							
							$sql = " UPDATE WORKGROUP_SEND_CONFIRM SET  STATUS=2 WHERE WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.")  AND BUDGET_YEAR=".$budgetyear." AND STEP=".$step;
							$this->db->Execute($sql);
							
							echo "<script>
							alert('ระบบทำการส่งงบประมาณเพื่อตรวจสอบเรียบร้อยแล้ว');
							window.location='".JS_FIX_URLPATH."/budget_request/index/?budgetyear=".$budgetyear."&divisionid=".$divisionid."'
							</script>";			
						}
						else
						{
							echo "<script>
							alert('ไม่สามารถส่งตรวจสอบได้ เนื่องจากงบประมาณที่ปรับปรุงแล้ว กับ งบประมาณที่ได้รับ มียอดไม่ตรงกัน');
							window.location='".JS_FIX_URLPATH."/budget_request/index/?budgetyear=".$budgetyear."&divisionid=".$divisionid."'
							</script>";							
						}
					break;			
				}				
			}
	}
	public function budget_request_form($budgetid){
		$data['bmaster'] = $this->bg_master->get_row($budgetid);
		$data['subactivitydata'] = $this->budget_plan->get_row($data['bmaster']['subactivityid']);
		$data['bg_process'] = $this->bg_process->where("budgetid=".$budgetid)->get(FALSE,TRUE);
		$this->template->build('budget_request_form',$data);
	}
	
	public function import_old_system($tablename,$execute = FALSE){
		$this->db->debug=true;		
		
		$columns = $this->db->MetaColumnNames($tablename);	
		if($execute==FALSE)
		{
			$request_url = "http://budget.m-society.go.th/db_service.php?tablename=".$tablename; 
			$xml = simplexml_load_file($request_url) or die("feed not loading");
			$data['xml'] = $xml;		
			if(count($xml)>0)
			{
				foreach($xml as $row):
					$item = get_object_vars($row);				
					$exist = $this->db->getone("SELECT ID FROM BUDGET_MASTER WHERE ID=".$item['ID']);			
					if($exist<1)
					{								
						$this->bg_master->save(preg_replace('/(<[^>]+) style=".*?"/i', '$1', strip_slashes($item)),TRUE);
					}
				endforeach;											
			}
		}
		else{
		$sql ="
			INSERT INTO budget_master(ID,BUDGETYEAR,SUBACTIVITYID,PROJECTTITLE,POLICYACCORD,POLICYACTIVITY,OBJECTIVE,TARGETGROUP,ESTIMATERESULT,
			ISSUMPRODUCTIVITY,ESTIMATEQTY_Y1,ESTIMATEUNITTYPEID_Y1,ESTIMATEBUDGET_Y1,ESTIMATEQTY_Y2,ESTIMATEUNITTYPEID_Y2,ESTIMATEBUDGET_Y2,ESTIMATEQTY_Y3,
			ESTIMATEUNITTYPEID_Y3,ESTIMATEBUDGET_Y3,OPERATIONAREA,BUDGETAREA,BOTHEREXPENSE,BMINEXPENSE,CREATEDATE,LASTMODIFY,CREATEBY,LASTMODIFYBY,STEP,STATUS,
			CHKOPERATIONCENTRAL,CHKOPERATIONREGION,CHKSUMMARYCENTRALBUDGET,CHKSUMMARYREGIONBUDGET,SUMMARYCENTRALBUDGET,WORKGROUP_ID,LASTESTIMATEQTY_Y1,LASTESTIMATEUNITTYPEID_Y1,
			LASTESTIMATEBUDGET_Y1,LASTESTIMATEQTY_Y2,LASTESTIMATEUNITTYPEID_Y2,LASTESTIMATEBUDGET_Y2,PRINCIPLES) VALUES (
			88,2012,215,'การพัฒนารูปแบบและแนวทางการเข้าถึงสวัสดิการสังคม','<p><span><span lang=\"TH\">๑</span><span lang=\"TH\">. นโยบายรัฐบาล \"สังคมสวัสดิการ\" คนไทยได้รับสวัสดิการสังคมถ้วนหน้า ในปี ๒๕๖๐</span>
			<span lang=\"TH\"><br />๒</span><span lang=\"TH\">. </span><span lang=\"TH\">แผนพัฒนาเศรษฐกิจและสังคมแห่งชาติ</span><span lang=\"TH\">ฉบับที่</span>
			<span lang=\"TH\">๑๑</span><span lang=\"TH\"> (</span><span lang=\"TH\">พ</span><span lang=\"TH\">.</span><span lang=\"TH\">ศ</span>
			<span lang=\"TH\">. ๒๕๕๕-๒๕๕๙) เป้าหมายหลักสังคมไทยมีความสงบสุข และประชาชนไทยทุกคนมีหลักประกันทางสังคมที่มีคุณภาพทั่วถึง<br />๓. แผนปฏิบัติราชการ ปี พ.ศ.๒๕๕๕-๒๕๕๙ ของกระทรวง พม. ประเด็นยุทธศาสตร์ : 
			การผลักดันให้เกิดสังคมสวัสดิการ</span></span></p>','','<p><span style=\"font-size: large; font-family: andale mono,times;\"><span>๑</span><span lang=\"TH\">. 
			</span><span >เพื่อศึกษาวิเคราะห์รูปแบบและแนวทางการเข้าถึงสวัสดิการสังคมของประชาชนในรูปแบบศูนย์เรียนรู้สวัสดิการชุมชน</span><br /><span>๒</span><span lang=\"TH\">. </span>
			<span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">เพื่อพัฒนาและขับเคลื่อนกระบวนการเข้าถึงสวัสดิการสังคมของประชาชน</span> </span><br /><span style=\"font-size: large; font-family: andale mono,times;\"><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">๓</span><span lang=\"TH\">. </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">เพื่อติดตามประเมินผลการขับเคลื่อนการพัฒนากองทุนสวัสดิการชุมชนสู่ความเข้มแข็ง</span></span></p>','<p style=\"margin: 0cm 0cm 0pt;\"><span style=\"font-size: large; font-family: andale mono,times;\"><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">๑</span><span lang=\"TH\">. </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด</span><span lang=\"TH\"> (</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">๗๖</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">จังหวัด</span><span lang=\"TH\">) </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">ศูนย์พัฒนาสังคม </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">สำนักงานส่งเสริมและสนับสนุนวิชาการ</span>&nbsp;</span></p> <p style=\"margin: 0cm 0cm 0pt;\"><span style=\"font-size: large; font-family: andale mono,times;\"><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">๒</span><span lang=\"TH\">. </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">หน่วยงานภาครัฐที่เกี่ยวข้อง</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">องค์กรปกครองส่วนท้องถิ่น</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">องค์กรสวัสดิการชุมชนและภาคประชาชน</span></span></p>','<p style=\"margin: 0cm 0cm 0pt; text-align: left;\"><span style=\"font-family: andale mono,times;\"><span style=\"font-size: large;\"><span lang=\"TH\">๑. </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">ได้รูปแบบและแนวทางการดำเนินงานศูนย์เรียนรู้สวัสดิการชุมชนต้นแบบ</span><span lang=\"TH\">&nbsp;</span></span>&nbsp;</span></p> <p style=\"margin: 0cm 0cm 0pt; text-align: left;\"><span style=\"font-family: andale mono,times;\"><span style=\"font-size: large;\"><span style=\"font-size: large;\"><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">๒</span><span lang=\"TH\">. </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">สำนักงานพัฒนาสังคมและความมั่นคงของมนุษย์จังหวัด</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">องค์กรปกครองส่วนท้องถิ่น</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">องค์กรสวัสดิการชุมชนและภาคประชาชนได้แลกเปลี่ยนเรียนรู้แนวทาง/กระบวนการเข้าถึงสวัสดิการสังคม และ</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">สามารถนำ</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">ไปใช้ประโยชน์ได้<br />๓. ประชาชนสามารถเข้าถึงสวัสดิการสังคมที่เหมาะสม</span></span></span></span></p>',0,3,13,0.00,3,13,0,4,13,0,0,'',0.00,4190500.00,1297325153,1316504893,12,56,1,2,'1','','1','',0.00,35,0,0,2000000.00,0,0,1370000.00,'<p style=\"text-align: left;\"><span style=\"font-size: large;\"><span>&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style=\"font-size: large; font-family: andale mono,times;\"><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">รัฐบาลกำหนดให้</span><span style=\"line-height: 115%;\">\"</span><span style=\"line-height: 115%;\"><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">สังคมสวัสดิการ</span><span lang=\"TH\">\" </span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">เป็นวาระแห่งชาติ</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">และเป็นแนวทางในการขับเคลื่อนระบบสวัสดิการสังคมถ้วนหน้าในปี</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">๒๕๖๐</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">เพื่อนำไปสู่เป้าหมายประชาชนได้รับสวัสดิการโดยส่งเสริมให้ภาคส่วนต่าง</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">ๆ</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">เข้ามามีส่วนร่วมในการจัดสวัสดิการสังคม</span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">ซึ่งถือเป็นนโยบายสำคัญที่จะนำไปสู่เป้าหมายประชาชนได้รับสวัสดิการสังคมถ้วนหน้า</span><span lang=\"TH\">&nbsp;<br /></span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">&nbsp;&nbsp;&nbsp;&nbsp; รัฐธรรมนูญแห่งราชอาณาจักรไทย พ.ศ.๒๕๕๐ ได้บัญญัติในเรื่องสิทธิสวัสดิการสังคมที่ประชาชนต้องได้รับอย่างเท่าเทียมทั่วถึง<br />&nbsp;&nbsp;&nbsp;&nbsp; สถานการณ์การเปลี่ยนแปลงอย่างรวดเร็วทางเศรษฐกิจ สังคม สิ่งแวดล้อม และเทคโนโลยี&nbsp; การสื่อสาร รวมทั้งการเปลี่ยนแปลงทางโครงสร้างของประชากรวัยสูงอายุทั้งในระดับโลกและในประเทศ ส่งผลต่อการพัฒนาประเทศและการดำเนินชีวิตของคนในสังคม การที่มีประชากร วัยสูงอายุเพิ่มขึ้นแต่ในขณะที่วัยเด็กและวัยแรงงานลดลง&nbsp; ทำให้ภาครัฐและครัวเรือนมีภาระค่า ใช้จ่ายในการดูแลและพัฒนาคุณภาพชีวิตของผู้สูงอายุในด้านสุขภาพอนามัยและสวัสดิการเพิ่มมากขึ้น &nbsp;นอกจากนี้ยังมีปัญหาด้านพฤติกรรมเสี่ยงของเด็กและเยาวชน ปัญหาด้านการศึกษา ยาเสพติด และภัยพิบัติต่างๆ ซึ่งที่ผ่านมาหน่วยงานภาครัฐและภาคส่วนต่างๆได้ดำเนินการด้านการคุ้มครองทางสังคมและจัดสวัสดิการสังคมให้กับประชาชนกลุ่มเป้าหมายในหลากหลายรูปแบบ แต่ยังมีกลุ่มผู้ด้อยโอกาสอีกจำนวนมากที่ไม่สามารถเข้าถึงสวัสดิการสังคมอย่างทั่วถึง<br />&nbsp;&nbsp;&nbsp;&nbsp; กระทรวงการพัฒนาสังคมและความมั่นคงของมนุษย์มีภารกิจหลักในการดำเนินงานด้านพัฒนาสังคมและสวัสดิการสังคม&nbsp; การสร้างความเสมอภาคและความเป็นธรรมในสังคม การคุ้มครองพิทักษ์สิทธิ รวมทั้งการพัฒนางานด้านความมั่นคงของมนุษย์ในภาพรวมของประเทศ โดยมียุทธศาสตร์กระทรวงฯในการผลักดันให้เกิดสังคมสวัสดิการ เป็นยุทธศาสตร์ในการขับเคลื่อนการ ดำเนินงาน<br /></span><span style=\"color: black; mso-ascii-font-family: \'Times New Roman\'; mso-hansi-font-family: \'Times New Roman\';\" lang=\"TH\">&nbsp;&nbsp;&nbsp;&nbsp; ดังนั้น เพื่อพัฒนาและขับเคลื่อนการเข้าถึงสวัสดิการสังคมของประชาชนในรูปแบบและแนวทางใหม่ๆเพื่อให้มีความเหมาะสม และสอดคล</span></span></span></p>')            
		";	
		
		$this->db->Execute($sql);
		}	
	}		
	
	
}
?>