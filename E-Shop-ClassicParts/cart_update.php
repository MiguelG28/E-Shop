<?php
    session_start();

    include 'inc/db.php';
    require_once "HTML/Template/IT.php";
    
    function display()
    {
        $template = new HTML_Template_IT('.');
        $template->loadTemplatefile('carrinho.html', true, true);
 
        if(!isset($_SESSION['username']))
            echo "<h2>nao tem sessao</h2>";
 
        if(isset($_POST["acao"]) && $_POST["acao"]=='add' && $_POST["product_qty"]>0)
        {
            
            foreach($_POST as $key => $value)
            { 
                $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
            }
 
            unset($new_product['type']);
            unset($new_product['return_url']);
 
            //fetch product name, price from db and add to new_product array
            $new_product['product_id'] = $_POST['product_id'];
            $new_product["product_name"] = $_POST['product_name'];
            $new_product["product_type"] = $_POST['product_type'];
            $new_product["product_preco"] = $_POST['product_price'];
            $new_product["product_qty"] = $_POST['product_qty'];
            $new_product["product_disp"] = $_POST['product_disp'];
           
            if(isset($_SESSION["cart_products"]))
            {  //if session var already exist
                if(isset($_SESSION["cart_products"][$new_product['product_id']])) //check item exist in products array
                {
                    unset($_SESSION["cart_products"][$new_product['product_id']]); //unset old array item
                }          
            }

            $_SESSION["cart_products"][$new_product['product_id']] = $new_product; //update or create product session with new item
        
            
        }
        if(isset($_POST["remove_code"]) && is_array($_POST["remove_code"]))
            {
                foreach($_POST["remove_code"] as $key)
                {
                    unset($_SESSION["cart_products"][$key]);
                }
            }
        /*
        else
        {
            header('Location: register.php?error=&nome=&email=');
            die;
        }*/
        //back to return url
        header('Location: view_cart.php');
    }
    //---------------------------------//
    // Database connection
    $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
    if($db)
    {
        display();
        mysql_close($db); //Close database
    }
?>