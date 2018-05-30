<?php

namespace App\Controller;

use App\Entity\Single;
use App\Form\SingleType;
use App\Repository\SingleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/single")
 */
class SingleController extends Controller
{
    /**
     * @Route("/", name="single_index", methods="GET")
     */
    public function index(SingleRepository $singleRepository): Response
    {
        return $this->render('single/index.html.twig', ['singles' => $singleRepository->findAll()]);
    }

    /**
     * @Route("/new", name="single_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $single = new Single();
        $form = $this->createForm(SingleType::class, $single);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($single);
            $em->flush();

            return $this->redirectToRoute('single_index');
        }

        return $this->render('single/new.html.twig', [
            'single' => $single,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="single_show", methods="GET")
     */
    public function show(Single $single): Response
    {
        return $this->render('single/show.html.twig', ['single' => $single]);
    }

    /**
     * @Route("/{id}/edit", name="single_edit", methods="GET|POST")
     */
    public function edit(Request $request, Single $single): Response
    {
        $form = $this->createForm(SingleType::class, $single);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('single_edit', ['id' => $single->getId()]);
        }

        return $this->render('single/edit.html.twig', [
            'single' => $single,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="single_delete", methods="DELETE")
     */
    public function delete(Request $request, Single $single): Response
    {
        if ($this->isCsrfTokenValid('delete'.$single->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($single);
            $em->flush();
        }

        return $this->redirectToRoute('single_index');
    }
}
