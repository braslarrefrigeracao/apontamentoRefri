<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if(!isset($_SESSION['ice']['user'])){
$_SESSION['ice']['pagina']='View/login.php';
$_SESSION['ice']['titulo']='Braslar Refrigeração- Apontamento - Login';
}


    if (isset($_SESSION['ice']['erro'])){
        
        if ($_SESSION['ice']['erro']==true) {
          
         $script="<script>";
         $script.="alert('";
         $script.=$_SESSION['ice']['mensagem'];
         $script.="')";
         $script.="</script>";
   
        }
        unset($_SESSION['ice']['erro']);
        
     }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (!isset($_SESSION['ice']['titulo'])) {
            echo "Braslar Refrigeração - Apontamento";
        } else {
            echo $_SESSION['ice']['titulo'];
        }
        if (!isset($_SESSION['ice']['linha'])) {
            $_SESSION['ice']['linha']="Linha 1";
        } 
        ?>
    </title>
    <link rel="icon" type="image/x-icon" href="content/icone.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap-icons.css">
    
   
</head>

<body>
    <div style="background-color:#333; color:#fff;margin-top:-8px; padding:0">
    <div class="container">
      <?php
        include('template/header.php');
    ?>  
    </div>
    </div>
    <div class="container">
        <?php 
        include($_SESSION['ice']['pagina']);
        ?>
    </div>
   

    <script src="script.js"></script>
</body>

</html>