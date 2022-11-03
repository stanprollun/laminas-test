<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

class HelloWorldPageHandlerFactory
{
    public function __invoke(ContainerInterface $container): HelloWorldPageHandler
    {
        return new HelloWorldPageHandler($container->get(LoggerInterface::class), $container->get(TemplateRendererInterface::class));
    }
}
