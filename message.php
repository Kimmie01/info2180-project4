<?php
	require "connect.php";

	session_start();

	//TODO check if user is logged in

	$recipient_id = $_SESSION['id'];

	$message_id = $_GET['id'];

	$query = mysql_query("SELECT * FROM Message_read");

	/*Mark message as read*/
	while ($row = mysql_fetch_array($query)) {
		if ($row['id'] == $message_id) {
			break;
		}

		/*Mark message as read*/
		$read = mysql_query("INSERT INTO Message_read (message_id, reader_id) VALUES ($row[id], $recipient_id)");
	}

	$get_message = "SELECT * FROM Message WHERE id=$message_id";
?>

<!DOCTYPE html>
<html>
<body>
	<?php
		$row = mysql_fetch_array(mysql_query($get_message));
	?>
	<div id="subject"><?php echo $row['subject']; ?></div>
	<div id="body"><?php echo $row['body']; ?></div>

	<div id="reply">
		<form action="reply.php" method="post">
			Message: <input type="text" id="body" name="body" placeholder="Message"><br>
			<input type="submit" value="reply">
			<input type="hidden" id="message_id" name="message_id" value=<?php echo $row['id']; ?>>
			<input type="hidden" id="subject" name="subject" value=<?php echo $row['subject']; ?>>
			<input type="hidden" id="recipient_id" name="recipient_id" value=<?php echo $row['recipient_ids']; ?>>
		</form>
	</div>
</body>
</html>