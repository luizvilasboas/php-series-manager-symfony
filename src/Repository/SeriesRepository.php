<?php

namespace App\Repository;

use App\DTO\SeriesCreateFromInput;
use App\Entity\Episode;
use App\Entity\Series;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

/**
 * @extends ServiceEntityRepository<Series>
 *
 * @method Series|null find($id, $lockMode = null, $lockVersion = null)
 * @method Series|null findOneBy(array $criteria, array $orderBy = null)
 * @method Series[]    findAll()
 * @method Series[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SeriesRepository extends ServiceEntityRepository
{
    private SeasonRepository $seasonRepository;
    private EpisodeRepository $episodeRepository;

    public function __construct(ManagerRegistry $registry, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository)
    {
        parent::__construct($registry, Series::class);

        $this->seasonRepository = $seasonRepository;
        $this->episodeRepository = $episodeRepository;
    }

    public function add(SeriesCreateFromInput $input): void
    {
        $entityManager = $this->getEntityManager();

        $series = new Series($input->seriesName);
        $entityManager->persist($series);
        $entityManager->flush();

        try {
            $this->seasonRepository->addSeasonsQuantity($input->seasonsQuantity, $series->getId());
            $seasons = $this->seasonRepository->findBy(['series' => $series]);
            $this->episodeRepository->addEpisodesPerSeason($input->episodesPerSeason, $seasons);
        } catch (Exception $e) {
            $this->remove($series, true);
        }
    }

    public function remove(Series $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function removeById(int $id): void
    {
        $series = $this->getEntityManager()->getReference(Series::class, $id);
        $this->remove($series, flush: true);
    }
}
