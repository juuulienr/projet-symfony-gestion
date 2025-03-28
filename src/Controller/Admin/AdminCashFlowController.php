<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Flux;
use App\Form\AdminCashflowType;
use App\Repository\FluxRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/cashflow')]
class AdminCashFlowController extends AbstractController
{
    #[Route('', name: 'admin_cashflow_index')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(
        FluxRepository $cashflowRepo,
        OrderRepository $orderRepo,
    ): Response {
        $cashflows = $cashflowRepo->findBy(['type' => 0], ['createdAt' => 'DESC']);
        $notPaid = 0;
        $orders = $orderRepo->findByNotNote();

        foreach ($orders as $item) {
            $notPaid = $notPaid + ($item->getTotal() - $item->getPaid());
        }

        return $this->render('admin/cashflow/index.html.twig', [
            'cashflows' => $cashflows,
            'notPaid' => $notPaid,
        ]);
    }

    #[Route('/new', name: 'admin_cashflow_new')]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $cashflow = new Flux();
        $form = $this->createForm(AdminCashflowType::class, $cashflow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cashflow->setType(false);
            $manager->persist($cashflow);
            $manager->flush();

            $this->addFlash(
                'success',
                'Un nouveau compte à été ajouté !'
            );

            return $this->redirectToRoute('admin_cashflow_index');
        }

        return $this->render('admin/cashflow/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/edit/{id}', name: 'admin_cashflow_edit')]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Flux $cashflow, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(AdminCashflowType::class, $cashflow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            $this->addFlash(
                'success',
                'Le compte a été modifié !'
            );

            return $this->redirectToRoute('admin_cashflow_index');
        }

        return $this->render('admin/cashflow/edit.html.twig', [
            'form' => $form->createView(),
            'cashflow' => $cashflow,
        ]);
    }

    #[Route('/delete/{id}', name: 'admin_cashflow_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteFlux(Flux $cashflow, EntityManagerInterface $manager): Response
    {
        $manager->remove($cashflow);
        $manager->flush();

        $this->addFlash(
            'success',
            'Le compte a été supprimé !'
        );

        return $this->redirectToRoute('admin_cashflow_index');
    }
}
