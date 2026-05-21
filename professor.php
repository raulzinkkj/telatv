<?php
include 'conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_professor = $_POST['nome_professor'] ?? null;
    $apelido_professor = $_POST['apelido_professor'] ?? null;
    $telefone_professor = $_POST['telefone_professor'] ?? null;
    $email_professor = $_POST['email_professor'] ?? null;

    $sql_professor = "INSERT INTO professores (nome_professor, apelido_professor, telefone_professor, email_professor)
            VALUES (:nome_professor, :apelido_professor, :telefone_professor, :email_professor)";

    $stmt_professor = $conexao->prepare($sql_professor);
    $stmt_professor->bindParam(':nome_professor', $nome_professor);
    $stmt_professor->bindParam(':apelido_professor', $apelido_professor);
    $stmt_professor->bindParam(':telefone_professor', $telefone_professor);
    $stmt_professor->bindParam(':email_professor', $email_professor);
    $stmt_professor->execute();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        header {
            height: 70px;
            padding: 15px 20px;
            width: 100%;
            background: #00004d;
            color: white;
            font-weight: bold;
        }

        body {
            display: flex;
            background: #f3f6fc;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container {
            display: flex;
            flex-direction: column;
            border-radius: 20px;
            background: white;
            height: 100vh;
            width: 1200px;
            margin: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 3px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 13px;

        }

        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        .linha {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        form {
            width: 100%;
        }

        .linha>div {
            flex: 1;
        }

        button {
            background: #00004d;
            padding: 8px 10px;
            border-radius: 5px;
            border: none;
            color: white;
            font-weight: bold;
            margin-top: 10px;
        }

        .topo h2 {
            margin: 10px 0px 10px 0px;
            font-size: 2rem;
        }

    </style>
</head>

<body>
    <header>
        <h2>Cadastro de Professores</h2>
    </header>
    <div class="container">
        <div class="topo">
            <button onclick="cursos()">Voltar para cursos</button>
            <h2>Novo Professor</h2>
        </div>
        <form action="" method="post">
            <label for="nome_professor">Nome completo</label>
            <input type="text" name="nome_professor" id="">

            <div class="linha">
                <div>
                    <label for="apelido_professor">Apelido (como aparece no calendário)</label>
                    <input type="text" name="apelido_professor" placeholder="Ex: Elcio, Amanda, João">
                </div>
                <div>
                    <label for="telefone_professor">Telefone</label>
                    <input type="number" name="telefone_professor" placeholder="(42) 9 9999-9999">
                </div>
            </div>
            <label for="email_professor">E-mail</label>
            <input type="email" name="email_professor" placeholder="prof@gmail.com">

            <button type="submit">Cadastrar Professor</button>
        </form>
    </div>

    <script>
         function cursos() {
            window.location.href = "cursos.php";
        }
    </script>
</body>

</html>