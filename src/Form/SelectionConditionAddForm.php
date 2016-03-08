<?php

/**
 * @file
 * Contains \Drupal\ctools\Form\SelectionConditionAddForm.
 */

namespace Drupal\ctools\Form;

use Drupal\Core\Condition\ConditionManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for adding a new selection condition.
 */
class SelectionConditionAddForm extends SelectionConditionFormBase {

  /**
   * The condition manager.
   *
   * @var \Drupal\Core\Condition\ConditionManager
   */
  protected $conditionManager;

  /**
   * Constructs a new SelectionConditionAddForm.
   *
   * @param \Drupal\Core\Condition\ConditionManager $condition_manager
   *   The condition manager.
   */
  public function __construct(ConditionManager $condition_manager) {
    $this->conditionManager = $condition_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('plugin.manager.condition')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'entity_display_variant_selection_condition_add_form';
  }

  /**
   * {@inheritdoc}
   */
  protected function prepareCondition($condition_id) {
    // Create a new selection condition instance.
    return $this->conditionManager->createInstance($condition_id);
  }

  /**
   * {@inheritdoc}
   */
  protected function submitButtonText() {
    return $this->t('Add selection condition');
  }

  /**
   * {@inheritdoc}
   */
  protected function submitMessageText() {
    return $this->t('The %label selection condition has been added.', ['%label' => $this->condition->getPluginDefinition()['label']]);
  }

}
