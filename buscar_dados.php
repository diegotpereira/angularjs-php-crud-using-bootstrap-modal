<?php

include('database_conexao.php');

$query = "SELECT * FROM tb_unica ORDER BY id";

$statement = $connect->prepare($query);

if ($statement->execute()) {
    # code...
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        # code...
        $data[] = $row;
    }
    echo json_encode($data);
}
?>