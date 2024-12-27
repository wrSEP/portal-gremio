// Função para abrir o modal de seleção de imagens
function abrirModal() {
    document.getElementById('modal').classList.add('show'); // 'show' usada para controlar a visibilidade de um elemento.
}

// Função para fechar o modal
function fecharModal() {
    document.getElementById('modal').classList.remove('show');
}

// Função para carregar a imagem e exibi-la na prévia
function carregarImagem(event, numeroImagem) {
    const file = event.target.files[0]; // Obtém o arquivo selecionado
    const previewImagem = document.getElementById(`previewImagem${numeroImagem}`);
   

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImagem.src = e.target.result; // Define a imagem como fonte da prévia
            previewImagem.classList.remove('hidden'); // Exibe a imagem */
        };
        reader.readAsDataURL(file); // Lê o arquivo como uma URL de dados
    }
}

// Função para gerar o post com os dados fornecidos
function gerarPost() {
    const titulo = document.getElementById('tituloPub').value;
    const subTitulo = document.getElementById('subTituloPub').value;
    const descricao = document.getElementById('descricao').value;


    if (titulo && descricao) {
        document.getElementById('previewTitle').innerText = titulo;
        document.getElementById('previewsubTitle').innerText = subTitulo;
        document.getElementById('previewDescricao').innerText = descricao;

        const timestamp = gerarTimestamp(); // Gera a data e hora atuais
        document.getElementById('previewTimestamp').innerText = timestamp;

        document.getElementById('postPreview').classList.remove('hidden'); // Exibe a prévia
    } else {
        alert('Preencha todos os campos obrigatórios!'); // Alerta se faltar algum campo
    }
}

// Função para gerar a data e hora atuais
function gerarTimestamp() {
    const agora = new Date();
    const dia = String(agora.getDate()).padStart(2, '0');
    const mes = String(agora.getMonth() + 1).padStart(2, '0');
    const ano = agora.getFullYear();
    const horas = String(agora.getHours()).padStart(2, '0');
    const minutos = String(agora.getMinutes()).padStart(2, '0');
    const segundos = String(agora.getSeconds()).padStart(2, '0');

     // Preencher os campos ocultos
     document.getElementById('dataAnuncio').value = `${ano}-${mes}-${dia}`; // Formato YYYY-MM-DD
     document.getElementById('horaAnuncio').value = `${horas}:${minutos}:${segundos}`; // Formato HH:MM:SS

    return `Criado em: ${dia}/${mes}/${ano} às ${horas}:${minutos}:${segundos}`;
}
