<?php
// server info
$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'maintenance';

// connect to the database
$link = mysqli_connect($server, $user, $pass, $db);
// show errors (remove this line if on a live site)
mysqli_report(MYSQLI_REPORT_ERROR);
?>

<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
<?php
$array_options=array("Yes","No","Yes","No","Yes","No","Yes","No","Yes","No"); //example set of options
// get database rows
if ($result = $link->query("SELECT * FROM maintenance ORDER BY maint_id"))
{
if ($result->num_rows > 0)
{
// set select box
echo '<select name="drop_down">';
for ($i = 0; $row = $result->fetch_object(); $i++) {
  $current_value = $row->maint_item; //$row is your array from the table, field_name is the column
  if($current_value==$array_options[$i]) $selected="selected";
  else $selected="";
  echo "<option value=" . $array_options[$i], $selected . ">" . $row->maint_item . "</option>";  //html quotes are escaped
  // this would have made more sense to me (echo '<option value="'. $row->maint_id .'">' . $row->maint_item . '</option>';) but I was tring to figure out exactly what your after
}
echo "</select><br><br>";
}
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $link->error;
}
// close database connection
$link->close();
?>
</body>
</html>
