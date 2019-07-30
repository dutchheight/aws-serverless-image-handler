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
        if (!empty($focalPoint)) {
            if ($focalPoint['x'] < 0.33) {
                $xPos = 'left';
            } elseif ($focalPoint['x'] < 0.66) {
                $xPos = 'center';
            } else {
                $xPos = 'right';
            }
            if ($focalPoint['y'] < 0.33) {
                $yPos = 'top';
            } elseif ($focalPoint['y'] < 0.66) {
                $yPos = 'center';
            } else {
                $yPos = 'bottom';
            }
            $position = $xPos.' '.$yPos;

            if (strpos($position, 'center') !== false) {
                $position = 'center';
            }
        }
        
        return $position;
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
