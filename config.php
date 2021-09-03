<?php

// var = new mysqli('host', 'usuariophpmyadmin', 'senhaphpmyadmin', 'banco')
$mysql = new mysqli('localhost', 'root', '', 'blog');
$mysql -> set_charset('utf8'); // Para ajustar o charset do banco com a aplicação

// Verificando se houve erro na tentativa de conexão com o banco
if (!$mysql) {
    echo "Banco desconectado";
}