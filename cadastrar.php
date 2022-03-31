<?php
    session_start();
    include_once('conexao.php');

    //Verificação de parâmetros
    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha'])){
        $usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
        $senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));

        $query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = mysqli_query($conexao, $query);
        $row = mysqli_num_rows($resultado);
        //confirma se existe algum usuário igual
        if($row == 1){
            $_SESSION['usuario_existe'] = true;
            header('Location: cadastro.php');
            exit;
        //Validação do cadastro
        }else{
            $resultado = mysqli_query($conexao, "INSERT INTO usuarios(usuario, senha) VALUES ('$usuario', '$senha')");

            $_SESSION['usuario_cadastrado'] = true;
            header('Location: cadastro.php');
            exit;
        }
    }else{
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: cadastro.php');
    }
?>