<?php
class ChairController extends AppController {
	var $name = 'Chair';
	var $helpers = array('Html','Form');
	var $components = array('Session','Attachment');
	var $uses = array('Article', 'ArticleUser','User');
	
	function index() {
        //$articles = $this->Article->query('SELECT DISTINCT articles.* FROM articles, articles_users WHERE articles_users.user_id='.$this->Session->read('Auth.User.id'));
		$this->User->id = $this->Session->read('Auth.User.id');
		$articles = $this->User->Article->find('all');
		$this->set('articles', $articles);
        //$this->set('authors', $this->User->query('SELECT DISTINCT users.firstname, users.surname, users.email FROM users, articles_users, articles WHERE articles_users.article_id=articles.id AND articles_users.user_id=users.id'));
	}
	
	function show($id = null) {
		$article = $this->Article->findById($id);
		if($this->Session->check('zalogowany')) {
			$this->set('article', $article);
		}
	}	

	function accept($article_id = NULL) {
	 



//$query=mysql_query('SELECT email FROM users, articles_users WHERE articles_users.article_id='.$article_id); 

//$query = mysql_query('SELECT email FROM users');
//echo $this->Session->read('Auth.User.id');
//echo $query .' aa'. $article_id;

$article = $this->Article->findById($article_id); 
pr($article);

foreach ($article['User'] AS $user) 

 { 

 $emails[] = $user['email']; 

 }

echo $emails;

	$this->requestAction(array('controller' => 'mail', 'action' => 'chairEmail'), array('pass' => array($query)));

        		$this->Session->setFlash('Akkcept. Mail wyslany.', 'default', array('class' => 'failure'));
		 	$this->redirect(array('controller' => 'chair', 'action' => 'index'));
	}	

	function reject() {
        		$this->Session->setFlash('Odrzucony. Mail wyslany.', 'default', array('class' => 'failure'));
		 	$this->redirect(array('controller' => 'chair', 'action' => 'index'));
	}	

	function correct() {
        		$this->Session->setFlash('Do poprawy. Mail wyslany.', 'default', array('class' => 'failure'));
		 	$this->redirect(array('controller' => 'chair', 'action' => 'index'));
	}	
}
?>