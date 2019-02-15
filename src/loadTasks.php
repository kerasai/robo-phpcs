<?php

namespace Kerasai\Robo\Phpcs;

/**
 * Robo task integration.
 */
trait loadTasks {

  /**
   * Provides a task for executing PHPCS.
   *
   * @return \Kerasai\Robo\Phpcs\PhpcsTask
   *   The PHPCS task.
   */
  protected function taskPhpcs() {
    return $this->task(PhpcsTask::class);
  }

}
