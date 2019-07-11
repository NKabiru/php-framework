<?php

namespace App\Users;

use Doctrine\DBAL\Query\QueryBuilder;

class UserRepository
{
    /**
     * @var QueryBuilder
     */
    private $builder;

    public function __construct(QueryBuilder $builder)
    {
        $this->builder = $builder;
    }

    public function getAll() : array
    {
        $query = $this->builder
            ->select('id', 'name')
            ->from('users');

        return $query->execute()->fetchAll();
    }


    public function add($name) : void
    {
        $query = $this->builder
            ->insert('users')
            ->setValue('name', '?')
            ->setParameter(0, $name);

        $query->execute();
    }
}
