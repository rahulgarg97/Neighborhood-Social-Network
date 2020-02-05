<?php include "header.php" ?>
<style type="text/css">
  .list-group {padding-top: 20px;}
</style>
</head>
<body>
<?php include "nav.php" ?>

<div class="container nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">Incoming Friend Requests</a>
  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">send Friend Requests</a>
  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
  <a class="nav-link" id="v-pills-inbox-tab" data-toggle="pill" href="#v-pills-inbox" role="tab" aria-controls="v-pills-inbox" aria-selected="false">Inbox</a>
  <a class="nav-link" id="v-pills-direct-tab" data-toggle="pill" href="#v-pills-direct" role="tab" aria-controls="v-pills-direct" aria-selected="false">Add Direct neighbors</a>

    <a class="nav-link" id="v-pills-block-tab" data-toggle="pill" href="#v-pills-block" role="tab" aria-controls="v-pills-block" aria-selected="false">Incoming Block Requests</a>

<!-- <a class="nav-link active" id="v-pills-block-tab" data-toggle="pill" href="#v-pills-block" role="tab" aria-controls="v-pills-block" aria-selected="true">Incoming Block Requests</a>
  
 -->
</div>
<!-- <div class="tab-content" id="v-pills-tabContent"> -->
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
    <div class="row">
      <div class="col-sm-2 col-md-2">
        <ul class="list-group">
  <li class="list-group-item" aria-disabled="true">
    
    


<?php
          session_start();
          $cemail = $_SESSION['email'];   
          $_SESSION['femail'] = $cemail;
          //$_SESSION['demail'] = $cemail;

          //$cemail = "alex.gordon97@gmail.com";
          $sql1 = "select friend_request.uemail_1 as fremail from friend_request where friend_request.status = 0 and friend_request.uemail_2 = ?";
          $statement = $link->prepare($sql1);
          $statement->bind_param('s', $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["fremail"]."</li>";
              $bb = $row["fremail"];
              echo "<button name='accept' value='$bb' form='form_new_1'>Accept</button><br>";
              echo "<button name='reject' value='$bb' form='form_new_2'>Reject</button><br>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No incoming requests";
          }
          $statement->close();
?>
  </li>

</ul>
      </div>

    </div>
    
  </div>



  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
  	<div class="row">
  		<div class=" col-sm-3 col-md-3">
  			<ul class="list-group">
  <li class="list-group-item" aria-disabled="true">
    <?php
          $cemail = $_SESSION['email'];   

          $_SESSION['demail'] = $cemail;

          $sql = "select residents.uemail as rmail from residents where residents.uemail != ? and residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?)";
          $statement = $link->prepare($sql);
          $statement->bind_param('ss', $cemail, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["rmail"]."</li>";
                $aa = $row["rmail"];
              echo "<button name='send' value='$aa' form='form_new'>Send</button><br>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Neighborhood members";
          }
          $statement->close();
?>
  </li>
  

</ul>
  		</div>

  	</div>
  </div>

  <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
  	<div class="row">
  		<div class="col-sm-2 col-md-2">
  			<ul class="list-group">
  <li class="list-group-item" aria-disabled="true">
  
<form action="newmessage.php" method="post">

                <div class="form-group">
                <label>Whom you want to send?</label>
                <select name="receivertype">

                <option value="1">Friends</option>
                  
                <option value="2">Direct Neighbors</option>
                  
                <option value="3">Block Members</option>
                  
                <option value="4">Hood Members</option>
                  
                </select>
                </div>

            <div> 
                <label>Thread Name</label>
                <input type="text" name="thread" class="form-control" required>
            </div>
                <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                    <input type="text" name="message" class="form-control" required>
            </div>
           <input type="submit">
           <?php
              $_SESSION['demail'] = $cemail;
              
          ?>

</form>

  </li>

</ul>

  		</div>

  	</div>
  </div>
  


  <div class="tab-pane fade" id="v-pills-inbox" role="tabpanel" aria-labelledby="v-pills-inbox-tab">
    <div class="row">
      <div class="col-sm-2 col-md-2">
        <ul class="list-group">
  
<!-- <form action="inbox.php" method="post">
 -->
                <div class="form-group">
                <label>Friends Feed</label>

          <?php
          $cemail = $_SESSION['email'];   

          $_SESSION['demail'] = $cemail;

          $sql1 = "select distinct mthread as thread, receiver_type from message where receiver_type = '1' and friend_neighbor_email = ?";
          $statement1 = $link->prepare($sql1);
          $statement1->bind_param('s', $cemail);
          $statement1->execute();
          $result1 = $statement1->get_result();
          //  $result = $link->query($sql);
          if ($result1->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row1 = $result1->fetch_array(MYSQLI_ASSOC)) {
              
              $bb = $row1["receiver_type"];
              $aa = $row1["thread"];
              //echo  '<a href= "view_thread.php?link='.$row["thread"].' linkname = '.$row["thread"].'"></a>';
              ?>
              <form action="view_thread.php" method="post" id="form_new_10">
              
              <input type="hidden" name="rtype" value="<?=$bb?>"/>
              
             
              <?php
              
              echo "<li class='list-group-item'>".$row1["thread"]."</li>";

              echo "<button name='view' value='$aa'>View Thread</button><br>";
              }
            $result1->close();
            echo "</ul>";
          } else {
            echo "No Message from any friend";
          }
          $statement1->close();
          ?>

          </form>


                <label>Direct Neighbors Feed</label>

                 <?php
          $cemail = $_SESSION['email'];   

          $_SESSION['demail'] = $cemail;

          $sql2 = "select distinct mthread as thread, receiver_type from inbox where receiver_type = '2' and receiver_email = ?";
          $statement2 = $link->prepare($sql2);
          $statement2->bind_param('s', $cemail);
          $statement2->execute();
          $result2 = $statement2->get_result();
          //  $result = $link->query($sql);
          if ($result2->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row2 = $result2->fetch_array(MYSQLI_ASSOC)) {
              $bb = $row2["receiver_type"];
              $aa = $row2["thread"];
              //echo  '<a href= "view_thread.php?link='.$row["thread"].' linkname = '.$row["thread"].'"></a>';
            

              ?>
              <form action="view_thread.php" method="post" id="form_new_10">
              
              <input type="hidden" name="rtype" value="<?=$bb?>"/>
              
             
              <?php
              
              echo "<li class='list-group-item'>".$row2["thread"]."</li>";

              echo "<button name='view' value='$aa'>View Thread</button><br>";
              }
            $result2->close();
            echo "</ul>";
          } else {
            echo "No Message from any friend";
          }
          $statement2->close();
          ?>

          </form>

              <!-- echo "<li class='list-group-item'>".$row["thread"]."</li>";
               // $aa = $row["rmail"];
              echo "<button name='view' value='$aa' form='form_new_10'>View Thread</button><br>";
               // $aa = $row["rmail"];
              //echo "<button name='send' value='$aa' form='form_new'>Send</button><br>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Neighborhood members";
          }
          $statement->close();
          ?> -->
                
                <label>Block Members Feed</label>

                   <?php
          $cemail = $_SESSION['email'];   

          $_SESSION['demail'] = $cemail;

          $sql3 = "select mthread as thread, receiver_type from message join (select concat(ufname, ' ', ulname) as name, a.uemail as blockmail from user join (select residents.uemail from residents where residents.neighborhood_id = (select neighborhood_id from residents where uemail = ? ) and residents.block_id = (select block_id from residents where uemail = ?)) a where a.uemail = user.uemail) b where b.blockmail = message.sender_email and receiver_type = '3'";
          $statement3 = $link->prepare($sql3);
          $statement3->bind_param('ss', $cemail, $cemail);
          $statement3->execute();
          $result3 = $statement3->get_result();
          //  $result = $link->query($sql);
          if ($result3->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row3 = $result3->fetch_array(MYSQLI_ASSOC)) {

              $bb = $row3['receiver_type'];
             $aa = $row3["thread"];

             ?>
             <form action="view_thread_bl.php" method="post" id="form_new_11">
              
              <input type="hidden" name="rtype" value="<?=$bb?>"/>
              
             <?php
              //echo  '<a href= "view_thread.php?link='.$row["thread"].' linkname = '.$row["thread"].'"></a>';
              echo "<li class='list-group-item'>".$row3["thread"]."</li>";
               // $aa = $row["rmail"];
              echo "<button name='view' value='$aa'>View Thread</button><br>";
               // $aa = $row["rmail"];
              //echo "<button name='send' value='$aa' form='form_new'>Send</button><br>";
              }
            $result3->close();
            echo "</ul>";
          } else {
            echo "No Message from any block member";
          }
          $statement3->close();
          ?>

</form>
                
                <label>Neighborhood Members Feed</label>

                
   <?php
          $cemail = $_SESSION['email'];   

          $_SESSION['demail'] = $cemail;

          $sql4 = "select mthread as thread, receiver_type from message join (select concat(ufname, ' ', ulname) as name, a.uemail as nmail from user join (select residents.uemail from residents where residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?)) a where a.uemail = user.uemail) b where b.nmail = message.sender_email and receiver_type = '4'";
          $statement4 = $link->prepare($sql4);
          $statement4->bind_param('s', $cemail);
          $statement4->execute();
          $result4 = $statement4->get_result();
          //  $result = $link->query($sql);
          if ($result4->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row4 = $result4->fetch_array(MYSQLI_ASSOC)) {
              $bb = $row4["receiver_type"];
              $aa = $row4["thread"];

              ?>

              <form action="view_thread_bl.php" method="post" id="form_new_11">
              
              <input type="hidden" name="rtype" value="<?=$bb?>"/>

              <?php
              //echo  '<a href= "view_thread.php?link='.$row["thread"].' linkname = '.$row["thread"].'"></a>';
              echo "<li class='list-group-item'>".$row4["thread"]."</li>";
               // $aa = $row["rmail"];
              echo "<button name='view' value='$aa' >View Thread</button><br>";
               // $aa = $row["rmail"];
              //echo "<button name='send' value='$aa' form='form_new'>Send</button><br>";
              }
            $result4->close();
            echo "</ul>";
          } else {
            echo "No Message from any block member";
          }
          $statement4->close();
          ?>












                <!-- <select name="receivertype">
                
                <option value="1">Friends</option>
                  
                <option value="2">Direct Neighbors</option>
                  
                <option value="3">Block Members</option>
                  
                <option value="4">Hood Members</option>
                  
                </select>
                 -->
                </div>
<!-- 
            <div> 
                <label>Thread Name</label>
                <input type="text" name="thread" class="form-control" required>
            </div>
                <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                    <input type="text" name="message" class="form-control" required>
            </div>
           <input type="submit">
           <?php
             // $_SESSION['demail'] = $cemail;
              
          ?> -->

</form>

  </li>

</ul>

      </div>

    </div>
  </div>
  












  <div class="tab-pane fade" id="v-pills-direct" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <div class="row">
      <div class=" col-sm-3 col-md-3">
        <ul class="list-group">
  <li class="list-group-item" aria-disabled="true">
    <?php
          
          $cemail = $_SESSION['email'];
          $_SESSION['kemail'] = $cemail;

    
          $sql ="select residents.uemail as rmail from residents where residents.uemail != ? and residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?) and residents.block_id = (select block_id from residents where uemail = ?) and residents.uemail not in (select uemail_2 from direct_neighbors where uemail_1 = ?)";
          // $sql = "select residents.uemail as rmail from residents where residents.uemail != ? and residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?) and residents.block_id = (select block_id from residents where uemail = ?)";
          // $sql = "select uemail from residents where uemail != ? and neighborhood_id = (select neighborhood_id from residents where uemail = ?)";
          $statement = $link->prepare($sql);
          $statement->bind_param('ssss', $cemail, $cemail, $cemail, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["rmail"]."</li>";
              $aa = $row['rmail'];
              echo "<button name='add' value='$aa' form='form_new_3'>Add</button><br>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Block Member available";
          }
          $statement->close();
?>  </li>
  

</ul>
      </div>

    </div>
  </div>


<div class="tab-pane fade" id="v-pills-block" role="tabpanel" aria-labelledby="v-pills-block-tab">
    <div class="row">
      <div class=" col-sm-3 col-md-3">
        <ul class="list-group">
  <li class="list-group-item" aria-disabled="true">
    <?php
          
          $cemail = $_SESSION['email'];
          $_SESSION['kemail'] = $cemail;

    
          $sql ="WITH temp as(select * from verified join (select verified.applicant_email as amail, verified.neighborhood_id as nid, verified.block_id as bid
from verified join (select apply.applicant_email from apply where apply.neighborhood_id = (select neighborhood_id from residents where residents.uemail = ?) and
apply.block_id = (select block_id from residents where residents.uemail = ?) and apply.applicant_email <> ?) a
where verified.applicant_email = a.applicant_email and (verified.verifieremail_1 IS NULL OR verified.verifieremail_2 IS NULL OR verified.verifieremail_3 IS NULL)) b
where b.amail = verified.applicant_email)
select applicant_email as amail, neighborhood_id as nid, block_id as bid from temp
except
(select applicant_email, neighborhood_id, block_id from temp where verifieremail_1 = ? or verifieremail_2 = ? or verifieremail_3 = ? )";

          $statement = $link->prepare($sql);
          $statement->bind_param('ssssss', $cemail, $cemail, $cemail, $cemail, $cemail, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["amail"]."</li>";
              $aa = $row['amail'];
              $bb = $row['nid'];
              $cc = $row['bid'];
             ?> 
             <form action="blockver.php" method="post" id="form_new_4">
              
              <input type="hidden" name="nid" value="<?=$bb?>"/>
              
              <input type="hidden" name="bid" value="<?=$cc?>"/>
              <?php
              echo "<button name='add' value='$aa'>&#9660;Add</button><br>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Block Member available";
          }
          $statement->close(); 
?>  </li>
  

</ul>
      </div>

    </div>
  </div>





<form action="sendreq.php" method="post" id="form_new">
</form>  
<form action="acceptreq.php" method="post" id="form_new_1">
</form>
<form action="rejectreq.php" method="post" id="form_new_2">
</form>
<form action="adddn.php" method="post" id="form_new_3">
</form>
<!-- <form action="view_thread.php" method="post" id="form_new_10">
</form> -->
<!-- <form action="view_thread_bl.php" method="post" id="form_new_11">
</form> -->
</body>
</html>