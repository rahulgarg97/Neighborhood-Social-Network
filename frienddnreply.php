<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
	<?php
		session_start();
		$cemail = $_SESSION['demail']; 
		$thread = $_POST['view'];
		$subject = $_POST['sub'];
		$sender = $_POST['sender'];
		$receiver = $_POST['receiver'];
		$text = $_POST['message'];
		
		$receiver_type = $_POST['rtype'];
		echo $cemail;
		echo $thread;
		echo $subject;
		echo $sender;
		echo $receiver;
		echo $receiver_type;
		echo $text;

		$sql1 = "CALL frienddnreply (?,?,?,?,?,?)";
		$statement = $link->prepare($sql1);
		$statement->bind_param('sssssi', $receiver, $sender, $thread, $subject, $text, $receiver_type);
		$statement->execute();
		$result = $statement->get_result();
		          //  $result = $link->query($sql);
		       
		//header('refresh:3; url=view_thread.php');
		// echo "The message has been sent to your friend";
		// echo "<br>";
		// echo "You will be redirected to yor friends list in 3 seconds";
		// //$result->close();
		// echo "</ul>";
		?>
		<form action="view_thread.php" method="post" id="form_new_79">
              
              <input type="hidden" name="rtype" value="<?=$receiver_type?>"/>
              
              <input type="hidden" name="view" value="<?=$thread?>"/>
              <!-- <input type="hidden" name="subject" value="<?=$subject?>"/> -->
              <!-- <input type="hidden" name="message" value="<?=$message?>"/> -->
         <?php
              echo "<button name='back' value=''>Go Back to the thread</button><br>";
       



		?>
		
		
		
