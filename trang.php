<!--Nguyen Van Thien Tam - 25IT176-->
<?php
$conn = mysqli_connect("localhost", "root", "", "phantrang", 3307);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}
mysqli_query($conn, "SET NAMES 'utf8'");
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page = intval($_GET['page']);
} else {
    $page = 1;
}

$limit = 3; //page limit
$start = ($page - 1) * $limit; 

$result_all = mysqli_query($conn, "SELECT * FROM tintuc");
$total_title = mysqli_num_rows($result_all);

$total_page = ceil($total_title / $limit);

$query = "SELECT * FROM tintuc LIMIT $start, $limit";
$result = mysqli_query($conn, $query);

echo "<div class=\"title\">";
while ($row = mysqli_fetch_array($result)) {
    echo '<a href="#">' . $row['id'] . '. ' . $row['title'] . '</a><br />';
}
echo "</div>";

echo "<div class=\"pagination\" style=\"margin-top: 15px;\">";
for ($i = 1; $i <= $total_page; $i++) {
    if ($i == $page) {
        echo '<strong style="color: red; margin: 0 5px;">' . $i . '</strong> | ';
    } else {
        echo '<a href="trang.php?page=' . $i . '" style="margin: 0 5px;">' . $i . '</a> | ';
    }
}
echo "</div>";
?>
<style>
body{
  background: #ecf0f1;
  font-family: Arial, sans-serif; 
}
a:link, a:visited{
    text-decoration: none;
}
a:hover{
    color: #f00;
}

.title, .pagination{
  width: 600px;
  margin: 0 auto;
  margin-bottom: 20px;
}

.title{
  background: #3498db;
  padding: 20px;
  line-height: 1.8;
  border-radius: 6px; 
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.title a{
  color: #fff;
  display: block;
  padding: 4px 0;
  transition: color 0.2s ease;
}
.title a:hover{
  color: #e67e22;
}


.pagination {
  text-align: center;
  padding: 10px;
  background: #fff;
  border-radius: 6px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.05);
}

.pagination a, .pagination strong {
  display: inline-block;
  padding: 6px 12px;
  margin: 0 2px;
  background: #e0e6ed;
  color: #2c3e50;
  border-radius: 4px;
  font-weight: bold;
  transition: background 0.2s;
}

.pagination a:hover {
  background: #3498db;
  color: #fff;
}

.pagination strong {
  background: #e67e22; 
  color: #fff;
}
</style>
