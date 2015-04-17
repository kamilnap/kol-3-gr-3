<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Turcja;
use AppBundle\Form\TurcjaType;

/**
 * Turcja controller.
 *
 * @Route("/admin/turcja")
 */
class TurcjaController extends Controller
{

    /**
     * Lists all Turcja entities.
     *
     * @Route("/", name="admin_turcja")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Turcja')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Turcja entity.
     *
     * @Route("/", name="admin_turcja_create")
     * @Method("POST")
     * @Template("AppBundle:Turcja:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Turcja();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('admin_turcja_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Turcja entity.
     *
     * @param Turcja $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Turcja $entity)
    {
        $form = $this->createForm(new TurcjaType(), $entity, array(
            'action' => $this->generateUrl('admin_turcja_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Turcja entity.
     *
     * @Route("/new", name="admin_turcja_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Turcja();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Turcja entity.
     *
     * @Route("/{id}", name="admin_turcja_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Turcja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Turcja entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Turcja entity.
     *
     * @Route("/{id}/edit", name="admin_turcja_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Turcja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Turcja entity.');
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
    * Creates a form to edit a Turcja entity.
    *
    * @param Turcja $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Turcja $entity)
    {
        $form = $this->createForm(new TurcjaType(), $entity, array(
            'action' => $this->generateUrl('admin_turcja_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Turcja entity.
     *
     * @Route("/{id}", name="admin_turcja_update")
     * @Method("PUT")
     * @Template("AppBundle:Turcja:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Turcja')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Turcja entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('admin_turcja_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Turcja entity.
     *
     * @Route("/{id}", name="admin_turcja_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Turcja')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Turcja entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('admin_turcja'));
    }

    /**
     * Creates a form to delete a Turcja entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_turcja_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
