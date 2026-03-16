<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QagtCompaniesRepository;

class CompaniesController extends AbstractController
{
    #[Route('/societes', name: 'companies_index')]
    public function index(QagtCompaniesRepository $companiesRepository): Response
    {
        $companies = $companiesRepository->findAll();
        return $this->render('companies/index.html.twig', [
            'companies' => $companies
        ]);
    }
}