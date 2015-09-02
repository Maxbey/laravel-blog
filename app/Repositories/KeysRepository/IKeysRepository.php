<?php namespace App\Repositories\KeysRepository;

interface IKeysRepository
{
    public function all();

    public function create($key);

    public function save(array $keys);

    public function exists($key);

    public function delete($key);
}