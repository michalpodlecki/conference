<div class="adres index">
	<h2><?php __('Adres');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('ulica');?></th>
			<th><?php echo $this->Paginator->sort('nr');?></th>
			<th><?php echo $this->Paginator->sort('nr_lokalu');?></th>
			<th><?php echo $this->Paginator->sort('kod_poczt');?></th>
			<th><?php echo $this->Paginator->sort('miasto');?></th>
			<th><?php echo $this->Paginator->sort('panstwo');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($adres as $adre):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $adre['Adre']['id']; ?>&nbsp;</td>
		<td><?php echo $adre['Adre']['ulica']; ?>&nbsp;</td>
		<td><?php echo $adre['Adre']['nr']; ?>&nbsp;</td>
		<td><?php echo $adre['Adre']['nr_lokalu']; ?>&nbsp;</td>
		<td><?php echo $adre['Adre']['kod_poczt']; ?>&nbsp;</td>
		<td><?php echo $adre['Adre']['miasto']; ?>&nbsp;</td>
		<td><?php echo $adre['Adre']['panstwo']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $adre['Adre']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $adre['Adre']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $adre['Adre']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $adre['Adre']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Adre', true), array('action' => 'add')); ?></li>
	</ul>
</div>