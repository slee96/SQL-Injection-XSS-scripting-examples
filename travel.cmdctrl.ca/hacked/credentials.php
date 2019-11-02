$conn = new mysqli('mysql_net', 'root', 'toor', 'iss');

if (!$conn) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}else{
    #echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
}
?>

