<?php
class Usuario {
    private $conexao;
    private $tabela_nome = "Usuarios";

    public $id;
    public $Usuario;
    public $telefone;

    public function __construct($db) {
        $this->conexao = $db;
    }

    function ler() {
        $query = "SELECT id, Usuario, telefone FROM " . $this->tabela_nome;
        $comando = $this->conexao->prepare($query);
        $comando->execute();
        return $comando;
    }

    function criar() {
        $query = "INSERT INTO " . $this->tabela_nome . " SET Usuario=:Usuario, telefone=:telefone";
        $comando = $this->conexao->prepare($query);
        $this->Usuario = htmlspecialchars(strip_tags($this->Usuario));
        $this->telefone = htmlspecialchars(strip_tags($this->telefone));
        $comando->bindParam(":Usuario", $this->Usuario);
        $comando->bindParam(":telefone", $this->telefone);
        if ($comando->execute()) {
            return true;
        }
        return false;
    }
}
?>
