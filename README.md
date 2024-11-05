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

 
* Supporting GraphQL for fetching / saving Question to allow for a headless Magento support


* Allowing the use of customer names in the Q/A section on the frontend. It was left blank due to the requirements not
stating to need it and due to possible GDPR issues.


* Removing the need to use Product Block class in the layout file. Using this is very heavy for only needing the ProductID


* Remove the use of collection for the frontend however collections was used to keep the functionality of Magento pager support~~~~~~~~

## Explanations

Researched preferred module structures as per official Magento guidance.

* Seperated the Repository functions into `Command` folders to aid in readability and extendability.
For example changing the webapi to only point to those files at a later date


* Created validator chain for validating repository saves to also aid in readability and extendability
custom rows could be added to the table and then extended via di.xml without having to use a plugin / preference


* Seperated ACL permissions for both WebAPI and Admin pages so the store owner
can set between allowing admin users to only use the admin page for example


* Store config for setting a custom admin contact email for module functionality


* Seperated the script tag to be in its own `script-main.phtml` file this keeps the frontend JS functionality seperated and
aids readability


* Added tabbing support though the question list on the product page to allow for accessibility requirements

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
