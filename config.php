<?php
 
/**
 * Configuracao global do sistema
 */

/* ******************** */
/* ***** CAMINHOS ***** */
/* ******************** */
define('ROOT_PATH', dirname(__FILE__)); 					// Raiz do Sistema
define('UPLOAD_PATH', ROOT_PATH . '/app/views/_uploads'); 	// Pasta de uploads
define('VIEWS_PATH', ROOT_PATH . '/app/views');				// Pasta de views
define('MODAL_PATH', VIEWS_PATH . '/_includes/modals');		// Pasta com modais

define('CONTROL_PATH', ROOT_PATH . '/app/controllers');		// Controllers
define('PACKS_PATH', ROOT_PATH . '/app/_packages');			// Namespaces



/* ******************** */
/* ******* URLs ******* */
/* ******************** */
define('HOME_URL', "http://$_SERVER[HTTP_HOST]/sma");			// Home
define('STYLE_URL', HOME_URL . "/app/views/_css");				// Estilos
define('UPLOAD_URL', HOME_URL . '/app/views/_uploads');			// Uploads
define('VIEWS_URL', HOME_URL . "/app/views");					// Views




/* ********************************* */
/* ********* BASE DE DADOS ********* */
/* ********************************* */
define('DB_HOSTNAME', 'localhost'); 	// Nome do host
define('DATABASE', 'SMA'); 				// Nome do banco de dados
define('DB_USERNAME', 'root');			// Usuário do banco de dados
define('DB_PASSWORD', '');				// Senha do MySQL
define('DB_CHARSET', 'utf8');			// Charset da conexão
 

## true durante o processo de desenvolvimento
define('DEBUG', true);
 
## Carrega o loader, que vai carregar a aplicação inteira
require_once ROOT_PATH . '/loader.php';
