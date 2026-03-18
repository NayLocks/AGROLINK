<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\QagtCompanies;
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

    #[Route('/societes/ajouter', name: 'companies_add', methods: ['GET','POST'])]
    public function add(Request $request, EntityManagerInterface $entityManager): Response 
    {
        $company = new QagtCompanies();

        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('add_companies', $request->request->get('_token'))) {
                throw $this->createAccessDeniedException('Token CSRF invalide');
            }
        
            $company = new QagtCompanies();
        
            $data = $request->request->all();
        
            foreach ($data as $field => $value) {
                if ($field === '_token') {
                    continue;
                }

                $method = 'set' . ucfirst($field);

                if (method_exists($company, $method)) {
                    if ($field === 'isActived') {
                        $company->$method((bool) $value);
                    } else {
                        $company->$method(empty($value) ? null : $value);
                    }
                }
            }
        
            $entityManager->persist($company);
            $entityManager->flush();
        
            $this->addFlash('success', 'Société ajoutée avec succès');
            return $this->redirectToRoute('companies_index');
        }
        
        return $this->render('companies/form.html.twig', ['company' => $company]);
    }

    #[Route('/societes/{id}/modifier', name: 'companies_edit', methods: ['GET','POST'])]
    public function edit(QagtCompanies $company, Request $request, EntityManagerInterface $entityManager): Response 
    {
        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('edit_companies_' . $company->getId(), $request->request->get('_token'))) {
                throw $this->createAccessDeniedException('Token CSRF invalide');
            }
        
            $data = $request->request->all();
        
            foreach ($data as $field => $value) {
                if ($field === '_token') {
                    continue;
                }

                $method = 'set' . ucfirst($field);

                if (method_exists($company, $method)) {
                    if ($field === 'isActived') {
                        $company->$method((bool) $value);
                    } else {
                        $company->$method(empty($value) ? null : $value);
                    }
                }
            }
        
            $entityManager->flush();
        
            $this->addFlash('success', 'Société modifiée avec succès');
            return $this->redirectToRoute('companies_index');
        }
        
        return $this->render('companies/form.html.twig', [
            'company' => $company
        ]);
    }

}