<?php
include_once("database.php");

		$id = $_GET['id'];
		$query = mysqli_query($con,"SELECT * FROM users WHERE id in (SELECT friend2 FROM friends WHERE  friend1 = '$id' and request_accepted = '1')") or die("could not find friends in database");
		while($row = mysqli_fetch_assoc($query))
	{
	if($row["active"] == 1)
	echo'<button type="button" class="list-group-item" data-id = "'.$row["id"].'" onclick = "set_id(this)" ><div class="grad"></div>&nbsp;'.$row["name"].'</button>';
	else
	echo'<button type="button" class="list-group-item" data-id = "'.$row["id"].'" onclick = "set_id(this)">'.$row["name"].'</button>';
	}
	
?>