<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\QagtUsers;
use App\Entity\QagtCompanies;
use App\Repository\QagtUsersRepository;
use App\Repository\QagtCompaniesRepository;

class UsersController extends AbstractController
{
    #[Route('/utilisateurs', name: 'users_index')]
    public function index(QagtUsersRepository $usersRepository): Response
    {
        $users = $usersRepository->findAll();
        return $this->render('users/index.html.twig', [
            'users' => $users
        ]);
    }

    #[Route('/utilisateurs/{id}/modifier', name: 'users_edit', methods: ['GET','POST'])]
    public function edit(QagtUsers $user, Request $request, EntityManagerInterface $entityManager, QagtCompaniesRepository $companiesRepository): Response 
    {
        if ($request->isMethod('POST')) {
            if (!$this->isCsrfTokenValid('edit_user_'.$user->getId(), $request->request->get('_token'))) {
                throw $this->createAccessDeniedException('Token CSRF invalide');
            }
    
            $data = $request->request->all();
        
            foreach ($data as $field => $value) {
    
                    if ($field === '_token') {
                        continue;
                    }
    
                    if ($field === 'companyActive') {
                        if (empty($value)) {
                            $company = $companiesRepository->findOneBy(['name' => 'DEFAUT']);
                            $user->setCompanyActive($company);
                        } else {
                            $company = $companiesRepository->find($value);
                            $user->setCompanyActive($company);
                        }
                        continue;
                    }
    
                    $method = 'set' . ucfirst($field);
    
                    if (method_exists($user, $method)) {
                        if ($field === 'isActived') {
                            $user->$method((bool) $value);
                        } else {
                            $user->$method(empty($value) ? null : $value);
                        }
                    }
                }
                $entityManager->flush();
                
                $selectedCompanies = $request->request->all('companies') ?? [];
                
                // Supprimer toutes les liaisons existantes
                foreach ($user->getCompanies() as $companies) {
                    $user->removeCompany($companies);
                }
                

                // Ajouter les nouvelles liaisons
                $companiesRepository = $entityManager->getRepository(QagtCompanies::class);
                foreach ($selectedCompanies as $companyId) {
                    $company = $companiesRepository->find($companyId);
                    if ($company) {
                        $user->addCompany($company);
                    }
                }
                
                $entityManager->flush();
            }
    
            return $this->render('users/edit.html.twig', [
                'user' => $user,
                'companies' => $companiesRepository->findAll()
            ]);
    }
}