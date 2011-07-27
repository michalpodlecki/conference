<?php
class ArticlesController extends AppController {

	var $components = array('Attachment');
	
	var $uses = array('Article', 'ArticleUser', 'User');
	
	function index()
    {
    //$articles = $this->Article->query('SELECT DISTINCT articles.* FROM articles, articles_users WHERE articles_users.user_id='.$this->Session->read('Auth.User.id'));
		$this->User->id = $this->Session->read('Auth.User.id');
		//$articles = $this->User->Article->find('all');
		$articles = $this->Article->query('SELECT articles.* FROM articles, articles_users WHERE articles_users.user_id='.$this->Session->read('Auth.User.id').' AND articles.id=articles_users.article_id');
		$this->set('articles', $articles);
    //$this->set('authors', $this->User->query('SELECT DISTINCT users.firstname, users.surname, users.email FROM users, articles_users, articles WHERE articles_users.article_id=articles.id AND articles_users.user_id=users.id'));
	 }
	
	function show($id = null)
    {
		$article = $this->Article->findById($id);
		$coauthors = $this->Article->query('SELECT users.* FROM users, articles_users WHERE articles_users.article_id=\''.$article['Article']['id'].'\' AND articles_users.user_id=users.id');
		//if($this->Session->check('zalogowany')) {
			$this->set('article', $article);
			$this->set('coauthors', $coauthors);
		//}
    }
	
	function add()
    {
		if(!empty($this->data))
      {
      //$this->Article->filename = $this->data['Article']['submittedfile']['tmp_name'];
			if($this->data['Article']['article']['type'] != 'application/pdf' || $this->data['Article']['article']['type'] == '') {
				$this->Session->setFlash('Niepoprawny format pliku. Wymagany plik PDF');
				$this->redirect($this->referer());
			}
			$this->Attachment->upload($this->data['Article']);
			//$this->Session->write();
			//$unikalny = uniqid();
			$this->data['Article']['status_id'] = 1;
			$this->Article->save($this->data);
			$this->data['ArticleUser']['user_id'] = $this->Session->read('Auth.User.id');
			$this->data['ArticleUser']['article_id'] = $this->Article->id;
			$this->ArticleUser->save($this->data);

            // dodawanie współautorów
            if(!empty($this->data['Author'])) {
                foreach($this->data['Author'] as $author) {
					// sprawdzenie, czy współautor posiada już konto w systemie
					$user = $this->User->findByEmail($author['email']);
					// jeśli nie, zakładane jest konto
					if(empty($user)) {
						$this->User->create();
						// z users_controller

						/* kod aktywacyjny */
						$activation_code = substr(str_shuffle("qwertyupasdfghkzxcvbnm23456789"), 0, 16);

						/* tymczasowe hasło */
						$temp_pass = substr(str_shuffle("zxcvbmnbv7655954asda9c"), 0, 8);

						$this->User->set(array(
							'author' => 1,
							'activation_code' => $activation_code,
							'password' => $this->Auth->password($temp_pass)
							));
						$this->User->save($author);

						// wysłanie maila z kodem aktywacyjnym
						$this->Email->from = 'SZK <szk@ppazdan.pl>';
						// email adresata
						$this->Email->to = $author['firstname'].' '.$author['surname'].' <'.$author['email'].'>';
						$this->Email->subject = 'Rejestracja [SZK]';
						$this->Email->template = 'register_coauthor';
						$this->Email->sendAs = 'both';
						$this->set('activation_code', $activation_code);
						$this->set('temp_pass', $temp_pass);
						$this->Email->send();
						$this->Email->reset();
					}
					// jeśli konto współautora istnieje, pobieramy jego id
					else {
						$this->User->id = $user['User']['id'];
						//$this->User->read();
						$this->User->set(array('author' => 1));
						$this->User->save(); /// !!!!!!!!!!!!!!!!!!!!!! $author
					}

					$this->ArticleUser->create();
					$this->ArticleUser->set(array(
						'user_id' => $this->User->id,
						'article_id' => $this->Article->id
					));
					//$this->data['ArticleUser']['user_id'] = $this->Session->read('Auth.User.id');
					//$this->data['ArticleUser']['article_id'] = $this->Article->id;
					$this->ArticleUser->save();
					$this->Session->setFlash('Artykuł został pomyślnie dodany.');
                }
            }
            
			
			//$this->Session->setFlash('Artykuł został pomyślnie dodany.');
			
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function edit($article_id = null) {
		
		$this->Article->id = $article_id;
		
		if (empty($this->data)) {
			$this->data = $this->Article->read();
			$coauthors = $this->Article->query('SELECT users.* FROM users, articles_users WHERE articles_users.article_id=\''.$this->Article->id.'\' AND articles_users.user_id=users.id');
			$this->set('coauthors', $coauthors);
			$this->set('article_id', $this->Article->id);
		} else {
			$this->Session->write('article_array', $this->data);
			if(!empty($this->data['Article']['article']['type']) && $this->data['Article']['article']['type'] != 'application/pdf') { //  && $this->data['Article']['article']['type'] != 'application/pdf'
				$this->Session->setFlash('Niepoprawny format pliku. Wymagany plik PDF');
				$this->redirect($this->referer());
			}
			$this->Attachment->upload($this->data['Article']);
			$this->Article->save($this->data);
            
//            
            // dodawanie współautorów
            if(!empty($this->data['Author'])) {
                foreach($this->data['Author'] as $author) {
					// sprawdzenie, czy współautor posiada już konto w systemie
					$user = $this->User->findByEmail($author['email']);
					// jeśli nie, zakładane jest konto
					if(empty($user)) {
						$this->User->create();
						// z users_controller

						/* kod aktywacyjny */
						$activation_code = substr(str_shuffle("qwertyupasdfghkzxcvbnm23456789"), 0, 16);

						/* tymczasowe hasło */
						$temp_pass = substr(str_shuffle("zxcvbmnbv7655954asda9c"), 0, 8);

						$this->User->set(array(
							'author' => 1,
							'activation_code' => $activation_code,
							'password' => $this->Auth->password($temp_pass)
							));
						$this->User->save($author);

						// wysłanie maila z kodem aktywacyjnym
						$this->Email->from = 'SZK <szk@ppazdan.pl>';
						// email adresata
						$this->Email->to = $author['firstname'].' '.$author['surname'].' <'.$author['email'].'>';
						$this->Email->subject = 'Rejestracja [SZK]';
						$this->Email->template = 'register_coauthor';
						$this->Email->sendAs = 'both';
						$this->set('activation_code', $activation_code);
						$this->set('temp_pass', $temp_pass);
						$this->Email->send();
						$this->Email->reset();
					}
					// jeśli konto współautora istnieje, pobieramy jego id
					else {
						$this->User->id = $user['User']['id'];
						//$this->User->read();
						$this->User->set(array('author' => 1));
						$this->User->save(); /// !!!!!!!!!!!!!!!!!!!!!! $author
					}

					$this->ArticleUser->create();
					$this->ArticleUser->set(array(
						'user_id' => $this->User->id,
						'article_id' => $this->Article->id
					));
					//$this->data['ArticleUser']['user_id'] = $this->Session->read('Auth.User.id');
					//$this->data['ArticleUser']['article_id'] = $this->Article->id;
					$this->ArticleUser->save();
					$this->Session->setFlash('Artykuł został pomyślnie dodany.');
                }
            }
//            
            
			$this->Session->setFlash('Artykuł został pomyślnie zaktualizowany.');
			$this->redirect(array('action' => 'show', $this->Article->id));
		}
	}

	function download($url) {
		if(!empty($url)) {
			header('Content-type: application/pdf');
			//header('Content-Disposition: attachment; filename='.WWW_ROOT.'/attachments/files/'.$url);
			readfile(WWW_ROOT.'/attachments/files/'.$url);
		}
	}

	function delete($article_id) {
		if(!empty($article_id)) {
			$this->Article->delete($article_id, $cascade=false);
			$this->ArticleUser->deleteAll(array('article_id' => $article_id), $cascade=false);
			$this->Session->setFlash('Artykuł został pomyślnie usunięty.');
			$this->redirect(array('action' => 'index'));
		}
	}

	function delete_coauthor($article_id, $coauthor_id) {
		$this->ArticleUser->deleteAll(array('article_id' => $article_id, 'user_id' => $coauthor_id), $cascade=false);
		$this->redirect(array('action' => 'edit', $article_id));
		//$this->redirect('/');
	}
	
	##############################################################################	

  function bidding()
    {
    $this->set('fields', $this->paginate());
    }
    
  function bid($article_id, $bid)
    {
    if (!empty($article_id) AND !empty($bid))
      {
      $this->loadModel('Bid');
      
      $old_bid = $this->Bid->find('first', array('conditions' => array('article_id' => $article_id, 'user_id' => $this->Auth->user('id'))));
      if (!empty($old_bid))
        {
        $this->Bid->delete($old_bid['Bid']['id']);
        }
      
      $this->Bid->create();
      $this->Bid->set(array(
        'article_id' => $article_id,
        'user_id' => $this->Auth->user('id'),
        'bid' => $bid        
        ));
      if ($this->Bid->save())
        {
        $this->Session->setFlash('Zabidowano artykuł.', 'default', array('class' => 'success'));
		    $this->redirect(array('action' => 'bidding'));
        }
      }
    }
    
  function reviewing()
    {
    $this->set('fields', $this->paginate());
    }
  
  function review()
    {
    }

}
