<?php function readComments($section) {
	$file = fopen("comments.txt", "r+");

	if ($file) {
		echo "<p id='titleComments'>KOMENTARZE</p>";
		echo "<div class='comments'>";
		while (($line = fgets($file)) !== false) {
			$lineArray = explode ("**", "$line**");
			if($lineArray[0] == $section) {
				echo "<div class='commentField'>";
				echo "<span class='user'>" . $lineArray[1] . " " . "</span>";
				echo "<span class='comment'>" . $lineArray[2] . " " . "</span>";
				echo "</div>";
			}
		}
		echo "</div>";
		fclose($file);
	}
	
	if(isset($_SESSION['login']) && $_SESSION['login']) {
	echo "<form method='post' action='' class='inline'>
			<div class='input-group'>
				<input class='addComment' type='text' name='comment'>
				<input type='hidden' name='section' value='" . $section . "'/>
			</div>
			<div class='input-group'>
				<button type='submit' class='btn addComment' name='add_comment'>Dodaj komentarz</button>
			</div>

		</form>";	
	}
}
?>