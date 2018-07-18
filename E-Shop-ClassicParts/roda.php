<?php

require_once "HTML/Template/IT.php";
include 'inc/db.php';
 
session_start();

function display($result)
{    
 if(isset($_SESSION['username']))
 {
    $template = new HTML_Template_IT('.');
    $template->loadTemplatefile('roda_protected.html', true, true);

     $nomeuser = $_SESSION['username'];
     $template->setCurrentBlock("MENU");
     $template->setVariable('Home', "ClassicParts");
     $template->setVariable('Dropdown', "Motorizadas");
     $template->setVariable('Mota1', "Sachs");
     $template->setVariable('Mota2', "Famel");
     $template->setVariable('Mota3', "Casal");
     $template->setVariable('Menu1', "Sobre nós/Contactos");
     $template->setVariable('Logout', "Sair");
     $template->setVariable('Welcome', "Welcome $nomeuser"); 
     $template->parseCurrentBlock();

  $tuple = mysql_fetch_array($result,MYSQL_ASSOC);
        $img = $tuple['img'];
        $id = $tuple['id'];
        $nome = $tuple['nome'];
        $preco = $tuple['preco'];
        $disp = $tuple['disp'];
        $tipo = $tuple['tipo'];

     $template->setCurrentBlock("TIPO");
     $template->setVariable('TIPO', $tipo);
     $template->parseCurrentBlock();


     $template->setCurrentBlock("RODA");
     $template->setVariable('ID', $id);
     $template->setVariable('IMG', $img);
     $template->setVariable('NOME', $nome);
     $template->setVariable('PRECO', $preco);
     $template->setVariable('TIPO', $tipo);
     $template->setVariable('DISPONIBILIDADE', $disp);
     $template->parseCurrentBlock();
    $template->show();
 }

 else{
  $template = new HTML_Template_IT('.');
  $template->loadTemplatefile('roda.html', true, true);

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

        $tuple = mysql_fetch_array($result,MYSQL_ASSOC);
        $img = $tuple['img'];
        $nome = $tuple['nome'];
        $preco = $tuple['preco'];
        $disp = $tuple['disp'];
        $tipo = $tuple['tipo'];

     $template->setCurrentBlock("TIPO");
     $template->setVariable('TIPO', $tipo);
     $template->parseCurrentBlock();


     $template->setCurrentBlock("RODA");
     $template->setVariable('IMG', $img);
     $template->setVariable('NOME', $nome);
     $template->setVariable('PRECO', $preco);
     $template->setVariable('DISPONIBILIDADE', $disp);
     $template->parseCurrentBlock();
    $template->show();
  }
  
}

 

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
  $produto = $_GET["PRODUTO"];
  $query  = "SELECT nov.disp, nov.id, nov.img, nov.nome, nov.preco, nov.tipo FROM nov WHERE nov.id = '$produto' ";

  if(!($result = @ mysql_query($query,$db )))
   showerror($db);

 display($result);
 mysql_close($db);
}
?>


 
