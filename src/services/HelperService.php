<?php
/**
 * aws-serverless-image-handler plugin for Craft CMS 3.x
 *
 * AWS Serverless Image Handler plugin for Craft CMS 3
 *
 * @link      https://www.dutchheight.com
 * @copyright Copyright (c) 2019 Dutch Height
 */

namespace dutchheight\awsserverlessimagehandler\services;

use Craft;
use craft\base\Component;

/**
 * @author    Dutch Height
 * @package   Awsserverlessimagehandler
 * @since     1.0.0
 */
class HelperService extends Component {
    // Public Methods
    // =========================================================================

    /**
     * Get focalpoint translation
     *
     * @return string
     */
    public function getFocalPoint($focalPoint)
    {
        $position = [
            0 => [0 => "left top",      1 => "top",         2 => "right top"],
            1 => [0 => "left",          1 => "center",      2 => "right"],
            2 => [0 => "left bottom",   1 => "bottom",      2 => "right bottom"]
        ];

        $xCord = round($focalPoint['x'] * 2);
        $yCord = round($focalPoint['y'] * 2);

        return $position[$yCord][$xCord];
    }
    
    /**
     * Get focalpoint translation
     *
     * @return bool
     */
    public function getClientWebPSupport()
    {
        return Craft::$app->getRequest()->accepts('image/webp');
    }
}
