<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            $dsn = 'mysql:dbname=produto;host=localhost:3306';
            $user = "root";
            $password = "";
            try {
                $dbh = new PDO($dsn,$user,$password);   
   
                $prod        = $_GET["PRODUTO"];
                $peso        = $_GET["PESO"];
                $qde         = $_GET["QUANTIDADE"];
                $preco       = $_GET["PRECO"];
                $buscaprod   = $_GET["BUSCAPROD"];
                $buscapreco  = $_GET["PRODPRECO"];
                $comando = $_GET["COMANDO"];
                
                if($comando == "Insere"){
                        $sql = "INSERT INTO TB_LISTA(PRODUTO, PESO, QUANTIDADE, PRECO) "
                                . "VALUES( '$prod','$peso','$qde','$preco');";
                        $dbh->exec($sql);
                }
                if($comando == "Lista"){
                    $sql = "SELECT PRODUTO, PESO, QUANTIDADE, PRECO"
                            . " FROM TB_LISTA;";             
                    $resultado = $dbh->query($sql);

                    print "<table border=3>";
                    foreach ($resultado as $row) {
                        print   "<TR> "
                                . "<TD>" . $row["PRODUTO"]    . "</TD>"
                                . "<TD>" . $row["PESO"]       . "</TD>"
                                . "<TD>" . $row["QUANTIDADE"] . "</TD>"
                                . "<TD>" . $row["PRECO"]      . "</TD>"
                                . "</TR>";
                    }
                    print "</table>";
                }
                if($comando == "Dados Produto"){
                    $sql = "SELECT PRODUTO, PESO, QUANTIDADE, PRECO"
                            . " FROM TB_LISTA"
                            . " WHERE '$buscaprod' = PRODUTO;";
                    
                    $resultado = $dbh->query($sql);
                    $total = 0.0;
                    print "<table border=3>";
                    foreach ($resultado as $row) {
                        $total += $row["PESO"] * $row["QUANTIDADE"] * $row["PRECO"];     
                                
                        print   "<TR> "
                                . "<TD>" . $row["PRODUTO"]    . "</TD>"
                                . "<TD>" . $row["PESO"]       . "</TD>"
                                . "<TD>" . $row["QUANTIDADE"] . "</TD>"
                                . "<TD>" . $row["PRECO"]      . "</TD>"
                                . "</TR>";
                    }
                        print   "<TR> "
                                . "<TD> Total gasto:  </TD>"
                                . "<TD> R$ </TD>"
                                . "<TD>" . $total . "</TD>"
                                . "<TD></TD>"
                                . "</TR>";
                    
                    print "</table>";
                }
                if($comando == "Total" ){
                    $sql = "SELECT PRODUTO, PESO, QUANTIDADE, PRECO"
                            . " FROM TB_LISTA;";             
                    $resultado = $dbh->query($sql);
                    $total = 0.0;
                    print "<table border=3>";
                    foreach ($resultado as $row) {
                        $total += $row["PESO"] * $row["QUANTIDADE"] * $row["PRECO"];     
                                
                        print   "<TR> "
                                . "<TD>" . $row["PRODUTO"]    . "</TD>"
                                . "<TD>" . $row["PESO"]       . "</TD>"
                                . "<TD>" . $row["QUANTIDADE"] . "</TD>"
                                . "<TD>" . $row["PRECO"]      . "</TD>"
                                . "</TR>";
                    }
                        print   "<TR> "
                                . "<TD> Total gasto:  </TD>"
                                . "<TD> R$ </TD>"
                                . "<TD>" . $total . "</TD>"
                                . "<TD></TD>"
                                . "</TR>";
                    
                    print "</table>";
                    
                }
                if($comando == "Busca Prod Preco"){
                                        $sql = "SELECT PRODUTO, PESO, QUANTIDADE, PRECO"
                            . " FROM TB_LISTA"
                            . " WHERE '$buscapreco' > PRECO;";
                    
                    $resultado = $dbh->query($sql);
                    $total = 0.0;
                    print "<table border=3>";
                    foreach ($resultado as $row) {
                        $total += $row["PESO"] * $row["QUANTIDADE"] * $row["PRECO"];     
                                
                        print   "<TR> "
                                . "<TD>" . $row["PRODUTO"]    . "</TD>"
                                . "<TD>" . $row["PESO"]       . "</TD>"
                                . "<TD>" . $row["QUANTIDADE"] . "</TD>"
                                . "<TD>" . $row["PRECO"]      . "</TD>"
                                . "</TR>";
                    }
                        print   "<TR> "
                                . "<TD> Total gasto:  </TD>"
                                . "<TD> R$ </TD>"
                                . "<TD>" . $total . "</TD>"
                                . "<TD></TD>"
                                . "</TR>";
                    
                    print "</table>";
                }
                                
            } catch (Exception $exc) {
                echo "Erro no banco" . $exc->getTraceAsString();
            }
        
        
        ?>
    </body>
</html>
