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

    //Handle request actions

    public function newContactFormAction(){
		include 'view/novo.php';	
	}

	public function newContactAction(){
		if (!isset($_POST['name']) && empty($_POST['name']) && !isset($_POST['email']) && empty($_POST['email'])){
			$error = 'Dados ausentes';
			$this->error($error);
			exit();
		}

        $name = $_POST['name'];
        $email = $_POST['email'];
        
       	// instancia contato
		$contato = new contato($name, $email);
	
		//chama o ContatoFactory
		$contatoFactory = new ContatoFactory();
		$insertResult = $contatoFactory->insertContato($contato);
		if ($insertResult)
			$this->error('Cadastro já existente!');
		else
			$this->error('Cadastro realizado com sucesso!');
	}
		


	public function editContactFormAction(){
		$id = isset($_GET['id']) ? $_GET['id'] : '0';
		intval($id);
		if($id ==0){
			$error ='ID inválido';
			$this->error($error);
		}
		else{
			include 'view/editar.php';
		}
	}
	
	public function editContactAction(){
		if (!isset($_POST['name']) && empty($_POST['name']) && !isset($_POST['email']) && empty($_POST['email'])){
			$error = 'Dados ausentes';
			$this->error($error);
			exit();
		}


		$name = $_POST['name'];
        $email = $_POST['email'];
        $contato = new contato($name, $email);
		$id = isset($_GET['id']) ? $_GET['id'] : '0';

		intval($id);

		if($id==0){
			$error ='ID inválido';
			$this->error($error);
			exit();
		}
		
		$contatoFactory = new ContatoFactory();

		if(!empty($email)){
			$updateResult = $contatoFactory->updateEmail($id, $contato);
		}

		if($updateResult){
			$error = 'Email ja existente';
			$this->error($error);
			exit();
		}

		if (!empty($name)){
			$contatoFactory->updateName($id, $contato);
		}

		$error = 'Dados atualizados com sucesso';
		$this->error($error);
	}

	public function listAction(){
		$contatoFactory = new ContatoFactory();
		$list = $contatoFactory->listing();
		include 'view/lista.php';
	}
	
	public function indexAction(){
		include 'view/index.php';
	}
	
	public function error($error){
		include 'view/mostra.php';
	}
		
	public function handleRequest (){
		$action = isset($_GET['action']) ? $_GET['action'] : 'index';
			
		switch($action){
			default:
				$this->indexAction();
				break;

			case 'newContactForm':
				$this->newContactFormAction();
				break;

			case 'newContact':
				$this->newContactAction();
				break;

			case 'list':
				$this->listAction();
				break;
			
			case 'editContactForm':
				$this->editContactFormAction();
				break;
					
			case 'editContact':
				$this->editContactAction();
				break;

			
		}	
	}
}
