<h1 class="pagetitle">MOJE ARTYKUŁY</h1>

<div class="articles">

<?php foreach ($articles as $article): ?>
        <div id="articles-container">
			<div style="position: absolute; top: 2px; right: 3px; color: black; font: 10px/10px Verdana; text-align: right">dodano: <b><?php echo $article['articles']['created']; ?></b><br />zmodyfikowano: <b><?php echo $article['articles']['modified']; ?></b></div>

			<p><b>TYTUŁ: </b><span><?php echo $article['articles']['title']; ?></span></p>
			<p><b>Identyfikator: </b><span><?php echo $article['articles']['id']; ?></span></p>
			
            <p><b>Streszczenie:</b></p>

            <p class="abstract"><b>&bdquo;</b><?php echo substr($article['articles']['abstract'], 0, 408).'...'; ?><b>"</b></p>

            <b><?php echo $html->link('Szczegóły', array('controller' => 'articles', 'action' => 'show', $article['articles']['id'])); ?> | <?php echo $html->link('Edycja', array('controller' => 'articles', 'action' => 'edit', $article['articles']['id'])); ?> | <?php  $html->link('Usuń', array('controller' => 'articles', 'action' => 'delete', $article['articles']['id']), null, 'Czy aby na pewno chcesz usunąć artykuł o tytule:\n'.$article['articles']['title'].'?'); ?></b>

        </div>

<?php endforeach; ?>

</div>

<?php
//print_r($articles);
//print_r($this->Session->read('Auth'));
?>