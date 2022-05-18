<?php



namespace App\Repository;

use App\Entity\User;

use App\Entity\VoiceActor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<VoiceActor>
 *
 * @method VoiceActor|null find($id, $lockMode = null, $lockVersion = null)
 * @method VoiceActor|null findOneBy(array $criteria, array $orderBy = null)
 * @method VoiceActor[]    findAll()
 * @method VoiceActor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VoiceActorRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, VoiceActor::class);
  }

  public function add(VoiceActor $entity, bool $flush = false): void
  {
    $this->getEntityManager()->persist($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove(VoiceActor $entity, bool $flush = false): void
  {
    $this->getEntityManager()->remove($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function findAllByInput(array $data): Query|array
  {
    $queryBuilder = $this->getEntityManager()->createQueryBuilder();
    if (!is_null($data['characterName']) && !is_null($data['voiceActor']) && !is_null($data['movieTitle'])) {
      $result = $queryBuilder
        ->addSelect('va')->from(VoiceActor::class, 'va')
        ->where('va.characterName LIKE :characterName')
        ->andWhere('va.voiceActor LIKE :voiceActor')
        ->andWhere('va.movieTitle LIKE :movieTitle')
        ->setParameter('characterName', '%' . $data['characterName'] . '%')
        ->setParameter('voiceActor', '%' . $data['voiceActor'] . '%')
        ->setParameter('movieTitle', '%' . $data['movieTitle'] . '%')
        ->getQuery();
    } elseif (!is_null($data['characterName']) && !is_null($data['voiceActor']) && is_null($data['movieTitle'])) {
      $result = $queryBuilder
        ->addSelect('va')->from(VoiceActor::class, 'va')
        ->where('va.characterName LIKE :characterName')
        ->andWhere('va.voiceActor LIKE :voiceActor')
        ->setParameter('characterName', '%' . $data['characterName'] . '%')
        ->setParameter('voiceActor', '%' . $data['voiceActor'] . '%')
        ->getQuery();
    } elseif (!is_null($data['characterName']) && !is_null($data['movieTitle']) && is_null($data['voiceActor'])) {
      $result = $queryBuilder
        ->addSelect('va')->from(VoiceActor::class, 'va')
        ->where('va.characterName LIKE :characterName')
        ->andWhere('va.movieTitle LIKE :movieTitle')
        ->setParameter('characterName', '%' . $data['characterName'] . '%')
        ->setParameter('movieTitle', '%' . $data['movieTitle'] . '%')
        ->getQuery();
    } elseif (!is_null($data['movieTitle']) && !is_null($data['voiceActor']) && is_null($data['characterName'])) {
      $result = $queryBuilder
        ->addSelect('va')->from(VoiceActor::class, 'va')
        ->Where('va.voiceActor LIKE :voiceActor')
        ->andWhere('va.movieTitle LIKE :movieTitle')
        ->setParameter('voiceActor', '%' . $data['voiceActor'] . '%')
        ->setParameter('movieTitle', '%' . $data['movieTitle'] . '%')
        ->getQuery();
    } elseif (!is_null($data['characterName']) && is_null($data['voiceActor']) && is_null($data['movieTitle'])) {
      $result = $queryBuilder
        ->addSelect('va')->from(VoiceActor::class, 'va')
        ->where('va.characterName LIKE :characterName')
        ->setParameter('characterName', '%' . $data['characterName'] . '%')
        ->getQuery();
    } elseif (is_null($data['characterName']) && !is_null($data['voiceActor']) && is_null($data['movieTitle'])) {
      $result = $queryBuilder
        ->addSelect('va')->from(VoiceActor::class, 'va')
        ->Where('va.voiceActor LIKE :voiceActor')
        ->setParameter('voiceActor', '%' . $data['voiceActor'] . '%')
        ->getQuery();
    } elseif (is_null($data['characterName']) && is_null($data['voiceActor']) && !is_null($data['movieTitle'])) {
      $result = $queryBuilder
        ->addSelect('va')->from(VoiceActor::class, 'va')
        ->Where('va.movieTitle LIKE :movieTitle')
        ->setParameter('movieTitle', '%' . $data['movieTitle'] . '%')
        ->getQuery();
    }else{
      $result = $this->getEntityManager()->getRepository(VoiceActor::class)->findAll();
    }
    return $result;
  }
}
