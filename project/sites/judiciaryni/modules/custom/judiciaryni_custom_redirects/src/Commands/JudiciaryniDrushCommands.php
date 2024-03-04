<?php

namespace Drupal\judiciaryni_custom_redirects\Commands;

use Drupal\structure_sync\StructureSyncHelper;
use Drush\Commands\DrushCommands;

/**
 * Drush custom commands.
 */
class JudiciaryniDrushCommands extends DrushCommands {

  /**
   * Core EntityTypeManager instance.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Class constructor.
   */
  public function __construct() {
    parent::__construct();
    $this->entityTypeManager = \Drupal::entityTypeManager();
  }

  /**
   * Drush command to generate old style redirects (sites/judiciaryni/files)
   * for Drupal 10 style paths (files/judiciaryni).
   *
   * @command judiciary-generate-old-redirects
   */
  public function generateOldStyleRedirects() {
    $storage = $this->entityTypeManager->getStorage('file');
    $fids = $storage->getQuery()
      ->accessCheck(FALSE)
      ->execute();
    $files = $storage->loadMultiple($fids);
    $titles = [];
    foreach ($files as $file) {
      $title = $file->getFilename();
      print("Title is " . $title);
    }
  }
}

