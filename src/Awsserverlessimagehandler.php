<?php
/**
 * aws-serverless-image-handler plugin for Craft CMS 3.x
 *
 * Plugin to generate handler JSON
 *
 * @link      https://www.dutchheight.com
 * @copyright Copyright (c) 2019 Dutch Height
 */

namespace dutchheight\awsserverlessimagehandler;

use yii\base\Event;

use Craft;
use craft\base\Plugin;

use craft\services\Plugins;
use craft\services\Fields;

use craft\events\PluginEvent;
use craft\events\RegisterComponentTypesEvent;

use craft\web\twig\variables\CraftVariable;


use dutchheight\awsserverlessimagehandler\fields\ImageProperties;
use dutchheight\awsserverlessimagehandler\variables\Variable;
use dutchheight\awsserverlessimagehandler\services\HelperService;

/**
 * Class Awsserverlessimagehandler
 *
 * @author    Dutch Height
 * @package   Awsserverlessimagehandler
 * @since     1.0.0
 *
 */
class Awsserverlessimagehandler extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var Awsserverlessimagehandler
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;
        $this->name = "Aws serverless image handler";

        $this->registerComponents();
        $this->registerEvents();        
    }

    /**
     * Returns the helper services
     *
     * @return HelperService
     */
    public function getHelpers(): HelperService
    {
        return $this->get('helpers');
    }

    // Protected Methods
    // =========================================================================
    
    protected function registerComponents() {
        $this->setComponents([
            'helpers' => HelperService::class
        ]);
    }

    protected function registerEvents() {
        Event::on(
            Plugins::class,
            Plugins::EVENT_AFTER_INSTALL_PLUGIN,
            function (PluginEvent $event) {
                if ($event->plugin === $this) {
                    
                }
            }
        );

        Event::on(Fields::class, Fields::EVENT_REGISTER_FIELD_TYPES, function(RegisterComponentTypesEvent $event) {
            $event->types[] = ImageProperties::class;
        });

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('awsserverlessimagehandler', Variable::class);
            }
        );
    }
}
