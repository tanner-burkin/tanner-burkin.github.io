<!DOCTYPE html>
<html>
	<head>
		<title>View Uploaded Image</title>
	</head>
	<body>

		<?php
			session_start();
			include "dbConfig.php";
			$instance = $db->query("SELECT * FROM images WHERE image_name = '" . $_SESSION["filename"] . "'");
			$row = $instance->fetch_assoc();
			echo "<img src = " . $row["file_path"] . " alt = 'previously uploaded photo'>";
			echo "<p>File Size = " . $row["file_size"] . "</p>";
			echo "<p>File Type = " . $row["file_type"] . "</p>";
			echo "<p>File Uploaded = " . $row["uploaded"] . "</p>";
			echo "<p>File Path = " . $row["file_path"] . "</p>";
		?>
	</body>
</html>
