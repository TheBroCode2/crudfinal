<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
<a href="projectlist.php">Projectlist</a>
<?php
// filmlist.php?cid=2
$pid = filter_input(INPUT_GET, 'pid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

require_once 'dbcon.php';
$sql = 'SELECT p.name, p.description, p.start_date, p.end_date, c.Client_id, c.name from project p, client c
where p.project_id = ?
AND c.client_id=p.client_client_id';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($pnam, $pdesc, $pstart, $pend, $cid, $cnam);

while($stmt->fetch()) {	
}
?>

<h1> <?=$pnam?> </h1>
<ul>
<?php
echo '<li>Project Name <br>'.$pnam.'</li>';
echo '<li>Project Description <br>'.$pdesc.'</li>';
echo '<li>Project Start <br>'.$pstart.'</li>';
echo '<li>Project End <br>'.$pend.'</li>';
echo '<li>Client ID <br>'.$cid.'</li>';
echo '<li>Client <br><a href="clientinf.php?cid='.$cid.'">'.$cnam.'</a></li>';
?>
</ul>
<h1>Resources in project </h1> 
<?php 


require_once 'dbcon.php';
$sql = 'SELECT r.r_name, r.resource_id, Hourly_Usage_Rate
FROM resource r, project p, resource_has_project rp
WHERE p.project_id = ?
AND p.project_id = rp.project_project_id
AND r.resource_id = rp.resource_resource_id';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $pid);
$stmt->execute();
$stmt->bind_result($rnam, $rid, $rhu);
while($stmt->fetch()) {	
echo '
<li><a href="resource.php?rid='.$rid.'"> '.$rnam.'<br>Hourly Usage Rate '.$rhu.' hours <br><br><br> </a></li>';
}
?>
































<br>
<hr>



<h1>Add Resource to Project</h1>
<form method="post">
	<select name="rid">
    <?php
$sql = 'select resource_id, r_name, t.r_type_name
from resource, type_code t
WHERE r_type_code = type_code_r_type_code';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($rid, $rnam, $tynam);
while ($stmt->fetch()) {
	echo '<option value='.$rid.'">'.$rnam.' ('.$tynam.')</option>'.PHP_EOL;
}
?>
	<h2>Start Dato</h2>
	<input type="date" name="start">
    <h2>Slut Dato</h2>
    <input type="date" name="end">
    <h2>Hourly Usage Rate</h2>
    <input type="number" name="hur">
    <input type="submit" name="add">
</form>

<?php
$rstart = filter_input(INPUT_POST, 'start');
$rend = filter_input(INPUT_POST, 'end');
$hur = filter_input(INPUT_POST, 'hur');
$rid = filter_input(INPUT_POST, 'rid');
if (isset($_POST['add'])) {
$sql = 'INSERT INTO resource_has_project
VALUES (?, ?, ?, ?, ?)';
$stmt = $link->prepare($sql);
$stmt->bind_param('iissi', $rid, $pid, $rstart, $rend, $hur);
$stmt->execute();
}
?>






<!--- DELETE -->












<hr>
<h1>Delete Resource From Project</h1>

<form method="post">
	<select name="dak">
    <?php
$sql = 'select resource_id, r_name, t.r_type_name
from resource, type_code t
WHERE r_type_code = type_code_r_type_code';
$stmt = $link->prepare($sql);
$stmt->execute();
$stmt->bind_result($rid, $rnam, $tynam);
while ($stmt->fetch()) {
	echo '<option value='.$rid.'">'.$rnam.' ('.$tynam.')</option>'.PHP_EOL;
}

?>
<input type="submit" name="delres">
</select>
</form>

<?php
$rid = filter_input(INPUT_POST, 'dak');
if (isset($_POST['delres'])) {
$sql = 'DELETE FROM resource_has_project
WHERE Resource_Resource_ID = ?';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $rid);
$stmt->execute();
}


?>









<hr>
<h1>Update Project Description</h1>

<!-- update -->

<form method="post">

<input name="pdesc" type="text">
<input type="submit" name="update" value="Update">
</form>
<?php 


if (isset($_POST['update'])) {
$pdesc = filter_input(INPUT_POST, 'pdesc');
$sql = 'UPDATE project p
SET p.description = ?
WHERE p.project_id = ?';
$stmt = $link->prepare($sql);
$stmt->bind_param('si', $pdesc, $pid);
$stmt->execute();
}
?>











</body>
</html>