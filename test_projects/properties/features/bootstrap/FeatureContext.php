<?php

use Behat\Behat\Context\BehatContext;

class FeatureContext extends BehatContext
{
    private $success;

    public function __construct(array $parameters)
    {
        $this->success = isset($parameters['success']) ? $parameters['success'] : false;

        if (!isset($parameters['mandatory'])) {
            throw new \RuntimeException('Mandatory parameter is missing. Was it lost?');
        }
    }

    /**
     * @Given /^stuff happens$/
     */
    public function stuffHappens()
    {
        if (!$this->success) {
            throw new \RuntimeException('Success is disabled.');
        }
    }
}
