<div class="adres form">
<?php echo $this->Form->create('Adre');?>
	<fieldset>
 		<legend><?php __('Edit Adre'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ulica');
		echo $this->Form->input('nr');
		echo $this->Form->input('nr_lokalu');
		echo $this->Form->input('kod_poczt');
		echo $this->Form->input('miasto');
		echo $this->Form->input('panstwo');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Adre.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Adre.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Adres', true), array('action' => 'index'));?></li>
	</ul>
</div>