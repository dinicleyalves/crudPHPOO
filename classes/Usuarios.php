<?php

require_once 'Crud.php';

class Usuarios extends Crud{
	
	protected $table = 'usuarios';
	private $nome;
	private $email;
	private $telefone;

	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getNome(){
		return $this->nome;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}

	

	public function insert(){

		$sql  = "INSERT INTO $this->table (nome, email, telefone) VALUES (:nome, :email, :telefone)";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':telefone', $this->telefone);
		return $stmt->execute(); 

	}

	public function update($id){

		$sql  = "UPDATE $this->table SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
		$stmt = DB::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':telefone', $this->telefone);
		$stmt->bindParam(':id', $id);
		return $stmt->execute();

	}

}