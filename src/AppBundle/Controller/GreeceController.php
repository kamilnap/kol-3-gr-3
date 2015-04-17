<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Greece;
use AppBundle\Form\GreeceType;

/**
 * Greece controller.
 *
 * @Route("/admin/greece")
 */
class GreeceController extends Controller
{

    /**
     * Lists all Greece entities.
     *
     * @Route("/", name="admin_greece")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Greece')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Greece entity.
     *
     * @Route("/", name="admin_greece_create")
     * @Method("POST")
     * @Template("AppBundle:Greece:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Greece();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_greece_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Greece entity.
     *
     * @param Greece $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Greece $entity)
    {
        $form = $this->createForm(new GreeceType(), $entity, array(
            'action' => $this->generateUrl('admin_greece_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Greece entity.
     *
     * @Route("/new", name="admin_greece_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Greece();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Greece entity.
     *
     * @Route("/{id}", name="admin_greece_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Greece')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Greece entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Greece entity.
     *
     * @Route("/{id}/edit", name="admin_greece_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Greece')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Greece entity.');
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
    * Creates a form to edit a Greece entity.
    *
    * @param Greece $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Greece $entity)
    {
        $form = $this->createForm(new GreeceType(), $entity, array(
            'action' => $this->generateUrl('admin_greece_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Greece entity.
     *
     * @Route("/{id}", name="admin_greece_update")
     * @Method("PUT")
     * @Template("AppBundle:Greece:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Greece')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Greece entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_greece_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Greece entity.
     *
     * @Route("/{id}", name="admin_greece_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Greece')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Greece entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_greece'));
    }

    /**
     * Creates a form to delete a Greece entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_greece_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
