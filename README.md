magmi-m2
===

This is a Magento 2 fork of the original "Magento Mass Importer".

The [official Magmi Wiki](http://wiki.magmi.org/) is still hosted at SourceForge.

### PHP 8.3 Support
This fork is compatible with PHP 8.3 and Magento 2.4.7.

### Authentication

Magmi now features shared Magento authentication out of the box.

Upon installing Magmi and visiting the web panel for the first time, the default username and password are both set to "magmi". Once successfully logged in, configure Magmi with the Magento database credentials (under Configure Global Parameters) and then save the settings. Afterwards, one can simply use their Magento administrative (backend) credentials to login to Magmi.