<?php
Class Test extends  Public_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('c_user/user_model','user');
		
	}
	function index(){
		//$this->db->debug = true;
		//time_check_last_login();
		$this->template->set_layout('login');
		$this->template->build('login_index');

	}
	function login($id=FALSE)
	{
		$this->db->debug = true;	
		if($_POST)
		{
			if(login(trim($_POST['email']), trim($_POST['password'])))
			{
				//AddLog(65);
				//time_login_update($this->session->userdata('id'));
				
				redirect('home');
			}
			else
			{
				echo "AA";
				//$this->db->debug=true;
				//$status = $this->db->GetOne("select status from users where email = '".$_POST['email']."' and password = '".$_POST['password']."'");
				//if($status == 1){
//					set_notify('error', "คุณได้มีการใช้งานอยู่ในขณะนี้");
				//	redirect('user');
				//}else{
					//set_notify('error', LOGIN_FAIL);
					//redirect('user');	
				//}
			}	
		}
		redirect('test/index');
	}
	function logout()
	{
		AddLog(66);
		logout();
		redirect('user');
	}

	function user_password()
	{
		$this->template->set_layout('blank');
		$this->template->build('user_password');
	}
	function forget_password()
	{
		require_once("PHPMailer_v5.1/class.phpmailer.php");  	// ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path		
		require_once("PHPMailer_v5.1/class.smtp.php");       	// ประกาศใช้ class phpmailer กรุณาตรวจสอบ ว่าประกาศถูก path	
		
		$password=$this->user->get_one("password","email",$_POST['email']);
			
			if($password)
			{								
				$host = "10.10.10.60";
    			$port = "25";
				$m="สวัสดีคะ, ".br(1);
				$m.="รหัสผ่านของคุณ     คือ $password";
				
				/* ###### PHPMailer #### */
				$mail = new PHPMailer();		
				$mail->CharSet = "utf-8";  						// ในส่วนนี้ ถ้าระบบเราใช้ tis-620 หรือ windows-874 สามารถแก้ไขเปลี่ยนได้     
				              		
				 	
				$mail->From     = "laws@m-society.go.th";		//  account e-mail ของเราที่ใช้ในการส่งอีเมล
				$mail->FromName = "โปรแกรมระบบสนับสนุนการพัฒนากฎหมาย"; 	//  ชื่อผู้ส่งที่แสดง เมื่อผู้รับได้รับเมล์ของเรา
				$mail->AddAddress($_POST['email']);	  			// Email ปลายทางที่เราต้องการส่ง
			
							  		
				$mail->IsHTML(true);                  			// ถ้า E-mail นี้ มีข้อความในการส่งเป็น tag html ต้องแก้ไข เป็น true
				$mail->Subject     = "แจ้งรหัสผ่าน";        			// หัวข้อที่จะส่ง
				$mail->Body     = $m;                   		// ข้อความ ที่จะส่ง
				$mail->SMTPDebug = false;
				$mail->do_debug = 0;
				
				$mail->IsSMTP();
							
				$mail->Host = $host;
				$mail->Port = $port;
				$mail->SMTPAuth = true;

				$mail->Username = 'crmsupport@m-society.go.th';
				$mail->Password = 'spiderman';
			
							
					if (!$mail->send())
					{																			
				     	echo "Mailer Error: " . $mail->ErrorInfo;
						exit;						
					}else{
						set_notify('success',"รหัสผ่านของคุณถูกส่งเข้าอีเมล์แล้วคะ");
					 	redirect('user');
					}
					    
			}else{
					set_notify('error', LOGIN_FAIL);
					redirect('user/user_password');	
			}
	}	

}
?>