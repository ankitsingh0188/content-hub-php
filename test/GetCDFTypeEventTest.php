<?php

namespace Acquia\ContentHubClient\test;

use Acquia\ContentHubClient\CDF\CDFObject;
use Acquia\ContentHubClient\CDF\CDFObjectInterface;
use Acquia\ContentHubClient\Event\GetCDFTypeEvent;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Class GetCDFTypeEventTest.
 *
 * @package Acquia\ContentHubClient\test
 */
class GetCDFTypeEventTest extends TestCase {

  /**
   * GetCDFTypeEvent instance.
   *
   * @var \Acquia\ContentHubClient\Event\GetCDFTypeEvent
   */
  private $getCdfTypeEvent;

  /**
   * {@inheritdoc}
   */
  public function setUp(): void {
    parent::setUp();
    try {
      $this->getCdfTypeEvent = new GetCDFTypeEvent($this->getCdfTypeEventData());
    }
    catch (\Exception $exception) {
    }
  }

  /**
   * {@inheritdoc}
   */
  public function tearDown(): void {
    parent::tearDown();
    unset($this->getCdfTypeEvent);
  }

  /**
   * {@inheritdoc}
   */
  public function testGetAndSetObject(): void {
    $this->assertNull($this->getCdfTypeEvent->getObject());

    $cdfObject = $this->getCdfObjectMock();
    $this->getCdfTypeEvent->setObject($cdfObject);
    $this->assertEquals($cdfObject, $this->getCdfTypeEvent->getObject());
    $this->assertInstanceOf(CDFObjectInterface::class,
      $this->getCdfTypeEvent->getObject());
  }

  /**
   * {@inheritdoc}
   */
  public function testCreateGetCdfTypeEventWithoutType(): void {
    $this->expectException(\InvalidArgumentException::class);
    new GetCDFTypeEvent([]);
  }

  /**
   * {@inheritdoc}
   */
  public function testGetData(): void {
    $this->assertEquals($this->getCdfTypeEventData(),
      $this->getCdfTypeEvent->getData());
  }

  /**
   * {@inheritdoc}
   */
  public function testGetType() {
    $this->assertEquals($this->getCdfTypeEventData()['type'],
      $this->getCdfTypeEvent->getType());
  }

  /**
   * Returns mock of CDFObject.
   *
   * @return \PHPUnit\Framework\MockObject\MockObject
   *   Mocked CDFObject.
   */
  private function getCdfObjectMock(): MockObject {
    return $this->getMockBuilder(CDFObject::class)
      ->disableOriginalConstructor()
      ->getMock();
  }

  /**
   * Returns event data.
   *
   * @return array
   *   Data.
   */
  private function getCdfTypeEventData(): array {
    return [
      'type' => 'dummy_type',
    ];
  }

}
