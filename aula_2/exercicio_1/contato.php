<?php

    if ($_SERVER['REQUEST_METHOD'] ==='POST'){

        echo 'Método HTTP: ' . $_SERVER['REQUEST_METHOD'] . '<br>';
        echo 'Cabeçalho HTTP: ' . json_encode(apache_request_headers()) . '<br>';

        if(isset($_POST['nome'])){
            $sNome = $_POST['nome'];
            echo 'Nome informado: ' . $sNome . '<br>';
        }

        if(isset($_POST['email'])){
            $sEmail = $_POST['email'];
            echo 'E-mail informado'. $sEmail . '<br>';
        }

        if(isset($_POST['telefone'])){
            $sTelefone = $_POST['telefone'];
            echo 'Telefone informado'. $sTelefone . '<br>';
        }
        if(isset($_POST['mensagem'])){
            $sMensagem = $_POST['mensagem'];
            echo 'Mensagem'. $sMensagem . '<br>';
        }

    }

    if ($_SERVER['REQUEST_METHOD'] ==='GET'){

        if ($_GET['requisicaoGet'] == 'true'){
            echo 'Requisição GET realizada com sucesso';
        }  

    }