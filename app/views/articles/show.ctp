<h1 class="pagetitle">Szczegóły</h1>

<div class="articles">

      <div id="articles-container">
			<div style="position: absolute; top: 2px; right: 3px; color: black; font: 10px/10px Verdana; text-align: right">dodano: <b><?php echo $article['Article']['created']; ?></b><br />zmodyfikowano: <b><?php echo $article['Article']['modified']; ?></b></div>

			<p><b>TYTUŁ: </b><span><?php echo $article['Article']['title']; ?></span></p>
			<p><b>Identyfikator: </b><span><?php echo $article['Article']['id']; ?></span></p>

            <p><b>Streszczenie:</b></p>

            <p class="abstract"><b>&bdquo;</b><?php echo substr($article['Article']['abstract'], 0, 408).'...'; ?><b>"</b></p>

			<p><b>Wpółautorzy:</b></p>
			<ul class="coauthors">
			<?php foreach($coauthors as $author): ?>
				<li><?php echo $author['users']['firstname'].' '.$author['users']['surname'] ?></li>
			<?php endforeach; ?>
			</ul>
            <?php if(!empty($article['Article']['article_file_path'])): ?>
				<p><b>Plik z artykułem:</b> <?php echo $this->Html->link($article['Article']['article_file_name'], '/attachments/files/' . $article['Article']['article_file_path']); ?></p>
            <?php endif; ?>
			<p><b>Słowa kluczowe: </b><span><?php echo $article['Article']['keywords']; ?></span></p>

            <p><?php echo $html->link('Edycja', array('controller' => 'articles', 'action' => 'edit', $article['Article']['id'])); ?> | <?php $html->link('Usuń', array('controller' => 'articles', 'action' => 'delete', $article['Article']['id']), null, 'Czy aby na pewno chcesz usunąć artykuł o tytule:\n'.$article['Article']['title'].'?'); ?><p>
			<p><?php echo $this->Html->link('Powrót', array('controller' => 'articles', 'action' => 'index')); ?></p>
        </div>

</div>


