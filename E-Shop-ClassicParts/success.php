<?php

require_once "HTML/Template/IT.php";


  $template = new HTML_Template_IT('.');
  $template->loadTemplatefile('register_success.html', true, true);

   
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

  $template->show();

 
?>