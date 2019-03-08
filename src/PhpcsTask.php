<?php

namespace Kerasai\Robo\Phpcs;

use Kerasai\Robo\Config\ConfigHelperTrait;
use Robo\Result;
use Robo\ResultData;
use Robo\Task\CommandStack;

/**
 * Class PhpcsTask.
 */
class PhpcsTask extends CommandStack {

  use ConfigHelperTrait;

  /**
   * {@inheritdoc}
   */
  public function run() {
    $phpcs = $this->getConfigVal('phpcs.path', 'phpcs');
    if (!$files = $this->getConfigVal('phpcs.files', [])) {
      return new Result($this, ResultData::EXITCODE_MISSING_OPTIONS, 'No phpcs.files configuration found.');
    }

    foreach ($files as $file => $options) {
      $command = [];

      if (!empty($options['standard'])) {
        $standard = escapeshellarg($options['standard']);
        $command[] = "--standard=$standard";
      }

      if (!empty($options['extensions'])) {
        $extensions = escapeshellarg($options['extensions']);
        $command[] = "--extensions=$extensions";
      }

      if (!empty($options['ignore'])) {
        $ignore = array_filter(array_map('trim', $options['ignore']));
        if ($ignore) {
          $ignore = implode(',', $ignore);
          $ignore = escapeshellarg($ignore);
          $command[] = "--ignore=$ignore";
        }
      }

      $command[] = $file;
      $this->executable($phpcs);
      $this->exec($command);
    }

    return parent::run();
  }

}
