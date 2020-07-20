<?php

namespace dutchheight\awsserverlessimagehandler\models;

use dutchheight\awsserverlessimagehandler\Awsserverlessimagehandler;

use Craft;
use craft\base\Model;

class Settings extends Model
{
  public $serverlessDistributionURL = '';

  public function rules()
  {
    return [
      ['serverlessDistributionURL', 'string'],
    ];
  }

  public function getSecretKey(): string
  {
    return Craft::parseEnv($this->serverlessDistributionURL);
  }
}