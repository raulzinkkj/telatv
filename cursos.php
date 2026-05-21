<?php
include 'conexao/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_professor = $_POST['id_professor'];
    $nome_curso = $_POST['nome_curso'] ?? null;
    $sigla_curso = $_POST['sigla_curso'] ?? null;
    $hora_inicio_curso = $_POST['hora_inicio_curso'] ?? null;
    $hora_fim_curso = $_POST['hora_fim_curso'] ?? null;

    $sql_curso = "INSERT INTO cursos (id_professor, nome_curso, sigla_curso, hora_inicio_curso, hora_fim_curso)
            VALUES (:id_professor, :nome_curso, :sigla_curso, :hora_inicio_curso, :hora_fim_curso)";

    $stmt_curso = $conexao->prepare($sql_curso);
    $stmt_curso->bindParam(':id_professor', $id_professor);
    $stmt_curso->bindParam(':nome_curso', $nome_curso);
    $stmt_curso->bindParam(':sigla_curso', $sigla_curso);
    $stmt_curso->bindParam(':hora_inicio_curso', $hora_inicio_curso);
    $stmt_curso->bindParam(':hora_fim_curso', $hora_fim_curso);
    $stmt_curso->execute();
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

        input, select {
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
        <h2>Cadastro de Cursos</h2>
    </header>
    <div class="container">
        <div class="topo">
            <button onclick="calendario()">Voltar para geração de calendário</button>
            <button onclick="professores()">Gerenciar professores</button>
            <h2>Novo Curso</h2>
        </div>
        <form action="" method="post">
            <label for="id_professor">Professor</label>
            <select name="id_professor" id="">
                <option value="">Selecione um Professor</option>
                <?php
                    $sql_busca = "SELECT * FROM professores";
                    $stmt_busca = $conexao->prepare($sql_busca);
                    $stmt_busca->execute();
                    while ($professor = $stmt_busca->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$professor['id_professor']}'>{$professor['nome_professor']}</option>";
                    }
                ?>
            </select>

            <label for="nome_curso">Nome do Curso</label>
            <input type="text" name="nome_curso" id="">

            <label for="sigla_curso">Sigla do Curso</label>
            <input type="text" name="sigla_curso" id="">

            <label for="hora_inicio_curso">Hora Início</label>
            <input type="time" name="hora_inicio_curso" id="">

            <label for="hora_fim_curso">Hora Fim</label>
            <input type="time" name="hora_fim_curso" id="">

            <button type="submit">Cadastrar Curso</button>
        </form>
    </div>
    <script>
         function professores() {
            window.location.href = "professor.php";
        }

        function calendario() {
            window.location.href = "index.php";
        }
    </script>
</body>

</html>