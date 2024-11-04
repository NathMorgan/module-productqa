# Bright_ProductQA

Bright_ProductQA is a module that allows customers to submit product question requests
that can be viewed and answered by the store owner. The questions once approved and answered will appear
on the product page in a form of an Q&A

## Structure

[Learn about a typical file structure for a Magento 2 module]
(https://developer.adobe.com/commerce/php/development/build/component-file-structure/).

## API

## Testing

## Future improvements

* Supporting multiple store views to allow for the same product to have different QA messages depending on
locale / region as the same product_id can be used on different stores. For now this can be dealt with translations on
the output.

## Explanations

Researched preferred module structures as per official Magento guidance.

* Seperated the Repository functions into `Command` folders to aid in readability and extendability.
For example changing the webapi to only point to those files at a later date


* Created validator chain for validating repository saves to also aid in readability and extendability
custom rows could be added to the table and then extended via di.xml without having to use a plugin / preference


* Seperated ACL permissions for both WebAPI and Admin pages so the store owner
can set between allowing admin users to only use the admin page for example

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
