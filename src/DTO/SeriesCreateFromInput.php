<?php

namespace App\DTO;

class SeriesCreateFromInput
{
  public string $seriesName;
  public int $seasonsQuantity;
  public int $episodesPerSeason;

  public function __construct(string $seriesName = '', int $seasonsQuantity = 0, int $episodesPerSeason = 0)
  {
    $this->seriesName = $seriesName;
    $this->seasonsQuantity = $seasonsQuantity;
    $this->episodesPerSeason = $episodesPerSeason;
  }
}
