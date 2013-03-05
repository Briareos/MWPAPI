<?php

namespace MWP\Repository;

use PDO;
use MWP\Entity\User;

class UserRepository extends BaseRepository
{
    public function getEntityClass()
    {
        return 'MWP\Entity\User';
    }

    /**
     * @param int $id
     * @return User|null
     */
    public function findById($id)
    {
        $qb = $this->createQueryBuilder();
        $qb->from($this->getPrefix() . 'users', 'u');
        $qb->select(
            'u.ID',
            'u.user_login',
            'u.user_pass',
            'u.user_nicename',
            'u.user_email',
            'u.user_url',
            'u.user_registered',
            'u.user_activation_key',
            'u.user_status',
            'u.display_name'
        );
        $qb->where('u.id = :id');
        $qb->setParameter('id', $id);

        /** @var $stmt \Doctrine\DBAL\Statement */
        $stmt = $qb->execute();

        $user = null;
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->getEntityClass());
            $user = $stmt->fetch();
        }
        return $user;
    }
}
