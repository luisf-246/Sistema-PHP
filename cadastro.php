<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> Cadastro </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">

</head>

<body class="body_cadastro">
    <!--Formulário de cadastro -->
    <form class="form_lg_cd" action="cadastrar.php" method="POST">

        <h1 class="h1_cd"> Cadastro </h1>

        <label class="label_lg_cd"> Usuario </label>
        <input class="input_lg_cd" type="text" name="usuario" placeholder="Informe o Usuário">
        <label class="label_lg_cd"> Senha </label>
        <input  class="input_lg_cd" type="password" name="senha" placeholder="Informe a Senha">
        <?php
            if((@$_SESSION['usuario_existe'])){
            ?>
            <div>
                <h4 class="h4_danger"> Erro Usuário Já Existe! </h4>
            </div>
            <?php
            }
            unset($_SESSION['usuario_existe']);
            ?>
            <?php
            if((@$_SESSION['usuario_cadastrado'])){
            ?>
            <div>
                <h4 class="sucesso"> Usuário Cadastrado Com Sucesso! </h4>
            </div>
            <?php
            }
            unset($_SESSION['usuario_cadastrado']);
        ?>
        <button class="btn_voltar"> <a class="a_lg_cd a_lg_cd:hover" href="index.php"> Voltar </a> </button>
        <button class="btn_cad" type="submit" name="submit"> Cadastrar </button>

    </form>
</body>
</html>