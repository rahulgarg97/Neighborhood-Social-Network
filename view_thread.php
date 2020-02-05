<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>

	<?php
		session_start();
		$cemail = $_SESSION['demail']; 
		$threadname = $_POST['view'];
		$receiver_type = $_POST['rtype'];
		echo $cemail;
		echo $threadname;
		echo $receiver_type;
	
		
		
		


		if ($receiver_type == '1' or '2' )
		{

			$sql = "with temp as (select sender_email, receiver_email, mtext, mthread, msubject, mtimestamp, receiver_type from inbox where receiver_type = ? and receiver_email = ? and mthread = ?) (select sender_email as ismail, receiver_email as irmail, mtext as itext, mthread as ithread, msubject as isubject, receiver_type as irtype, mtimestamp as itimestamp from temp) union (select  inbox.sender_email as smail, inbox.receiver_email as rmail, inbox.mtext as text, inbox.mthread as thread, inbox.msubject as subject, inbox.receiver_type as rtype, inbox.mtimestamp as atimestamp from inbox join temp where inbox.receiver_email =  temp.sender_email and inbox.sender_email = ? and inbox.mthread = temp.mthread )";

          $statement = $link->prepare($sql);
          $statement->bind_param('isss', $receiver_type, $cemail, $threadname, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > '0') 
          {
          	echo "<ul class='list-group'>";
            //$row = $result->fetch_assoc(MYSQLI_ASSOC);
            //echo $row["thread"];
            while ($row = mysqli_fetch_assoc($result)) {
             $GLOBALS['aa'] = $row["ithread"];
             $GLOBALS['bb'] = $row["isubject"];
			 $GLOBALS['cc'] = $row["ismail"];
             $GLOBALS['dd'] = $row["irmail"];
			 $GLOBALS['ee'] = $row["itext"]; 
			 $GLOBALS['ff'] = $row["irtype"]; 


             echo "<li class='list-group-item'>".$row["ismail"]."</li>";
             echo "<li class='list-group-item'>".$row["itext"]."</li>";
             echo "<li class='list-group-item'>".$row["itimestamp"]."</li>";
             


             

              }
           // $result->close();
            echo "</ul>";
          } //else {
            //echo "No messages found"; }

    	?>
	
		
 
      <form action="frienddnreply.php" method="post">

                 <div class="form-group">
                <label>Enter reply</label>
                </div>

           <!--  <div> 
                <label>Message</label>
                <input type="text" name="reply" class="form-control" required>
            </div> -->

             
             <input type="hidden" name="view" value="<?=$aa?>"/>
             <input type="hidden" name="sub" value="<?=$bb?>"/>
             <input type="hidden" name="sender" value="<?=$cc?>"/>
             <input type="hidden" name="receiver" value="<?=$dd?>"/>
             <input type="hidden" name="text" value="<?=$ee?>"/>
             <input type="hidden" name="rtype" value="<?=$ff?>"/>

             
        <input type="text" name="message" class="form-control" required>
            <!-- </div> -->
           <input type="submit" placeholder = "reply">
          <?php 

            $_SESSION['demail'] = $cemail;
            $_SESSION['view'] = $threadname;
            $_SESSION['rtype'] = $receiver_type;
    }

  			?>
          </form>
         
       
               <!-- <input type="submit"> -->
            <!-- <?php    
                // $aa = $row["ismail"];
               //  echo $aa;
            ?>   -->  
                <!-- <input type="hidden" name="rtype" value="<?=$aa?>"/>
                <input type="hidden" name="rtype" value="<?=$bb?>"/>
                <input type="hidden" name="rtype" value="<?=$bb?>"/> -->
           <!-- <?php
            //  $_SESSION['demail'] = $cemail;
              //echo "<button name='Reply' value='$aa'>Reply</button><br>";
              
          ?>

</form> -->



	