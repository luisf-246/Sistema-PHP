<?php
    session_start();
    include_once('conexao.php');

    //Verificar se o usuário está logado para acessar a página
    if((isset($_SESSION['usuario']) == true) && (isset($_SESSION['senha']) == true)){
        if(isset($_FILES['arquivo']) && !empty($_POST['categoria']) && !empty($_POST['descricao'])){
            $arquivo = $_FILES['arquivo'];

            if($arquivo['error']){
                die("Falha ao enviar arquivo");
            }
            
            $usuario = $_SESSION['usuario'];
            $categoria = $_POST['categoria'];
            $descricao = $_POST['descricao'];
            
            //Pasta na onde serão salvo os arquivos
            $pasta = "arquivos/";
            $nomeDoArquivo = $arquivo['name'];
            $novoNomeDoArquivo = uniqid();
            $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

            $caminho = $pasta . $novoNomeDoArquivo . "." . $extensao;
            $confirma = move_uploaded_file($arquivo["tmp_name"], $caminho);
            if($confirma){
                if(!mysqli_query($conexao, "INSERT INTO arquivos (usuario, arquivo, categoria, descricao)
                   VALUES ('$usuario', '$caminho', '$categoria', '$descricao')")){

                    echo("Descrição do erro: " . mysqli_error($conexao));  
                }
                $_SESSION['enviado'] = true;
                mysqli_close($conexao);
            }else{
                $_SESSION['no_enviado'] = true;
                mysqli_close($conexao);
            }
        }
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
    <title> Cadastro De Itens </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">

</head>
<body class="body_inicial">
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-black">
        <div class="container-fluid"> 
            <h2 class="navbar-brand"> Cadastro De Itens </h2>
        </div>
        <div class="d-flex">
            <a href="inicial.php" class="btn btn-danger  me-5"> Voltar </a>
        </div>
    </nav>
    <form class="form_itens" action="cadastrar_itens.php" method="POST" enctype="multipart/form-data">

        <label class="label_itens"> Arquivo </label>
        <input class="input_itens" type="file" name="arquivo">
        <label class="label_itens"> Categoria </label>
        <input class="input_itens" type="text" name="categoria" placeholder="Digite a Categoria">
        <label class="label_itens"> Descrição </label>
        <input class="input_itens" type="text" name="descricao" placeholder="Digite a Descrição">
        <button class="btn_enviar" type="submit" name="submit"> Enviar </button>
        <?php
            if((@$_SESSION['enviado'])){
            ?>
                <h4 class="h4_itens"> Enviado Com Sucesso </h4>
            <?php
            }
            unset($_SESSION['enviado']);
            ?>
            <?php
            if((@$_SESSION['no_enviado'])){
            ?>
                <h4 class="h4_danger"> Erro ao Enviar Arquivo </h4>
            <?php
            }
            unset($_SESSION['no_enviado']);
        ?>
    </form>
</body>
</html>