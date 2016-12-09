<?php

require_once 'ContextTrait.php';

use Behat\Behat\Context\BehatContext;
use Nulpunkt\BrowserstackFeatureContext;

class BsFeatureContext extends BrowserstackFeatureContext
{
    private $mentionID;
    use ContextTrait;

    public function getMentionID() {
      return $this->mentionID;
    }
    public function setMentionID($val) {
      $this->mentionID = $val;
    }
}
