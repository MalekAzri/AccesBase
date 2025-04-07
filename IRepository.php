<?php
interface IRepository
{
    public function findAll(): array;//une fonction qui rettourne la liste de tous les enregistrements
    public function findById(int $id): ?array;//une fonction qui retourne un enregistrement par son id
    public function create(array $data): void;//une fonction ajouter un enregistrement
    public function delete(int $id): void; //une fonction qui supprime un enregistrement par son id
}


?>
