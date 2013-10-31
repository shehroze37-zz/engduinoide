<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Search Form</title>

<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>

</head>

<body>

<h1>Search here please!</h1>
<p>Enter email address to search for user</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Email <input type="text" name="search_email" id="search_email"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "bd1be8c460144a";
    $pwd = "c672e99d";
    $db = "engduinoide";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info
    if(!empty($_POST)) {

		$search_email = $_POST['search_email'] ;

		$sql_select = "SELECT * FROM registration_tbl WHERE email LIKE '%$search_email%'";
		
		
		$stmt = $conn->query($sql_select);
		$registrants = $stmt->fetchAll(); 
		if(count($registrants) > 0) {
			echo "<h2>A record exists with this email !</h2>";
			echo "<table>";
			echo "<tr><th>Name</th>";
			echo "<th>Email</th>";
			echo "<th>Date</th>";
			echo "<th>Company Name</th></tr>";
			foreach($registrants as $registrant) {
				echo "<tr><td>".$registrant['name']."</td>";
				echo "<td>".$registrant['email']."</td>";
				echo "<td>".$registrant['date']."</td>";
				echo "<td>".$registrant['company_name']."</td></tr>";
			}
			echo "</table>";
		} else {
			echo "<h3>No one is currently registered with that email address !</h3>";
   		 }
	}
?>


</body>
</html>