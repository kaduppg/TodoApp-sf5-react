<?php

namespace App\Controller;

use App\Entity\Todo;
use App\Form\TodoType;
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

       $form = $this->createForm(TodoType::class);
       $form->submit((array)$content);

       if(!$form->isValid()){
           $erros = [];
           foreach ($form->getErrors(true,true) as $error) {
              $propertyName = $error->getOrigin()->getName();
              $errors[$propertyName] = $error->getMessage(); 
           }
            return $this->json([
                'message' => ['text' => join("\n", $errors), 'level' => 'error']
            ]);
       }

       $todo = new Todo();
       $todo->setTask($content->task);
       $todo->setDescription($content->description);

       try {
          $this->entityManager->persist($todo);
          $this->entityManager->flush();
         
       } catch (Exception $e) {
           return $this->json([
               'message'=> ['text'=> 'Could not reach database when attempting to create a to-do' , 
               'level'=>'error']
           ]);
       }

       return $this->json([
            'todo' => $todo->toArray(),
            'message' => ['text'=> 'To-do has been created!', 'level' => 'success']
       ]);


    }

    /**
    * @Route("/update/{id}", name="api_todo_update" , methods={"PUT"})
    */
    public function update (Request $request, Todo $todo)
    {
        $content  = json_decode($request->getContent());

        $form = $this->createForm(TodoType::class);

        $nonObject = (array)$content;
        unset($nonObject['id']);
        $form->submit((array)$nonObject);

       if(!$form->isValid()){
           $erros = [];
           foreach ($form->getErrors(true,true) as $error) {
              $propertyName = $error->getOrigin()->getName();
              $errors[$propertyName] = $error->getMessage(); 
           }
            return $this->json([
                'message' => ['text' => join("\n", $errors), 'level' => 'error']
            ]);
       }

        $todo->setTask($content->task);
        $todo->setDescription($content->description);

        try {
            $this->entityManager->flush();
        
        } catch (Exception $e) {
            return $this->json([
                'message'=> ['text'=> 'Could not reach database when attempting to update a to-do' , 
                'level'=>'error']
            ]);
        }

        return $this->json([
            'todo' => $todo->toArray(),
            'message' => ['text'=> 'To-do successfully updated!', 'level' => 'success']
        ]);

    }

    /**
    * @Route("/delete/{id}", name="api_todo_delete" , methods={"DELETE"})
    */
    public function delete (Todo $todo)
    {
        try {
            $this->entityManager->remove($todo);
            $this->entityManager->flush();

        } catch (Exception $e) {
            return $this->json([
                'message'=> ['text'=> 'Could not reach database when attempting to delete a to-do' , 
                'level'=>'error']
            ]);
        }

        return $this->json([
            'message' => ['text'=> 'To-do had successfully been deleted!', 'level' => 'success']
        ]);

    }
}
