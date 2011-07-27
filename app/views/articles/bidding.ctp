<h2>Recenzent » Biddowanie</h2>
<table cellspacing="0" cellpadding="5" style="width: 379px;">
  <tr>
    <th>Tytuł</th>
    <th class="small nowrap">Data dodania</th>
    <th class="small">Opcje</th>
  </tr>
<?php
$i = 1;
foreach ($fields as $field)
	{
	$class = null;
	if ($i++ % 2 == 0) { $class = ' class="altrow"'; }
?>
  <tr<?php echo $class; ?>>
    <td class="nowrap bold"><?php echo $field['Article']['title']; ?></td>
    <td><?php echo $this->Time->format('d.m.Y', $field['Article']['created']); ?></td>
    <td class="nowrap">
      <?php
      echo $this->Html->link('Konflikt', array('action' => 'bid', $field['Article']['id'], -2));
      echo '&nbsp;';
      echo $this->Html->link('Nie chcę', array('action' => 'bid', $field['Article']['id'], -1));
      echo '&nbsp;';
      echo $this->Html->link('Obojętnie', array('action' => 'bid', $field['Article']['id'], 0));
      echo '&nbsp;';
      echo $this->Html->link('Chcę', array('action' => 'bid', $field['Article']['id'], 1));
      ?>
    </td>
  </tr>
<?php
  }
?>
</table>