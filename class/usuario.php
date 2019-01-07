<?php

class Usuario {

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdUsuario() {
		return $this->idusuario;
	}

	public function setIdUsuario($idusuario) {
		$this->idusuario = $idusuario;
	}

	public function getLogin() {
		return $this->deslogin;
	}

	public function setLogin($login) {
		$this->deslogin = $login;
	}

	public function getSenha() {
		return $this->dessenha;
	}

	public function setSenha($senha) {
		$this->dessenha = $senha;
	}

	public function getDtCadastro() {
		return $this->dtcadastro;
	}

	public function setDtCadastro($dtcadastro) {
		$this->dtcadastro = $dtcadastro;
	}

	public function loadById($id) {
		$db = new Database();

		$results = $db->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
			":ID"=>$id
		));

		// if(isset($results[0])) {
		if (count($results) > 0) {
			$this->setData($results[0]);
		}

	}

	public static function getList() {
		$db = new Database();

		return $db->select("SELECT * FROM tb_usuarios ORDER BY deslogin;");
	}

	public static function search($login) {
		$db = new Database();

		return $db->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
			':SEARCH'=>"%".$login ."%"
		));
	}

	public function login($login, $senha) {
		$db = new Database();

		$results = $db->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
			":LOGIN"=>$login,
			":SENHA"=>$senha
		));

		// if(isset($results[0])) {
		if (count($results) > 0) {
	
			$this->setData($results[0]);
			
		} else {
			throw new Exception("Login e/ou senha inválidos!");			
		}
	}

	public function setData($data) {
		$this->setIdUsuario($data['idusuario']);
		$this->setLogin($data['deslogin']);
		$this->setSenha($data['dessenha']);
		$this->setDtCadastro(new DateTime($data['dtcadastro']));
	}

	public function insert() {

		$db = new Database();

		$result = $db->select("CALL sp_usuarios_insert(:LOGIN, :PASSOWORD)", array(
			':LOGIN'=>$this->getLogin(),
			':PASSOWORD'=>$this->getSenha()
		));

		if (count($result) > 0) {
			$this->setData($result[0]);
		}
	}

	public function update($login, $password) {
		$this->setLogin($login);
		$this->setSenha($password);

		$db = new Database();
		
		$db->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(
			':LOGIN'=>$this->getLogin(),
			':PASSWORD'=>$this->getSenha(),
			':ID'=>$this->getIdUsuario()
		));

	}

	public function delete() {
		$db = new Database();

		$db->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
			':ID'=>$this->getIdUsuario()
		));

		$this->setIdUsuario(0);
		$this->setLogin("");
		$this->setSenha("");
		$this->setDtCadastro(new DateTime());
	}

	public function __construct($login="", $password="") {
		$this->setLogin($login);
		$this->setSenha($password);
	}

	public function __toString() {
		return json_encode(array(
			"idusuario"=>$this->getIdUsuario(),
			"deslogin"=>$this->getLogin(),
			"dessenha"=>$this->getSenha(),
			"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
		));
	}

}

?>