<?php include "header.php" ?>
<style type="text/css">
  .list-group {padding-top: 20px;}
</style>
</head>
<body>
//<?php include "nav.php" ?>

<div class="container nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Incoming Friend Requests</a>
  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">send Friend Requests</a>
  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
  <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Add Direct neighbors</a>

<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Incoming Block Requests</a>
  


</div>
<div class="tab-content" id="v-pills-tabContent">
  <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
  	<div class="row">
  		<div class="col-sm-2 col-md-2">
  			<ul class="list-group">
  <li class="list-group-item" aria-disabled="true"></li>

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
          session_start();
          $cemail = $_SESSION['email'];   

          $_SESSION['demail'] = $cemail;

          //$cemail = "alex.gordon97@gmail.com";
          $sql = "select residents.uemail as rmail from residents where residents.uemail != ? and residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?)";
          // $sql = "select uemail from residents where uemail != ? and neighborhood_id = (select neighborhood_id from residents where uemail = ?)";
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
  <?php
          $cemail = "shrutika19newyork@gmail.com";
          $sql = "select inbox.sender_email, inbox.mthread, inbox.msubject, inbox.mtext as message, inbox.mtimestamp from inbox join (select residents.uemail from residents join (select block_id, uemail from residents where uemail = ?) a where a.block_id = residents.block_id and residents.uemail <> a.uemail) b where receiver_email = ? and sender_email = b.uemail and inbox.mtimestamp >= (select logs.ltimestamp from logs join (select logs.ltimestamp from logs where uemail = ? order by ltimestamp desc limit 1) q where q.ltimestamp > logs.ltimestamp order by logs.ltimestamp desc limit 1);";
          // $sql = "select uemail from residents where uemail != ? and neighborhood_id = (select neighborhood_id from residents where uemail = ?)";
          $statement = $link->prepare($sql);
          $statement->bind_param('sss', $cemail, $cemail, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["message"]."</li>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Block Member available";
          }
          $statement->close();
?>  
  </li>
  <li><p>hey <p> by sender name</p></p></li>
  <form><input type="text" name=""></form>
</ul>

  		</div>

  	</div>
  </div>
  <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab"><div class="row">
  		<div class="col-sm-3 col-md-3">
  			<ul class="list-group">
  <li class="list-group-item" aria-disabled="true"><?php
          $cemail = "alex.gordon97@gmail.com";
          $sql = "select residents.uemail as rmail from residents where residents.uemail != ? and residents.neighborhood_id = (select neighborhood_id from residents where uemail = ?) and residents.block_id = (select block_id from residents where uemail = ?)";
          // $sql = "select uemail from residents where uemail != ? and neighborhood_id = (select neighborhood_id from residents where uemail = ?)";
          $statement = $link->prepare($sql);
          $statement->bind_param('sss', $cemail, $cemail, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["rmail"]."</li>";
              echo "<button>add</button><br>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Block Member available";
          }
          $statement->close();
?></li>
  
</ul>
  		</div></div>
</div>
<form action="sendreq.php" method="post" id="form_new">
<form action="acceptreq.php" method="post" id="form_new_1">
</form>
</body>
</html>