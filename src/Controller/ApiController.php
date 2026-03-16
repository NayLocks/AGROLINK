<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QagtCompaniesRepository;
use Doctrine\ORM\EntityManagerInterface;

class ApiController extends AbstractController
{
    #[Route('/api/user/set-active-company', name: 'api_set_active_company', methods: ['POST'])]
    public function setActiveCompany(Request $request, QagtCompaniesRepository $companiesRepository, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $companyId = $data['companyId'] ?? null;
        
        if (!$companyId) {
            return new JsonResponse(['success' => false, 'message' => 'Company ID missing'], 400);
        }
        
        $user = $this->getUser();
        $company = $companiesRepository->find($companyId);
        
        if (!$company) {
            return new JsonResponse(['success' => false, 'message' => 'Company not found'], 404);
        }
        
        $user->setCompanyActive($company);
        $entityManager->flush();
        
        return new JsonResponse(['success' => true]);
    }
}