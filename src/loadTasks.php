<?php

namespace Kerasai\Robo\Phpcs;

/**
 * Robo task integration.
 */
trait loadTasks {

  /**
   * Provides a task for executing PHPCBF.
   *
   * @return \Kerasai\Robo\Phpcs\PhpcbfTask
   *   The PHPCS task.
   */
  protected function taskPhpcbf() {
    return $this->task(PhpcbfTask::class);
  }

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
