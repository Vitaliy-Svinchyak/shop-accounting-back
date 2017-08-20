<?php

namespace Application\Repository;

use Application\Entity\User;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{

    /**
     * @param string $email
     *
     * @return null|User
     */
    public function findOneByEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }

}