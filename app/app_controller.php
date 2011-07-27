<?php
class AppController extends Controller {

  var $components = array('Auth', 'Email', 'Session');
  
  var $helpers = array('Form', 'Html', 'Js', 'Session', 'Text', 'Time');

  function beforeFilter()
    {
    $this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'index');
    $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
    
    $this->Auth->loginError = 'Niepoprawna nazwa użytkownika lub hasło!';
    $this->Auth->authError = 'Niestety, nie masz tu dostępu!';

    $this->Auth->fields = array(
		  'username' => 'email',
		  'password' => 'password'
		  );
    $this->Auth->userScope = array('User.active' => true);
        
    //pr($this->Auth->user());
    
    $this->Auth->allow(array('login', 'logout', 'activate', 'register', 'lost_password'));
    }

}
