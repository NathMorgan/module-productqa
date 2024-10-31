# Bright_ProductQA

Bright_ProductQA is a module that allows customers to submit product question requests
that can be viewed and answered by the store owner. The questions once approved and answered will appear
on the product page in a form of an Q&A

## Structure

[Learn about a typical file structure for a Magento 2 module]
(https://developer.adobe.com/commerce/php/development/build/component-file-structure/).

## API

## Testing

## Installation

1. Install via composer
   Note: both repositories need to be configured until the package and its dependency are available through packagist.
   ```
   composer config repositories.bright-module-productqa git "https://github.com/NathMorgan/module-productqa.git"
   composer require bright/module-productqa
   ```
2. Enable module
   ```
   bin/magento setup:upgrade
   ```
