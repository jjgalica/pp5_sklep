<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Movie;
use AppBundle\Entity\Reflection;
use AppBundle\Form\MovieType;
use Symfony\Component\HttpFoundation\Response;
/**
 * Movie controller.
 *
 * @Route("/")
 */
class MovieController extends Controller
{

    /**
     * Lists all Movie entities.
     *
     * @Route("/", name="")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Movie')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Movie entity.
     *
     * @Route("/", name="add_reflection")
     * @Method("POST")
     */
    public function addReflectionAction(Request $request)
    {
        $entity = new Reflection();
        $entity->setMovieId($_POST['movie_id']);
        $entity->setText($_POST['text']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();

     
        return new Response("ok");
    }

    /**
     * Creates a new Movie entity.
     *
     * @Route("/", name="_create")
     * @Method("POST")
     * @Template("AppBundle:Movie:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Movie();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Movie entity.
     *
     * @param Movie $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Movie $entity)
    {
        $form = $this->createForm(new MovieType(), $entity, array(
            'action' => $this->generateUrl('_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Movie entity.
     *
     * @Route("/new", name="_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Movie();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Movie entity.
     *
     * @Route("/movie/{id}", name="_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Movie')->find($id);
        
        $reflections = $em->getRepository('AppBundle:Reflection')->findBy(array('movie_id'=>$id));
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'reflections'      => $reflections,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Movie entity.
     *
     * @Route("/{id}/movie/edit", name="_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Movie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movie entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Movie entity.
    *
    * @param Movie $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Movie $entity)
    {
        $form = $this->createForm(new MovieType(), $entity, array(
            'action' => $this->generateUrl('_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Movie entity.
     *
     * @Route("/{id}", name="_update")
     * @Method("PUT")
     * @Template("AppBundle:Movie:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Movie')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Movie entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Movie entity.
     *
     * @Route("/{id}", name="_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Movie')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Movie entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl(''));
    }

    /**
     * Creates a form to delete a Movie entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
