# Bright_ProductQA

![M2 Coding Standard](https://github.com/NathMorgan/module-productqa/actions/workflows/coding-standard.yml/badge.svg)

Bright_ProductQA is a module that allows customers to submit product question requests
that can be viewed and answered by the store owner. The questions once approved and answered will appear
on the product page in a form of an Q&A

### Contents
- [Structure](#structure)
- [Module Config](#module-config)
- [API Endpoints](#api-endpoints)
    - [Get List of Questions](#1-get-list-of-questions)
    - [Create a New Question](#2-create-a-new-question)
    - [Update an Existing Question](#3-update-an-existing-question)
    - [Delete a Question by ID](#4-delete-a-question-by-id)
    - [Create a Public Api Question](#5-create-a-public-api-question)
    - [Interfaces](#interfaces)
        - [QuestionRepositoryInterface](#questionrepositoryinterface)
        - [QuestionInterface](#questioninterface)
        - [QuestionSearchResultsInterface](#questionsearchresultsinterface)
        - [QuestionMessageInterface](#questionmessageinterface)
- [Testing](#testing)
- [Future improvements](#future-improvements)
- [Explanations](#explanations)
- [Installation](#installation)
---

## Structure

[Learn about a typical file structure for a Magento 2 module]
(https://developer.adobe.com/commerce/php/development/build/component-file-structure/).

---

## Module Config

Config Location:

`Stores` -> `Configuration` -> `Bright` -> `Product QA`

Default Values:

`Admin Notification Email` -> `test@test.com`

Product QA Grid Location:

`Bright` -> `ProductQA`

---

## API Endpoints

### 1. Get List of Questions

- **URL:** `/V1/bright/question-items`
- **Method:** `GET`
- **Permissions:** `Bright_ProductQA::web_api_fetch`
- **Description:** Fetches a list of questions based on optional search criteria.

#### Request Parameters

- `searchCriteria` (optional) – JSON structure following Magento’s Search Criteria format.

#### Response

- Returns a list of questions in a `QuestionSearchResultsInterface`.

---

### 2. Create a New Question

- **URL:** `/V1/bright/question-items`
- **Method:** `PUT`
- **Permissions:** `Bright_ProductQA::web_api_create`
- **Description:** Creates a new question entry.

#### Request Parameters

- `question` – The `QuestionInterface` object containing question details.
- `shouldNotifyEmail` (optional) – Boolean to notify via email after creation.

#### Response

- Returns the ID of the created question.

---

### 3. Update an Existing Question

- **URL:** `/V1/bright/question-items`
- **Method:** `POST`
- **Permissions:** `Bright_ProductQA::web_api_edit`
- **Description:** Updates an existing question entry.

#### Request Parameters

- `question` – The `QuestionInterface` object with updated question details.
- `shouldNotifyEmail` (optional) – Boolean to notify via email after update.

#### Response

- Returns the ID of the updated question.

---

### 4. Delete a Question by ID

- **URL:** `/V1/bright/question-delete`
- **Method:** `POST`
- **Permissions:** `Bright_ProductQA::web_api_delete`
- **Description:** Deletes a question by its ID.

#### Request Parameters

- `questionId` – Integer representing the ID of the question to delete.

#### Response

- Returns a boolean indicating the success of the deletion.

---

### 5. Create a Public Api Question

- **URL:** `/V1/productqa/create-question`
- **Method:** `PUT`
- **Permissions:** `anonymous`
- **Description:** Creates a question

#### Request Parameters

- `question` – The `QuestionInterface` object containing question details.
- `formKey` – The form key for the post request

#### Response

- Returns `QuestionMessageInterface` object containing messages of the request

---

## Interfaces

### QuestionRepositoryInterface

The main repository interface for managing question entities.

- **Methods:**
    - `save(QuestionInterface $question, bool $shouldNotifyEmail = false): int`
        - Saves the question. Optionally sends a notification email.
    - `get(int $questionId): QuestionInterface`
        - Fetches a question by its ID.
    - `getList(SearchCriteriaInterface $searchCriteria = null): QuestionSearchResultsInterface`
        - Retrieves a list of questions based on optional search criteria.
    - `deleteById(int $questionId): bool`
        - Deletes a question by its ID.

### QuestionManagementInterface

The public management of questions that has public scope

- **Methods:**
    - `create(QuestionInterface $question, string $formKey): QuestionMessageInterface`
        - Creates the question.

### QuestionInterface

Defines the data structure for a question entity.

- **Methods:**
    - `getEntityId(): int|null`
        - Get question ID.
    - `setEntityId(int $id): $this`
        - Set question ID.
    - `getProductId(): int|null`
        - Get product ID.
    - `setProductId(int $productId): $this`
        - Set product ID.
    - `getCustomerName(): string|null`
        - Get customer name.
    - `setCustomerName(string $customerName): $this`
        - Set customer name.
    - `getCustomerEmail(): string|null`
        - Get customer email.
    - `setCustomerEmail(string $customerEmail): $this`
        - Set customer email.
    - `getQuestion(): string|null`
        - Get question content.
    - `setQuestion(string $question): $this`
        - Set question content.
    - `getAnswer(): string|null`
        - Get answer content.
    - `setAnswer(string $answer): $this`
        - Set answer content.
    - `getCreatedAt(): string|null`
        - Get created at timestamp.
    - `setCreatedAt(string $createdAt): $this`
        - Set created at timestamp.
    - `getUpdatedAt(): string|null`
        - Get updated at timestamp.
    - `setUpdatedAt(string $updatedAt): $this`
        - Set updated at timestamp.
    - `getIsApproved(): bool|null`
        - Get approval status.
    - `setIsApproved(bool $isApproved): $this`
        - Set approval status.


### QuestionMessageInterface

Defines the structure for a response message associated with question operations.

- **Methods:**
    - `getSuccess(): bool`
        - Returns the success status of the operation.
    - `setSuccess(bool $success): void`
        - Sets the success status of the operation.
    - `getMessage(): Phrase`
        - Retrieves the message for the operation as a `Phrase`.
    - `setMessage(Phrase $message): void`
        - Sets the message for the operation.

### QuestionMessageInterface

Defines the structure for a response message associated with question operations.

- **Methods:**
    - `getSuccess(): bool`
        - Returns the success status of the operation.
    - `setSuccess(bool $success): void`
        - Sets the success status of the operation.
    - `getMessage(): Phrase`
        - Retrieves the message for the operation as a `Phrase`.
    - `setMessage(Phrase $message): void`
        - Sets the message for the operation.

---

## Testing

---

To run Unit tests within this module:

`./vendor/bin/phpunit \-c dev/tests/unit/phpunit.xml.dist vendor/bright/module-productqa/Test/Unit`

---

## Future improvements

---

After the technical test is submitted I will still be working on this to improve the module over time

* Supporting multiple store views to allow for the same product to have different QA messages depending on
locale / region as the same product_id can be used on different stores. For now this can be dealt with translations on
the output.

 
* Supporting GraphQL for fetching / saving Question to allow for a headless Magento support


* Allowing the use of customer names in the Q/A section on the frontend. It was left blank due to the requirements not
stating to need it and due to possible GDPR issues.


* Removing the need to use Product Block class in the layout file. Using this is very heavy for only needing the ProductID


* Remove the use of collection for the frontend however collections was used to keep the functionality of Magento pager support


* Improving email sent out to the admin (Including data from the question)


* Add the error / success message to be part of the form so the customer can see it easier and not at the top of the page


* Moving the Product QA grid to be part of the actual product it's assigned to aid store owner in knowing what
product the question is for


* Adding more unit test classes for each PHP class


* Improving the looks of the ProductQA admin grid to make it more visible that the question needs to be reviewed / answered

---

## Explanations

---

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

---

## Installation

---

1. Install via composer
   Note: both repositories need to be configured until the package and its dependency are available through packagist.
   ```
   composer config repositories.bright-module-productqa git "https://github.com/NathMorgan/module-productqa.git"
   composer require bright/module-productqa
   ```
2. Setup
   ```
   bin/magento setup:upgrade
   ```
