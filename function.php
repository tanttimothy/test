<?php
require 'pdo.php';
class User {
	function displayer()
	{
		$sql = "SELECT * FROM tt225.accounts";
		$results = runQuery($sql);
		if(count($results) > 0)
		{
			echo "<table border=\"5\">
			<tr><th>ID</th>
				<th>Email</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Phone</th>
				<th>Gender</th>
				<th>Birthday</th>
				<th>Password</th></tr>";
			foreach ($results as $row) {
				echo "<tr>
						<td>".$row["id"]."</td>
						<td>".$row["email"]."</td>
						<td>".$row["fname"]."</td>
						<td>".$row["lname"]."</td>
						<td>".$row["phone"]."</td>
						<td>".$row["gender"]."</td>
						<td>".$row["birthday"]."</td>
						<td>".$row["password"]."</td>
					</tr>";
			}
		}
		else{
		    echo '0 results';
		}
	}
	function remover($email)
	{	
		$this->email = $email;
		$sql = "DELETE FROM tt225.accounts WHERE email = ".$this->email;
		$results = runQuery($sql);
	}
	function adder($email, $fname, $lname, $phone, $birthday, $gender, $password)
	{
		$sql = "INSERT INTO tt225.accounts (email, fname, lname, phone, birthday, gender, password) VALUES ('$email', 
		'$fname', '$lname', '$phone', '$birthday', '$gender', '$password')";
		$results = runQuery($sql);
	}
	function updater($email, $password)
	{
		$this->email = $email;
		$this->password = $password;
		$sql = "UPDATE tt225.accounts SET password = ".$this->password." where email = ".$this->email;
		$results = runQuery($sql);
	}
}
$person = new User;
$person->updater('ttan@pd.technology', 'yes');
$person->remover('ttan@pd.technology');
$person->adder('ttan@pd.technology', 'Timothy', 'Tan', '123-456-7890', '1997-02-24', 'male', '1337');

$person->displayer();
?>