<?php
try {
		$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}



$not_solved = "0";

$query =$pdo->prepare("SELECT * FROM `karolos`.`spots`  WHERE solved=:solved;");
$query->bindParam(':solved', $not_solved, PDO::PARAM_INT);
$query->execute();
$num_of_unsolved = $query->rowCount();

$query1 =$pdo->prepare("SELECT * FROM `karolos`.`spots`");
$query1->execute();
$num_spots = $query1->rowCount();

$query2 =$pdo->prepare("SELECT * FROM `karolos`.`spots`  WHERE solved<>:solved;");
$query2->bindParam(':solved', $not_solved, PDO::PARAM_INT);
$query2->execute();
$num_of_solved = $query2->rowCount();

$query3 =$pdo->prepare("SELECT * FROM `karolos`.`spots`  WHERE solved<>:solved;");
$query3->bindParam(':solved', $not_solved, PDO::PARAM_INT);
$query3->execute();
$num_of_solved1 = $query3->rowCount();
$results = $query3->fetchAll( PDO::FETCH_ASSOC );

foreach( $results as $row ) {


$created = strtotime($row['created_at']);
    $updated = strtotime($row['updated_at']);
    $time = $time + ($updated - $created);
}

 //$temp_av = $time / $num_of_solved1;


 $average_time = $time / $num_of_solved1 ;



$a = gmdate('m-d H:i:s',$average_time);

$results = array(
	'spots'		=> $num_spots,
	'solved'	=> $num_of_solved,
	'unsolved'	=> $num_of_unsolved,
	'average'	=> $a
);

echo json_encode($results);
		

?>