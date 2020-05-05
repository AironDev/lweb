<?php require "partials/header.php"; 
    $term = $_GET['term'];
    $search = [':term' => $term, '%'];

    $stmt = $pdo->prepare('SELECT name FROM Institution WHERE name LIKE :term');
    $stmt->execute($search);
    $retval = array();

    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    $retval[] = $row['name'];}

    echo(json_encode($retval));
?>