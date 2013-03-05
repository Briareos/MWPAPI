<?php

namespace MWP\Repository;

use PDO;
use MWP\Entity\Group;
use MWP\Entity\User;

class GroupRepository extends BaseRepository
{
    public function getEntityClass()
    {
        return 'MWP\Entity\Group';
    }

    public function getSelectFields()
    {
        return array('g.ID', 'g.group_name', 'g.user_id');
    }

    /**
     * @param \MWP\Entity\User $user
     * @return Group[]
     */
    public function findByUser(User $user)
    {
        $qb = $this->createQueryBuilder();

        $qb->from($this->getPrefix() . 'mwp_groups', 'g');
        $qb->where('g.user_id = :user_id');

        // Join site IDs.
        $qb->innerJoin('g', $this->getPrefix() . 'mwp_group_sites', 'gs', 'gs.group_id = g.ID');
        $qb->innerJoin('gs', $this->getPrefix() . 'mwp_sites', 's', 's.ID = gs.site_id');
        $qb->groupBy('g.ID');

        $qb->select($this->getSelectFields());
        $qb->addSelect('GROUP_CONCAT(s.ID) AS site_ids');

        $qb->setParameter('user_id', $user->getId());

        /** @var $stmt \Doctrine\DBAL\Statement */
        $stmt = $qb->execute();

        $groups = array();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->getEntityClass());
            /** @var $group Group */
            while ($group = $stmt->fetch()) {
                $groups[$group->getId()] = $group;
            }
        }
        return $groups;
    }
}
