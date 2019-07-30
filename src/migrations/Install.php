<?php
namespace dutchheight\awsserverlessimagehandler\migrations;

use Craft;
use craft\db\Migration;
use craft\models\FieldGroup;
use craft\base\Field;

use dutchheight\awsserverlessimagehandler\fields\ImageProperties;

class Install extends Migration
{
    public function safeUp()
    {
        $fieldGroup = new FieldGroup();
        $fieldGroup->name = "AWS Serverless Image Handler";
        Craft::$app->fields->saveGroup($fieldGroup);
        
        $group = (new \craft\db\Query())
            ->select("id")
            ->from("fieldgroups")
            ->where(["name" => "AWS Serverless Image Handler"])
            ->one();

        $field          = new ImageProperties();
        $field->groupId = $group["id"];
        $field->name    = "Toggle aws image processor";
        $field->handle  = "toggleAwsImageProcessor";
        Craft::$app->fields->saveField($field);
    }

    public function safeDown()
    {
        $group = (new \craft\db\Query())
            ->select("id")
            ->from("fieldgroups")
            ->where(["name" => "AWS Serverless Image Handler"])
            ->one();
        Craft::$app->fields->deleteGroupById($group["id"]);
        $field = Craft::$app->fields->getFieldByHandle('toggleAwsImageProcessor');
        if (!is_null($field)) {
            Craft::$app->fields->deleteField($field);
        }
    }
}