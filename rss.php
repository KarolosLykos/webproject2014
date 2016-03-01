        <LINK REL="SHORTCUT ICON"
        href = "https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQlxhhjNyGGMVYJTJOX4hDwA6L1Hq6sxI7vXGZYP3Hg77v_0J7r">
<?php
try {
		$pdo = new PDO('mysql:host=localhost;dbname=karolos;charset=utf8', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

$myFile = "rss.xml";
$fh = fopen($myFile, 'w') or die("can't open file");
$rss_txt ='';
$rss_txt .= '<?xml version="1.0" encoding="utf-8"?>';
$rss_txt .= "<rss version='2.0'>";
$rss_txt .= '<channel>';
$rss_txt .='<title>karolos.upatras.gr</title>';
$rss_txt .='<link>localohost/karolos/rss.php</link>';
$rss_txt .='<description>Latest Reports</description>';


$query =$pdo->prepare("SELECT * FROM `karolos`.`spots` ORDER BY created_at DESC LIMIT 0,20");
$query->execute();
$results1 = $query->fetchAll( PDO::FETCH_ASSOC );

foreach( $results1 as $row )
 {
		$id				=$row['id'];
        $rss_txt .= '<item>';

        $rss_txt .= '<title>' .$row['created_at']. '</title>';
        $rss_txt .= '<link>http://localhost/report_profile.php?id='.$id.'</link>';
        $rss_txt .= '<description>' .$row['title']. '</description>';
        $rss_txt .= '<description>' .$row['area']. '</description>';
        $rss_txt .= '<description>' .$row['user_id']. '</description>';
        $rss_txt .= '</item>';

        
    }
$rss_txt .= '</channel>';
$rss_txt .= '</rss>';
	

fwrite($fh, $rss_txt);
fclose($fh);
header('Location: rss.xml');
?>
 
 
