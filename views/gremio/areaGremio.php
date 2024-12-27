<?php
session_start(); // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../login.php"); // Redireciona para a página de login
    exit();
}

// Armazena o nome do usuário em uma variável
$nome_usuario = $_SESSION['usuario_nome'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <title>Área | Aluno</title>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: linear-gradient(
                rgba(0, 0, 0, 0.6), 
                #20074ec5
            ), url('../img/Background 2.png');
            background-size: cover;
            background-position: center;
        }

        /* Contêiner principal (quadrado bonito) */
        .container {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 10px 70px rgba(0, 0, 0, 0.8);
            padding: 40px;
            max-width: 500px;
            text-align: center;
            width: 100%;
            margin: 20px;
            font-family: 'Poppins', sans-serif;
        }

        h1 {
            color: #333;
            font-size: 2rem;
            font-family: 'Raleway', sans-serif;
            margin-bottom: 20px;
            font-size: 25px;
        }

        /* Estilo dos botões */
        button {
            background-color: #20074ec5;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 15px;
            margin: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        button:hover {
            background-color: #8185b9;
            transform: translateY(-3px);
        }

        button a {
            color: white;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        button a:hover {
            text-decoration: underline;
            font-family: 'Poppins', sans-serif;
        }

        /* Estilo do botão de logout */
        .logout-button {
            background-color: #20074ec5;
            color: white;
            border: none;
            padding: 15px 25px;
            font-size: 15px;
            margin: 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }

        .logout-button:hover {
            background-color: #8185b9;
            transform: translateY(-3px);
            font-family: 'Poppins', sans-serif;
        }

    </style>

</head>
<body>
    <div class="container">
    <img src="../img/icon.png" style="width: 60px;">

        <h1>Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>

        <!-- Formulário de logout -->
        <form action="../logout.php" method="POST">
            <button type="submit" class="logout-button">Logout</button>
        </form>

        <!-- Botões -->
        <button><a href="criandoPublicacao/publicacao.php">Criar Postagens</a></button>
        <br>
        <button><a href="feed_adm/feedADM.php">Postagens</a></button>
    </div>
</body>
</html>
