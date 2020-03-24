<?php
require('pdo.php');
session_start();
if (isset($_POST['delete'])) {
	$sql="DELETE FROM `profile` WHERE  profile_id=:id";
	$stmt=$pdo->prepare($sql);
	$stmt->execute(array(':id' =>$_POST['profile_id']));
	$_SESSION['success'] = 'Record deleted';
	header( 'Location: index.php' ) ;
	return;
}
$stmt = $pdo->prepare("SELECT * FROM profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['err'] = 'Bad value for id';
    header( 'Location: index.php' ) ;
    return;
}
  ?>
<!DOCTYPE html>
<html>
<head>
<title>Dr. Chuck's Profile Add</title>

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>Deleteing Profile</h1>
<form method="post" action="delete.php">
<p>First Name:<?=$row['first_name']?>
</p>
<p>Last Name:<?= $row['last_name']?>
</p>
<input type="hidden" name="profile_id"
value="<?=$_GET['profile_id']?>"
/>
<input type="submit" name="delete" value="Delete">
<input type="submit" name="cancel" value="Cancel">
</p>
</form>
</div>
</body>
</html>