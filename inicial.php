<?php
    session_start();
    include_once('conexao.php');
    // Verifica se o usuário está logado na sessão 
    if((isset($_SESSION['usuario']) == true) && (isset($_SESSION['senha']) == true)){
        $logado = $_SESSION['usuario'];

    }else{
        unset($_SESSION['usuario']);
        unset($_SESSION['senha']);
        header('Location: index.php');
    }
?>

<!DOCTYPE <html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Página Inicial </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">
    
</head>
<body class="body_inicial">
    <nav class="navbar fixed-top navbar-expand-lg bg-black">
        <div class="container-fluid"> 
            <h2 class="navbar-brand"> CDZ - Colecionadores do Zodíaco </h2>                
        </div>
        <div class="d-flex">
            <a href="logout.php" class="btn btn-danger me-5"> Sair </a>
        </div>
    </nav>
    <?php
        echo "<h1 class='h1_inicial'> Bem Vindo: $logado </h1>";  
    ?>
    <div class="box">
        <a class="a_2" href="busca.php"> Buscar Itens </a>
        <a class="a_2" href="cadastrar_itens.php"> Cadastrar Itens </a>
        <a class="a_2" href="deletar.php"> Excluir Itens </a>
    </div>
</body>
</html>