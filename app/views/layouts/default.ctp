<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title>SZK - system zarządzania konferencją</title>
	<?php echo $this->Html->css('style'); ?>
  <?php echo $this->Html->css('authors'); ?>
</head>
<body>
	<?php
  if ($this->Session->check('Auth.User'))
    {
  ?>
    <div style="width: 960px; margin: 3px auto; text-align: right; font: 11px verdana; color: black">Zalogowany: <b><?php echo $this->Session->read('Auth.User.email')?></b></div>
	<?php
    }
  ?>
  <div class="container">
    
    <div class="header"><a href="http://ppazdan.pl"><h1>System zarządzania konferencją 1.0</h1></a></div>
    
    <div class="navigation">
      <ul>
      <?php
      if (!$this->Session->check('Auth.User'))
        {
      ?>
        <li><?php echo $this->Html->link('Zaloguj się', array('controller' => 'users', 'action' => 'login')); ?></li>
        <li><?php echo $this->Html->link('Rejestracja', array('controller' => 'users', 'action' => 'register')); ?></li>
		    <li><?php echo $this->Html->link('Przywróć hasło', array('controller' => 'users', 'action' => 'lost_password')); ?></li>
      <?php
        } else {
      ?>        
		    <li class="menu"><a href="javascript: void(0);">Artykuły</a>
          <ul>
            <li><?php echo $this->Html->link('Moje artykuły', array('controller' => 'articles', 'action' => 'index')); ?></li>
            <li><?php echo $this->Html->link('Dodaj artykuł', array('controller' => 'articles', 'action' => 'add')); ?></li>
          </ul>
        </li>
        <li class="menu"><a href="javascript: void(0);">Recenzent</a>
          <ul>
            <li><?php echo $this->Html->link('Biddowanie', array('controller' => 'articles', 'action' => 'bidding')); ?></li>
            <li><?php echo $this->Html->link('Recenzowanie', array('controller' => 'articles', 'action' => 'reviewing')); ?></li>
          </ul>
        </li>
        <li class="menu"><a href="javascript: void(0);">Chair</a>
          <ul>
            <li><?php echo $this->Html->link('Podglad artykulow', array('controller' => 'chairs', 'action' => 'index')); ?></li>
          </ul>
        </li>
        <li class="menu"><a href="javascript: void(0);">Edycja profilu</a>
          <ul>
            <li><?php echo $this->Html->link('Zmień hasło', array('controller' => 'users', 'action' => 'change_password')); ?></li>
            <li><?php echo $this->Html->link('Zmień swoje dane', array('controller' => 'users', 'action' => 'edit_profile')); ?></li>
          </ul>
        </li>
        <li><?php echo $this->Html->link('Wyloguj', array('controller' => 'users', 'action' => 'logout')); ?></li>
      <?php
        }
      ?>         
      </ul>
    </div>
    
    <div class="main">
      <?php 
      echo $this->Session->flash();
      echo $this->Session->flash('auth');
      echo $content_for_layout;
      ?>
    </div>
	  
    <div class="footer">Copyright &copy; 2011 SZK | Open source | Modified by <a href="http://inf.ug.edu.pl/" title="Modifyer Homepage">UG students</a> | <a href="http://validator.w3.org/check?uri=referer" title="Validate XHTML code">XHTML 1.0</a> | <a href="http://jigsaw.w3.org/css-validator/" title="Validate CSS code">CSS 2.0</a></div>
          
  </div>
<?php echo $this->element('sql_dump'); ?>
</body>
</html>