<?php
use Behat\Behat\Exception\PendingException;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Mink\Driver\Selenium2Driver;
require_once('FeatureConfig.php');
trait ContextTrait
{
    /**
    * Method to log with predefined user
    *
    * @When /^log me as "([^"]*)" on (PRODUCTION|DEVEL|STAGING)?$/
    * @When /^I log me as "([^"]*)" on (PRODUCTION|DEVEL|STAGING)?$/
    */
    public function logMeAs($user, $env)
    {
      //go to page
      $session = $this->getSession();
      $this->visit(BASE.constant($env).BASE_URL.LOGIN);
      $this->waitSeconds("2");
      //fill in login
      $this->fillField("login", $user);
      // fill in password
      $this->fillField("password", constant($user));
      //Press to conect
      $this->pressButton("connectBtn");
    }


    /**
     * @When /^I wait (\d+) seconds?$/
     */
    public function waitSeconds($seconds)
    {
        $this->getSession()->wait(1000*$seconds);
    }

    /**
     * @When /^I switch to iframe "(?P<iframe>(?:[^"]|\\")*)"$/
     */
    public function switchToIframe($iframe)
    {
        $this->getSession()->switchToIframe($iframe);
    }

    /**
     * @When /^I switch back$/
     */
    public function switchBack()
    {
        $this->getSession()->switchToIframe();
    }

    
    /**
     * @Given I reload the page :arg1
     */
    public function iReloadThePage($arg1)
    {
        $this->getSession()->visit($arg1);
    }

    /**
    * @Then /^the element attribute "([^"]*)" should contain "([^"]*)" in "([^"]*)"$/
    */
    public function theElementAttributeShouldContainIn($attribute, $value, $selector)
    {
      
      $element = $this->getSession()->getPage()->find('css', $selector);
      if (null === $element) 
      {
        $message = sprintf("The selector '%s' was not found.", $selector);   
        throw new PendingException($message);              
      }
      $found = $element->getAttribute($attribute);
      if ($found != $value) 
      {
        $message = sprintf("We not find the same value. '%s' found", $found);   
        throw new PendingException($message);      
      }
    }

    /**
    * @Given /^I press key "([^"]*)" in \'([^\']*)\'$/
    */
    public function iPressKeyOn($key, $xpath)
    {
        $this->getSession()->getDriver()->keyPress($xpath, $key);
    }

    /**
    * @When /^I click xpath \'([^\']*)\'$/
    */
    public function iClickXpath($xpath)
    {
        $this->getSession()->getDriver()->click($xpath);
    }

    /**
    * @When /^I select "([^"]*)" in dropdown \'([^\']*)\'$/
    */
    public function iSelectOption($value, $xpath)
    {
      $this->getSession()->getDriver()->selectOption($xpath, $value);
    }

    /**
    * Method to find Xpath in the DOM
    *
    * @Given /^I should see "([^"]*)" in \'([^\']*)\'$/
    */
    public function iShouldSeeIn($value, $xpath)
    {
      $this->getSession()->getDriver()->isVisible($xpath);
    }

    /**
    * Method to count element DOM
    *
    * @Then /^I should see (more|less) than "([^"]*)" "([^"]*)" elements$/
    */
    public function iShouldSeeMoreThanElements($def,$value, $css)
    {
      $container = $this->getSession()->getPage();
      $nodes = $container->findAll('css', $css);

      if ($def == "more" && intval($value) > count($nodes))
      {
        $message = sprintf('%d elements find ', count($nodes));
        throw new PendingException($message);
      }elseif ($def == "less" && intval($value) < count($nodes)){
        $message = sprintf('%d elements find ', count($nodes));
        throw new PendingException($message);
      }

    }

    /**
    * Method to compare if a value is contain in the DOM by Xpath
    *
    * @Then /^I should( | not )see "([^"]*)" value in( | input )\'([^\']*)\'$/
    */
    public function iShouldSeeValueIn($def, $value,$type, $xpath)
    {
      $container = $this->getSession()->getDriver();
      if($type ===" input "){
        $DomValue = $container->getValue($xpath);
        $isInput = true;
      }else{
        $DomValue = $container->getHtml($xpath);
        $isInput = false;
      }
      $isVisible = $container->isVisible($xpath);
      //$this->printDebug($DomValue);

      if( $def == " not ")
      {
        if($isVisible || $isInput)
        {
          if($DomValue == $value)
          {
            $message = sprintf("We find the same value or It is visible.\n Value find is : %s == %s", $value, $DomValue);
            throw new PendingException($message);
          }
        }
      }
      else
      {
        if($isVisible || $isInput)
        {
          if($DomValue != $value )
          {
            $message = sprintf("We not find the same value.\n Value find is : %s", $DomValue);
            throw new PendingException($message);
          }
        }else{
          $message = sprintf("Your value is not visible");
          throw new PendingException($message);
        }
      }
    }

    /**
    * Method to Save and Compare Mention Id
    *
    * @Given /^I (save|compare) mention id \'([^\']*)\'$/
    */
    public function iSaveMentionId($def,$xpath)
    {
      if($def == "save"){
        $this->setMentionID($this->getSession()->getDriver()->getAttribute($xpath,'id'));
      }else{
        $oldMentionId = $this->getMentionID();
        $error = true;
        if($oldMentionId != null)
        {
          $tabOfMentions = $this->getSession()->getPage()->findAll("css", $xpath);
          $tablenght = count($tabOfMentions);
          for ($i = 0; $i <= $tablenght; $i++)
          {
            $mention = $tabOfMentions[$i];
            $idMention = $mention->getAttribute("id");
            if($idMention == $oldMentionId)
            {
              $error = false;
              break;
            }
          }
          if($error)
          {
            $message = sprintf("We don't find the mention in the current list of mentions. Mention ID is :  \n %s \n %s", $oldMentionId, $idMention);
            throw new PendingException($message);
          }
        }else{
          $message = sprintf("You need to save a mention id before to compare.");
          throw new PendingException($message);
        }
      }


    }

    /**
    * Method to show a screenshot
    *
    * @Then /^show me a screenshot$/
    */
    public function showMeAScreenshot() {

      $image_data = $this->getSession()->getDriver()->getScreenshot();
      $file_and_path = '/tmp/behat_screenshot.jpg';
      file_put_contents($file_and_path, $image_data);

      if (PHP_OS === "Darwin" && PHP_SAPI === "cli") {
        exec('open -a "Preview.app" ' . $file_and_path);
      }

    }

    /**
    * Method to swith to the current window
    *
    * @Then /^switch to current window$/
    */
    public function switchToCurrentWindow() {
      $driver = $this->getSession()->getDriver();
      $wdSession = $driver->getWebDriverSession();
      //get all open windows name
      $nameWindows = $wdSession->window_handles();

      $driver->switchToWindow($nameWindows[1]);
    }

    /**
    * Method to set the mouse on a specific element
    *
    * @When /^I hover over the element \'([^\']*)\'$/
    */
    public function iHoverOverTheElement($xpath)
    {
      $driver = $this->getSession()->getDriver();
      $wdSession = $driver->getWebDriverSession();
      $element = $wdSession->element('xpath', $xpath);
      if (null === $element)
      {
        throw new PendingException(sprintf('Could not evaluate xpath : "%s"', $xpath));
      }
      $wdSession->moveto(array('element' => $element->getID()));
    }

/**
     * Capture screenshot after a step has failed (valid only for webdriver)
     *
     * @AfterStep
     * @param AfterStepScope $scope
     */
    public function afterStep(AfterStepScope $scope)
    {
        if (99 === $scope->getTestResult()->getResultCode())
        {
            $this->takeScreenshot();
        }
    }
   /**
     * Capture screenshot of the browser opened by Selenium
     */
    private function takeScreenshot()
    {
        $driver = $this->getSession()->getDriver();
        if ($driver instanceof Selenium2Driver)
        {   
                $fileName = date_default_timezone_set('Europe/Paris') . '_' . uniqid() . '.png';
                $filePath = getcwd() . DIRECTORY_SEPARATOR . 'screenshots';

                // create folder if not already existing
                if (!file_exists($filePath))
                {
                    mkdir($filePath, 0777, true);
                }

                $this->saveScreenshot($fileName, $filePath);
                print('Screenshot at: ' . $filePath . DIRECTORY_SEPARATOR . $fileName);
        }
    }


    abstract public function getMentionID();
    abstract public function setMentionID($val);
}
