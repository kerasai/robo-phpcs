[![CircleCI](https://circleci.com/gh/kerasai/robo-phpcs.svg?style=svg)](https://circleci.com/gh/kerasai/robo-phpcs)

# Robo PHPCS

## Installation

> composer require kerasai/robo-phpcs

## Usage

> vendor/bin/robo test:phpcs

### robo.yml

```yaml
phpcs:
  # Defaults to 'phpcs'.
  path: vendor/bin/phpcs
  files:
    src:
      standard: vendor/drupal/coder/coder_sniffer/Drupal
    tests:
      standard: vendor/drupal/coder/coder_sniffer/Drupal
```

### Robofile.php:

```php
<?php

class RoboFile {

  use \Kerasai\Robo\Phpcs\loadTasks;

  /**
   * PHPCS code style checks.
   */
  public function testPhpcs() {
    $this->taskPhpcs()->run();
  }

}
``` 