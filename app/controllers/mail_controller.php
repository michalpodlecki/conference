<?php
class MailController extends AppController {		

	var $uses = array('User');
	
	function chairEmail($query = NULL, $flag = NULL, $artic_id=NULL){

		if(!empty($this->data['User']['reviewer'])){
			$query=mysql_query("SELECT email FROM users WHERE reviewer!=0");
		}else if(!empty($this->data['User']['author'])){
			$query=mysql_query("SELECT email FROM users WHERE author!=0");
		}else if(empty($query)){
			$query=mysql_query("SELECT email FROM users");
		}

		/*do zmiany*/
		if(!empty($query) || !empty($this->data['User']['reviewer']) || !empty($this->data['User']['author']) || !empty($this->data['User']['email'])){

			$maillist = "";
			while(list($email)=mysql_fetch_row($query))
			{
				$maillist .= "$email,";
			}

	 		$maillist .= $this->data['User']['email'];
        		$this->Email->from = 'Chair <szk@ppazdan.pl>';
        		$this->Email->to = $maillist;
        	
			if($flag = "accept"){
				$this->Email->subject = "Twój artyku? zostal zakc";
				$this->Email->template = 'akceptacja';
				$this->set('id', $artic_id);
	 		}
			else if($flag = "rejecet"){
	 			$this->Email->subject ="odrzucony";
	 		}
	 		else if($flag = "correct"){
	 			$this->Email->subject = "poprawa";
	 		}
	 		else $this->Email->subject = $this->data['User']['subject'];
	  
			$this->Email->sendAs = 'both';
	 		$this->Email->send($this->data['User']['content']);
			$this->Email->reset();
		}		  
	}

}

?>