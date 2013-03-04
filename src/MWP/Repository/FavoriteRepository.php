<?php

namespace MWP\Repository;

use MWP\Entity\Favorite;

class FavoriteRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function getEntityClass()
    {
        return 'MWP\Entity\Favorite';
    }

    public function getAvailableTypes()
    {
        return array(
            'theme',
            'plugin',
        );
    }

    public function isTypeAvailable($type)
    {
        return array_search($type, $this->getAvailableTypes(), true) !== false;
    }

    /**
     * @param $type
     * @param array $options
     * @return Favorite[]
     * @throws \Exception
     */
    public function findPopular($type, array $options = array())
    {
        if (!$this->isTypeAvailable($type)) {
            throw new \Exception(sprintf('Unrecognized type specified: "%s".', $type));
        }

        $options += array(
            'offset' => null,
            'limit' => null,
        );

        $qb = $this->createQueryBuilder();

        $qb->from($this->prefix . 'mwp_favorites', 'f');
        $qb->select(
            'f.user_id',
            'f.type',
            'f.name',
            'f.url',
            'f.description',
            'f.active'
        );
        $qb->where('f.type = :type');

        $qb->addSelect('COUNT(*) AS popularity');
        $qb->orderBy('popularity', 'DESC');
        $qb->groupBy('f.url');

        if ($options['offset'] !== null) {
            $qb->setFirstResult($options['offset']);
        }
        if ($options['limit'] !== null) {
            $qb->setMaxResults($options['limit']);
        }

        $params = array('type' => $type);
        $stmt = $this->db->executeQuery($qb->getSQL(), $params);

        $favorites = array();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(\PDO::FETCH_CLASS, $this->getEntityClass());
            /** @var $favorite Favorite */
            while ($favorite = $stmt->fetch()) {
                $favorites[$favorite->getUrl()] = $favorite;
            }
        }

        return $favorites;
    }
}