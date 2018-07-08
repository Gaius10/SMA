/* Funcoes javascript usadas */

/* Usada na modal para adicionar ocorrencia para aluno */
function newOc(cod, nome) {
    document.getElementById('cod_aluno').value = cod;
    document.getElementById('nome_aluno').value = nome;
    document.getElementById('label').classList.add('active');
}

/* Usada em modais de confirmação */

// sem senha
function confirmar(frase, idSubmit) {
    document.getElementById('conteudo_confirmacao').innerHTML = frase;
    document.getElementById('toSubmit').value = idSubmit;
}

// com senha
function confirmarComSenha(frase, idSubmit, pass) {
    document.getElementById('conteudo_confirmacao_com_senha').innerHTML = frase;
    document.getElementById('toSubmitComSenha').value = idSubmit;
    document.getElementById('passSubmit').value = pass;
}



/* Alterar Mês visualizado na pagina de gerenciamento de almoços */
function alterarMes(url) {
    window.location.replace(url);
}
