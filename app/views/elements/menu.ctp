<ul>
  <li>
  <?php
  if($session->check('zalogowany'))
    echo $html->link('home','/');
  ?>
  </li>
</ul>

<ul>
  <li>
  <?php
  if($session->check('zalogowany'))
    echo $html->link('Rejestracja','/users/error_add');
  else
    echo $html->link('Rejestracja','/users/add');
  ?>
  </li>
</ul>

<ul>
  <li>
  <?php
  if ( $session->check( 'zalogowany' ) )
    {
    echo $html->link( __( 'Wyloguj', true ), '/Users/logout' );
    } else {
    echo $html->link( 'Zaloguj', '/Users/login' );
    }
  ?>
  </li>
</ul>

<?php if($this->Session->check('zalogowany')): ?>
<ul>
  <li><?php echo $html->link('Pokaż dane','/users/view');?></li>
</ul>

<ul>
  <li class="konf">Obecna konferencja / dane </li>
</ul>
<!-- Navigation item -->

<ul>
  <li><a href="#">Wybierz konferencje<!--[if IE 7]><!--></a><!--<![endif]-->

  <!--[if lte IE 6]><table><tr><td><![endif]-->

    <ul>

      <li><a href="#">Layout-1</a></li>

      <li><a href="#">Layout-2</a></li>

      <li><a href="#">Layout-3</a></li>

    </ul>

  <!--[if lte IE 6]></td></tr></table></a><![endif]-->

</li>

</ul>          

<?php endif; ?>