<?php

include 'conexao.php';

// Verificar se os dados foram enviados
if (isset($_POST['nome'], $_POST['email'], $_POST['mensagem'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    // Preparar a instrução SQL com placeholders
    $sql = "INSERT INTO ideia (nome, email, mensagem) VALUES (?, ?, ?)";

    // Preparar a consulta
    $stmt = mysqli_prepare($conn, $sql);

    // Verifique se a preparação foi bem-sucedida
    if ($stmt) {
        // Associar os parâmetros e executar a consulta
        mysqli_stmt_bind_param($stmt, "sss", $nome, $email, $mensagem);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: index.html");
            exit();
        } else {
            echo "Você não foi não cadastrado: " . mysqli_stmt_error($stmt);
        }

        // Fechar a declaração
        mysqli_stmt_close($stmt);
    } else {
        // Exibir o erro de preparação para depuração
        echo "Erro ao preparar a consulta: " . mysqli_error($conn);
    }
} else {
    echo "Dados não recebidos.";
}

// Fechar a conexão com o banco de dados
mysqli_close($conn);

