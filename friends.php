<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
<?php     
          session_start();
          $cemail = $_SESSION['email'];
         
          $sql = "select concat(ufname, ' ', ulname) as name from user join friends where (friends.uemail_1 = ? and friends.uemail_2 = user.uemail) 
          union select concat(ufname, ' ', ulname) as name from user join friends where (friends.uemail_2 = ? and friends.uemail_1 = user.uemail) ";
          $statement = $link->prepare($sql);
          $statement->bind_param('ss', $cemail, $cemail);
          $statement->execute();
          $result = $statement->get_result();
          //  $result = $link->query($sql);
          if ($result->num_rows > 0) {
          echo "<ul class='list-group'>";
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
              echo " <li class='list-group-item'>".$row["name"]."</li>";
              }
            $result->close();
            echo "</ul>";
          } else {
            echo "No Friends Available";
          }
          $statement->close();
          // $link->close();
?>
</body>
</html>