<?php

namespace App\Controller;

use App\Entity\Series;
use App\Form\SeriesType;
use App\Repository\SeriesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
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
        $seriesForm = $this->createForm(SeriesType::class, new Series(''));
        return $this->render('series/form.html.twig', compact('seriesForm'));
    }


    #[Route('/series/create', name: 'app_series_create', methods: ['POST'])]
    public function addSeries(Request $request): Response
    {
        $series = new Series();

        $seriesForm = $this->createForm(SeriesType::class, $series)
            ->handleRequest($request);
        
        if (!$seriesForm->isValid()) {
            return $this->render('/series/form.html.twig', compact('seriesForm'));
        }

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
        $seriesForm = $this->createForm(SeriesType::class, $series, ['is_edit' => true]);
        return $this->render('series/form.html.twig', [
            'seriesForm' => $seriesForm,
            'is_edit' => true
        ]);
    }

    #[Route('/series/edit/{series}', name: 'app_series_edit', methods: ['POST'])]
    public function editSeries(Series $series, Request $request): Response
    {
        $seriesForm = $this->createForm(SeriesType::class, $series, ['is_edit' => true]);
        $seriesForm->handleRequest($request);

        if (!$seriesForm->isValid()) {
            return $this->render('series/form.html.twig', [
                'seriesForm' => $seriesForm,
                'is_edit' => true
            ]);
        }
            
        $this->addFlash('success', 'Série editada com sucesso');
        $this->entityManager->flush();

        return new RedirectResponse('/series');
    }
}
