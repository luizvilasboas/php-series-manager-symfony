<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class SeriesCreationInputDTO
{
  #[Assert\NotBlank]
  #[Assert\Length(min: 5)]
  public string $seriesName;

  #[Assert\NotBlank]
  #[Assert\Positive]
  public int $seasonsQuantity;

  #[Assert\NotBlank]
  #[Assert\Positive]
  public int $episodesPerSeason;

  public function __construct(string $seriesName = '', int $seasonsQuantity = 0, int $episodesPerSeason = 0)
  {
    $this->seriesName = $seriesName;
    $this->seasonsQuantity = $seasonsQuantity;
    $this->episodesPerSeason = $episodesPerSeason;
  }
}
