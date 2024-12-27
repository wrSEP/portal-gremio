<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Grêmio | Login</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>
<style>
    .interface {
  max-width: 1280px;
  margin: 0 auto;
}

header {
  width: 100%;
  height:65px;
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
    </style>
<body>
<header>
        <div class="interface"> 
            <section class="logo">
            <img src="img/logo2.png" style="margin-top: 5px;width: 85%;" alt="">
            </section>
            
            <section class="menu-desktop">
                <nav>
                    <ul>
                        <li><a href="pagcursos/index.html">Início</a></li>
                        <li><a href="pagcursos/vest.html">Vestibulinho</a></li>
                        <li><a href="pagcursos/index.html#review">Cursos</a></li>
                        <li><a href="pagcursos/esportes.html">Esportes</a></li>
                        <li><a href="pagcursos/gremio.html">Grêmio</a></li>
                     
                    </ul>
                    
                </nav>
                
            </section>
            
        </div>
    </header>
<body>
    <div class="container" id="container">
        <div class="form-container login-container">
            <form id="formulario" action="verificacaoLogin.php" method="POST">
                <img src="https://images.vexels.com/content/153708/preview/graduation-hat-flat-icon-401100.png" style="width: 55px; height: auto;" alt="">
                 <h1>PORTAL DO ALUNO</h1>
                 <br>
                <div class="formulario">
                    <input type="text" id="emailGremio" placeholder="E-mail" name="Usu_emailEntrar" />
                    <small></small>
                </div>
                <div class="formulario">
                    <input type="password" id="senhaGremio" placeholder="Senha" name="Usu_senhaEntrar"/>
                    <small></small>
                </div>
                <br>
                <button type="submit" value="Entrar" name="login">Entrar</button>
                <br>
                <a href="aluno/Cadastro.php" style="color: rgb(125, 62, 197); text-decoration: none; font-size: 12px; margin-top: -20px;"><i><br>Não possui conta?<br> <b>CADASTRE-SE!</b></i></a>
             </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-direita">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
