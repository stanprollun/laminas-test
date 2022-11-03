<?php

declare(strict_types=1);

namespace App\Handler;

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;

class HelloWorldPageHandler implements RequestHandlerInterface
{
    public function __construct(private LoggerInterface $logger, private TemplateRendererInterface $renderer)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $this->logger->info('hello world handler called');
        return new HtmlResponse($this->renderer->render(
            'app::hello-world-page',
            [] // parameters to pass to template
        ));
    }
}
