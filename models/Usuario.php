<?php

class Usuario
{
    private PDO $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function buscarPorEmail(string $email)
    {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $comando = $this->conexao->prepare($sql);
        $comando->bindValue(':email', $email);
        $comando->execute();

        return $comando->fetch(PDO::FETCH_ASSOC);
    }
}
