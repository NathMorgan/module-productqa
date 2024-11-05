<?php

declare(strict_types=1);

namespace Bright\ProductQA\Test\Unit\Model;

use Bright\ProductQA\Api\Data\QuestionInterface;
use Bright\ProductQA\Api\Data\QuestionSearchResultsInterface;
use Bright\ProductQA\Model\Question\Command\DeleteById;
use Bright\ProductQA\Model\Question\Command\Get;
use Bright\ProductQA\Model\Question\Command\GetList;
use Bright\ProductQA\Model\Question\Command\Save;
use Bright\ProductQA\Model\QuestionRepository;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Framework\Validation\ValidationException;
use PHPUnit\Framework\TestCase;

class QuestionRepositoryTest extends TestCase
{
    /**
     * @var QuestionInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $question;

    /**
     * @var QuestionRepository
     */
    private $questionRepository;

    /**
     * @var DeleteByIdInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $deleteByIdCommand;

    /**
     * @var GetInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $getCommand;

    /**
     * @var GetListInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $getListCommand;

    /**
     * @var SaveInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $saveCommand;

    /**
     * @var ExampleSearchResultsInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $searchResults;

    /**
     * Setup function for creating mock classes
     *
     * @return void
     */
    public function setUp(): void
    {
        $this->question = $this->getMockBuilder(QuestionInterface::class)->getMock();
        $this->deleteByIdCommand = $this->getMockBuilder(DeleteById::class)->disableOriginalConstructor()->getMock();
        $this->getCommand = $this->getMockBuilder(Get::class)->disableOriginalConstructor()->getMock();
        $this->getListCommand = $this->getMockBuilder(GetList::class)->disableOriginalConstructor()->getMock();
        $this->saveCommand = $this->getMockBuilder(Save::class)->disableOriginalConstructor()->getMock();
        $this->searchResults = $this->getMockBuilder(QuestionSearchResultsInterface::class)->getMock();

        $this->questionRepository = (new ObjectManager($this))->getObject(
            QuestionRepository::class,
            [
                'deleteById' => $this->deleteByIdCommand,
                'get' => $this->getCommand,
                'getList' => $this->getListCommand,
                'save' => $this->saveCommand,
            ]
        );
    }

    /**
     * Test successful call and return expected Object
     */
    public function testGet()
    {
        $entityId = 1;

        $this->getCommand
            ->expects($this->once())
            ->method('execute')
            ->with($entityId)
            ->willReturn($this->question);

        $this->assertEquals(
            $this->question,
            $this->questionRepository->get($entityId)
        );
    }

    /**
     * Test error call and return expected exception
     */
    public function testGetWithNoSuchEntityException()
    {
        $entityId = 1;

        $this->expectException(NoSuchEntityException::class);
        $this->expectExceptionMessage(sprintf(
            'Question with id "%s" does not exist.',
            $entityId
        ));

        $this->getCommand
            ->expects($this->once())
            ->method('execute')
            ->with($entityId)
            ->willThrowException(
                new NoSuchEntityException(
                    __('Question with id "%id" does not exist.', ['id' => $entityId])
                )
            );

        $this->questionRepository->get($entityId);
    }

    /**
     * Test successful call and return expected Object
     */
    public function testGetListWithSearchCriteria()
    {
        $searchCriteria = $this->getMockBuilder(SearchCriteriaInterface::class)->getMock();

        $this->getListCommand
            ->expects($this->once())
            ->method('execute')
            ->with($searchCriteria)
            ->willReturn($this->searchResults);

        $this->assertEquals(
            $this->searchResults,
            $this->questionRepository->getList($searchCriteria)
        );
    }

    /**
     * Test successful call and return expected Object
     */
    public function testGetListWithoutSearchCriteria()
    {
        $this->getListCommand
            ->expects($this->once())
            ->method('execute')
            ->with(null)
            ->willReturn($this->searchResults);

        $this->assertEquals(
            $this->searchResults,
            $this->questionRepository->getList()
        );
    }

    /**
     * Test error call and return expected exception
     */
    public function testDeleteByIdWithCouldNotDeleteException()
    {
        $entityId = 1;

        $this->expectExceptionMessage('Could not delete Question');
        $this->expectException(CouldNotDeleteException::class);

        $this->deleteByIdCommand
            ->expects($this->once())
            ->method('execute')
            ->with($entityId)
            ->willThrowException(
                new CouldNotDeleteException(
                    __('Could not delete Question')
                )
            );

        $this->questionRepository->deleteById($entityId);
    }

    /**
     * Test error call and return expected exception
     */
    public function testDeleteByIdWithNoSuchEntityException()
    {
        $entityId = 1;

        $this->expectException(NoSuchEntityException::class);
        $this->expectExceptionMessage(sprintf(
            'Question with id "%s" does not exist.',
            $entityId
        ));

        $this->deleteByIdCommand
            ->expects($this->once())
            ->method('execute')
            ->with($entityId)
            ->willThrowException(
                new NoSuchEntityException(
                    __('Question with id "%id" does not exist.', ['id' => $entityId])
                )
            );

        $this->questionRepository->deleteById($entityId);
    }

    /**
     * Test successful call and return expected Object
     */
    public function testSave()
    {
        $this->saveCommand
            ->expects($this->once())
            ->method('execute')
            ->with($this->question)
            ->willReturn(1);

        $this->questionRepository->save($this->question);
    }

    /**
     * Test error call and return expected exception
     */
    public function testSaveWithCouldNotSaveException()
    {
        $this->expectExceptionMessage('Could not save Question');
        $this->expectException(CouldNotSaveException::class);

        $this->saveCommand
            ->expects($this->once())
            ->method('execute')
            ->with($this->question)
            ->willThrowException(
                new CouldNotSaveException(
                    __('Could not save Question')
                )
            );

        $this->questionRepository->save($this->question);
    }

    /**
     * Test error call and return expected exception
     */
    public function testSaveWithValidationException()
    {
        $this->expectExceptionMessage('Validation Failed');
        $this->expectException(ValidationException::class);

        $this->saveCommand
            ->expects($this->once())
            ->method('execute')
            ->with($this->question)
            ->willThrowException(
                new ValidationException(
                    __('Validation Failed')
                )
            );

        $this->questionRepository->save($this->question);
    }
}
