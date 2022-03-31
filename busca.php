<?php
    session_start();
    include_once('conexao.php');

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
    <title> Busca </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo.css">

</head>
<body class="body_inicial">
    <nav class="navbar fixed-top navbar-expand-lg bg-black">
        <div class="container-fluid"> 
            <h2 class="navbar-brand"> Buscar </h2>
        </div>
        <div class="d-flex">
            <a href="inicial.php" class="btn btn-danger  me-5"> Voltar </a>
        </div>
    </nav>
    <form class="form_busca" action="" method="GET">
        <input class="input_busca" type="text" name="buscar" placeholder="Pesquisar">
        <button class="btn_busca" type="submit" name="submit"> Pesquisar </button>
    </form>
    <table>
        <tr> 
            <th> Imagem </th>
            <th> Categoria </th>
            <th> Descrição </th>
            <th> Perfil </th>
        </tr>
        <?php
        if(empty($_GET['buscar'])){
        ?>
        <tr> 
            <td colspan="4"> Digite algo para pesquisar </td>
        </tr>
        <?php
        }else{
            $pesquisa = mysqli_real_escape_string($conexao, $_GET['buscar']);
            $query = "SELECT * FROM arquivos Where usuario LIKE '%$pesquisa%' OR categoria LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%'";

            $resultado= mysqli_query($conexao, $query);
            $row= mysqli_num_rows($resultado);
             if($row == 0){
                ?>
                <tr>
                    <td colspan="5"> Nenhum Resultado Encontrado... </td>
                </tr>
            <?php
            }else{
                 while($dados = mysqli_fetch_assoc($resultado)){
                    ?>
                    <tr>
                        <td class="imagem"> <a target="_blank" href="<?php echo $dados['arquivo']; ?>"> <img src="<?php echo $dados['arquivo']; ?>" alt=""> </a> </td>
                        <td> <?php echo $dados['categoria']; ?> </td>
                        <td> <?php echo $dados['descricao']; ?> </td>
                        <td class="perfil"> <a class="perfil" href="perfil.php?user=<?=$dados['usuario'];?>"> <?php echo $dados['usuario'];?> </a> </td>    
                    </tr>
                    <?php  
                }
            }
            ?>
        <?php             
        } ?>
    </table>
</body>
</html>