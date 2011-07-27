<h1 class="pagetitle">MOJE ARTYKUŁY</h1>

<div class="articles">



<?php foreach ($articles as $article): ?>
        <div id="articles-container">
			<div style="position: absolute; top: 2px; right: 3px; color: black; font: 10px/10px Verdana; text-align: right">dodano: <b><?php echo $article['Article']['created']; ?></b><br />zmodyfikowano: <b><?php echo $article['Article']['modified']; ?></b></div>

			<p><b>TYTUŁ: </b><span><?php echo $article['Article']['title']; ?></span></p>
			<p><b>Identyfikator: </b><span><?php echo $article['Article']['id']; ?></span></p>
			<p><b>Status: </b><span><?php echo $article['Status']['name']; ?></span></p>

            <p><b>Streszczenie:</b></p>

            <p class="abstract"><b>&bdquo;</b><?php echo substr($article['Article']['abstract'], 0, 408).'...'; ?><b>"</b></p>

            <!-- <p><b>Wpółautorzy:</b></p> -->

                <?php if(!empty($authors)): ?>

            <ul class="coauthors">

                    <?php if(isset($authors)) { foreach ($authors as $author): ?>

                <li><?php echo $author['users']['firstname'].' '.$author['users']['surname']; ?></li>





                <?php endforeach; } ?>

            </ul><?php endif; ?>

            <?php if(!empty($article['Article']['article_file_path'])): ?>

            <p><b>Plik z artykułem:</b> <?php echo $this->Html->link($article['Article']['article_file_name'], '/attachments/files/' . $article['Article']['article_file_path']); ?><br /><span style="color: #767676; font: 12px/14px Tahoma">(kliknij prawym i wybierz opcję <i>Zapisz jako...</i>)</span></p>

            <?php endif; ?>

<b>
<?php echo $html->link('Akceptuj', array('controller' => 'chair', 'action' => 'accept', $article['Article']['id'])); ?> | 
<?php echo $html->link('Odrzuc', array('controller' => 'chair', 'action' => 'reject', $article['Article']['id'])); ?> | 
<?php echo $html->link('Do poprawy', array('controller' => 'chair', 'action' => 'correct', $article['Article']['id'])); ?>
</b>

        </div>

<?php endforeach; ?>

</div>

<?php //print_r($articles); ?>

<?php
//print_r($authors);

?>