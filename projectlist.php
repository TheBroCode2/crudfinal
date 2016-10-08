<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" type="text/css" href="animate.css">
</head>

<body>

<h1 class="animated fadeInDown">Project list</h1>
<h2>Open a project to, Update project description, add resource to project<br> or Delete a resource from the project</h2></h2>

<ul class="animated fadeInUp">

<?php
require_once 'dbcon.php';

$sql = 'SELECT Project_ID, Name
FROM project';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($pid, $pnam);

while($stmt->fetch()) {
	echo '<li><a href="project.php?pid='.$pid.'">'.$pnam.'</a></li>'.PHP_EOL;
}


?>
</ul>
<hr>
<a href="http://nikolajdommergaard.dk/crudbckup/resourcelist.php"><h1>Resource list with create resource function</h1></a>
</body>
</html>