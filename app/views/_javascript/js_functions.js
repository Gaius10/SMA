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
