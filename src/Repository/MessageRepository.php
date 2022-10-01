<?php

namespace POSD\Repository;

use POSD\Entity\Message;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }


    /**
     * Get messages where message timestamp > (now - 30s) and <= now
     *
     * @param int $now
     * @param int $timestamp_show_start
     * @param int $timeline_cursor (default to 0)
     * @return array Message
     */
    public function getMessagesToSend(int $now, int $timestamp_show_start, int $timeline_cursor)
    {
        $time_elapsed = $now - $timestamp_show_start;
        $time_elapsed_minus = $time_elapsed - 30;
        return $this->createQueryBuilder('m')
            ->andWhere('m.timestamp <= :time_elapsed')
            ->andWhere('m.timestamp > :time_elapsed_minus')
            ->andWhere('m.timestamp >= :timeline_cursor')
            ->setParameter('time_elapsed', $time_elapsed)
            ->setParameter('time_elapsed_minus', $time_elapsed_minus)
            ->setParameter('timeline_cursor', $timeline_cursor)
            ->orderBy('m.timestamp', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * Get total quantity of messages
     * @param int $timeline_cursor
     * @return int
     */
    public function countMessages(int $timeline_cursor)
    {
        $qb = $this->createQueryBuilder('m')
                    ->select('count(m.id)')
                    ->andWhere('m.timestamp >= :timeline_cursor')
                    ->setParameter('timeline_cursor', $timeline_cursor);

        $count = $qb->getQuery()->getSingleScalarResult();
        return $count;
    }


    /*
    public function findOneBySomeField($value): ?Message
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
