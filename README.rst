Behat Launcher
==============

|test_status| |last_version|

.. |test_status| image:: https://travis-ci.org/alexandresalome/behat-launcher.png
   :alt: Build status
   :target: https://travis-ci.org/alexandresalome/behat-launcher

.. |last_version| image:: https://poser.pugx.org/alexandresalome/behat-launcher/v/stable.png
   :alt: Latest stable version
   :target: https://packagist.org/packages/alexandresalome/behat-launcher

An application to **launch your Behat tests from your browser**:

.. image:: src/Alex/BehatLauncher/Resources/demo.png

Installation
------------

To install Behat-Launcher, you will need:

* PHP 5.4 (at least & NOT PHP 7 !)
* Apache2 or Nginx or anything that can run a PHP application
* A MySQL database
* NodeJS and npm to install Bower and Grunt
* Selenium-server-standalone-x.xx.x.jar
* Firefox

**1. Get the code**

Go to folder where you want to install Behat-Launcher and clone the sourcecode through git command:

.. code-block:: bash

    cd /var/www
    git clone git@github.com:yoannbrault/Behat_Launcher_FMM.git
    cd behat-launcher

**2. Install dependencies**

Behat-Launcher works with `composer <http://getcomposer.org>`_, a tool to manage dependencies.

Download it in behat-launcher folder:

.. code-block:: bash

    cd /var/www/behat-launcher
    curl http://getcomposer.org/installer | php
    php composer.phar install

This command will download dependencies in **vendor/** folder to make them available to the application.

Next you will need to install the assets using Bower and Grunt.

You can install these tools using npm, the NodeJS package manager:

.. code-block:: bash

    npm install -g bower
    npm install -g grunt-cli

You can now install the assets:

.. code-block:: bash

    bower install
    npm install
    grunt

**3. Configuration**

In this folder, create a file **config.php** where you will configure your database and your projects.

You can use the **config.php.dist** file to get an exhaustive list of configuration features.

.. code-block:: bash

    cd /var/www/behat-launcher
    cp config.php.dist config.php
    vi config.php # (or notepad, or whatever you use to edit this file)

**4. Database**

When you're done, initialize your database:

.. code-block:: bash

    php behat-launcher init-db

**5. WebServer**

Now, configure your web server to make the application accessible through your webserver. Make it serve the **web** folder:

.. code-block:: bash

    DocumentRoot /var/www/behat-launcher/web

Make sure web server has write access to *data/* folder.

**6. Background job**

To run tests, Behat-Launcher needs to run jobs in background and a selenium server. Start it using:

.. code-block:: bash

    cd /var/www/behat-launcher
    php behat-launcher run

.. code-block:: bash

    cd /var/www/behat-launcher
    java -jar selenium-server-standalone-x.xx.x.jar

**If you are using Linux**, take a look at `this gist <https://gist.github.com/OwlyCode/9661213>`_ to daemonize it.

This command will execute until you stop it. If you want command to stop after all units are ran, pass the **--stop-on-finish** option:

.. code-block:: bash

    cd /var/www/behat-launcher
    php behat-launcher run --stop-on-finish

You're done! Access your application through web server. Given you use Apache and only have this application set up, access http://localhost

Changelog
---------

**v0.1**

* Restart one test, all tests or failed only
* Run multiple tests concurrently
* Relaunch whole run or just failed, or stop execution
* Override behat.yml configuration values
* Record additional formats (html, failed, progress, ...)
* View output while process is running

**v0.2**

* Add the steps to perform before launched the service
* Add a how to create new test run
* Add reference to Selenium server
* Update the composer.json


HOW TO:
-------

**1 - Prerequise:**

Open a terminal and run:

.. code-block:: bash

    java -jar selenium-server-standalone-x.xx.x.jar

Then

Open a new terminal and run:

.. code-block:: bash

    php behat-launcher run 

**2 - Access the service:**

Open a browser and go to localhost:8888

**3 - Use the service:**

To launch a new run:

- Click on "Create a run"
- Fill the field Title with a appropriate title (With the # ticket should be a minimum)
- To launch all feature just check the checkbox near Features **All scenarios will be played**
- To launch specific scenarios, click on the blue arrow and select the features you want to play
- Click on "Create run"

To check the result of a run 

- Go to All runs 
- Click on the # regarding the title you give before
- If the block, is green, all good your test is ok, if it's orange the test is pending, if it's red, damn an error occured
- Click on output column to see the output of your test, if it's failed, you can see a screenshot to find the error.
- You can restart all the test selected, restard only the one are failed, you can also stop a run or delete it.

**Things to improve**

- Add the browserstack support
- Add a green dot to tell if the runner and the selenium server are up
- Add a button to update all feature to be up to date 
- Check if we can implement Behat Launcher with Genkins
