  <h1 class="pagetitle">REJESTRACJA</h1>
 <div class="subcontent-unit-border">

 <h2 class="pagetitle">ZAŁÓŻ KONTO</h2>



<?php echo $this->Form->create('User');?>

 	
	
		<p><b><?php echo $this->Form->input('imie');?></b></p><br/>
		<p><b><?php echo $this->Form->input('nazwisko');?></b></p><br/>
		<!-- <p><b><?php echo $this->Form->input('adres_id');?></b></p><br/> -->
		<p><b><?php echo $this->Form->input('telefon');?></b></p><br/>
		<p><b><?php echo $this->Form->input('haslo');?></b></p><br/>
		<p><b><?php echo $this->Form->input('email');?></b></p><br/>
		<!-- <p><b><?php echo $this->Form->labelTag('cur_timestamp');?></b></p><br/>-->
	
	
<?php echo $this->Form->end(__('Rejestruj', true));?>




</div>

<!-- 
<div class="actions">
	
	<ul>
	
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Adres', true), array('controller' => 'adres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Adres', true), array('controller' => 'adres', 'action' => 'add')); ?> </li>
	</ul>
	
	
</div>

-->