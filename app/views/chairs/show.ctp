	<h1 class="pagetitle">MOJE ARTYKUŁY</h1>
	<div  style="background: #EBEBEB; border: 1px solid #BEBEBE; padding: 10px 15px">

		<div style="background: white; padding: 10px; margin: 0 0 10px">

  		<p>Identyfikator: <b><?php echo $article['Article']['id']; ?></b></p>
  		<p>Nazwa: <i><?php echo $article['Article']['nazwa']; ?></i></p>
  		<p>Status: <b><?php echo $article['Article']['status']; ?></b></p>
  		<p>Współautorzy: <b><?php echo $article['Article']['abstract']; ?></b></p>
  		<p>Link do artykułu: <?php echo $this->Html->link($article['Article']['article_file_name'], '/attachments/files/'.$article['Article']['article_file_path']); ?></p>
  		<b><?php echo $html->link('Edycja', array('controller' => 'articles', 'action' => 'edit', $article['Article']['id'])); ?> | <?php echo $this->Html->link('Powrót', array('controller' => 'articles', 'action' => 'index')); ?></b>

		</div>

	</div>
<?php print_r($article); ?>

