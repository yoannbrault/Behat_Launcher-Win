<?php
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

require_once('ContextTrait.php');
require_once('Actionwords.php');


class FeatureContext extends MinkContext implements SnippetAcceptingContext
{
  private $mentionID;
    use ContextTrait;

  public function __construct() {
    $this->actionwords = new Actionwords();
  }
  public function getMentionID() {
    return $this->mentionID;
  }
  public function setMentionID($val) {
      $this->mentionID = $val;
  }

  /**
   * @Then /^the "(.*)" should contain "(.*)"$/
   */
  public function theSelectorShouldContainDatasets($selector, $datasets){
    $this->actionwords->theSelectorShouldContainDatasets($selector, $datasets);
  }

  /**
   * @Then /^the response status code should be "(.*)"$/
   */
  public function theResponseStatusCodeShouldBeStatus($status){
    $this->actionwords->theResponseStatusCodeShouldBeStatus($status);
  }

  /**
   * @Given /^I wait "(.*)" seconds$/
   */
  public function iWaitXSeconds($x){
    $this->actionwords->iWaitXSeconds($x);
  }



  /**
   * @When /^I call "(.*)" with "(.*)"$/
   */
  public function iCallProductUrlWithToken($product_url, $token){
    $this->actionwords->iCallProductUrlWithToken($product_url, $token);
  }

  /**
   * @When /^I received "(.*)" on "(.*)" $/
   */
  public function iReceivedJsonDataOnContentAPIEndpoint($json_data, $content_api_endpoint){
    $this->actionwords->iReceivedJsonDataOnContentAPIEndpoint($json_data, $content_api_endpoint);
  }

  /**
   * @Then /^the "(.*)" should be stored in content as a "(.*)"$/
   */
  public function theJsonDataShouldBeStoredInContentAsAEntity($_json_data, $entity){
    $this->actionwords->theJsonDataShouldBeStoredInContentAsAEntity($_json_data, $entity);
  }

  /**
   * @When /^I send "(.*)"$/
   */
  public function iSendXmlAttachement($xml_attachement){
    $this->actionwords->iSendXmlAttachement($xml_attachement);
  }

  /**
   * @Then /^I should convert it to "(.*)"$/
   */
  public function iShouldConvertItToJsonData($json_data, PyStringNode $__free_text){
    $this->actionwords->iShouldConvertItToJsonData($json_data, $__free_text);
  }

  /**
   * @Given /^I open the "(.*)"$/
   */
  public function iOpenTheApp($app){
    $this->actionwords->iOpenTheApp($app);
  }

  /**
   * @Then /^the player should "(.*)"$/
   */
  public function thePlayerShouldAction($action){
    $this->actionwords->thePlayerShouldAction($action);
  }

}
?>