<?php  if (count($errors) > 0) : ?>
  <div class="error">
  <?php
  $message = "";
  foreach ($errors as $error) :
	$message = $message . $error . ". ";
  endforeach;
   
	
  if(isset($_SESSION['errorSrc']) && $_SESSION['errorSrc'] == "reg" ) {
	echo '<script language="javascript">';
	echo 'alert("Błąd rejestracji: ' . trim($message) . '")';
	echo '</script>';
	
  } else if(isset($_SESSION['errorSrc']) && $_SESSION['errorSrc'] == "log" ) {
	echo '<script language="javascript">';
	echo 'alert("Błąd logowania: \n' . trim($message) . '")';
	echo '</script>';
  }
  $errors = array();
	?>
  </div>
 

<?php  endif ?>