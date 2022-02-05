[![CircleCI](https://circleci.com/gh/kerasai/robo-phpcs.svg?style=svg)](https://circleci.com/gh/kerasai/robo-phpcs)

# Robo PHPCS

## Installation

> composer require --dev kerasai/robo-phpcs

You'll also want standards to apply. For the example configruation below:

> composer require --dev drupal/coder

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
    modules:
      path: web/modules/custom
      standard: vendor/drupal/coder/coder_sniffer/Drupal
      extensions: 'php,module,inc,install,test,profile,theme,css,info,txt,md'
      ignore: 'node_modules,bower_components,vendor'
    themes:
      path: web/themes/custom
      standard: vendor/drupal/coder/coder_sniffer/Drupal
      extensions: 'php,module,inc,install,test,profile,theme,css,info,txt,md'
      ignore: 'node_modules,bower_components,vendor'
    modules_practice:
      path: web/modules/custom
      standard: vendor/drupal/coder/coder_sniffer/DrupalPractice
      extensions: 'php,module,inc,install,test,profile,theme,css,info,txt,md'
      ignore: 'node_modules,bower_components,vendor'
    themes_practice:
      path: web/themes/custom
      standard: vendor/drupal/coder/coder_sniffer/DrupalPractice
      extensions: 'php,module,inc,install,test,profile,theme,css,info,txt,md'
      ignore: 'node_modules,bower_components,vendor'
```

### Robofile.php:

```php
<?php

class RoboFile {

  use \Kerasai\Robo\Phpcs\loadTasks;

  /**
   * PHPCS code style checks
   */
  public function testPhpcs() {
    $this->taskPhpcs()->run();
  }

}
```
