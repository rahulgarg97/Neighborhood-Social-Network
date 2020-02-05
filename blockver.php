<?php include "header.php" ?>
</head>
<body>
<?php include "nav.php" ?>
<?php
	session_start();
    $cemail = $_SESSION['email'];
    $amail = $_POST['add'];
    $nid = $_POST['nid'];
    $bid = $_POST['bid'];
    echo $amail;
    echo $nid;
    echo $bid;
    $sql1 = "SELECT applicant_email from verified where applicant_email = ? and verifieremail_1 is null";
    $statement1 = $link->prepare($sql1);
    $statement1->bind_param('s', $amail);
    $statement1->execute();
    $result1 = $statement1->get_result();


    $sql2 = "SELECT applicant_email from verified where applicant_email = ? and verifieremail_2 is null";
	$statement2 = $link->prepare($sql2);
    $statement2->bind_param('s', $amail);
    $statement2->execute();
    $result2 = $statement2->get_result();


    $sql3 = "SELECT applicant_email from verified where applicant_email = ? and verifieremail_3 is null";
    $statement3 = $link->prepare($sql3);
    $statement3->bind_param('s', $amail);
    $statement3->execute();
    $result3 = $statement3->get_result();


    if ($result1->num_rows > 0) 
    {
    	$sql4 = "CALL startverify_1(?,?)";
        $stmt4 = $link->prepare($sql4);
        $stmt4->bind_param('ss', $amail, $cemail);        
        $stmt4->execute();
        $stmt4->close(); 
     	goto abc;
    }
 		
    $result1->close();
    $statement1->close();

	if($result2->num_rows > 0)
	{
       $sql5 = "CALL startverify_2(?,?)";
       $stmt5 = $link->prepare($sql5);
       $stmt5->bind_param('ss', $amail, $cemail);        
       $stmt5->execute();
       $stmt5->close();
       goto abc;

    }
    $result2->close();
    $statement2->close();

    if($result3->num_rows > 0)
	{
       $sql6 = "CALL startverify_3(?,?,?,?)";
       $stmt6 = $link->prepare($sql6);
       $stmt6->bind_param('ssii', $amail, $cemail, $nid, $bid);        
       $stmt6->execute();
       $stmt6->close();
       goto abc;

    }
    $result3->close();
    $statement3->close();
    abc:

    header('refresh:3; url=home.php');
	echo "You have verified this user";
	echo "<br>";
	echo "You will be redirected to home page in 3 seconds";
  
             ?>
         </body>
         </html>