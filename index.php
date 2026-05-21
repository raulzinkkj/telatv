<?php

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
            height: 100px;
            padding: 20px 30px;
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: #00004d;
            color: white;
        }

        #tv-clock {
            font-size: 3rem;
            font-weight: bold;
        }

        #tv-date {
            font-weight: bold;
        }

        button {
            padding: 10px;
            background: #2310c5;
            border-radius: 5px;
            border: none;
            color: white;
            font-weight: bold;
        }

        footer {
            display: flex;
            justify-content: center;
            position: fixed;
            bottom: 0;
            padding: 10px;
            width: 100%;
            background: #00004d;
            color: white;
        }

        .container {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 20px;
            padding: 20px;
            height: calc(100vh - 150px);
        }

        .agenda,
        .alertas,
        .proximas {
            background: #170a9d;
            height: 100%;
        }

        .agenda {
            border-radius: 20px 0px 0px 20px;

        }

        .proximas {
            border-radius: 0px 20px 20px 0px;
        }

        h3 {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .aula {
            background: white;
            border-radius: 8px;
            margin: 20px;
            padding: 15px;
            border-left: 10px solid #ffd900;
        }

        h1 {
            font-size: 1.9rem;
        }
    </style>
</head>

<body>
    <header>
        <div class="horario">
            <h1>Sistema De Agenda Senai</h1>
            <p id="tv-date"></p>
        </div>

        <div class="botoes">
            <button onclick="professores()">Professores</button>
            <button onclick="cursos()">Cursos</button>
        </div>

        <p id="tv-clock"></p>
    </header>
    <div class="container">
        <div class="agenda">
            <h3>📅 Agenda do Dia</h3>

            <?php
            include 'conexao/conexao.php';

            $sql_busca = "SELECT
                            p.nome_professor, c.hora_inicio_curso, c.hora_fim_curso, c.nome_curso 
                            FROM professores AS p 
                            INNER JOIN cursos AS c ON p.id_professor = c.id_professor ";

            $stmt_busca = $conexao->prepare($sql_busca);
            $stmt_busca->execute();
            while ($busca = $stmt_busca->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='aula'>";
                echo "<div class='aulinha'>";
                echo "<h2>{$busca['hora_inicio_curso']} - {$busca['hora_fim_curso']} </h2>";
                echo "<h1>{$busca['nome_curso']}</h1>";
                echo "<p>👨‍🏫 {$busca['nome_professor']} | 🏢</p>";
                echo "</div>"; //fecha div aulinha
                echo "</div>"; //fecha div aula
            }
            ?>
        </div>

        <div class="alertas">
            <h3>⚠️ Alertas</h3>
        </div>

        <div class="proximas">
            <h3>🎓 Próximas Aulas</h3>

            <?php
            include 'conexao/conexao.php';

            $sql_busca = "SELECT
                            p.nome_professor, c.hora_inicio_curso, c.hora_fim_curso, c.nome_curso 
                            FROM professores AS p 
                            INNER JOIN cursos AS c ON p.id_professor = c.id_professor ";

            $stmt_busca = $conexao->prepare($sql_busca);
            $stmt_busca->execute();
            while ($busca = $stmt_busca->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='aula'>";
                echo "<div class='aulinha'>";
                echo "<h2>{$busca['hora_inicio_curso']}</h2>";
                echo "<h1>{$busca['nome_curso']}</h1>";
                echo "<p>👨‍🏫 {$busca['nome_professor']} | 🏢</p>";
                echo "</div>"; //fecha div aulinha
                echo "</div>"; //fecha div aula
            }
            ?>
        </div>
    </div>
    <footer>
        <h2>Sistema de Gestão de Agenda SENAI -Atualização automática</h2>
    </footer>
    <script>
        function updateClock() {
            const now = new Date();
            document.getElementById('tv-clock').textContent = now.toLocaleTimeString('pt-BR');
        }

        function updateDate() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('tv-date').textContent = now.toLocaleDateString('pt-BR', options).toUpperCase();
        }

        setInterval(updateClock, 1000);
        updateClock();
        updateDate();

        setTimeout(() => {
            window.location.reload();
        }, 30000);

        function professores() {
            window.location.href = "professor.php";
        }

        function cursos() {
            window.location.href = "cursos.php";
        }
    </script>
</body>

</html>