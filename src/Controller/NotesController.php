<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class NotesController extends AbstractController
{
    #[Route('/notes', name: 'app_notes')]
    public function index(SessionInterface $session): Response
    {
        if (!($session->has('notes'))) {
            $notes = ['math' => 15, 'info' => 17];
            $session->set('notes', $notes);
            $this->addFlash('info', 'Notes initialisés');
        }
        return $this->render('notes/index.html.twig');
    }

    /**
     * @Route("/notes/add/{matiere}/{note}")
     */
    public function addNote($matiere, $note, SessionInterface $session)
    {
        if (!$session->has('notes')) {
            $this->addFlash('error', 'Not initalised');
        } else {
            $notes = $session->get('notes');
            $notes[$matiere] = $note;
            $session->set('notes', $notes);
            $this->addFlash('success', "Note ajoutée avec success ");
        }
        return $this->redirectToRoute('app_notes');
    }

    /**
     * @Route("/notes/delete/{matiere}")
     */
    public function delete($matiere,SessionInterface $session)
    {
        if (!$session->has('notes')) {
            $this->addFlash('error', 'Not initalised');
        }
        else{
            $notes=$session->get('notes');
            if(!isset($notes[$matiere])){
                $this->addFlash('error', 'Doesnt exist');
            }
            else{
                unset($notes[$matiere]);
                $session->set('notes', $notes);
                $this->addFlash('success', "Note supprimée avec success ");
            }
        }
        return $this->redirectToRoute('app_notes');
    }
}