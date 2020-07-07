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

    foreach ($files as $path => $options) {
      $command = [];

      if (!empty($options['path'])) {
        $path = $options['path'];
      }

      if (!empty($options['standard'])) {
        $standard = escapeshellarg($options['standard']);
        $command[] = "--standard=$standard";
      }

      if (!empty($options['extensions'])) {
        $extensions = array_filter(array_map('trim', $options['extensions']));
        if ($extensions) {
          $extensions = implode(',', $extensions);
          $extensions = escapeshellarg($extensions);
          $command[] = "--extensions=$extensions";
        }
      }

      if (!empty($options['ignore'])) {
        $ignore = array_filter(array_map('trim', $options['ignore']));
        if ($ignore) {
          $ignore = implode(',', $ignore);
          $ignore = escapeshellarg($ignore);
          $command[] = "--ignore=$ignore";
        }
      }

      $command[] = $path;
      $this->executable($phpcs);
      $this->exec($command);
    }

    return parent::run();
  }

}
