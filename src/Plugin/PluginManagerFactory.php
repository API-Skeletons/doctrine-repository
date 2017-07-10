<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Doctrine\Repository\Plugin;

use Zend\Mvc\Service\AbstractPluginManagerFactory;
use GianArb\Angry\Unclonable;
use GianArb\Angry\Unserializable;

class PluginManagerFactory extends AbstractPluginManagerFactory
{
    use Unclonable;
    use Unserializable;

    const PLUGIN_MANAGER_CLASS = PluginManager::class;
}
