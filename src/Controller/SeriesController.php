<?php

namespace App\Controller;

use App\Entity\Series;
use App\Repository\SeriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    private SeriesRepository $seriesRepository;

    public function __construct(SeriesRepository $seriesRepository)
    {
        $this->seriesRepository = $seriesRepository;
    }

    #[Route('/series', name: 'app_series', methods: ['GET'])]
    public function index(): Response
    {
        $seriesList = $this->seriesRepository->findAll();

        return $this->render('series/index.html.twig', [
            'series' => $seriesList,
        ]);
    }

    #[Route('/series/create', name: 'app_series_form', methods: ['GET'])]
    public function addSeriesForm(): Response
    {
        return $this->render('series/create.html.twig');
    }


    #[Route('/series/create', name: 'app_series_create', methods: ['POST'])]
    public function addSeries(Request $request): Response
    {
        $seriesName = $request->request->get('name');

        $series = new Series($seriesName);

        $this->seriesRepository->add($series, true);

        return new RedirectResponse('/series');
    }

    #[Route('/series/delete/{id}', name: 'app_series_delete', methods: ['POST'])]
    public function deleteSeries(int $id): Response
    {
        $this->seriesRepository->removeById($id);

        return new RedirectResponse('/series');
    }
}
