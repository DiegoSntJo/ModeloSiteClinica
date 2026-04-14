<?php

require_once __DIR__ . '/../../config/database.php';

$db_conec = null;
$mysqli = null;

try {
	$db_conec = clinic_create_mysqli('appointments');
	$mysqli = $db_conec;
} catch (Throwable $e) {
	echo "Falha na conexão: " . $e->getMessage();
}


Class Usuario
{
	private $pdo;
	public $msgErro = "";//tudo ok

	public function conectar()
	{
		try 
		{
			$this->pdo = clinic_create_pdo('appointments');
			$this->msgErro = "";
		} catch (Throwable $e) {
			$this->msgErro = $e->getMessage();
		}
	}

	public function cadastrar($email, $senha)
	{
		//verificar se já existe o email cadastrado
		$sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e",$email);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //ja esta cadastrado
		}
		else
		{
			//caso nao, Cadastrar
			$sql = $this->pdo->prepare("INSERT INTO usuarios (email, senha) VALUES (:e, :s)");
			$sql->bindValue(":e",$email);
			$sql->bindValue(":s",($senha));
			$sql->execute();
			return true; //tudo ok
		}
	}


	public function logar($email, $senha)
	{
		//verificar se o email e senha estao cadastrados, se sim
		$sql = $this->pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
		$sql->bindValue(":e",$email);
		$sql->bindValue(":s",($senha));
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			//entrar no sistema (sessao)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; //cadastrado com sucesso
		}
		else
		{
			return false;//nao foi possivel logar
		}
	}
} 







?> 