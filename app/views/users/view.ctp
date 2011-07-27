  <h1 class="pagetitle">KONTO UŻYTKOWNIKA</h1>



 <div class="subcontent-unit-border">

   
 
    	
		
    	<p><b>IMIĘ: </b><?php echo $user['User']['imie'];?></p><br/>
 <p><b>NAZWISKO: </b><?php echo $user['User']['nazwisko'];?></p><br/>
  <p><b>TELEFON: </b><?php echo $user['User']['telefon'];?></p><br/>
   <p><b>HASŁO: </b><?php echo $user['User']['haslo'];?></p><br/>
    <p><b>EMAIL: </b><?php echo $user['User']['email'];?></p><br/>
   
 
   
    <h1><b><?php echo $html->link('Edycja', array('controller' => 'users', 'action' => 'edit')); ?></b></h1>
    
</div>