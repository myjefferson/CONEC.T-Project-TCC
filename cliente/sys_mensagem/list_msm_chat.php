<?php //SELECIONAR MENSAGENS NO BANCO
include("../../conexao_banco.php");

if(isset($_GET['user'])){   
    $id_cli_enviou = $_GET['id_cli_enviou'];
    $id_para = $_GET['user'];

    $resultado = mysqli_query($conexao, "SELECT * FROM(SELECT * FROM chat WHERE (id_user_enviou = ".$id_cli_enviou." AND id_user_recebeu = '$id_para') OR (id_user_enviou = '$id_para' AND id_user_recebeu = ".$id_cli_enviou.") ORDER BY id DESC) sub ORDER BY id ASC ") or die("");
    $conta = mysqli_num_rows($resultado);

    if($conta <= 0){
        //echo"<code>{ HELLO! }</code>";
    }else{
        while($row = mysqli_fetch_array($resultado)){
            
            //se enviei mensagem
            if($row['id_user_enviou'] == $id_cli_enviou){ ?>
                <div align="right" id="right"><p><?php echo$row['mensagem']; ?></p></div>
            <?php }
                //Não enviei mensagem esquerda
                else if($row['id_user_enviou'] != $id_cli_enviou){ ?>
                <div id="left"><p><?php echo$row['mensagem']; ?></p></div>
            <?php } ?>                                                   
<?php }}} ?>