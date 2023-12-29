<?php

namespace App\Controller;

use App\Entity\Series;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    private SeriesRepository $seriesRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(SeriesRepository $seriesRepository, EntityManagerInterface $entityManager)
    {
        $this->seriesRepository = $seriesRepository;
        $this->entityManager = $entityManager;
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
        return $this->render('series/form.html.twig');
    }


    #[Route('/series/create', name: 'app_series_create', methods: ['POST'])]
    public function addSeries(Request $request): Response
    {
        $seriesName = $request->request->get('name');

        $series = new Series($seriesName);

        $this->seriesRepository->add($series, true);
        $this->addFlash('success', 'Série criada com sucesso');

        return new RedirectResponse('/series');
    }

    #[Route('/series/delete/{id}', name: 'app_series_delete', methods: ['POST'])]
    public function deleteSeries(int $id): Response
    {
        $this->seriesRepository->removeById($id);
        $this->addFlash('success', 'Série removida com sucesso');

        return new RedirectResponse('/series');
    }

    #[Route('/series/edit/{series}', name: 'app_series_edit_form', methods: ['GET'])]
    public function editSeriesForm(Series $series): Response
    {
        return $this->render('series/form.html.twig', compact('series'));
    }

    #[Route('/series/edit/{series}', name: 'app_series_edit', methods: ['POST'])]
    public function editSeries(Series $series, Request $request): Response
    {
        $series->setName($request->request->get('name'));
        $this->entityManager->flush();

        $this->addFlash('success', 'Série editada com sucesso');

        return new RedirectResponse('/series');
    }
}
