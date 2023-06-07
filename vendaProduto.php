<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Venda Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include ('config.php');  ?>

</head>
<body>
    <form action="vendaProduto.php" method="post" name="venda">
        <table>
            <tr>
                <td>Venda de Produto</td>
            </tr>
            <tr>
                <td>Código Cliente:</td>
                <td><input type="number" name="cod_cliente" ></td>
            </tr>
            <tr>
                <td>Código Produto:</td>
                <td><input type="number" name="cod_produto" ></td>
            </tr>
            <tr>
                <td>Data:</td>
                <td><input type="date" name="data" ></td>
            </tr>
            <tr>
                <td>Valor:</td>
                <td><input type="number" name="valor" ></td>
            </tr>
            <tr>
                <td>Quantidade:</td>
                <td><input type="number" name="qtde" ></td>
            </tr>
            <tr>
                <td><input type="submit" value="Enviar" name="botaoVenda"></td>
            </tr>	
        </table>
    </form>


    <?php
        if (@$_POST['botaoVenda'] == "Enviar") 
        {

            $CODIGO_CLIENTE = $_POST['cod_cliente'];
            $CODIGO_PRODUTO = $_POST['cod_produto'];
            $DATA = $_POST['data'];
            $VALOR = $_POST['valor'];
            $QTDE = $_POST['qtde'];
            
            $insere = "INSERT into VENDA (CODIGO_CLIENTE, CODIGO_PRODUTO, DATA, VALOR, QTDE) VALUES ('$CODIGO_CLIENTE', '$CODIGO_PRODUTO', '$DATA', '$VALOR', '$QTDE')";
            mysqli_query($mysqli, $insere) or die ("Não foi possivel inserir os dados");
        }
    ?>

    <table width="95%" border="1" align="center">
    <tr bgcolor="#CCABD8">
        <th width="25%">Nome do Cliente</th>
        <th width="25%">Nome do Produto</th>
        <th width="25%">Data</th>
        <th width="25%">Valor Total</th>
    </tr>

    <?php
    $query = "SELECT c.NOME AS NomeCliente, p.NOME AS NomeProduto, v.DATA, (v.VALOR * v.QTDE) AS ValorTotalVenda
            FROM VENDA v
            JOIN CLIENTE c ON v.CODIGO_CLIENTE = c.CODIGO
            JOIN PRODUTO p ON v.CODIGO_PRODUTO = p.CODIGO
            GROUP BY c.NOME, p.NOME, v.DATA;";

    $result = mysqli_query($mysqli, $query);

    while ($coluna=mysqli_fetch_array($result)) 
    {
        
    ?>

        <tr>
            <th width="25%"><?php echo $coluna['NomeCliente']; ?></th>
            <th width="25%"><?php echo $coluna['NomeProduto']; ?></th>
            <th width="25%"><?php echo $coluna['DATA']; ?></th>
            <th width="25%"><?php echo $coluna['ValorTotalVenda']; ?></th>
            <br>   
        </tr>
    <?php

    } // fim while
    ?>   
    </table>
</body>
</html>