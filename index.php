<?php
    require_once "conexao.php";
    $btnFabricante = filter_input(INPUT_POST, 'addFabricante'); 

    $nomeFabricante = filter_input(INPUT_POST, 'nomeFabricante');
    $categoria1 = filter_input(INPUT_POST, 'cat1');
    $categoria2 = filter_input(INPUT_POST, 'cat2');
    $categoria3 = filter_input(INPUT_POST, 'cat3');

	$btnProduto = filter_input(INPUT_POST, 'addProduto');

    $nomeProduto = filter_input(INPUT_POST, 'addProduto');
	$fabricanteProduto = filter_input(INPUT_POST, 'fabricanteProduto');
	$categoriaProduto = filter_input(INPUT_POST, 'categoriaProduto');
	$precoProduto = filter_input(INPUT_POST, 'precoProduto');

    if (isset($btnFabricante)){
        $addFabricanteQuery = 'INSERT INTO fabricante VALUES (null, "' . $nomeFabricante . '")';

        mysqli_query($conexao, "$addFabricanteQuery");

        $buscaFabricanteQuery = 'SELECT idFabricante FROM fabricante WHERE nomeFabricante = "'.$nomeFabricante.'"';

        $result2 = mysqli_query($conexao, "$buscaFabricanteQuery");
        $fabricante = mysqli_fetch_array($result2);

        if (mysqli_num_rows($result2) != 0){

            $fabricanteId = $fabricante['idFabricante'];

            if($categoria1){
                $addCategoria1 = 'INSERT INTO categoria VALUES (null, "'.$categoria1.'", "'.$fabricanteId.'")';
            }
            if($categoria2){
                $addCategoria2 = 'INSERT INTO categoria VALUES (null, "'.$categoria2.'", "'.$fabricanteId.'")';
            }
            if($categoria3){
                $addCategoria3 = 'INSERT INTO categoria VALUES (null, "'.$categoria3.'", "'.$fabricanteId.'")';
            }
        }
    } 

    if (isset($btnProduto)){
        $buscaIdFabricanteQuery = 'SELECT idFabricante FROM fabricante WHERE nomeFabricante = "' . $fabricanteProduto. '"';
        $produtoFabricanteId = 

        $buscaIdCategoriaQuery = 'SELECT idCategoria FROM categoria WHERE nomeCategoria= "' . $categoriaProduto. '"';
        $addCategoria1 = 'INSERT INTO produto VALUES (null, "'.$nomeProduto.'", "'.$precoProduto.'", "'.$precoProduto.'", "'.$precoProduto.'" )';

    }       

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row align-content-center">
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-5 col-xxl-4 m-auto mt-5">
                <div class="card border-0 shadow rounded-0 mt-4">
                    <div class="card-body">
                        <form action="" method="POST" name="formularioFabricante" class="bg-white text-dark">
                            <h4 class="mb-3">Fabricante e categoria</h4>
                                <h5>Fabricante</h5>
                                    <input type="text" name="nomeFabricante" class="form-control rounded-0 mb-3" placeholder="Digite o nome do fabricante" required>
                                <label class="form-label"><h5 class="mb-1">Categoria</h5></label>
                                    <input type="text" name="cat1" class="form-control rounded-0 mb-3" placeholder="Digite o nome da categoria 1">
                                    <input type="text" name="cat2" class="form-control rounded-0 mb-3" placeholder="Digite o nome da categoria 2">
                                    <input type="text" name="cat3" class="form-control rounded-0 mb-3" placeholder="Digite o nome da categoria 3">
                            <div class="text-center d-grid gap-2">
                                <button type="submit" class="btn btn-outline-primary rounded-0" name="addFabricante" value="addFabricante">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-4 col-xl-5 col-xxl-4 m-auto mt-5">
                <div class="card border-0 shadow rounded-0">
                    <div class="card-body">
                        <form action="" method="POST" name="formularioProduto" class="bg-white text-dark">
                        <h4 class="mb-3">Produtos</h4>
                            <h5>Nome do produto</h5>
                                <input type="text" name="nomeProduto" class="form-control rounded-0 mb-3" placeholder="Digite o nome do produto" required>
                            <h5>Fabricante</h5>
                                <select class="form-select" name="fabricanteProduto" id="fabricanteProduto">
                                    <option selected>Selecione o fabricante</option>
                                    <?php
                                        $fabricanteQuery = "SELECT * FROM fabricante";
                                        $result = mysqli_query($conexao, "$fabricanteQuery");
                                        
                                        while ($fabricante = mysqli_fetch_array($result)) {              
                                            echo '<option value="'.$fabricante["nomeFabricante"].'"> ' . $fabricante["nomeFabricante"] . '</option>';
                                        }
                                    ?>
                                </select>
                            <h5>Categoria</h5>
                                <select class="form-select" name="categoriaProduto" id="categoriaProduto">
                                    <option selected>Selecione a categoria</option>
                                    <?php
                                        $categoriaQuery = "SELECT * FROM categoria";
                                        $result = mysqli_query($conexao, "$categoriaQuery");
                                        
                                        while ($categoria = mysqli_fetch_array($result)) {              
                                            echo '<option value="'.$categoria["nomeCategoria"].'"> ' .$categoria["nomeCategoria"]. '</option>';
                                        }
                                    ?>
                                </select>
                           <h5>Preço</h5>
                                <input type="text" name="precoProduto" class="form-control rounded-0 mb-3" placeholder="Digite o preço" required>
                            <div class="text-center d-grid gap-2">
                                <button type="submit" class="btn btn-outline-primary rounded-0" name="addProduto" value="addProduto">Adicionar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-content-center">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-10 col-xxl-9 mx-auto">
            <div class="card rounded-0 border-0 shadow mt-5">
                <div class="card-body py-0">
                    <div class="table-responsive">
                        <div class="table-hover">
                            <table class="table table-hover text-black  caption-top">
                            <caption class="text-white">Registros de login</caption>
                                <thead class="table-light border-dark border-bottom border-3">
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome produto</th>
                                    <th scope="col">Fabricante</th>
                                    <th scope="col">Categoria</th>
                                    <th scope="col">Preço</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $produtoQuery = "SELECT idProduto, nomeProduto, nomeFabricante, nomeCategoria, precoProduto FROM produto p 
                                        JOIN fabricante f JOIN categoria c 
                                        ON p.categoria_fk = idCategoria 
                                        AND p.fabricante_fk = idFabricante";
                        
                                        $total_reg = "8";
                                        @$pagina=$_GET['pagina'];
                                        if (!$pagina) {

                                            $pc = "1";
                                        } 
                                        else {
                                            $pc = $pagina;
                                        }
                                        $inicio = $pc - 1;
                                        $inicio = $inicio * $total_reg;
                                        $limite = mysqli_query($conexao, "$produtoQuery LIMIT $inicio, $total_reg");
                                        $todos = mysqli_query($conexao, "$produtoQuery");

                                        $tr = mysqli_num_rows($todos);
                                        $tp = $tr / $total_reg;

                                        while ($produto = mysqli_fetch_array($limite)) {              
                                            echo '<tr>';
                                            echo '<td>'.$produto["idProduto"].'</td>';
                                            echo '<td>'.$produto["nomeProduto"].'</td>';
                                            echo '<td>'.$produto["nomeFabricante"].'</td>';
                                            echo '<td>'.$produto["nomeCategoria"].'</td>';
                                            echo '<td>'.$produto["precoProduto"].'</td>';
                                            echo '</tr>';
                                        }                           
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card rounded-0 border-0 shadow">
                <div class="card-body">
                    <form action="" method="GET" >
                        <div class="text-center d-grid gap-2 col-6 mx-auto d-md-block">
                            <div class="input-group mb-3">
                                <label for="1" class="col-form-label col-form-label-lg fs-4 px-3">Página</label>
                                <input type="text" name="pagina" class="form-control col-xs-1" id="1" aria-label="Recipient's username" aria-describedby="button-addon2" value="<?php echo $pc ?>">
                                <button class="btn btn-outline-primary" name="btnPag" type="submit" id="button-addon2">Ir</button><div class="col-form-label col-form-label-md fs-4 px-3">de <?php echo ceil($tp) ?></div>
                            </div>
                            <a href="baixaPlanilha.php" class="btn btn-outline-primary mx-2 rounded-0" name="btnPlanilha" type="button" id="button-addon2" aria-label="Recipient's username" aria-describedby="button-addon2" target="_blank">Baixar Planilha</a>
                            <a href='logout.php' type="button" name="botaoLogout" class="btn btn-outline-primary mx-2 rounded-0" >Deslogar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>