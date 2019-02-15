<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {

  use \Kerasai\Robo\Phpcs\loadTasks;

  /**
   * Run tests.
   */
  public function test() {
    $this->testPhpcs();
    $this->testPhpunit();
  }

  /**
   * PHPCS code style checks.
   */
  public function testPhpcs() {
    $this->taskPhpcs()->stopOnFail()->run();
  }

  /**
   * PHPUnit tests.
   */
  public function testPhpunit() {
    $this->taskPhpUnit()->run();
  }

}
