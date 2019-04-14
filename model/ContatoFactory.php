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
    	$this->file_db->exec("CREATE TABLE IF NOT EXISTS contato (
			id INTEGER PRIMARY KEY AUTOINCREMENT, 
			name TEXT, 
			email TEXT)");
	}

	public function insertContato($contato){
		$search = $this->search($contato);
		// verifica se o email já está cadastrado
		if ($search) {
			return true;
		}
		else {
			$this->insert($contato);
			return false;
		}
	}

	public function insert($contato){
		$insert ="INSERT INTO contato(name, email)
					VALUES(:name, :email);";

		$stmt = $this->file_db->prepare($insert); 
		//bind parametro-statement
		$stmt->bindParam(':name',$contato->name);
		$stmt->bindParam(':email',$contato->email);
		$stmt->execute();
	}

	public function updateName($id, $contato){
		$insert ="UPDATE contato
					SET name = :name
					WHERE id = :id";
		$stmt = $this->file_db->prepare($insert); 
		//bind parametro-statement
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':name',$contato->name);
		$stmt->execute();
	}

	public function updateEmail($id, $contato){
		$search = $this->search($contato);
		// verifica se o email já está cadastrado
		if ($search) {
			return true;
		}
		else {
			$this->updateEmailReady($id, $contato);
			return false;
		}
	}

	public function updateEmailReady($id, $contato){
		$insert ="UPDATE contato
					SET email = :email
					WHERE id = :id";

		$stmt = $this->file_db->prepare($insert); 
		//bind parametro-statement
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':email',$contato->email);
		$stmt->execute();
	}


	/**
	*Busca no banco um contato pelo email
	*@return true se o contato está cadastrado
	*@return false do contrário.
	*/
	public function search($contato) {
		$busca = "SELECT email FROM contato WHERE :email = email";
		
		$stmt = $this->file_db->prepare($busca); 	
		$stmt->bindParam(':email', $contato->email);
		$stmt->execute();

		$email = $stmt->fetch();
		if ($email[0] == $contato->email)
			return true;
		else
			return false;
	}

	public function selectId($id){
		$busca = "SELECT * FROM contato WHERE id = :id";
		$stmt = $this->file_db->prepare($busca);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$array = $stmt->fetch();
		return $array;
	}

	public function deleteContact($id){
		$search = "DELETE FROM contato WHERE id = :id";
		$stmt = $this->file_db->prepare($search);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
	}

	public function listing(){
		$busca = "SELECT * FROM contato";

		$stmt = $this->file_db->prepare($busca); 
		$stmt->execute();

		$array = $stmt->fetchAll();
		return $array;
	}
}