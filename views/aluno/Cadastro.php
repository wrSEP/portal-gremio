<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Grêmio | Cadastro</title>
    <link rel="stylesheet" href="style.css">
    <script defer src="script.js"></script>
</head>
<style>
        .hidden {
            display: none; /* Esconder campo opcional */
        }
       
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
                        <li><a href="../pagcursos/index.html">Início</a></li>
                        <li><a href="../pagcursos/vest.html">Vestibulinho</a></li>
                        <li><a href="../pagcursos/index.html#review">Cursos</a></li>
                        <li><a href="../pagcursos/Esportes.html">Esportes</a></li>
                        <li><a href="../pagcursos/gremio.html">Grêmio</a></li>
                        <li><a href="../login.php">Login</a></li>
                    </ul>
                    
                </nav>
                
            </section>
            
        </div>
    </header>
   <BR><BR>
    <div class="container" id="container">
        <div class="form-container login-container">
        <form id="formulario" action="../../model/Usuario.php" method="POST">
                <br>
                <img src="https://cdn-icons-png.flaticon.com/512/748/748137.png" style="width: 30px; height: auto;" alt="Cadastro Icon">
                <h1>Cadastro</h1>
                <div>
                    <label for="tipoUsuario" style="font-size: 12px;">Professor | Aluno <br> </label>
                    <select id="tipoUsuario" style="font-size: 12px; padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
                        <option value="">Selecione:</option>
                        <option value="aluno">🎓 Aluno</option>
                        <option value="professor">👨‍🏫 Professor</option>
                    </select>
                    
                </div>
                <a style="font-size: 13px; font-weight: bold;">💡 Cadastre-se e seja a mudança no nosso Grêmio Estudantil!
                </a>
             
               
                <div class="formulario">
                    <span id="rmaluno" class="erro"></span>
                    <input type="text" id="rmAluno" name="Usu_RM" placeholder="RM" class="hidden" />
                    <span id="erroRM" class="erro"></span>
                </div> 

                
                <div class="formulario">
                    <input type="text" id="nomeAluno" name="Usu_nome" placeholder="Nome" required/>
                    <span id="erroNomeAluno" class="erro"></span>
                </div>

             


                <div class="formulario">
                    <input type="tel" id="telefoneAluno" name="Usu_telefone" placeholder="Telefone" required/>
                    <span id="erroTelefoneAluno" class="erro"></span>
                </div>


                <div class="formulario">
                    <input type="email" id="emailETEC" name="Usu_emailETEC" placeholder="E-mail" required/>
                    <span id="erroEmailEtecAluno" class="erro"></span>
                </div>


                <div class="formulario">
                    <input type="password" id="senhaEtec" name="Usu_senhaETEC" placeholder="Senha" required/>
                    <span id="erroSenhaEtecAluno" class="erro"></span> 
                </div>

               
                <input type="hidden" id="numeroAcessoAluno"  name="Usu_numAcesso" value="2" />
                <a href="../login.php" style="color: rgb(125, 62, 197); text-decoration: none; font-size: 12px;"><i>Já possui cadastro? <br> Faça <b>LOGIN.</b></i></a>

                <input type="submit" value="Cadastrar"  id="botaoAluno" disabled />

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
