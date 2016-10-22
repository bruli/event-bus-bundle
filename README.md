# event-bus-bundle
======
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bruli/event-bus-bundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bruli/event-bus-bundle/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/bruli/event-bus-bundle/v/stable.svg)](https://packagist.org/packages/bruli/event-bus-bundle) 
[![Total Downloads](https://poser.pugx.org/bruli/event-bus-bundle/downloads)](https://packagist.org/packages/bruli/event-bus-bundle) 
[![Latest Unstable Version](https://poser.pugx.org/bruli/event-bus-bundle/v/unstable.svg)](https://packagist.org/packages/bruli/event-bus-bundle) 
[![License](https://poser.pugx.org/bruli/event-bus-bundle/license.svg)](https://packagist.org/packages/bruli/event-bus-bundle)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/c402ad75-26d7-4dc9-b774-c064b16d30cf/mini.png)](https://insight.sensiolabs.com/projects/c402ad75-26d7-4dc9-b774-c064b16d30cf)
[![Donate button](https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif)](https://www.paypal.me/brulics)

Bundle to use event bus in symfony projects

## Installation

### Step 1: Composer

```bash
$ composer require bruli/event-bus-bundle
```

Add in your app/AppKernel.php file:

```php
public function registerBundles()
    {
        ...
            new \Bruli\EventBusBundle\EventBusBundle()
    }
```

## Credits

* Pablo Braulio ([@brulics](https://twitter.com/brulics))
* [All contributors](https://github.com/bruli/event-bus-bundle/graphs/contributors)

## License

event-bus-bundle is released under the [MIT License](https://opensource.org/licenses/MIT). See the bundled LICENSE file for details.