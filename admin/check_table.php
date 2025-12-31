<?php
$conn = mysqli_connect('localhost', 'root', '', 'sspsof5_tdspt2');
$result = mysqli_query($conn, 'DESCRIBE tour_packages');
echo "tour_packages table columns:\n\n";
while($row = mysqli_fetch_assoc($result)) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
mysqli_close($conn);
?>
