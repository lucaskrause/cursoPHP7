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
			$row = $results[0];

			$this->setIdUsuario($row['idusuario']);
			$this->setLogin($row['deslogin']);
			$this->setSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
		}

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