<?php
class UsersController extends AppController {		
		
	var $uses = array('User');

  /**
   * to co uzytkownik widzi po zalogowaniu
   */       
  function index()
    {    
    $this->set('firstname', $this->Session->read('Auth.User.firstname'));
		$this->set('surname', $this->Session->read('Auth.User.surname'));
		}
  
  /**
   * aktywacja usera, szuka kodu aktywacyjnego podanego w linku, jesli znajdzie to zmienia
   * userowi pole 'active' na true i usuwa tresc pola activation_code
   */   
  function activate($code = null)
    {
    if (!empty($code))
      {
      if ($user = $this->User->findByActivationCode($code))
        {
        $this->User->set(array(
          'activation_code' => null,
          'active' => 1
          ));
        $this->User->id = $user['User']['id'];
        if ($this->User->save($this->data))
				  {
				  $this->Session->setFlash('Aktywowano konto, możesz się teraz zalogować.', 'default', array('class' => 'success'));
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
				  }
        } else {
        $this->Session->setFlash('Niestety nie znaleziono konta dla tego kodu aktywacyjnego!', 'default', array('class' => 'failure'));
		    $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
      } else {
      $this->redirect(array('controller' => 'users', 'action' => 'login'));
			}
    }

  /**
   * przypominac hasla, szuka podanego maila i wysyla nowe wygenerowane haslo
   * do usera (i zapisuje zahashowane do bazy of course)
   */         
  function lost_password()
    {
    if ($this->Auth->user())
		  {
		  $this->redirect(array('controller' => 'users', 'action' => 'login'));
      } else {
      if (!empty($this->data))
        {
        if ($user = $this->User->findByEmail($this->data['User']['email']))
          {
          $this->User->id = $user['User']['id'];
          $generated_password = substr(str_shuffle("qwertyupasdfghkzxcvbnm23456789"), 0, 8);
          $this->User->set(array(
            'password' => $this->Auth->password($generated_password)
            ));
          if ($this->User->save($this->data))
            {
            $this->Email->from = 'SZK <szk@ppazdan.pl>';
            $this->Email->to = $user['User']['username'].' <'.$user['User']['email'].'>';
            $this->Email->subject = 'Przywracanie hasła [SZK]';
            $this->Email->template = 'lost_password';
            $this->Email->sendAs = 'both';
            $this->set('generated_password', $generated_password);
            $this->Email->send();
            $this->Email->reset();
            
				    $this->Session->setFlash('W ciągu kilku minut powinnien dojść mail z wygenerowanym nowym hasłem.', 'default', array('class' => 'success'));
				    $this->redirect(array('controller' => 'users', 'action' => 'login'));
				    }
          } else {
          $this->Session->setFlash('Niestety, nie znaleziono konta użytkownika z podanym adresem email.', 'default', array('class' => 'failure'));
		      $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }
        }
      }
    }

  /**
   * rejestrcja, nic specjalnego, validacja jest w modelu usera (models/user.php).
   * przerzucamy tresc pola register_email do email i register_password do password
   * to jest po to, by przy logowaniu nie bylo validacji (a ta przypisana jest do nazwy pola formularza)
   * generuje sie tez kod aktywacji i wysyla mail
   */              
	function register()
		{
		if (!empty($this->data))
      {		          
      $this->User->create();
      $activation_code = substr(str_shuffle("qwertyupasdfghkzxcvbnm23456789"), 0, 16);
      $this->User->set(array(
        'email' => $this->data['User']['register_email'],
        'password' => $this->Auth->password($this->data['User']['register_password']),
        'activation_code' => $activation_code
        ));
      if ($this->User->save($this->data))
        {
        $this->Email->from = 'SZK <szk@ppazdan.pl>';
        $this->Email->to = $this->data['User']['surname'].' <'.$this->data['User']['register_email'].'>';
        $this->Email->subject = 'Rejestracja [SZK]';
        $this->Email->template = 'register';
        $this->Email->sendAs = 'both';
        $this->set('activation_code', $activation_code);
        $this->Email->send();
        $this->Email->reset();
        
        $this->Session->setFlash('Zapisano, w ciągu kilku minut powinnien dojść mail z linkiem aktywacyjnym, dziekujemy!', 'default', array('class' => 'success'));
			  $this->redirect(array('controller' => 'users', 'action' => 'login'));
			  }
      }
		}
  
  /**
   * funkcja AuthComponent
   */     
  function login()
    {
    }
		
	/**
   * funkcja AuthComponent
   */
  function logout()
		{
    $this->redirect($this->Auth->logout());
		}
		
	/**
	 * zmiana hasla, nic nowego
	 */   	
	function change_password()
    {
    $this->User->id = $this->Auth->user('id');
	
		if (!empty($this->data))
      {
      if( ($this->data['User']['change_password']) == ($this->data['User']['repeat_password']) )
        {
		    $this->User->set(array(
          'password' => $this->Auth->password($this->data['User']['change_password'])
          ));
		    if ($this->User->save($this->data))
          {
          $this->Session->setFlash('Hasło zostało zmienione', 'default', array('class' => 'success'));
          }
        } else {
        $this->Session->setFlash('Hasła nie zgadzają się', 'default', array('class' => 'failure'));
        }			 
      }
    }

  /**
   * edycja profilu, nic nowego
   */     
  function edit_profile()
    {
    $this->User->id = $this->Auth->user('id');
    
    if (empty($this->data))
      {
      $this->data = $this->User->read();
      } else {
      /*$mail = $this->User->findByEmail($this->data['User']['email']);
		  if( ($mail) && ($this->data['User']['email']!=$this->Session->read('Auth.User.email')) )
        {
        $this->Session->setFlash('Podany mail już istnieje, podaj inny', 'default', array('class' => 'failure'));
		    } else {*/
        $this->User->save($this->data);
        $this->Session->setFlash('Konto zostało zaktualizowane', 'default', array('class' => 'success'));
        /*}*/
      }
    }
    
  #################################################################################


/* CHAIR */
function chair()
{

}

function chairEmail($mailList = NULL){

if(!empty($this->data['User']['reviewer'])){
	$query=mysql_query("SELECT email FROM users WHERE reviewer!=0"); 
}else if(!empty($this->data['User']['author'])){
	$query=mysql_query("SELECT email FROM users WHERE author!=0"); 
}

/*do zmiany*/
if(!empty($this->data['User']['reviewer']) || !empty($this->data['User']['author']) || !empty($this->data['User']['email'])){

	$maillist="";

	while(list($email)=mysql_fetch_row($query))
	{
		$maillist .= "$email,";
	}
	 $maillist .= $this->data['User']['email'];
        $this->Email->from = 'Chair <szk@ppazdan.pl>';
        $this->Email->to = $maillist;
        $this->Email->subject = $this->data['User']['subject'];

        $this->Email->sendAs = 'both';
	 $this->Email->send($this->data['User']['content']);

        $this->Email->reset();

        $this->Session->setFlash('Email wyslany!', 'default', array('class' => 'success'));
	 $this->redirect(array('controller' => 'users', 'action' => 'chair'));
}else{
        $this->Session->setFlash('Nie zaznaczyles odbiorcy!', 'default', array('class' => 'success'));
	 $this->redirect(array('controller' => 'users', 'action' => 'chair'));
}
		  
}

function formularz(){

}

}
