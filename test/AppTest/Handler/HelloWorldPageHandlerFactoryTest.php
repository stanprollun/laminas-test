<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HelloWorldPageHandler;
use App\Handler\HelloWorldPageHandlerFactory;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class HelloWorldPageHandlerFactoryTest extends TestCase
{
    /** @var ContainerInterface&MockObject */
    protected $container;

    /** @var LoggerInterface&MockObject */
    protected $logger;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->logger    = $this->createMock(LoggerInterface::class);
    }

    public function testFactoryWithTemplate(): void
    {
        $renderer = $this->createMock(TemplateRendererInterface::class);
        $this->container
            ->expects($this->exactly(2))
            ->method('get')
            ->withConsecutive(
                [LoggerInterface::class],
                [TemplateRendererInterface::class],
            )
            ->willReturnOnConsecutiveCalls(
                $this->logger,
                $renderer
            );

        $factory = new HelloWorldPageHandlerFactory();
        $page    = $factory($this->container);

        self::assertInstanceOf(HelloWorldPageHandler::class, $page);
    }
}
