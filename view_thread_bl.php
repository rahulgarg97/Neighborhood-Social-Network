<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>

	<?php
		session_start();
		$cemail = $_SESSION['demail']; 
		$threadname = $_POST['view'];
		$receiver_type = $_POST['rtype'];
		//echo $cemail;
		//echo $threadname;
		echo $receiver_type;
	
		

		if ($receiver_type == '3' or '4' )
		{

			$sql = "(select distinct mtext as text, sender_email as smail, msubject as smjuc, mthread as thready, receiver_type as rtipe, mtimestamp as yourtime from inbox where (receiver_email= ? or sender_email = ?) and mthread= ? and receiver_type= ?)";

          $statement = $link->prepare($sql);
          $statement->bind_param('sssi', $cemail, $cemail, $threadname, $receiver_type);
          $statement->execute();
          $result = $statement->get_result();
          
          
          //  $result = $link->query($sql);
          if ($result->num_rows > '0') 
          {
          	echo "<ul class='list-group'>";
            //$row = $result->fetch_assoc(MYSQLI_ASSOC);
            //echo $row["thread"];
            while ($row = mysqli_fetch_assoc($result)) {
             $GLOBALS['gg'] = $row["thready"];
             $GLOBALS['hh'] = $row["smjuc"];
	$GLOBALS['ii'] = $row["smail"];
             //$GLOBALS['dd'] = $row["irmail"];
	 $GLOBALS['jj'] = $row["text"]; 
	$GLOBALS['kk'] = $row["rtipe"]; 
            	
			 echo "<li class='list-group-item'>".$row["text"]."</li>";
             echo "<li class='list-group-item'>".$row["smail"]."</li>";
             echo "<li class='list-group-item'>".$row["yourtime"]."</li>";
             // echo "<li class='list-group-item'>".$row["itimestamp"]."</li>";
             


             

              }
           // $result->close();
            echo "</ul>";
          } //else {
            //echo "No messages found"; }

    	?>
	
		
 
      <form action="blockhoodreply.php" method="post">

                 <div class="form-group">
                <label>Enter reply</label>
                </div>

           <!--  <div> 
                <label>Message</label>
                <input type="text" name="reply" class="form-control" required>
            </div> -->

             
             <input type="hidden" name="view" value="<?=$gg?>"/>
             <input type="hidden" name="sub" value="<?=$hh?>"/>
             <input type="hidden" name="sender" value="<?=$ii?>"/>
             <!-- <input type="hidden" name="receiver" value="<?=$dd?>"/> -->
             <input type="hidden" name="text" value="<?=$jj?>"/>
             <input type="hidden" name="rtype" value="<?=$kk?>"/>

             
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



	