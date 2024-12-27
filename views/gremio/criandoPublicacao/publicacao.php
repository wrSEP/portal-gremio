<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criação | Postagens</title>
    <link rel="stylesheet" href="publicacao.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
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
          padding: 0 10px;
      }

      header .logo img {
          max-height: 50px;
          width: auto;
      }

      header .menu-desktop nav ul {
          list-style-type: none;
          padding: 0;
          margin: 0;
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
    </style>
</head>
<body>
  <br><br><br>
<form action="../../../model/Publicacao.php" method="POST" enctype="multipart/form-data">
    <div class="container">
        <h2>CRIE SEU POST</h2>
        <label for="title">Título do Post</label>
        <input type="text" id="tituloPub" name="tituloPub" placeholder="Digite o título do post">
    
        <label for="title">Subtitulo do Post</label>
        <input type="text" id="subTituloPub" name="subTituloPub" placeholder="Digite o subtítulo do post">

        <label for="content">Descrição</label>
        <textarea id="descricao" name="descricao" rows="5" placeholder="Escreva o conteúdo aqui..."></textarea>

        <input type="hidden" id="dataAnuncio" name="dataAnuncio">
        <input type="hidden" id="horaAnuncio" name="horaAnuncio">

        <button onclick="abrirModal()" type="button">Selecionar Imagem</button>

        <br>

        <div id="postPreview" class="post-preview hidden">
            <h2 id="previewTitle"></h2>
            <h4 id="previewsubTitle"></h4> <!-- Corrigido fechamento de tag -->
            <p id="previewDescricao"></p>
            <img id="previewImagem1" src="#" alt="Imagem1 do post" class="hidden" width="420px" height="300px">
            <img id="previewImagem2" src="#" alt="Imagem2 do post" class="hidden" width="420px" height="300px">
            <p id="previewTimestamp" class="timestamp"></p>
        </div>

        <!-- Modal para seleção de imagem -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <h3>Escolha as Imagens</h3>
                <label for="imageInput1">Imagem 1:</label>
                <input type="file" id="imagem1" name="imagem1" accept="image/*" onchange="carregarImagem(event, 1)" required>
                
                <label for="imageInput2">Imagem 2:</label>
                <input type="file" id="imagem2" name="imagem2" accept="image/*" onchange="carregarImagem(event, 2)">
                
                <button onclick="fecharModal()" type="button">Fechar</button>
            </div> 
        </div>

        <button onclick="gerarPost()" type="button">Gerar Post</button>
        <button type="submit">Publique seu Post</button>
    </div>
</form>

<script src="publicacao.js"></script>
</body>
</html>
