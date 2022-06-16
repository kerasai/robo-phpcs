<?php

namespace Kerasai\Robo\Phpcs;

use Kerasai\Robo\Config\ConfigHelperTrait;
use Robo\Result;
use Robo\ResultData;
use Robo\Task\CommandStack;

/**
 * Class PhpcbfTask.
 */
class PhpcbfTask extends CommandStack {

  use ConfigHelperTrait;

  const PATH_CONFIG_NAME = 'phpcs.phpcbf_path';

  const PATH_CONFIG_DEFAULT = 'phpcbf';

  /**
   * {@inheritdoc}
   */
  public function run() {
    $phpcs = $this->getConfigVal($this::PATH_CONFIG_NAME, $this::PATH_CONFIG_DEFAULT);
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
        $extensions = escapeshellarg($options['extensions']);
        $command[] = "--extensions=$extensions";
      }

      if (!empty($options['ignore'])) {
        $ignore = escapeshellarg($options['ignore']);
        $command[] = "--ignore=$ignore";
      }

      $command[] = $path;
      $this->executable($phpcs);
      $this->exec($command);
    }

    return parent::run();
  }

}
