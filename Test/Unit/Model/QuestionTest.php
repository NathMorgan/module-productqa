<?php

declare(strict_types=1);

namespace Bright\ProductQA\Test\Unit\Model;

use Bright\ProductQA\Model\Question as QuestionModel;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Bright\ProductQA\Api\Data\QuestionInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{

    /** @var QuestionInterface|MockObject */
    private $question;

    /**
     * Setup function for creating mock classes
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->question = (new ObjectManager($this))->getObject(QuestionModel::class);
    }

    public function testGetId()
    {
        $testId = 1;
        $this->question->setId($testId);
        $this->assertEquals($testId, $this->question->getId());
    }

    public function testSetId()
    {
        $testId = 1;
        $question = $this->question->setId($testId);
        $this->assertEquals($question, $this->question);
    }

    public function testGetProductId()
    {
        $testProductId = 1;
        $this->question->setProductId($testProductId);
        $this->assertEquals($testProductId, $this->question->getProductId());
    }

    public function testSetProductId()
    {
        $testProductId = 1;
        $question = $this->question->setProductId($testProductId);
        $this->assertEquals($question, $this->question);
    }

    public function testGetCustomerName()
    {
        $testCustomerName = 'Test Name';
        $this->question->setCustomerName($testCustomerName);
        $this->assertEquals($testCustomerName, $this->question->getCustomerName());
    }

    public function testSetCustomerName()
    {
        $testCustomerName = 'Test Name';
        $question = $this->question->setCustomerName($testCustomerName);
        $this->assertEquals($question, $this->question);
    }

    public function testGetCustomerEmail()
    {
        $testCustomerEmail = 'Test Email';
        $this->question->setCustomerEmail($testCustomerEmail);
        $this->assertEquals($testCustomerEmail, $this->question->getCustomerEmail());
    }

    public function testSetCustomerEmail()
    {
        $testCustomerEmail = 'Test Email';
        $question = $this->question->setCustomerEmail($testCustomerEmail);
        $this->assertEquals($question, $this->question);
    }

    public function testGetQuestion()
    {
        $testQuestion = 'Test Question';
        $this->question->setQuestion($testQuestion);
        $this->assertEquals($testQuestion, $this->question->getQuestion());
    }

    public function testSetQuestion()
    {
        $testQuestion = 'Test Question';
        $question = $this->question->setQuestion($testQuestion);
        $this->assertEquals($question, $this->question);
    }

    public function testGetAnswer()
    {
        $testAnswer = 'Test Answer';
        $this->question->setAnswer($testAnswer);
        $this->assertEquals($testAnswer, $this->question->getAnswer());
    }

    public function testSetAnswer()
    {
        $testAnswer = 'Test Answer';
        $question = $this->question->setAnswer($testAnswer);
        $this->assertEquals($question, $this->question);
    }

    public function testGetCreatedAt()
    {
        $testCreatedAt = 'Test Created At';
        $this->question->setCreatedAt($testCreatedAt);
        $this->assertEquals($testCreatedAt, $this->question->getCreatedAt());
    }

    public function testSetCreatedAt()
    {
        $testCreatedAt = 'Test Created At';
        $question = $this->question->setCreatedAt($testCreatedAt);
        $this->assertEquals($question, $this->question);
    }

    public function testGetUpdatedAt()
    {
        $testUpdatedAt = 'Test Updated At';
        $this->question->setUpdatedAt($testUpdatedAt);
        $this->assertEquals($testUpdatedAt, $this->question->getUpdatedAt());
    }

    public function testSetUpdatedAt()
    {
        $testUpdatedAt = 'Test Updated At';
        $question = $this->question->setUpdatedAt($testUpdatedAt);
        $this->assertEquals($question, $this->question);
    }

    public function testGetIsApproved()
    {
        $testIsApproved = true;
        $this->question->setIsApproved($testIsApproved);
        $this->assertEquals($testIsApproved, $this->question->getIsApproved());
    }

    public function testSetIsApproved()
    {
        $testIsApproved = true;
        $question = $this->question->setIsApproved($testIsApproved);
        $this->assertEquals($question, $this->question);
    }
}
