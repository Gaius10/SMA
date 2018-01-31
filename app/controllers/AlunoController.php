<?php
use mvc\MainController;
/**
 * AlunoController Controlador de acoes relacionadas ao aluno
 * @author Caio Corrêa Chaves
 */
class AlunoController extends MainController
{
    /**
     * function cadastrar($aluno)
     * 
     * Funçao que cadastra novo aluno ou mostra formulario de cadastro
     * 
     * @access public
     * @param array|null $aluno Dados do aluno a ser cadastrado
     * @return void
     */
    public function cadastrar($aluno = null)
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL . "/login");
        } else {
            
        }
    }

    /**
     * function cadastrados()
     * 
     * Função que mostrará os alunos cadastrados
     * 
     * @access public
     * @return void
     */
    public function cadastrados()
    {
        if (!$this->loggedIn) {
            header("Location: " . HOME_URL . "/login");
        } else {
            
        }
    }
}
