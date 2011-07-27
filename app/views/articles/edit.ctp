<h1 class="pagetitle">Artykuł - edycja</h1>
<div style="background: #EBEBEB; border: 1px solid #BEBEBE; padding: 10px 15px">
<?php echo $this->Form->create('Article', array('action' => 'edit', 'enctype' => 'multipart/form-data'));?>

	<?php echo $this->Form->input('title', array('label' => 'Tytuł artykułu:')); ?>
	<?php echo $this->Form->input('abstract', array('label' => 'Strzeszczenie:')); ?>
	<?php echo $this->Form->input('article', array('type' => 'file', 'label' => 'Plik z artykułem (PDF):')); ?>
	<?php echo $this->Form->input('keywords', array('label' => 'Słowa kluczowe (oddzielone przecinkiem):', 'autocomplete' => 'off')); ?>
    <!--<p><b>WSPÓŁAUTORZY</b></p>
    <div id="coauthors">
    </div>
    <a href="#" id="addcoauthorlink">Dodaj współautora</a>-->
	<p><b>Wpółautorzy:</b></p>
			<ul class="coauthors">
			<?php foreach($coauthors as $author): ?>
				<li><?php echo $author['users']['firstname'].' '.$author['users']['surname'] ?>	<?php if($author['users']['id'] != $this->Session->read('Auth.User.id')): echo $html->link('Usuń', array('controller' => 'articles', 'action' => 'delete_coauthor', $article_id, $author['users']['id']), null, 'Czy aby na pewno chcesz usunąć współautora:\n'.$author['users']['firstname'].' '.$author['users']['surname'].'?'); endif; ?>
				</li>
			<?php endforeach; ?>
			</ul>
    <div id="coauthors">
    </div>
    <a href="#" id="addcoauthorlink">Dodaj współautora</a>
	
<?php echo $this->Form->end('Zatwierdź zmiany') ;?>
<?php echo $this->Html->link('Powrót', array('controller' => 'articles', 'action' => 'show', $article_id)); ?>

</div>

<script type="text/javascript">
    var licznik = 0;

	var kill = function(id) {
		var x = document.getElementById(id);
		var div = document.getElementById('coauthors');
		div.removeChild(x);
		return;
	}

    var addCoauthor = function() {
        var div = document.getElementById('coauthors');
        var container = document.createElement('div');
        container.className = 'coauthors-container';
		container.id = 'krzyzyk_'+licznik;

        var nowy = document.createElement('label');
        nowy.setAttribute('for', 'coauthor['+licznik+']');
        nowy.innerHTML = 'Imię:';
        container.appendChild(nowy);

        nowy = document.createElement('input');
        nowy.id = 'coauthor['+licznik+']';
        nowy.type = 'text';
        nowy.name = 'data[Author]['+licznik+'][firstname]';
        nowy.className = 'coauthor_input';
        container.appendChild(nowy);

		// krzyżyk do usuwania
		nowy = document.createElement('a');
		nowy.href = 'javascript: kill(\'krzyzyk_'+licznik+'\')';
		//nowy.id = 'krzyzyk_'+licznik;
		nowy.className = 'krzyzyk';
		nowy.innerHTML = 'usuń';
		container.appendChild(nowy);

        nowy = document.createElement('label');
        nowy.setAttribute('for', 'coauthor['+licznik+']');
        nowy.innerHTML = 'Nazwisko:';
        container.appendChild(nowy);

        nowy = document.createElement('input');
        nowy.id = 'coauthor['+licznik+']';
        nowy.type = 'text';
        nowy.name = 'data[Author]['+licznik+'][surname]';
        nowy.className = 'coauthor_input';
        container.appendChild(nowy);

        nowy = document.createElement('label');
        nowy.setAttribute('for', 'coauthor['+licznik+']');
        nowy.innerHTML = 'email:';
        container.appendChild(nowy);

        nowy = document.createElement('input');
        nowy.type = 'text';
        nowy.name = 'data[Author]['+licznik+'][email]';
        nowy.className = 'coauthor_input';
        container.appendChild(nowy);
        //div.appendChild(document.createElement('hr'));
        div.appendChild(container);
        licznik++;
        return false;
    }
    document.getElementById('addcoauthorlink').onclick = addCoauthor;
</script>

<!-- 
<div class="actions">
	
	<ul>
	
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Adres', true), array('controller' => 'adres', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Adres', true), array('controller' => 'adres', 'action' => 'add')); ?> </li>
	</ul>
	
	
</div>

-->

<?php
//if($this->Session->check('article_array')) {
//	print_r($this->Session->read('article_array'));
//}
echo 'Czas serwera: '.date('d-m-Y, G:i:s');
?>