<?php
$pdo = new PDO("mysql:host=localhost; dbname=dashboard2",'root','', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

function queimadasPorBiomas($pdo) {
    $query = $pdo->prepare(
        "SELECT bioma_referencial,
        (COUNT(1)/(SELECT COUNT(1) FROM queimadas WHERE queimadas_2018 != 0)) * 100 AS media
        FROM queimadas
        WHERE queimadas_2018 != 0
        GROUP BY bioma_referencial"
    );

    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function queimadasPorCoordenacaoRegional($pdo) {
    $query = $pdo->prepare(
        "SELECT coordenacao_regional,
        (COUNT(1)/(SELECT COUNT(1) FROM queimadas WHERE queimadas_2018 != 0)) * 100 AS media
        FROM queimadas WHERE queimadas_2018 != 0
        GROUP BY coordenacao_regional ORDER BY media DESC"
    );

    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function queimadasPorUnidadesDeConservacao($pdo) {
    $query = $pdo->prepare(
        "SELECT categoria_uc,
        (COUNT(1)/(SELECT COUNT(1) FROM queimadas WHERE queimadas_2018 != 0)) * 100 AS media
        FROM queimadas WHERE queimadas_2018 != 0
        GROUP BY categoria_uc"
    );

    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function queimadasNosUltimos7Anos($pdo) {
    $query = $pdo->prepare(
        "SELECT SUM(queimadas_2018) AS queimadas_2018,
        SUM(queimadas_2017) AS queimadas_2017,
        SUM(queimadas_2016) AS queimadas_2016,
        SUM(queimadas_2015) AS queimadas_2015,
        SUM(queimadas_2014) AS queimadas_2014,
        SUM(queimadas_2013) AS queimadas_2013,
        SUM(queimadas_2012) AS queimadas_2012
        FROM queimadas"
    );

    $query->execute();
    return $query->fetch(PDO::FETCH_OBJ);
}