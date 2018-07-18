<?php
require_once "HTML/Template/IT.php";
include 'inc/db.php';
session_start();
function display()
{    
    $template = new HTML_Template_IT('.');
    $template->loadTemplatefile('carrinho.html', true, true);

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

     if(!isset($_SESSION['username']))
     	header('Location: login.php ');

     if(isset($_SESSION["cart_products"]))
        {

        	foreach ($_SESSION["cart_products"] as $cart_itm)
            {
            $id = $cart_itm["product_id"];
            $nome =$cart_itm["product_name"];
            $preco = $cart_itm["product_preco"];
            $tipo = $cart_itm["product_type"];
            $disp = $cart_itm["product_disp"];
            
            $total = $total + $preco;

            $template->setCurrentBlock("CARRINHO");
            $template->setVariable('ID', $id);
            $template->setVariable('NOME', $nome);
            $template->setVariable('PRECO', $preco);
            $template->setVariable('DISP', $disp);
            $template->setVariable('TIPO', $tipo);
            $template->parseCurrentBlock();

        	}

            $template->setCurrentBlock("TOTAL");
            $template->setVariable('TOTAL',$total );
            $template->parseCurrentBlock();
            $template->show();
        }
        else{
          header('Location: carrinhovazio.html ');
        }
}
    

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
 display();
 mysql_close($db);
}
?>

