<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
<?php
          session_start();
          $cemail = $_SESSION['email'];
           $sql = "select concat(ufname, ' ', ulname) as name from user join direct_neighbors where direct_neighbors.uemail_1 = ? and direct_neighbors.uemail_2 = user.uemail";
          // $sql = "select uemail_2 from direct_neighbors where uemail_1 = ?";
          $statement = $link->prepare($sql);
          $statement->bind_param('s', $cemail);
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
            echo "No Direct Neighbor Added";
          }
          $statement->close();
          // $link->close();
?>
</body>
</html>