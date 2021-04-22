<?php

include ('database_conexao.php');

$form_data = json_decode(file_get_contents("php://input"));

$error = '';
$message = '';
$valida_erro = '';
$nome = '';
$sobrenome = '';

if ($form_data->action == 'buscar_unico_dado') {
    # code...

    $query = "SELECT * FROM tb_unica WHERE id='".$form_data->id."'";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach ($result as $row){
        $output['nome'] = $row['nome'];
        $output['sobrenome'] = $row['sobrenome'];
    }
} 
elseif ($form_data->action == "Delete") 
{
    # code...
    $query = " DELETE FROM tb_unica WHERE id='".$form_data->id."'";
    $statement = $connect->prepare($query);

    if ($statement->execute()) {
        # code...
        $output['message'] = 'Dado Deletado';
    } 

}   
else 
{
    # code...

    if (empty($form_data->nome)) 
    {
        # code...
        $error[] = 'O primeiro nome é necessário';
    } 
    else 
    {
        # code...
        $nome = $form_data->nome;
    }
    if (empty($form_data->sobrenome)) 
    {
        # code...
        $error [] = 'O sobrenome nome é necessário';
    } 
    else 
    {
        # code...
        $sobrenome = $form_data->sobrenome;
    }

    if (empty($error)) 
    {
        # code...
        if ($form_data->action == 'Insert') {
            # code...
            $data = array(
                ':nome' => $nome,
                ':sobrenome' => $sobrenome
            );

            $query = "INSERT INTO tb_unica (nome, sobrenome) VALUES (:nome, :sobrenome)";

            $statement = $connect->prepare($query);

            if ($statement->execute($data)) 
            {
                # code...
                $message = 'Dados Inseridos';
            }
        }
        if ($form_data->action == 'Edit') 
        {
            # code...
            $data = array(
                ':nome' => $nome,
                ':sobrenome' => $sobrenome,
                ':id' => $form_data->id
            );
            $query = "UPDATE tb_unica SET nome = :nome, sobrenome = :sobrenome WHERE id =:id";
            $statement = $connect->prepare($query);

            if ($statement->execute($data)) 
            {
                # code...
                $message = 'Dados Editados';
            }
        }
    } 
    else 
    {
        # code...
        $valida_erro = implode(", ", $error);
    }

    $output = array(
    'error'		=>	$valida_erro,
    'message'	=>	$message
    );

}

echo json_encode($output);

?>