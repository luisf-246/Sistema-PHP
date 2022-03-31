<?php
    session_start();
    include_once('conexao.php');

    if((isset($_SESSION['usuario']) == true) && (isset($_SESSION['senha']) == true) && (isset($_GET['user']))){
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
    <title> Perfil </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">

</head>
<body class="body_inicial">
    <nav class="navbar fixed-top navbar-expand-lg bg-black">
        <div class="container-fluid"> 
            <h2 class="navbar-brand"> Perfil </h2>
        </div>
        <div class="d-flex">
            <a href="busca.php" class="btn btn-danger  me-5"> Voltar </a>
        </div>
    </nav>
        <?php 
            $user = ($_GET['user']);
            echo "<h1 class='h1_inicial'> $user </h1>";
        ?>
    <table>
        <tr> 
            <th> Imagem </th>
            <th> Categoria </th>
            <th> Descrição </th>
        </tr>
        <?php
            $query = "SELECT * FROM arquivos WHERE usuario ='$user'";
            $resultado= mysqli_query($conexao, $query);
            $row= mysqli_num_rows($resultado);

            if($row == 0){
                ?>
                <tr>
                    <td colspan="3"> Nenhum Resultado Encontrado... </td>
                </tr>
            <?php
            }else{
                while($dados = mysqli_fetch_assoc($resultado)){
                    ?>
                    <tr>
                        <td class="imagem"> <a target="_blank" href="<?php echo $dados['arquivo']; ?>"> <img src="<?php echo $dados['arquivo']; ?>" alt=""> </a> </td>
                        <td> <?php echo $dados['categoria']; ?> </td>
                        <td> <?php echo $dados['descricao']; ?> </td>
                    </tr>
                    <?php  
                }
            }
            ?>
    </table>
</body>
</html>