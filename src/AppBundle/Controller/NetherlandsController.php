<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Netherlands;
use AppBundle\Form\NetherlandsType;

/**
 * Netherlands controller.
 *
 * @Route("/admin/netherlands")
 */
class NetherlandsController extends Controller
{

    /**
     * Lists all Netherlands entities.
     *
     * @Route("/", name="admin_netherlands")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Netherlands')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Netherlands entity.
     *
     * @Route("/", name="admin_netherlands_create")
     * @Method("POST")
     * @Template("AppBundle:Netherlands:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Netherlands();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_netherlands_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Netherlands entity.
     *
     * @param Netherlands $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Netherlands $entity)
    {
        $form = $this->createForm(new NetherlandsType(), $entity, array(
            'action' => $this->generateUrl('admin_netherlands_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Netherlands entity.
     *
     * @Route("/new", name="admin_netherlands_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Netherlands();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Netherlands entity.
     *
     * @Route("/{id}", name="admin_netherlands_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Netherlands')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Netherlands entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Netherlands entity.
     *
     * @Route("/{id}/edit", name="admin_netherlands_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Netherlands')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Netherlands entity.');
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
    * Creates a form to edit a Netherlands entity.
    *
    * @param Netherlands $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Netherlands $entity)
    {
        $form = $this->createForm(new NetherlandsType(), $entity, array(
            'action' => $this->generateUrl('admin_netherlands_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Netherlands entity.
     *
     * @Route("/{id}", name="admin_netherlands_update")
     * @Method("PUT")
     * @Template("AppBundle:Netherlands:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Netherlands')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Netherlands entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_netherlands_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Netherlands entity.
     *
     * @Route("/{id}", name="admin_netherlands_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Netherlands')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Netherlands entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_netherlands'));
    }

    /**
     * Creates a form to delete a Netherlands entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_netherlands_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
