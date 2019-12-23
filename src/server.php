<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 
$numberOfVisits;

if (isset($_POST['reg_user'])) {
  checkIfInactive();
  $username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password_1 = $_POST['password_1'];
  $password_2 = isset($_POST['password_2']) ? $_POST['password_2'] : '';

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array

  $valid = true;
  if (empty($username)) { $valid = false; array_push($errors, "Name is required");}
  if (empty($email)) { $valid = false; array_push($errors, "Email is required"); }
  if (empty($password_1)) { $valid = false; array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) { $valid = false; array_push($errors, "The two passwords do not match");}

	if($valid) {
	$file = fopen('usersInfo.txt', 'r+');
		while(!feof($file)){
			$line = fgets($file);
			$array = explode(";","$line;");
			if(trim($array[0])==$username){
				array_push($errors, "Username already exists");
				break;
			}
			if(isset($array[2]) && trim($array[2])==$email){
				array_push($errors, "Email already exists");
				break;
			}
		}
	}
	
if (count($errors) == 0) {	
	fwrite($file, $username . ";" . $password_1 . ";" . $email . ';' . "\n");	
	fclose($file);
	$_SESSION['username'] = $username;
  	$_SESSION['login'] = true;
} else {
	$_SESSION['errorSrc'] = "reg";
}
}

if (isset($_POST['log_user'])) {
	checkIfInactive();
	$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
	$password = $_POST['password_1'];
	
	 if (empty($username)) {
		array_push($errors, "Username is required");
		}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}
	
	if (count($errors) == 0) {
		$file = fopen('usersInfo.txt', 'r+');
		while(!feof($file)){
			$line = fgets($file);
			$array = explode(";","$line;");
			if(trim($array[0])==$username && trim($array[2])==$password){
				$_SESSION['username'] = $username;
				$_SESSION['login'] = true;
				return;
			}
		}
		array_push($errors, "Wrong username/password combination");
	}
}

if (isset($_POST['log_out'])) {
	$_SESSION['login'] = false;
	session_unset(); 	
}

if(isset($_POST['add_comment'])) {
	checkIfInactive();
	$comment = htmlspecialchars($_POST['comment'], ENT_QUOTES, 'UTF-8');
	$section = htmlspecialchars($_POST['section'], ENT_QUOTES, 'UTF-8');

	$file = fopen("comments.txt", "a") or die("Unable to open file!");
	fwrite($file, $section . '**' . $_SESSION['username'] . '**' . $comment  . '**' . "\n");	
	fclose($file);
	if($section != 2)
		header("Location: index.php#Alg" . $section);
	else {
		header("Location: index.php#Jaco");
	}
}

function addVisitor() {
	checkIfInactive();
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	$today = date("Y-m-d H:i:s");
	$tomorrow = date("Y-m-d H:i:s", strtotime('+1 days'));
	$ipExists = false;
	$file = fopen("usersIP.txt", "r+");

	if ($file) {		
		$oldNumberOfVisits = trim(file_get_contents('userNumber.txt'));
		$newNumberOfVisits = $oldNumberOfVisits;

		while (($line = fgets($file)) !== false) {
			$lineArray = explode ("**", "$line**");
			if(trim($lineArray[0]) == $ip) {
				 if($lineArray[1] < $today) {
					$contents = file_get_contents("usersIP.txt");
					$contents = str_replace($line, $ip . '**' . $tomorrow . '**', $contents);
					file_put_contents("usersIP.txt", $contents);
					$newNumberOfVisits++;
				 }
				 $ipExists = true;				
			} else if($lineArray[1] < $today) {
					$contents = file_get_contents("usersIP.txt");
					$contents = str_replace($line, '', $contents);
					file_put_contents("usersIP.txt", $contents);
			}
			
			
		}
		if(!$ipExists) {
			fwrite($file, $ip . '**' . $tomorrow . '**' . "\n");
			$newNumberOfVisits++;
		}
		
		$contents = file_get_contents("userNumber.txt");
		$contents = str_replace($oldNumberOfVisits,$newNumberOfVisits, $contents);
					file_put_contents("userNumber.txt", $contents);
		
    }
	global $numberOfVisits;
	$numberOfVisits = $newNumberOfVisits;
	fclose($file);
}

function checkIfInactive() {
	if(isset($_SESSION['login']) && $_SESSION['login'] && isset($_SESSION['timestamp']) && time() - $_SESSION['timestamp'] > 300) {
		
		$_SESSION['login'] = false;
		session_unset();
		header("Location: sessionExpired.php");
		exit;
		
	} else {
		$_SESSION['timestamp'] = time();
	}
}

function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
