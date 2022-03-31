<?php
    session_start();
    include_once('conexao.php');

    if((isset($_SESSION['usuario']) == true) && (isset($_SESSION['senha']) == true)){
        $usuario = $_SESSION['usuario'];
        
        if(isset($_GET['deletar'])){
            $deletar = ($_GET['deletar']);
            $confirma= unlink(''.$deletar);
            if($confirma){
                $query = "DELETE FROM arquivos WHERE arquivo = '$deletar'";
                $result = mysqli_query($conexao, $query);
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
    <title> Exclusão De Itens </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">

</head>
<body class="body_inicial">
    <nav class="navbar fixed-top navbar-expand-lg bg-black">
        <div class="container-fluid"> 
            <h2 class="navbar-brand"> Excluir Itens</h2>
        </div>
        <div class="d-flex">
            <a href="inicial.php" class="btn btn-danger  me-5"> Voltar </a>
        </div>
    </nav>
        <?php 
            echo "<h1 class='h1_inicial'> $usuario </h1>";
        ?>
    <table>
        <tr> 
            <th> Imagem </th>
            <th> Categoria </th>
            <th> Descrição </th>
            <th> Excluir </th>
        </tr>
        <?php
            $query = "SELECT * FROM arquivos WHERE usuario ='$usuario'";
            $resultado = mysqli_query($conexao, $query);
            $row = mysqli_num_rows($resultado);

            if($row == 0){
                ?>
                <tr>
                    <td colspan="4"> Nenhum Resultado Encontrado... </td>
                </tr>
            <?php
            }else{
                while($dados = mysqli_fetch_assoc($resultado)){
                    ?>
                    <tr>
                        <td class="imagem"> <a target="_blank" href="<?php echo $dados['arquivo']; ?>"> <img src="<?php echo $dados['arquivo']; ?>" alt=""> </a> </td>
                        <td> <?php echo $dados['categoria']; ?> </td>
                        <td> <?php echo $dados['descricao']; ?> </td>

                        <td><a class="a_lg_cd" href="?deletar=<?php echo $dados['arquivo']; ?>"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" 
                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5
                                0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5
                                3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1
                                1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg> 
                            </a>
                        </td>
                    </tr>
                    <?php
                }
            }
        ?>
    </table>
</body>
</html>