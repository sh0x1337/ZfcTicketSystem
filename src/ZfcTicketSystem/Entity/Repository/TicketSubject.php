<?php

namespace ZfcTicketSystem\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class TicketSubject extends EntityRepository
{
	/**
	 * @return \ZfcTicketSystem\Entity\TicketSubject[]
	 */
	public function getTicketList4UserId($userId)
    {
		$query = $this->createQueryBuilder('p')
			->select('p')
			->where('p.user = :user')
			->setParameter('user', $userId)
			->orderBy('p.lastEdit','desc')
			->getQuery();

		return $query->getResult();
	}

	/**
	 * @param $ticketId
	 *
	 * @return \ZfcTicketSystem\Entity\TicketSubject|null
	 */
	public function getTicketSubject4Admin($ticketId)
    {
		$query = $this->createQueryBuilder('p')
			->select('p')
			->where('p.id = :subjectTicketId')
			->setParameter('subjectTicketId', $ticketId)
			->getQuery();

		return $query->getOneOrNullResult();
	}

	/**
	 * @return \ZfcTicketSystem\Entity\TicketSubject|null
	 */
	public function getTicket4UserId($userId, $ticketId)
    {
		$query = $this->createQueryBuilder('p')
			->select('p')
			->where('p.id = :subjectTicketId')
			->setParameter('subjectTicketId', $ticketId)
			->andWhere('p.user = :user')
			->setParameter('user', $userId)
			->getQuery();

		return $query->getOneOrNullResult();
	}

	/**
	 * @param $type
	 *
	 * @return \ZfcTicketSystem\Entity\TicketSubject[]
	 */
	public function getTickets4Type($type)
    {
		$query = $this->createQueryBuilder('p')
			->select('p')
			->where('p.type = :type')
			->setParameter('type', $type)
			->orderBy('p.lastEdit','asc')
			->getQuery();

		return $query->getResult();
	}

    /**
     * @return int
     */
    public function getNumberOfNewTickets()
    {
        $query = $this->createQueryBuilder( 'p' )
            ->select( 'COUNT(p.id)' )
            ->where( 'p.type = :type' )
            ->setParameter( 'type', \ZfcTicketSystem\Entity\TicketSubject::TypeNew )
            ->getQuery();

        return $query->getSingleScalarResult();
    }
} 