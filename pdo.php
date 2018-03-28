<?php
$hostname = "sql2.njit.edu";
$username = "tt225";
$password = "scapula44";
$dbName = "tt225";
$conn = NULL;
try 
{
    $conn = new PDO("mysql:host=$hostname;dbname=$dbName",
    $username, $password);
    echo 'Connected Successfully'.'<br>';
}
catch(PDOException $e)
{
	// echo "Connection failed: " . $e->getMessage();
	http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
}
// Runs SQL query and returns results (if valid)
function runQuery($query) {
	global $conn;
    try {
		$q = $conn->prepare($query);
		$q->execute();
		$results = $q->fetchAll();
		$q->closeCursor();
		return $results;	
	} catch (PDOException $e) {
		http_error("500 Internal Server Error\n\n"."There was a SQL error:\n\n" . $e->getMessage());
	}	  
}
function http_error($message) 
{
	header("Content-type: text/plain");
	die($message);
}
$sql = "select id,email,fname,lname,password from tt225.accounts where id < 6;  ";
$results = runQuery($sql);
if(count($results) > 0)
{
	echo "<table border=\"1\"><tr><th>ID</th><th>Email</th><th>First Name</th><th>Last Name</th><th>Pass</th></tr>";
	foreach ($results as $row) {
		echo "<tr><td>".$row["id"]."</td><td>".$row["email"]."</td><td>".$row["fname"]."</td><td>".$row["lname"]."</td><td>".$row["password"]."</td></tr>";
	}
	echo 'Number of results: '.count($results);
}else{
    echo 'No results';
}
?>