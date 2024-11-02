<?php

declare(strict_types=1);

namespace Bright\ProductQA\Test\Unit\Model;

use Bright\ProductQA\Api\Data\QuestionInterfaceFactory;
use Bright\ProductQA\Model\ResourceModel\Question as QuestionResource;
use Bright\ProductQA\Model\Question as QuestionModel;
use Magento\Framework\Registry;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\Api\DataObjectHelper;
use Bright\ProductQA\Api\Data\QuestionInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class QuestionTest extends TestCase
{
    /** @var QuestionModel|MockObject */
    private $questionModel;

    /** @var QuestionInterface|MockObject */
    private $question;

    /** @var Registry|MockObject */
    private $registryMock;

    /** @var QuestionResource|MockObject */
    private $resourceMock;

    /** @var DataObjectHelper|MockObject */
    private $dataObjectHelper;

    /** @var QuestionInterfaceFactory|MockObject */
    private $questionInterfaceFactory;

    /**
     * Setup function for creating mock classes
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->questionInterfaceFactory = $this->getMockBuilder(QuestionInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();

        $this->question = $this->getMockBuilder(
            Question::class
        )->getMock();

        $this->resourceMock = $this->createPartialMock(
            QuestionResource::class,
            ['getIdFieldName']
        );

        $this->resourceMock->expects($this->any())
            ->method('getIdFieldName')
            ->willReturn('id');

        $this->registryMock = $this->createPartialMock(Registry::class, ['registry']);
        $this->dataObjectHelper = $this->getMockBuilder(DataObjectHelper::class)
            ->disableOriginalConstructor()
            ->setMethods(['populateWithArray'])
            ->getMock();

        $this->questionModel = (new ObjectManager($this))->getObject(
            QuestionModel::class,
            [
                'registry' => $this->registryMock,
                'questionInterfaceFactory' => $this->questionInterfaceFactory,
                'dataObjectHelper' => $this->dataObjectHelper,
                'resource' => $this->resourceMock,
            ]
        );
    }

    public function testGetDataModel()
    {
        $entityId = 1;

        $this->questionModel->setEntityId($entityId);
        $this->questionModel->setId($entityId);

        $questionDataObject = $this->getMockForAbstractClass(QuestionInterface::class);

        $this->questionInterfaceFactory
            ->expects($this->atLeastOnce())
            ->method('create')
            ->willReturn($questionDataObject);

        $this->dataObjectHelper
            ->expects($this->atLeastOnce())
            ->method('populateWithArray')
            ->with($questionDataObject, $this->questionModel->getData(), QuestionInterface::class)
            ->willReturnSelf();

        $this->questionModel->getDataModel();
    }
}
