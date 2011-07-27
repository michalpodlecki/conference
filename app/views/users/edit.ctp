







<h1 class="pagetitle"><b>Edycja konta dla: </b><span><?php echo $this->Session->read('zalogowany.User.imie').' '.$this->Session->read('zalogowany.User.nazwisko') ?></span></h1>

 <div class="subcontent-unit-border">




 
<?php echo $this->Form->create('User', array('action' => 'edit', 'enctype' => 'multipart/form-data'));?>

<p><b><?php echo $this->Form->input('User.imie', array('label' => 'Imię: '));?></b></p><br/>
<p><b><?php echo $this->Form->input('User.nazwisko', array('label' => 'Nazwisko:'));?></b></p><br/>
<p><b><?php echo $this->Form->input('User.telefon', array('label' => 'Telefon:'));?></b></p><br/>
<p><b><?php echo $this->Form->input('User.haslo', array('label' => 'Hasło:'));?></b></p><br/>



<?php echo $this->Form->end('Zatwierdź');?>


</div>