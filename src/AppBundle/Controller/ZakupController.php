<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Zakup;
use AppBundle\Form\ZakupType;

/**
 * Zakup controller.
 *
 * @Route("/buy")
 */
class ZakupController extends Controller
{

    /**
     * Lists all Zakup entities.
     *
     * @Route("/", name="buy")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Zakup')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Zakup entity.
     *
     * @Route("/buy/{id}", name="buy_new")
     * @Method("GET")
     * @Template("AppBundle:Zakup:index.html.twig")
     */
    public function createAction($id)
    {
        $entity = new Zakup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('buy_show', array('id' => $entity->getId())));
        }

        return array(
            'id' => $id,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Zakup entity.
     *
     * @param Zakup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Zakup $entity)
    {
        $form = $this->createForm(new ZakupType(), $entity, array(
            'action' => $this->generateUrl('buy_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Zakup entity.
     *
     * @Route("/new", name="buy_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Zakup();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Zakup entity.
     *
     * @Route("/{id}", name="buy_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Zakup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zakup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Zakup entity.
     *
     * @Route("/{id}/edit", name="buy_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Zakup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zakup entity.');
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
    * Creates a form to edit a Zakup entity.
    *
    * @param Zakup $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Zakup $entity)
    {
        $form = $this->createForm(new ZakupType(), $entity, array(
            'action' => $this->generateUrl('buy_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Zakup entity.
     *
     * @Route("/{id}", name="buy_update")
     * @Method("PUT")
     * @Template("AppBundle:Zakup:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Zakup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Zakup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('buy_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Zakup entity.
     *
     * @Route("/{id}", name="buy_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Zakup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Zakup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('buy'));
    }

    /**
     * Creates a form to delete a Zakup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('buy_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
