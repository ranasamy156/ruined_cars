<?php
$dsn = 'mysql:host=localhost;dbname=cars;charset=utf8';  // data source name
$user = 'root';
$pass = '';

try {
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES,TRUE);
} catch (PDOException $e) {
    echo 'failed '.$e->getMessage();
}
        // $typeID = $_SESSION['type_id'];
        // $userID = $_SESSION['id'];
        // $mapQuery = "CALL getAmanaUsers(? , ?)";
        // $stmt1 = $conn->prepare($mapQuery);
        // $stmt1->bindParam(1, $typeID, PDO::PARAM_INT);
        // $stmt1->bindParam(2, $userID, PDO::PARAM_INT);
        // $stmt1->execute();
        // $rowmap = $stmt1->fetchAll();
        // print_r($rowmap);

?>