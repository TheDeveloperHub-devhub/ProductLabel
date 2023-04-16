### Overview ###

Highlight your products with eye-catching ribbons to immediately draw customers attention to particular items. This allows you to easily inform your customers about all the upcoming or ongoing offers which ultimately helps to generate more sales.

### Features ###

This extension will allow you to create two types of ribbons i.e. Static and Dynamic Ribbons
Static Ribbons will allow you to highlight attractive Ribbons on Product and Categories Pages
Dynamic Ribbons comes with an additional feature that allows you to add specific discounts (with the help of the catalog price rule) on the product along with the Ribbon

## Installation

1. Please run the following command
```shell
composer require devhub/core
composer require devhub/product-label
```

2. Update the composer if required
```shell
composer update
```

3. Enable module
```shell
php bin/magento module:enable DeveloperHub_Core
php bin/magento module:enable DeveloperHub_ProductLabel
php bin/magento setup:upgrade
php bin/magento cache:clean
php bin/magento cache:flush
```
4.If your website is running in product mode the you need to deploy static content and
then clear the cache
```shell
php bin/magento setup:static-content:deploy
php bin/magento setup:di:compile
```



#####This extension is compatible with all the versions of Magento 2.3.* and 2.4.*.
###Tested on following instances:
#####multiple instances i.e. 2.3.7-p4 and 2.4.5p1
