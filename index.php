<?php

require_once("config.php");

/*
SELECT - SELECIONA OS USUARIOS DA TABELA

$database = new Database();

$usuarios = $database->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);

==============================================================
CARREGA APENAS UM USUARIO BUSCANDO PELO ID

$user = new Usuario();

$user->loadById(2);

echo $user;

==============================================================
CARREGA A LISTA DE USUARIO

$lista = Usuario::getList();

echo json_encode($lista);

==============================================================
CARREGA UMA LISTA DE USUARIO BUSCANDO PELO LOGIN

$search = Usuario::search("u");

echo json_encode($search);

==============================================================
VALIDACAO DE LOGIN

$usuario = new Usuario();
$usuario->login("krause", "210797");

echo $usuario;

==============================================================
INSERT USUARIO - INSERI USUARIO NA TABELA
---------------------------------------
insert SEM __construct($login, $senha)
---------------------------------------

$aluno = new Usuario();

$aluno->setLogin("aluno");
$aluno->setSenha("@luno");

$aluno->insert();

echo $aluno;

---------------------------------------
insert COM __construct($login, $senha)
---------------------------------------

$aluno = new Usuario("aluno", "@luno");

$aluno->insert();

echo $aluno;

==============================================================
UPDATE - ALTERAR USUÁRIO

$usuario = new Usuario();

$usuario->loadById(4);

$usuario->update("professor", "master");

echo $usuario;

==============================================================
DELETE - DELETAR USUÁRIO
*/
$usuario = new Usuario();

$usuario->loadById(6);

$usuario->delete();

echo $usuario;

?>