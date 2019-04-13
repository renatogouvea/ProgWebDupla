<?php

namespace controller;

use model\contato;
use model\ContatoFactory;

class controle{

	public function __construct (){
        $this->handleRequest();
    }

	public function redirect ($section, $action){
        ob_get_clean ();
        
        header ('location: index.php?section='.$section.'&action='.$action);

        exit();
    }

	public function novoAction(){
		// Verificar nome e email
        $name = $_POST['nome'];
        $email = $_POST['email'];
        if (empty($name) || empty($email)){
           $this-> mostraFalha();
            exit();
        }
       	// instancia contato
		$contato = new contato($name, $email);
	
		//chama o ContatoFactory
		$contatoFactory = new ContatoFactory();
		$insertResult = $contatoFactory->inserirContato($contato);
		if ($insertResult)
			$this->error('Cadastro já existente!');
		else
			$this->error('Cadastro realizado com sucesso!');
	}
		
	//require views adequadas
	public function formnovo(){
		include 'views/novo.php';	
	}
	
	public function lista(){
		$contatoFactory = new ContatoFactory();
		$lista = $contatoFactory->listagem();
		include 'views/lista.php';
	}
	
	public function indexAction(){
		include 'views/index.php';
	}
	
	public function error($erro){
		include 'views/mostra.php';
	}
		
	public function handleRequest (){
		$action = isset($_GET['action']) ? $_GET['action'] : 'index';
			
		switch($action){
			case 'novo':
				$this->novoAction();
				break;

			default:
				$this->indexAction();
				break;

			case 'formnovo':
				$this->formnovo();
				break;

			case 'lista':
				$this->lista();
				break;
			
		}	
	}
}
