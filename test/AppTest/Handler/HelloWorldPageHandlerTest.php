<?php

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HelloWorldPageHandler;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;

class HelloWorldPageHandlerTest extends TestCase
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

    public function testReturnsHtmlResponseWhenTemplateRendererProvided(): void
    {
        $renderer = $this->createMock(TemplateRendererInterface::class);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with('app::hello-world-page', $this->isType('array'))
            ->willReturn('');

        $page = new HelloWorldPageHandler(
            $this->logger,
            $renderer
        );

        $response = $page->handle(
            $this->createMock(ServerRequestInterface::class)
        );

        self::assertInstanceOf(HtmlResponse::class, $response);
    }
}
