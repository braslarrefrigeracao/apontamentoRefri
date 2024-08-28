<div class="container m-2 p-2">
    <div class="container m2-p-2">
        <div class="row">
            <div class="col-3">
                <img src="content/logobranco.png" width="200px;"  class="">
            </div>
            <div class="col-6">
 <h2 class="text-center m-2 p-2">
            <?php
                if(isset($_SESSION['ice']['linha'])){
                    echo ("Apontamento: <i style='font-size:150%;padding:3px 8px;color:yellow; font-weight:bolder;text-shadow:2px 2px 2px #000;'>".$_SESSION['ice']['linha']).'</i>';
                  
                }else{
                    echo ("Apontamento ");
                }
            ?>

        </h2>
            </div>
            <div class="col-3">
                <a href="Control/sair.php" class="btn btn-sm btn-warning">Sair</a>
            </div>
        </div>
    
       
       
    </div>
</div>