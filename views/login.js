document.addEventListener("DOMContentLoaded", function () {

    console.log('olá')
    const emailGremio = document.getElementById('emailGremio')
    const senhaGremio = document.getElementById('senhaGremio')
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/  // Regex para validação de e-mail


    function verificarLogin() {
        
        document.getElementById('erroEmailGremio').textContent = '';
        document.getElementById('erroSenhaGremio').textContent = '';

        let formValido = true; // Assume que o formulário é válido inicialmente

        // Validação do Email
        if (emailGremio.value.trim() === "") {
            document.getElementById('erroEmailGremio').textContent = "Email Inválido ❌";
            formValido = false; // Define como inválido
        } else if (!emailRegex.test(emailGremio.value) || !emailGremio.value.endsWith("@etec.sp.gov.br")) // deve conter 
        {
            document.getElementById('erroEmailGremio').textContent = "Email Inválido ❌";
            formValido = false; // Define como inválido
        } else {
            document.getElementById('erroEmailGremio').textContent = "Email Válido ✅";
        }

        // Validação da Senha
          if (senhaGremio.value.trim() === "") {
            document.getElementById('erroSenhaGremio').textContent = "Senha Inválida ❌";
            formValido = false; // Define como inválido
        } else if (senhaGremio.value.length < 5 ) {
            document.getElementById('erroSenhaGremio').textContent = "Senha Inválida ❌";
            formValido = false; // Define como inválido
        } else {
            document.getElementById('erroSenhaGremio').textContent = "Senha Válida ✅";
        }
    }

    emailGremio.addEventListener('input', verificarLogin);
    senhaGremio.addEventListener('input', verificarLogin);

    verificarLogin()
    
});