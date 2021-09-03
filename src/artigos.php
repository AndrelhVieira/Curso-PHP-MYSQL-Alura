<?php

class Artigo {

    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this-> mysql = $mysql;
    }

    public function exibirTodos(): array
    {
        $query = $this -> mysql -> query("SELECT id, titulo, conteudo FROM artigos;"); // Faz a consulta no banco

        $artigos = $query -> fetch_all(MYSQLI_ASSOC); // Transforma a query do tipo mysqli para uma maneira mais legível para o php

        return $artigos;
    }

    public function encontrarPorId(string $id)
    {
        // Evitando falhas de segurança como SQLinjection
        $selecionaArtigo = $this -> mysql -> prepare("SELECT id, titulo, conteudo FROM artigos WHERE id = ?"); // prepara a query para receber parâmetro
        $selecionaArtigo -> bind_param('s', $id); // Vai vincular o ID com o sinal de "?"
        $selecionaArtigo -> execute(); // Executa a query
        $artigo = $selecionaArtigo -> get_result() -> fetch_assoc(); // Pega o resultado da query e retorna como um array associoativo
        return $artigo;
    }

    public function adicionar(string $titulo, string $conteudo): void
    {
        $insereArtigo = $this -> mysql -> prepare("INSERT INTO artigos (titulo, conteudo) VALUES (?, ?);");
        $insereArtigo -> bind_param("ss", $titulo, $conteudo);
        $insereArtigo -> execute();
    }

    public function delete(string $id): void
    {
        $removerArtigo = $this -> mysql -> prepare("DELETE FROM artigos WHERE id = ?");
        $removerArtigo -> bind_param('s', $id);
        $removerArtigo -> execute();
    }

    public function editar(string $id, string $titulo, $conteudo): void
    {
        $editaArtigo = $this -> mysql -> prepare("UPDATE artigos SET titulo = ?, conteudo = ? WHERE id = ?");
        $editaArtigo -> bind_param("sss", $titulo, $conteudo, $id);
        $editaArtigo -> execute();
    }
}
?>