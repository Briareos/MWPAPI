<?php

namespace MWP\Repository;

use PDO;
use MWP\Entity\Group;
use MWP\Entity\User;
use MWP\Entity\Site;

class SiteRepository extends BaseRepository
{
    public function getEntityClass()
    {
        return 'MWP\Entity\Site';
    }

    protected function getSelectFields()
    {
        return array(
            's.ID',
            's.wp_url',
            's.wp_admin_url',
            's.site_ip',
            's.wp_username',
            's.wp_title',
            's.wp_description',
            's.db_name',
            's.ftp_host',
            's.ftp_username',
            's.ftp_password',
            's.site_key',
            's.is_readonly',
            's.is_ftp_site',
            's.ftp_home_dir',
            's.worker_path',
            's.content_path',
            's.backup_manual',
            's.backup_daily',
            's.backup_weekly',
            's.backup_timestamp',
            's.auto_backups',
            's.table_optimization',
            's.worker_version',
            's.secure_transfer',
            's.message_id',
            's.note',
            's.random_worker_key',
            's.google_analytics_id',
            's.site_color',
            's.notification_key',
            's.multisite',
            's.multisite_network',
            's.site_added'
        );
    }

    /**
     * @param User $user
     * @param array $options
     *   'limit'     int Query result limit.
     *   'offset'    int Query result offset. Enabling offset implies limit is provided.
     * @return Site[]
     */
    public function findByUser(User $user, array $options = array())
    {
        $options += array(
            'limit' => null,
            'offset' => null,
        );

        $qb = $this->createQueryBuilder();
        $qb->from($this->getPrefix() . 'mwp_sites', 's');
        $qb->innerJoin('s', $this->getPrefix() . 'mwp_user_sites', 'us', 'us.site_id = s.ID');
        $qb->where('us.user_id = :user_id');
        $qb->setParameter('user_id', $user->getID());

        $qb->select($this->getSelectFields());

        if ($options['offset'] !== null) {
            $qb->setFirstResult($options['offset']);
        }
        if ($options['limit'] !== null) {
            $qb->setMaxResults($options['limit']);
        }

        /** @var $stmt \Doctrine\DBAL\Statement */
        $stmt = $qb->execute();

        $sites = array();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->getEntityClass());
            /** @var $site Site */
            while ($site = $stmt->fetch()) {
                $sites[$site->getId()] = $site;
            }
        }

        return $sites;
    }

    public function findByUserAndGroup(User $user, Group $group = null)
    {
        $qb = $this->createQueryBuilder();
        $qb->from($this->getPrefix() . 'mwp_sites', 's');
        $qb->innerJoin('s', $this->getPrefix() . 'mwp_user_sites', 'us', 'us.user_id = :user_id');
        $qb->leftJoin($this->getPrefix() . 'mwp_group_sites', 'gs', 'gs.site_id = s.ID');
        $qb->setParameter('user_id', $user->getID());
        if ($group === null) {
            $qb->where('gs.group_id IS NULL');
        } else {
            $qb->where('gs.group_id = :group_id');
            $qb->setParameter('group_id', $group->getID());
        }

        $qb->select($this->getSelectFields());

        /** @var $stmt \Doctrine\DBAL\Statement */
        $stmt = $qb->execute();

        $sites = array();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $this->getEntityClass());
            /** @var $site Site */
            while ($site = $stmt->fetch()) {
                $sites[$site->getId()] = $site;
            }
        }

        return $sites;
    }

    /**
     * Returns the ungrouped sites IDs, that belong to the user, but don't belong to any group.
     *
     * @param \MWP\Entity\User $user
     * @return array
     *   An array of site IDs.
     */
    public function findUngroupedIdsByUser(User $user)
    {
        $qb = $this->createQueryBuilder();

        $qb->from($this->getPrefix() . 'mwp_sites', 's');

        $qb->innerJoin('s', $this->getPrefix() . 'mwp_user_sites', 'us', 'us.site_id = s.ID AND us.user_id = :user_id');
        $qb->leftJoin('s', $this->getPrefix() . 'mwp_group_sites', 'gs', 'gs.site_id = s.ID');
        $qb->andWhere('gs.ID IS NULL');
        $qb->setParameter('user_id', $user->getID());
        $qb->select('s.ID');

        /** @var $stmt \Doctrine\DBAL\Statement */
        $stmt = $qb->execute();

        $siteIds = array();
        if ($stmt->rowCount()) {
            $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
            $siteIds = $stmt->fetchAll();
        }
        return $siteIds;
    }
}
