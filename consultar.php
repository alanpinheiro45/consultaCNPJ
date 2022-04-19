<!DOCTYPE html>
<html lang="pt-br">
  
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        body{
            background-color: #003948;
            color:aliceblue;
            text-align: center;
        }
        table{
            color:aliceblue!important;
        }

    </style>

</head>
<body>

<div class="container mt-5">
    <?php
  
    $cnpj = $_GET['Cnpj'];
    $cnpjstring = substr($cnpj,0,2) . "." . substr($cnpj,2,3) . "." . substr($cnpj,5,3) . "/" . substr($cnpj,8,4). "-" . substr($cnpj,12,2);
    
    $db= new PDO("sqlite:CnpjDB.sqlite3");
    $result =  $db->query(" SELECT * FROM Consulta WHERE cnpj = '$cnpjstring'", PDO::FETCH_ASSOC);
    $resultados = $result->fetchAll();
    echo $cnpjstring;

        if(count($resultados)<=0){

            $curl = curl_init();

            echo("<br>Não foi encontrado registros no banco de dados<br>");

            //Consulta API
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://receitaws.com.br/v1/cnpj/$cnpj",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //Fim Consulta API

            //Converte resposta em json para PHP
            $response = json_decode($response, true);
            //Fim conversão
            
            //print_r($response);
            //print_r($response['atividades_secundarias'][0]['text']);

            //Inserção dos valores no banco de dados
            $linhasafetadas = $db->exec(" INSERT INTO Consulta 
            ('nome',
            'uf',
            'telefone',
            'cnpj',
            'atividade_principal',
                'data_situacao',
                'complemento',
                'tipo',
                'atividades_secundarias',
                'situacao',
                'bairro',
                'logradouro',
                'numero',
                'cep',
                'municipio',
                'porte',
                'abertura',
                'natureza_juridica',
                'ultima_atualizacao',
                'status',
                'fantasia',
                'email',
                'efr',
                'motivo_situacao',
                'situacao_espacial',
                'data_situacao_especial',
                'capital_social',
                'extra',
                'billing') 
            VALUES('$response[nome]',
            '$response[uf]',
            '$response[telefone]',
            '$response[cnpj]',
            '". $response['atividade_principal'][0]['text'] .  "',
            '$response[data_situacao]',
            '$response[complemento]',
            '$response[tipo]',
            '".$response['atividades_secundarias'][0]['text'] ."',
            '$response[situacao]',
            '$response[bairro]',
            '$response[logradouro]',
            '$response[numero]',
            '$response[cep]',
            '$response[municipio]',
            '$response[porte]',
            '$response[abertura]',
            '$response[natureza_juridica]',
            '$response[ultima_atualizacao]',
            '$response[status]',
            '$response[fantasia]',
            '$response[email]',
            '$response[efr]',
            '$response[motivo_situacao]',
            '$response[situacao_especial]',
            '$response[data_situacao_especial]',
            '$response[capital_social]',
            '',
            '')");
            //Fim Inserção
                 
            if($linhasafetadas>0){

                echo("Sucesso!");
                header("Refresh:0");

            }


        }else {
            echo("<br>Existe um registro igual no banco de dados<br>");

        }
    ?>
        <?php $resultados = $resultados[0]; ?>
        <table class="table table-bordered mt-5">

            <tr>
                <th>Cnpj</th>
                <td> <?=$resultados['cnpj']?> </td>
            </tr>
            <tr>
                <th>Nome</th>
                <td><?=$resultados['nome']?></td>
            </tr>
            <tr>
                <th>Telefone</th>
                <td><?=$resultados['telefone']?></td>
            </tr>
            <tr>
                <th>UF</th>
                <td><?=$resultados['uf']?></td>
            </tr>
            <tr>
                <th>Atividade Principal</th>
                <td><?=$resultados['atividade_principal']?></td>
            </tr>
            <tr>
                <th>Data Situação</th>
                <td><?=$resultados['data_situacao']?></td>
            </tr>
            <tr>
                <th>Complemento</th>
                <td><?=$resultados['complemento']?></td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td><?=$resultados['tipo']?></td>
            </tr>
            <tr>
                <th>Atividades Secundárias</th>
                <td><?=$resultados['atividades_secundarias']?></td>
            </tr>
            <tr>
                <th>Situação</th>
                <td><?=$resultados['situacao']?></td>
            </tr>
            <tr>
                <th>Bairro</th>
                <td><?=$resultados['bairro']?></td>
            </tr>
            <tr>
                <th>Logradouro</th>
                <td><?=$resultados['logradouro']?></td>
            </tr>
            <tr>
                <th>Número</th>
                <td><?=$resultados['numero']?></td>
            </tr>
            <tr>
                <th>Cep</th>
                <td><?=$resultados['cep']?></td>
            </tr>
            <tr>
                <th>Município</th>
                <td><?=$resultados['municipio']?></td>
            </tr>
            <tr>
                <th>Porte</th>
                <td><?=$resultados['porte']?></td>
            </tr>
            <tr>
                <th>Abertura</th>
                <td><?=$resultados['abertura']?></td>
            </tr>
            <tr>
                <th>Natureza Jurídica</th>
                <td><?=$resultados['natureza_juridica']?></td>
            </tr>
            <tr>
                <th>Última Atualização</th>
                <td><?=$resultados['ultima_atualizacao']?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?=$resultados['status']?></td>
            </tr>
            <tr>
                <th>Nome Fantasia</th>
                <td><?=$resultados['fantasia']?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?=$resultados['email']?></td>
            </tr>
            <tr>
                <th>EFR</th>
                <td><?=$resultados['efr']?></td>
            </tr>
            <tr>
                <th>Motivo Situação</th>
                <td><?=$resultados['motivo_situacao']?></td>
            </tr>
            <tr>
                <th>Situação Especial</th>
                <td><?=$resultados['situacao_espacial']?></td>
            </tr>
            <tr>
                <th>Data Situação Especial</th>
                <td><?=$resultados['data_situacao_especial']?></td>
            </tr>
            <tr>
                <th>Capital Social</th>
                <td><?=$resultados['capital_social']?></td>
            </tr>
        </table>
    </div>
</body>
</html>