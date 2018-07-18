<?php
include 'inc/db.php';
require_once "HTML/Template/IT.php";


function display()
{ 
$nome = '';
$email = '';

$error = $_GET["error"];
$nome = $_GET["nome"];
$email = $_GET["email"];


if($error == 1){
	$notificacao="Insira palavra passe com pelo menos 10 caracteres.";}
if($error == 2){
	$notificacao="As palavras passe introduzidas não coincidem.";}
if($error ==  3){
	$notificacao="Falha na criação de nova conta.Email já existe!";}
if($error ==  4){
  $notificacao="Insira um nome de utilizador válido.";}


   $template = new HTML_Template_IT('.');

   $template->loadTemplatefile('registo.html', true, true);
   
   $template->setCurrentBlock("MENSSAGEM");
    $template->setVariable('MESSAGE', $notificacao);
    $template->parseCurrentBlock();
   
   $template->setCurrentBlock("MENU");
     $template->setVariable('Home', "ClassicParts");
     $template->setVariable('Dropdown', "Motorizadas");
     $template->setVariable('Mota1', "Sachs");
     $template->setVariable('Mota2', "Famel");
     $template->setVariable('Mota3', "Casal");
     $template->setVariable('Menu1', "Sobre nós/Contactos");
     $template->setVariable('Menu2', "Registar");
     $template->setVariable('Menu3', "Login");
     $template->parseCurrentBlock();

   $template->setCurrentBlock("SIGN");
     $template->setVariable('Utilizador', $nome);
     $template->setVariable('Email', $email);
     $template->parseCurrentBlock();
	
   $template->show();
   
}
 

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);  
if($db) {
	
  display();
  
}
?>