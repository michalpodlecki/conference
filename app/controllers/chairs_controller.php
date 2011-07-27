<?php

class ChairsController extends AppController {
	var $name = 'Chairs';
	var $helpers = array('Html','Form');
	var $components = array('Session','Attachment');
	var $uses = array('Article', 'ArticleUser','User','Statuse');
	
	function index() {
		$this->User->id = $this->Session->read('Auth.User.id');
		$articles = $this->User->Article->find('all');
		$this->set('articles', $articles);

		$selectfield = $this->User->Article->find('all', array('order'=>'Article.title ASC', 'fields' =>'Article.id, Article.title'));
		$selectfield = Set::combine($selectfield, '{n}.Article.title',array('%s', '{n}.Article.title'));
		$this->set('selectarticles', $selectfield);

		$selectfield2 = $this->User->find('all', array('conditions'=>array('User.author' => 1), 'order'=>'User.surname ASC', 'fields' =>'User.id, User.firstname, User.surname'));
		$selectfield2 = Set::combine($selectfield2, '{n}.User.id',array('%s %s', '{n}.User.firstname', '{n}.User.surname'));
		$this->set('selectauthors', $selectfield2);

		$selectfield3 = $this->Statuse->find('all', array('fields' =>'Statuse.id, Statuse.name'));
		$selectfield3 = Set::combine($selectfield3, '{n}.Statuse.id',array('%s', '{n}.Statuse.name'));
		$this->set('selectstatuses', $selectfield3);
	}
	
	function show($id = null) {
		$article = $this->Article->findById($id);
		if($this->Session->check('zalogowany')) {
			$this->set('article', $article);
		}
	}	
	
	function accept($article_id) {
		$query = mysql_query('SELECT users.email FROM users, articles_users WHERE articles_users.article_id=\''.$article_id.'\' AND articles_users.user_id=users.id');
		$this->requestAction(array('controller' => 'mail', 'action' => 'chairEmail'), array('pass' => array($query,"accept",$article_id)));
			
			$this->Article->id = $article_id;
			$this->Article->saveField('status_id', 5); 
        		$this->Session->setFlash('Akkcept. Mail wyslany.', 'default', array('class' => 'success'));
			$this->redirect(array('controller' => 'chairs', 'action' => 'index'));
	}	

	function reject($article_id) {
		$query = mysql_query('SELECT users.email FROM users, articles_users WHERE articles_users.article_id=\''.$article_id.'\' AND articles_users.user_id=users.id');

		$this->requestAction(array('controller' => 'mail', 'action' => 'chairEmail'), array('pass' => array($query,"reject",$article_id)));
			$this->Article->id = $article_id;
			$this->Article->saveField('status_id', 6);
			$this->Session->setFlash('Odrzucony. Mail wyslany.', 'default', array('class' => 'success'));
		 	$this->redirect(array('controller' => 'chairs', 'action' => 'index'));
	}	

	function correct($article_id) {
		$query = mysql_query('SELECT users.email FROM users, articles_users WHERE articles_users.article_id=\''.$article_id.'\' AND articles_users.user_id=users.id');
		$this->requestAction(array('controller' => 'mail', 'action' => 'chairEmail'), array('pass' => array($query,"correct",$article_id)));
			$this->Article->id = $article_id;
			$this->Article->saveField('status_id', 7);		
        		$this->Session->setFlash('Do poprawy. Mail wyslany.', 'default', array('class' => 'success'));
		 	$this->redirect(array('controller' => 'chairs', 'action' => 'index'));
	}	

	function search(){
		if($arttitle = $this->data['Chair']['selectbyauthor'] && $status = $this->data['Chair']['selectbystatuses']){
			$articles = $this->Article->query('SELECT articles.* FROM articles, articles_users WHERE articles_users.user_id='.$this->data['Chair']['selectbyauthor'].' AND articles.id=articles_users.article_id AND articles.status_id=\''.$status.'\'');
			$this->set('articles', $articles);			
		}else if($arttitle = $this->data['Chair']['selectbyarticle']){
			$article = $this->Article->query('SELECT articles.* FROM articles WHERE articles.title=\''.$arttitle.'\'');	
			$this->set('articles', $article);
		}else if($arttitle = $this->data['Chair']['selectbyauthor']){
			$articles = $this->Article->query('SELECT articles.* FROM articles, articles_users WHERE articles_users.user_id='.$this->data['Chair']['selectbyauthor'].' AND articles.id=articles_users.article_id');
			$this->set('articles', $articles);
		}else if($arttitle = $this->data['Chair']['selectbystatuses']){
			$articles = $this->Article->query('SELECT articles.* FROM articles WHERE articles.status_id=\''.$arttitle.'\'');
			$this->set('articles', $articles);			
		}
	}

	function assign(){
		$articles = mysql_query('SELECT id FROM articles');	
		$count = mysql_query('SELECT id FROM users');

		//$this->set('count', $count);
		
		for($j=0;$j<count($articles) && list($artid)=mysql_fetch_row($articles); $j++){
			for($i=0;$i<count($count) && list($userid)=mysql_fetch_row($count); $i++){
				$exist = $this->Article->query('SELECT bids.id FROM bids WHERE bids.article_id=\''.$artid.'\' AND bids.bid=1');
				if($exist){
				$tab[$j][$i] = $userid;
				echo $tab[$j][$i];
				//echo $id;
				}
			}
		}
//$cos = $count[1];
//		echo $cos;
	}
}

?>