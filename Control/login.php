<?php 
session_start();
$url=$dados = file_get_contents('http://localhost/apicold/getUser/'.$_POST['nick'].'/'.$_POST['senha']);
$dados = json_decode($dados, true);
try{
    if (is_array($dados)) {
        if (count($dados)==2) {
            $_SESSION['ice']['pagina']='View/apontamento.php';
            $_SESSION['ice']['user']=$dados['user'];
            $_SESSION['ice']['nivel']=$dados['nivel'];
        } else{
            $_SESSION['ice']['erro']=true;
            $_SESSION['ice']['mensagem']='Usuário não autorizado';
        }     
    }
}catch(Exception $e){
    $_SESSION['ice']['erro']=true;
    $_SESSION['ice']['mensagem']='Usuário não autorizado';

}

header('location:../');
?>