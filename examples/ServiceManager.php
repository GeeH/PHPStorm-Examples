<?php
/**
 * Created by Gary Hockin.
 * Date: 10/06/2015
 * @GeeH
 */


// create a service manager - note that it implements the Zend\ServiceManager\ServiceLocatorInterface
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;

$serviceManager = new ServiceManager(new Config());

// I'm registering an `invokable` with the service manager, this means the service manager can create it using just a
// `new` statement, effectively it's running `return new \Zend\ServiceManager\Config();` - ignore the fact it's a config
// object that we used to create the service manager above, that's just coincidence, I'm using that object because
// it can be created without having dependencies

// note, the first parameter is the name, we use the ::class super constant to name our classes as a best and this is
// the behaviour we want to exploit later - we can now pull this named service out of the service manager
$serviceManager->setInvokableClass(Config::class, Config::class);

// retrieve the class from the service manager, obviously this is usually done in a different class later in the app
$config = $serviceManager->get(Config::class);

// at this point the IDE has no idea what the $config variable holds for code completion purposes, but because
// $serviceManager implements the ServiceLocatorInterface, and we've called `get` with a ::class super constant, we
// can assume that the method has returned an instance of the `Config` class