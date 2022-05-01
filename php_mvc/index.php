<?php
/* 
    Simples Aplicação MVC com PHP
*/

// Identifica os dados carregados pela URL
 // ex. Alunos

if(isset($_GET['controller'])){
    $controller = $_GET['controller'].'Controller';
} // o que fazer com o aluno
else{
    $controller = 'AlunoController';
}

if(isset($_GET['metodo'])){
    $metodo = $_GET['metodo'];
} // o que fazer com o aluno
else{
    $metodo = 'listar';
}

// Carrega o controlador selecionado pela URL 
require_once 'system/Model.php';
require_once 'controller/'.$controller.'.php';

// instancia um novo objeto
$site = new $controller();  // carrega o escopo atual
$site->$metodo();
