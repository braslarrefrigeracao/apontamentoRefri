<?php 
session_start();
$dados = file_get_contents('http://localhost/apicold/getUser/'.$_POST['nick'].'/'.$_POST['senha']);
$dados = json_decode($dados, true);
try{
    if (is_array($dados)) {
        # code...
    }
if (count($dados)==2) {
    $_SESSION['ice']['pagina']='View/apontamento.php';
    $_SESSION['ice']['user']=$dados['user'];
    $_SESSION['ice']['nivel']=$dados['nivel'];
} else{
    echo 'erro';
}
}catch(Exception $e){
    echo 'erro';

}

header('location:../');
?>