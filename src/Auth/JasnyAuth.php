<?php

namespace Src\Auth;

use Jasny\Auth\Sessions;
use Jasny\Auth\User;
use Src\Repository\RepositoryInterface;

class JasnyAuth extends \Jasny\Auth
{
    use Sessions;

    private RepositoryInterface $repository;


    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int|string $id
     * @return void
     */
    public function fetchUserById($id)
    {
       return $this->repository->find($id);
    }

    /**
     * @param string $username
     * @return array
     */
    public function fetchUserByUsername($username): array
    {
        return $this->repository->findByField('email',$username)[0];
    }
}