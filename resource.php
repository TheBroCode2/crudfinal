<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <a href="http://nikolajdommergaard.dk/crudbckup/resourcelist.php"><h1>Back To The Resourcelist</h1></a>
    <hr>
<?php 
$rid = filter_input(INPUT_GET, 'rid', FILTER_VALIDATE_INT) or die('Missing/illegal parameter');

require_once 'dbcon.php';
$sql = 'SELECT r.r_name, r.resource_detail, t.r_type_name
FROM resource r, type_code t
WHERE r.resource_id = ?
AND R_type_code = type_code_r_type_code';
$stmt = $link->prepare($sql);
$stmt->bind_param('i', $rid);
$stmt->execute();
$stmt->bind_result($rnam, $rdt, $rtype);
while($stmt->fetch()) {	

}
?>



<h1>Information om resourcen</h1>
<ul>
<?php 
echo '<li> '.$rdt.' </li>';
echo '<li> '.$rnam.' </li>';
echo '<li> '.$rtype.' </li>';
?>




<ul>

</body>
</html>