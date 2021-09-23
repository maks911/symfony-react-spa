<?php

namespace App\Repository;

use App\Entity\Meta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Meta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meta[]    findAll()
 * @method Meta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meta::class);
    }

    /**
     * @param int $pageId
     * @return array
     */
    public function findAllFeatures(int $pageId): array
    {
        // автоматически знает, что надо выбирать Продукты
        // "p" - это псевдоним, который вы будете использовать до конца запроса
        $qb = $this->createQueryBuilder('p')
            ->where('p.metakey like :features')
            ->andWhere('p.page_id = :page_id')
            ->setParameter('features', '%features%')
            ->setParameter('page_id', $pageId)
            ->orderBy('p.metakey', 'ASC');


        $query = $qb->getQuery();

        return $query->execute();
    }

    public function getFieldsCount() : int
    {
        return 3; //TODO: вывод кол-ва полей из таблицы (кроме id - primary)
    }
}
