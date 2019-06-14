<?php
	if(isset($_FILES['profile']))
	{
		echo "profile is set";
	}

	if(isset($_FILES['cover']))
	{
		echo "cover is set";
	}
	else
	{
		echo "nothing is set";
	}
	
?>