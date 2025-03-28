<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
    }

    public function totalAmount()
    {
        $query = $this->createQueryBuilder('t')
        ->select('SUM(t.amount) as total')
        ->where('t.invoice is null');

        return $query->getQuery()
        ->getResult();
    }

    public function findOneByInvoice(Order $invoice): ?Transaction
    {
        return $this->findOneBy(['invoice' => $invoice]);
    }
}
