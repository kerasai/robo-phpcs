<?php

namespace Kerasai\Robo\Phpcs;

use Kerasai\Robo\Config\ConfigHelperTrait;
use Robo\Common\BuilderAwareTrait;
use Robo\Contract\BuilderAwareInterface;
use Robo\Result;
use Robo\ResultData;
use Robo\Task\BaseTask;

/**
 * Class PhpcsTask.
 */
class PhpcsTask extends BaseTask implements BuilderAwareInterface {

  use BuilderAwareTrait;
  use ConfigHelperTrait;

  /**
   * {@inheritdoc}
   */
  public function run() {
    /** @var \Robo\Task\Base\ExecStack $e */
    $e = $this->collectionBuilder()->taskExecStack();

    $phpcs = $this->getConfigVal('phpcs.path', 'phpcs');
    if (!$files = $this->getConfigVal('phpcs.files', [])) {
      return new Result($this, ResultData::EXITCODE_MISSING_OPTIONS, 'No phpcs.files configuration found.');
    }

    foreach ($files as $file => $options) {
      $command = [$phpcs];

      if (!empty($options['standard'])) {
        $standard = escapeshellarg($options['standard']);
        $command[] = "--standard=$standard";
      }

      if (!empty($options['extensions'])) {
        $extensions = escapeshellarg($options['extensions']);
        $command[] = "--extensions=$extensions";
      }

      $command[] = $file;

      $e->exec(implode(' ', $command));
    }

    return $e->stopOnFail()->run();
  }

}
