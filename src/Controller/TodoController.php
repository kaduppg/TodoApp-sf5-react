<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Repository\TodoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonDecode;

/**
* @Route("/api/todo", name="api_todo")
*/
class TodoController extends AbstractController
{
    private $entityManager;
    private $todoRepository;

    public function __construct(EntityManagerInterface $entityManager, TodoRepository $todoRepository)
    {
        $this->todoRepository = $todoRepository;
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/read", name="api_todo_read", methods={"GET"})
     */
    public function index()
    {
       $todos = $this->todoRepository->findAll();
       $arrayTodos = [];

       foreach ($todos as $todo) {
          $arrayTodos[] = $todo->toArray();
       }

       return $this->json($arrayTodos);
    }

     /**
     * @Route("/create", name="api_todo_create" , methods={"POST"})
     */
    public function create(Request $request)
    {
       $content = json_decode($request->getContent());
       $todo = new Todo();
       $todo->setTask($content->task);

       try {
          $this->entityManager->persist($todo);
          $this->entityManager->flush();
          return $this->json([
            'todo' => $todo->toArray()
          ]);

       } catch (Exception $e) {
           // error message
       }
    }

    /**
    * @Route("/update/{id}", name="api_todo_update" , methods={"PUT"})
    */
    public function update (Request $request, Todo $todo)
    {
        $content  = json_decode($request->getContent());
        $todo->setTask($content->task);

        try {
            $this->entityManager->flush();
            return $this->json([
                'message' => 'the task has been updated.'
            ]);
        } catch (Exception $e) {
            //error msg
        }

    }

    /**
    * @Route("/delete/{id}", name="api_todo_delete" , methods={"DELETE"})
    */
    public function delete (Todo $todo)
    {
        try {
            $this->entityManager->remove($todo);
            $this->entityManager->flush();

            return $this->json([
                'message' => 'the task has been deleted.'
            ]);

        } catch (Exception $e) {
            //error msg 
        }

    }
}
