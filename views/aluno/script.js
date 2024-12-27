document.addEventListener("DOMContentLoaded", function () {
    // Obtém os valores dos campos do formulário
    const tipoUsuario = document.getElementById('tipoUsuario')
    const rmAluno = document.getElementById('rmAluno');
    const nomeAluno = document.getElementById('nomeAluno');
    const telefoneAluno = document.getElementById('telefoneAluno');
    const emailEtec = document.getElementById('emailETEC');
    const senhaEtec = document.getElementById('senhaEtec');
    //const numeroAcessoAluno = document.getElementById('numeroAcessoAluno');
    const botao = document.getElementById('botaoAluno');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;  // Regex para validação de e-mail



    
        function verificarTipoUsuario() {
            if (tipoUsuario.value === 'aluno') {
                document.getElementById('rmaluno').textContent = "RM: ";
                rmAluno.classList.remove('hidden'); // Mostra o campo RM
                console.log("pode colocar")
            } else {
                rmAluno.classList.add('hidden'); // Esconde o campo RM
                rmAluno.value = ""; // Limpa o valor do campo
                document.getElementById('erroRM').textContent = ""; // Limpa mensagem de erro
            }
        }


    function validarFormulario() {
        // Limpar mensagens de erro
        document.getElementById('rmaluno').textContent = '';
        document.getElementById('erroRM').textContent = '';
        document.getElementById('erroNomeAluno').textContent = '';
        document.getElementById('erroTelefoneAluno').textContent = '';
        document.getElementById('erroEmailEtecAluno').textContent = '';
        document.getElementById('erroSenhaEtecAluno').textContent = '';
     //   document.getElementById('erroNumeroAcessoAluno').textContent = '';

      verificarTipoUsuario()

        let formValido = true; // Assume que o formulário é válido inicialmente

        if (tipoUsuario.value === 'aluno') {

            if (rmAluno.value.trim() === "") {
                document.getElementById('erroRM').textContent = "RM Inválido ❌";
                formValido = false; // Define como inválido
            } else if (rmAluno.value.length !== 5 || isNaN(rmAluno.value)) // verifica se é numero
            {
                document.getElementById('erroRM').textContent = "Erro: Preencha novamente ❌";
                formValido = false; // Define como inválido
            } else {
                document.getElementById('erroRM').textContent = "Correto ✅";
            }
        } 

        // Validação do Nome
        if (nomeAluno.value.trim() === "" || !/^[a-zA-Z\s]+$/.test(nomeAluno.value)) // verfica se é letra
        {
            document.getElementById('erroNomeAluno').textContent = "Nome Inválido ❌";
            formValido = false; // Define como inválido
        } else {
            document.getElementById('erroNomeAluno').textContent = "Correto ✅";
        }

        // Validação do Telefone
        if (telefoneAluno.value.trim() === "") {
            document.getElementById('erroTelefoneAluno').textContent = "Telefone Inválido ❌";
            formValido = false; // Define como inválido
        } else if (telefoneAluno.value.length !== 11) {
            document.getElementById('erroTelefoneAluno').textContent = "Erro: Preencha novamente ❌";
            formValido = false; // Define como inválido
        } else {
            document.getElementById('erroTelefoneAluno').textContent = "Correto ✅";
        }

        // Validação do Email
        if (emailEtec.value.trim() === "") {
            document.getElementById('erroEmailEtecAluno').textContent = "Email Inválido ❌";
            formValido = false; // Define como inválido
        } else if (!emailRegex.test(emailEtec.value) || !emailEtec.value.endsWith("@etec.sp.gov.br")) // deve conter 
        {
            document.getElementById('erroEmailEtecAluno').textContent = "Email Inválido ❌";
            formValido = false; // Define como inválido
        } else {
            document.getElementById('erroEmailEtecAluno').textContent = "Email Válido ✅";
        }

        // Validação da Senha
        if (senhaEtec.value.trim() === "") {
            document.getElementById('erroSenhaEtecAluno').textContent = "Senha Inválida ❌";
            formValido = false; // Define como inválido
        } else if (senhaEtec.value.length < 5) {
            document.getElementById('erroSenhaEtecAluno').textContent = "Senha Inválida ❌";
            formValido = false; // Define como inválido
        } else {
            document.getElementById('erroSenhaEtecAluno').textContent = "Senha Válida ✅";
        }

      /*  
        if (numeroAcessoAluno.value.trim() === "") {
            document.getElementById('erroNumeroAcessoAluno').textContent = "Número de Acesso Inválido ❌";
            formValido = false; // Define como inválido
        } else if (numeroAcessoAluno.value !== '2') {
            document.getElementById('erroNumeroAcessoAluno').textContent = "Erro: Preencha novamente ❌";
            formValido = false; // Define como inválido
        } else {
            document.getElementById('erroNumeroAcessoAluno').textContent = "Correto ✅";
        } */

        // Habilita ou desabilita o botão com base na validade do formulário
        botao.disabled = !formValido;// Habilita o botão se formValido for true
    }

    // Adicionar eventos de input para validar em tempo real
    tipoUsuario.addEventListener('change', validarFormulario);
    rmAluno.addEventListener('input', validarFormulario);
    nomeAluno.addEventListener('input', validarFormulario);
    telefoneAluno.addEventListener('input', validarFormulario);
    emailEtec.addEventListener('input', validarFormulario);
    senhaEtec.addEventListener('input', validarFormulario);
    //numeroAcessoAluno.addEventListener('input', validarFormulario);

    // Executa a validação ao carregar a página
    validarFormulario();
});
