<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
	<?php
		session_start();

		$cemail = $_SESSION['demail'];
		$_SESSION['jmail'] = $cemail;

		$receiver = $_POST['receivertype'];
		$_SESSION['receiving'] = $receiver ;

		$thread = $_POST['thread'];
		$_SESSION['threading'] = $thread ;

		$subject = $_POST['subject'];
		$_SESSION['subjecting'] = $subject ;

		$message = $_POST['message'];
		$_SESSION['messaging'] = $message ;


		    //       echo $receiver;
		    //       echo $thread;
				  // echo $message;

	
	           
		// else


		// 	{

if($receiver == '1')
{
				  	$sql = "select concat(ufname, ' ', ulname) as name, friends.uemail_2 as friendmail from user join friends where (friends.uemail_1 = ? and friends.uemail_2 = user.uemail) 
		          union select concat(ufname, ' ', ulname) as name, friends.uemail_1 as friendmail from user join friends where (friends.uemail_2 = ? and friends.uemail_1 = user.uemail) ";
		          $statement = $link->prepare($sql);
		          $statement->bind_param('ss', $cemail, $cemail);
		          $statement->execute();
		          $result = $statement->get_result();
		          //  $result = $link->query($sql);
		          if ($result->num_rows > 0) 
		          {
			          	echo "<ul class='list-group'>";
			            while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			            {
			              echo " <li class='list-group-item'>".$row['name']."</li>";
			              $aa = $row['name'];
			              $bb = $row['friendmail'];
			              echo $bb;
			              echo "<button name='send' value='$bb' form='form_new_6'>Send</button><br>";
			            }
		            $result->close();
		            echo "</ul>";
		          } 

		          else 
		          {
		            echo "No Friend";
		          }
	$statement->close();
		          
}

else if($receiver == '2')
{
				  	$sql = "select concat(ufname, ' ', ulname) as name, direct_neighbors.uemail_2 as dnmail from user join direct_neighbors where direct_neighbors.uemail_1 = ? and direct_neighbors.uemail_2 = user.uemail";
		          $statement = $link->prepare($sql);
		          $statement->bind_param('s', $cemail);
		          $statement->execute();
		          $result = $statement->get_result();
		          //  $result = $link->query($sql);
		          if ($result->num_rows > 0) 
		          {
			          	echo "<ul class='list-group'>";
			            while ($row = $result->fetch_array(MYSQLI_ASSOC)) 
			            {
				              echo " <li class='list-group-item'>".$row['name']."</li>";
				              $aa = $row['name'];
				              $bb = $row['dnmail'];
				              echo $bb;
				              echo "<button name='send' value='$bb' form='form_new_7'>Send</button><br>";
			            }
		            $result->close();
		            echo "</ul>";
		          } 
		          else 
		          {
		            echo "No Direct Neighbor";
		          }
	$statement->close();
		          
}


else if($receiver == '3' or '4')
{

			  		$sql123 = "SELECT mthread from message where mthread = '$thread'";
					$result = $link->query($sql123);
					if ($result->num_rows > 0) 
					{
					// 	output data of each row
						$row = $result->fetch_array(MYSQLI_ASSOC);
						if ($thread == $row['mthread']) 
						{
							header('refresh:3; url=home.php');
							echo "Thread already exists";
							echo "<br>";
							echo "You will be redirected to home page in 3 seconds";
						}
					}
					else
					{
					  $sql1 = "CALL blockemail (?,?,?,?,?)";
					  echo "this loop is executed.";
					  echo $receiver;
					  $statement = $link->prepare($sql1);
			          $statement->bind_param('issss', $receiver, $cemail, $thread, $subject, $message);
			          $statement->execute();
			          $result = $statement->get_result();
			          //  $result = $link->query($sql);
			         
			    //       $sql2 = "CALL block_members_message (?,?,?,?,?)";
					  // $statement = $link->prepare($sql1);
			    //       $statement->bind_param('issss', $receiver, $cemail, $thread, $subject, $message);
			    //       $statement->execute();
			    //       $result = $statement->get_result();

				  	  header('refresh:3; url=home.php');
				  	  if ($receiver == '3')
					  {
					  	echo "The message has been sent to all your block members";
					 	 echo "<br>";
					  	echo "You will be redirected to home page in 3 seconds";
			          //$result->close();
			          	echo "</ul>";

			          }

			          else
			          {
							echo "The message has been sent to all your hood members";
					 		 echo "<br>";
					  		echo "You will be redirected to home page in 3 seconds";
			          //$result->close();
			          		echo "</ul>";

			          }
		           	}
}

		    //   if($receiver == '4')
				  // {
					 //  $sql1 = "CALL blockemail (?,?,?,?,?)";
					 //  $statement = $link->prepare($sql1);
			   //        $statement->bind_param('issss', $receiver, $cemail, $thread, $subject, $message);
			   //        $statement->execute();
			   //        $result = $statement->get_result();
			     
			   //  //       $sql2 = "CALL block_members_message (?,?,?,?,?)";
					 //  // $statement = $link->prepare($sql1);
			   //  //       $statement->bind_param('issss', $receiver, $cemail, $thread, $subject, $message);
			   //  //       $statement->execute();
			   //  //       $result = $statement->get_result();

				  // 	  header('refresh:3; url=home.php');
					 //  echo "The message has been sent to all your neighbor members";
					 //  echo "<br>";
					 //  echo "You will be redirected to home page in 3 seconds";
			   //        //$result->close();
			   //        echo "</ul>";
	     //       }
	    

	    // }
?>
  <form action="sendmsgfriend.php" method="post" id="form_new_6">
  	</form>
  <form action="sendmsgdn.php" method="post" id="form_new_7">
  	</form>
	</body>
</html>