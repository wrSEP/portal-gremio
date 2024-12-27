<?php
session_start(); // Inicia a sessão

require_once('../../config/db.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../login.php"); // Redireciona para a página de login
    exit();
}

// Armazena o nome do usuário em uma variável
$nome_usuario = $_SESSION['usuario_nome'];

require_once('../../model/Publicacao.php');
$publicacao = new Publicacao($conn);
$publicacoes = $publicacao->getPublicacoes();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="areaAluno.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Feed | Aluno</title>
</head>
<body>
<header>
        <div class="interface"> 
            <section class="logo">
            <img src="img/logo2.png" style="margin-top: 5px;width: 85%;" alt="">
            </section>
            
            <section class="menu-desktop">
                <nav>
                    <ul>
                        <li><a href="../pagcursos/index.html">Início</a></li>
                        <li><a href="../pagcursos/vest.html">Vestibulinho</a></li>
                        <li><a href="../pagcursos/index.html#review">Cursos</a></li>
                        <li><a href="../pagcursos/Esportes.html">Esportes</a></li>
                        <li><a href="../pagcursos/gremio.html">Grêmio</a></li>
                       
                        
                    </ul>
                    
                </nav>
                
            </section>
            
        </div>
    </header>
   
<br><br><br><br>
   <h1>Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>

   <br><br>

   <?php foreach ($publicacoes as $publicacao): ?>
        <div class="container">
       
            <br>
        <img src="img/post.png" style="width: 600px; display: block; margin: 0 auto;">
            <div class="post">
                <h2><?php echo htmlspecialchars($publicacao['Pub_titulo']); ?></h2>
                <h4><?php echo htmlspecialchars($publicacao['Pub_subTitulo']); ?></h4>
                <p>Publicado por: <?php echo htmlspecialchars($publicacao['Usu_nome']); ?></p>
                <p>Data de publicação: <?php echo htmlspecialchars($publicacao['Pub_dataAnuncio']); ?> às <?php echo htmlspecialchars($publicacao['Pub_horaAnuncio']); ?></p>
                <p><?php echo nl2br(htmlspecialchars($publicacao['Pub_descricao'])); ?></p>
                
                <?php if ($publicacao['Img1_caminho']): ?>
                    <img src="../../assets/<?php echo htmlspecialchars($publicacao['Img1_caminho']); ?>" alt="Imagem 1" width="420px" height="300px">
                <?php endif; ?>

                <?php if ($publicacao['Img2_caminho']): ?>
                    <img src="../../assets/<?php echo htmlspecialchars($publicacao['Img2_caminho']); ?>" alt="Imagem 2" width="420px" height="300px">
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>

    <form action="../logout.php" method="POST">
        <button type="submit">Logout</button>
    </form>

</body>
</html>

<!-- CSS -->
<style>
    
    .interface {
  max-width: 1280px;
  margin: 0 auto;
}

header {
  width: 100%;
  height: 60px;
  padding: 5px 0;
  position: fixed;
  top: 0;
  left: 0;
  background-color: hsla(207, 15%, 12%, 0.616);
  z-index: 1000;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.596);
  color: #f0f0f0;
  text-align: center;
}

header .interface {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0 10px; /* Adiciona um pouco de espaçamento lateral */
}

header .logo img {
  max-height: 50px;
  width: auto; /* Mantém a proporção da imagem */
}

header .menu-desktop nav ul {
  list-style-type: none;
  padding: 0; /* Remove o padding padrão */
  margin: 0; /* Remove a margem padrão */
  font-size: 14px;
}

header .menu-desktop nav ul li {
  display: inline-block;
  margin: 0 10px;
  font-size: 14px;
}

header .menu-desktop nav ul li a {
  color: #ffffff;
  text-decoration: none;
  display: inline;
  transition: transform 0.3s;
  text-align: center;
  font-size: 14px;
}

header .menu-desktop nav ul li a:hover {
  transform: scale(1.05);
  color: #00b31e;
  font-size: 14px;
}
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

body {
    /* Gradiente preto sobre a imagem */
    background: linear-gradient(
                rgba(0, 0, 0, 0.6), 
                #20074ec5
            ), url('../img/Background 2.png');
    background-size: cover;
    background-position: center;
    color: #fff; /* Texto branco para contraste com fundo escuro */
    font-size: 16px;
    line-height: 1.6;
}


h1 {
    text-align: center; /* Centraliza o texto */
    font-family: 'Poppins', sans-serif;
    font-size: 24px; /* Tamanho da fonte */
    margin-top: 80px; /* Ajuste a margem para dar espaço abaixo da navbar */
    margin-bottom: 0;
    color: white; /* Cor do texto */
    background-color: rgba(129, 133, 185, 0.8); /* Cor de fundo com opacidade (80%) */
    padding: 10px 20px; /* Adiciona espaçamento interno ao redor do texto */
    border-radius: 8px; /* Arredonda as bordas do fundo */
    width: 50%; /* Define a largura do título */
    margin: 0 auto; /* Centraliza o título horizontalmente */
    text-shadow: 2px 2px 5px black; /* Adiciona sombra preta ao texto */
}


h2 {
    text-align: center;
    color: rgb(73, 32, 92);
    font-size: 1.5em;
    margin-bottom: 15px;
}

h4 {
    color: #555;
    font-size: 1.1em;
    margin-bottom: 10px;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fdfcfc;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.post {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    margin-bottom: 20px;
}

/* Estilo das imagens dentro do post, centralizando e ajustando */
.post img {
    max-width: 100%;
    height: auto;
    border-radius: 5px;
    margin-top: 10px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}


button {
    display: block;
    width: 100px;
    margin: 20px auto;
    padding: 10px;
    background-color: rgb(126, 6, 238);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: rgb(81, 6, 143);
}

footer {
    text-align: center;
    margin-top: 30px;
}
</style>
