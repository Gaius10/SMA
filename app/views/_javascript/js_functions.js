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
