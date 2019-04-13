<?php

namespace model;
use PDO;

class ContatoFactory{
	private $file_db;

	public function __construct(){
		try {
			$this->file_db = new PDO('sqlite:model/DBContato.sqlite');
		} catch (PDOException $e) {
			echo 'Connection failed: ' . $e->getMessage();
		}

		$this->file_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$this->createTable();
	}
	
	public function createTable(){
    	$this->file_db->exec("CREATE TABLE IF NOT EXISTS contatos (
			id INTEGER AUTO_INCREMENT, 
			nome TEXT, 
			email TEXT,
			PRIMARY KEY (id))");
	}

	public function inserirContato($contato){
		$busca = $this->busca($contato);
		// verifica se o email já está cadastrado
		if ($busca) {
			return true;
		}
		else {
			$this->insert($contato);
			return false;
		}
	}

	public function insert($contato){
		$insert ="INSERT INTO contatos(nome, email)
					VALUES(:nome, :email);";

		$stmt = $this->file_db->prepare($insert); 

		//bind parametro-statement
		$stmt->bindParam(':nome',$contato->name);
		$stmt->bindParam(':email',$contato->email);

		$stmt->execute();
	}

	public function updateName($id, $contato){
		$insert ="UPDATE contatos
					SET nome = :nome
					WHERE id = :id";

		$stmt = $this->file_db->prepare($insert); 

		//bind parametro-statement
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':nome',$contato->name);
		$stmt->bindParam(':email',$contato->email);

		$stmt->execute();
	}

	public function updateEmail($id, $contato){
		$insert ="UPDATE contatos
					SET email = :email
					WHERE id = :id";

		$stmt = $this->file_db->prepare($insert); 

		//bind parametro-statement
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':nome',$contato->name);
		$stmt->bindParam(':email',$contato->email);

		$stmt->execute();
	}

	public function busca($contato) {
		
		$busca = "SELECT email FROM contatos WHERE :email = email";

		$stmt = $this->file_db->prepare($busca); 

		$stmt->bindParam(':email', $contato->email);
		
		$stmt->execute();
		$email = $stmt->fetch();

		if ($email[0] == $contato->email)
			return true;
		else
			return false;
	}

	public function listagem(){
		$busca = "SELECT * FROM contatos";

		$stmt = $this->file_db->prepare($busca); 
		$stmt->execute();

		$array = $stmt->fetchAll();

		return $array;
	}
}
