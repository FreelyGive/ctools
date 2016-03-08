<?php

/**
 * @file
 * Contains Drupal\ctools\Form\DisplayVariantAddForm.
 */

namespace Drupal\ctools\Form;

use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a form for adding a variant.
 */
class DisplayVariantAddForm extends DisplayVariantFormBase {

  /**
   * {@inheritdoc}
   */
  protected function submitText() {
    return $this->t('Add variant');
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    parent::save($form, $form_state);
    $form_state->setRedirectUrl($this->getEntity()->toUrl($this->getEntity()->get('display_entity_type') . '-edit-form'));
  }

}
