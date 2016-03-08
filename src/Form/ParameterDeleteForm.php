<?php

/**
 * @file
 * Contains \Drupal\ctools\Form\ParameterDeleteForm.
 */

namespace Drupal\ctools\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\ConfirmFormBase;
use Drupal\ctools\Entity\DisplayInterface;

/**
 * Provides a form for deleting an access condition.
 */
class ParameterDeleteForm extends ConfirmFormBase {

  /**
   * The display entity this static context belongs to.
   *
   * @var \Drupal\ctools\Entity\DisplayInterface
   */
  protected $entity;

  /**
   * The parameter configuration.
   *
   * @var array
   */
  protected $parameter;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'entity_panels_mini_parameter_delete_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return $this->t('Are you sure you want to delete the parameter %label?', ['%label' => $this->entity->getParameter($this->parameter)['label']]);
  }

  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return $this->entity->toUrl('edit-form');
  }

  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return $this->t('Delete');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state, DisplayInterface $entity = NULL, $name = NULL) {
    $this->entity = $entity;
    $this->parameter = $name;
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('The parameter %label has been removed.', ['%label' => $this->entity->getParameter($this->parameter)['label']]));
    $this->entity->removeParameter($this->parameter);
    $this->entity->save();
    $form_state->setRedirectUrl($this->getCancelUrl());
  }

}
