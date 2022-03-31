<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Entrar - CDZ Colecionadores Do Zodíaco</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">

</head>
<body class="body_index">
    <!-- Formulário de login -->
    <form class="form_lg_cd" action ="login.php" method ="POST">

        <h1 class="h1_lg"> Login </h1>

        <label class="label_lg_cd"> Usuario </label>
        <input class="input_lg_cd" type="text" name="usuario" placeholder="Informe o Usuário">
        <label class="label_lg_cd"> Senha </label>
        <input class="input_lg_cd" type="password" name="senha" placeholder="Informe a Senha">
        <?php
        //Mostrar mensagem de erro
        if((@$_SESSION['not'])){
        ?>
        <div>
            <h4 class="h4_danger"> Erro Usuário ou Senha Incorretos! </h4>
        </div>
        <?php
        }
        unset($_SESSION['not']);
        ?>
        <button class="btn_lg_cd"> <a class="a_lg_cd a_lg_cd:hover" href="cadastro.php"> Cadastrar-se </a> </button>
        <button class="btn_entrar" type="submit" name="submit"> Entrar </button>
    </form>
</body>
</html>