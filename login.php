<?php
    session_start();
    include_once('conexao.php');

    //Verificação se existe o usário informado
    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha'])){
        $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));

        $query = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha ='$senha'";
        $resultado = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($resultado);

        if($row == 0){
            $_SESSION['not'] = true;
            header('Location: index.php');
            exit;
        }
        if($row == 1){
            $_SESSION['usuario'] = $usuario;
            $_SESSION['senha'] = $senha;
            header('Location: inicial.php');
        }else{
            unset($_SESSION['usuario']);
            unset($_SESSION['senha']); 
            header('Location: index.php');
        }
    }else{
        header('Location: index.php');
    }
?>