<?php

namespace Drupal\entity_pager;

use Drupal\views\ResultRow;

/**
 * A class representing a single Entity Pager link.
 */
class EntityPagerLink implements EntityPagerLinkInterface {

  /**
   * @var \Drupal\views\ResultRow|NULL
   */
  var $resultRow;

  /**
   * @var string
   */
  var $text;

  /**
   * EntityPagerLink constructor.
   *
   * @param string $text
   *   The text of the link
   * @param \Drupal\views\ResultRow|NULL $resultRow
   *   The result row in the view to link to.
   */
  public function __construct($text, ResultRow $resultRow = NULL) {
    $this->text = $text;
    $this->resultRow = $resultRow;
  }

  /**
   * {@inheritdoc}
   */
  public function getLink() {
    if (empty($this->resultRow)) {
      return $this->noResult();
    }

    return [
      '#type' => 'link',
      '#title' => $this->text,
      '#url' => $this->resultRow->_entity->getTranslation(\Drupal::languageManager()->getCurrentLanguage()->getId())->toUrl('canonical'),
    ];
  }

  /**
   * Returns a render array for an entity pager link with no results.
   *
   * @return array
   *   The render array for the link with no results.
   */
  protected function noResult() {
    return [
      '#type' => 'markup',
      '#markup' => '<span class="inactive">' . $this->text . '</span>',
    ];
  }
}
