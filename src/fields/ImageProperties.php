<?php
/**
 * aws-serverless-image-handler plugin for Craft CMS 3.x
 *
 * Plugin to generate handler JSON
 *
 * @link      https://www.dutchheight.com
 * @copyright Copyright (c) 2019 Dutch Height
 */

namespace dutchheight\awsserverlessimagehandler\fields;

use Craft;
use craft\base\ElementInterface;
use craft\base\Field;
use craft\base\PreviewableFieldInterface;
use yii\db\Schema;

/**
 * Lightswitch represents a Lightswitch field.
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 3.0
 */
class ImageProperties extends Field implements PreviewableFieldInterface
{
    // Constants
    // =========================================================================

    // Static
    // =========================================================================

    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('app', 'SIH Settings');
    }

    /**
     * @inheritdoc
     */
    public static function valueType(): string
    {
        return 'bool';
    }

    // Properties
    // =========================================================================

    /**
     * @var bool Whether the lightswitch should be enabled by default
     */
    public $default = true;

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): string
    {
        return Schema::TYPE_BOOLEAN;
    }

    /**
     * @inheritdoc
     */
    public function getInputHtml($value, ElementInterface $element = null): string
    {
        $id = Craft::$app->getView()->formatInputId($this->handle);
        return Craft::$app->getView()->renderTemplate('_includes/forms/lightswitch',
            [
                'id' => $id,
                'labelId' => $id . '-label',
                'name' => Craft::t('aws-serverless-image-handler', $this->handle),
                'on' => (bool)$value,
            ]);
    }

    /**
     * @inheritdoc
     */
    public function getTableAttributeHtml($value, ElementInterface $element): string
    {
        if ($value) {
            return '<div class="status enabled" title="' . Craft::t('app', 'Enabled') . '"></div>';
        }

        return '<div class="status" title="' . Craft::t('app', 'Not enabled') . '"></div>';
    }

    /**
     * @inheritdoc
     */
    public function normalizeValue($value, ElementInterface $element = null)
    {
        // If this is a new entry, look for a default option
        if ($value === null) {
            $value = $this->default;
        }

        return $value;
    }
}
