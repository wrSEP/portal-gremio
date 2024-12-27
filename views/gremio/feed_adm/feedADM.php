<?php
session_start();

require_once('../../../config/db.php');

if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../login.php");
    exit();
}
$nome_usuario = $_SESSION['usuario_nome'];


require_once('../../../model/Publicacao.php');
$publicacao = new Publicacao($conn);
$publicacoes = $publicacao->getPublicacoes();

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="feedADM.css">
    <title>Portal Grêmio | Administrativo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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
                        <li><a href="../../pagcursos/index.html">Início</a></li>
                        <li><a href="../../pagcursos/vest.html">Vestibulinho</a></li>
                        <li><a href="../../pagcursos/index.html#review">Cursos</a></li>
                        <li><a href="../../pagcursos/Esportes.html">Esportes</a></li>
                        <li><a href="../../pagcursos/gremio.html">Grêmio</a></li>
                        
                    </ul>
                    
                </nav>
                
            </section>
            
        </div>
    </header>
    <style>
       
       .interface {
  max-width: 1280px;
  margin: 0 auto;
}

header {
  width: 100%;
  height: 50px;
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
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap');

body {
    font-family: 'Poppins', sans-serif;
    margin: 0px;
    padding: 0;
    background: rgb(93, 46, 124);
    font-size: 12px;
    background: linear-gradient(
        rgba(0, 0, 0, 0.6), 
        #20074ec5
    ), url('img/kefibac.png');
    background-size: cover;  /* Ensures the background image covers the entire screen */
    background-position: center; /* Centers the background image */
    background-attachment: fixed; /* Keeps the background fixed when scrolling */
    overflow-x: hidden; /* Prevents horizontal scrolling */

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



h2{
    text-align: center;
    font-family: 'Poppins', sans-serif;
    color: rgb(73, 32, 92);
}

.container {
    background-color: rgb(253, 252, 252);
    padding: 20px;
    border-radius: 8px;
    max-width: 600px;
    margin: auto;
    box-shadow: 0 0 10px rgba(145, 138, 138, 0.1);
    margin-top: 25px;
    font-family: 'Poppins', sans-serif; 
}

button {
    width: 100%;
    background-color: #20074ec5;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    margin-top: 10px;
}

button:hover {
    background-color: #8185b9;
}

.post {
    margin-top: 30px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #fff;
    font-family: 'Poppins', sans-serif;
}

/* Adicionando estilo para centralizar as imagens dentro da .post */
.post img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    max-width: 100%; /* Garante que a imagem não ultrapasse a largura da caixa */
    height: auto; /* Mantém a proporção da imagem */
}


        </style>
       <BR><BR><BR><BR><BR><BR>
           <h1>Bem-vindo, <?php echo htmlspecialchars($nome_usuario); ?>!</h1>
           <?php foreach ($publicacoes as $publicacao): ?>
        <div class="container">
            <br>
        <img src="img/post.png" style="width: 600px; display: block; margin: 0 auto;">
            <div class="post">
                    <h2><?php echo htmlspecialchars($publicacao['Pub_titulo']); ?></h2>
                <h4><?php echo htmlspecialchars($publicacao['Pub_subTitulo']); ?></h4>
                <p><b>Publicado por:</b> <?php echo htmlspecialchars($publicacao['Usu_nome']); ?></p>
                <p><b>Data de publicação:</b>  <?php echo htmlspecialchars($publicacao['Pub_dataAnuncio']); ?> às <?php echo htmlspecialchars($publicacao['Pub_horaAnuncio']); ?></p>
                <p><?php echo nl2br(htmlspecialchars($publicacao['Pub_descricao'])); ?></p>

                <!-- Exibindo as imagens -->
                <?php if ($publicacao['Img1_caminho']): ?>
                    <img src="../../../assets/<?php echo htmlspecialchars($publicacao['Img1_caminho']); ?>" alt="Imagem 1" width="420px" height="300px">
                <?php endif; ?>
                <?php if ($publicacao['Img2_caminho']): ?>
                    <img src="../../../assets/<?php echo htmlspecialchars($publicacao['Img2_caminho']); ?>" alt="Imagem 2" width="420px" height="300px">
                <?php endif; ?>

                <!-- Formulário de exclusão -->
                <form action="../../../model/Deletar.php" method="POST">
                    <input type="hidden" name="id" value="<?php  echo htmlspecialchars($publicacao['id_pla']); ?>"> 
                    <button type="submit" onclick="return confirm('Tem certeza que deseja deletar esta publicação?')">Deletar</button>
                </form>
            </div>
         

        </div>
    <?php endforeach; ?>
</body>
</html>