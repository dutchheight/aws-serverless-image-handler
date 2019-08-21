<?php
/**
 * aws-serverless-image-handler plugin for Craft CMS 3.x
 *
 * AWS Serverless Image Handler plugin for Craft CMS 3
 *
 * @link      https://www.dutchheight.com
 * @copyright Copyright (c) 2019 Dutch Height
 */

namespace dutchheight\awsserverlessimagehandler\variables;

use craft\elements\Asset;

use dutchheight\awsserverlessimagehandler\Awsserverlessimagehandler;

/**
 * @author    Dutch Height
 * @package   Awsserverlessimagehandler
 * @since     1.0.0
 */
class Variable
{
    // Public Methods
    // =========================================================================

    /**
     * Get the plugin's name
     *
     * @return null|string
     */
    public function getPluginName()
    {
        return Awsserverlessimagehandler::$plugin->name;
    }

    /**
     * Return a aws endpoint url for image
     *
     * @param Asset $image
     * @param array $edits
     * @return void
     */
    public function getImgUrl(Asset $image, array $edits = null, bool $allowWebP = true)
    {
        // If image AWS image processor setting is off.
        if (!isset($image->toggleAwsImageProcessor) || empty($image->toggleAwsImageProcessor) || $image->toggleAwsImageProcessor == 0) {
            return $image->url;
        }

        // If image is not stored on AWS we cant use the image processor.
        if ($image->getVolume()->displayName() != "Amazon S3") {
            return $image->url;
        }

        $json = [
            "bucket" => $image->getVolume()->bucket,
            "key" => ($image->getVolume()->subfolder ? $image->getVolume()->subfolder . "/" . $image['filename'] : $image['filename']),
            "edits" => [
                "resize" => [
                    "fit" => (isset($edits['fit']) ? $edits['fit'] : "cover"),
                    "position" => (isset($edits['position']) ? $edits['position'] : Awsserverlessimagehandler::$plugin->getHelpers()->getFocalPoint($image->getFocalPoint()))
                ]
            ]
        ];

        if (isset($edits['width'])) {
            $json["edits"]["resize"]["width"] = $edits['width'];
        }
        
        if (isset($edits['height'])) {
            $json["edits"]["resize"]["height"] = $edits['height'];
        }
        
        if (isset($edits['flip'])) {
            $json["edits"]["flip"] = $edits['flip'];
        }
        
        if (isset($edits['flop'])) {
            $json["edits"]["flop"] = $edits['flop'];
        }

        if (isset($edits['greyscale'])) {
            $json["edits"]["greyscale"] = $edits['greyscale'];
        }

        if (isset($edits['rotate'])) {
            $json["edits"]["rotate"] = $edits['rotate'];
        }

        if (isset($edits['blur']) && $edits['blur'] >= 0.3 && $edits['blur'] <= 1000) {
            $json["edits"]["blur"] = $edits['blur'];
        }

        // If client had webp support request webp version
        if ($allowWebP && Awsserverlessimagehandler::$plugin->getHelpers()->getClientWebPSupport()) {
            $json["edits"]["webp"] = [];
        }

        echo $image->volume->url . base64_encode(json_encode($json));
    }
}
