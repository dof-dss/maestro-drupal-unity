<?php

namespace Drupal\boundarycommission_field_formatter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the ' Response Type' formatter.
 *
 * @FieldFormatter(
 *   id = "response_type_formatter",
 *   label = @Translation("Unity response type field formatter"),
 *   field_types = {
 *     "entity_reference"
 *   }
 * )
 */
class ResponseTypeFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function settingsSummary() {
    $summary = [];
    $summary[] = $this->t('Backlink to display consultations of this response type.');
    return $summary;
  }

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $element = [];

    foreach ($items as $delta => $item) {
      // Get the taxonomy tid for this field.
      $tid = $item->target_id;
      if (!empty($tid)) {
        // Load up the taxonomy term so that we can get the name.
        $term = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($tid);
        // Build the link to return to the publications page with this term selected.
        $element[$delta] = ['#markup' => '<a href="/representations-received/type/' . $tid . '">' . $term->label() . '</a>'];
      }
    }

    return $element;
  }

}
