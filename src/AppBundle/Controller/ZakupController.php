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
     * @Route("/new/{id}", name="buy_new")
     * @Method("GET")
     * @Template("AppBundle:Zakup:index.html.twig")
     */
    public function createAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $movie = $em->getRepository('AppBundle:Movie')->findOneById($id);
        $entity = new Zakup();
        $entity->setMovie($movie);
        $entity->setUser($this->getUser());

        
        $em->persist($entity);
        $em->flush();

        $entities = $em->getRepository('AppBundle:Zakup')->findAll();
        return array(
            'entities' =>$entities,
            'id' => $id
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
