<?php
define('DB_SERVER', 'panther.cs.middlebury.edu');
define('DB_USERNAME', 'dsilver');
define('DB_PASSWORD', 'dsilver122193');
define('DB_DATABASE', 'dsilver_EventsCalendar');

$keyword = $_GET["event"];
$con = mysqli_connect (DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE) or die("Could not connect.");

$search_results = mysqli_query($con, "SELECT * FROM Events WHERE title LIKE '%$keyword%' ORDER BY event_date DESC");

$search_array = array();
while ($row = mysqli_fetch_array($search_results, MYSQLI_ASSOC)) {
  $search_array[] = $row;
}

mysqli_close($con);

?>
<!DOCTYPE html>
<html>
<?php
$title = "Midd Events";
include "templates/includes/head.php"
?>

<body>
<div class="container">
  <h2>Results</h2>

  <ul>
  <?php
  foreach ($search_array as $event) {
  ?>
  <li>
    <a href="event.php?event=<?php echo $event['id'] ?>">
      <?php $phpdate = strtotime($event['event_date']) ?>

      <strong><?php echo date('M j, Y', $phpdate) ?></strong>
      &nbsp;<?php echo $event['title'] ?>
    </a>
  </li>
  <?php
  }
  ?>
  </ul>

</div>

</html>