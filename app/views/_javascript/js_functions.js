/**
 * Abrir e fechar qualquer modal pelo ID
 */
 function openModal(elementId)
 {
     if (screen.width < 1024) {
         document.getElementById(elementId).style.transform = 'translateX(100%)';
     } else {
         document.getElementById(elementId).style.display = 'block';
     }
 }
 function closeModal(elementId)
 {
     if (screen.width < 1024) {
         document.getElementById(elementId).style.transform = 'translateX(0)';
     } else {
         document.getElementById(elementId).style.display = 'none';
     }
 }

/**
 * Mostra modal de confirmação para algo
 */
 function confirmar(confirmForm, passElement)
 {
     openModal('confirmacao');
     document.getElementById('confirmForm').value = confirmForm;
     document.getElementById('passElement').value = passElement;
 }
 /* Envia dados apos confirmacao */
 function confirmSubmit()
 {
     var form = document.getElementById('confirmForm').value;
     var pass = document.getElementById('passElement').value;

    // Enviar senha digitada para o formulario correto
    if (document.getElementById('userPass').value.length > 0) {
        document.getElementById(pass).value = document.getElementById('userPass').value;
        document.getElementById(form).submit();
    } else {
        document.getElementById('userPass').style.borderColor = "red";
    }
}

/**
 * Abre modal com dados do aluno em dispositivos mobile
 *
 * Funcao usada em "views/almoco.view.php"
 */
function verDados(codAluno)
{
    var elementId = 'dados_aluno' + codAluno;
    var caretId   = 'c' + codAluno;

    var element = document.getElementById(elementId);
    var caret   = document.getElementById(caretId);

    if (screen.width < 1024) {
        if (element.style.display == "none") {
            element.style.display = "grid";
            caret.setAttribute('class', 'fa fa-caret-up');
        } else {
            element.style.display = "none";
            caret.setAttribute('class', 'fa fa-caret-down');
        }
    }
}

/**
 * Abre formulario para registro de ocorrencia
 */
function novaOcorrencia(codAluno, nomeAluno)
{
    document.getElementById("cod_aluno").value = codAluno;
    document.getElementById('nome_aluno').value = nomeAluno;
    openModal('ocorrencia');
}
