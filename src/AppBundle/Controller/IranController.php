<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Iran;
use AppBundle\Form\IranType;

/**
 * Iran controller.
 *
 * @Route("/admin/iran")
 */
class IranController extends Controller
{

    /**
     * Lists all Iran entities.
     *
     * @Route("/", name="admin_iran")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Iran')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Iran entity.
     *
     * @Route("/", name="admin_iran_create")
     * @Method("POST")
     * @Template("AppBundle:Iran:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Iran();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_iran_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Iran entity.
     *
     * @param Iran $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Iran $entity)
    {
        $form = $this->createForm(new IranType(), $entity, array(
            'action' => $this->generateUrl('admin_iran_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Iran entity.
     *
     * @Route("/new", name="admin_iran_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Iran();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Iran entity.
     *
     * @Route("/{id}", name="admin_iran_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Iran')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Iran entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Iran entity.
     *
     * @Route("/{id}/edit", name="admin_iran_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Iran')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Iran entity.');
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
    * Creates a form to edit a Iran entity.
    *
    * @param Iran $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Iran $entity)
    {
        $form = $this->createForm(new IranType(), $entity, array(
            'action' => $this->generateUrl('admin_iran_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Iran entity.
     *
     * @Route("/{id}", name="admin_iran_update")
     * @Method("PUT")
     * @Template("AppBundle:Iran:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Iran')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Iran entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_iran_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Iran entity.
     *
     * @Route("/{id}", name="admin_iran_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Iran')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Iran entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_iran'));
    }

    /**
     * Creates a form to delete a Iran entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_iran_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
