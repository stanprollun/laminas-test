<?php

declare(strict_types=1);

namespace App\Handler;

use Mezzio\Template\TemplateRendererInterface;
use Psr\Container\ContainerInterface;

class HelloWorldPageHandlerFactory
{
    public function __invoke(ContainerInterface $container) : HelloWorldPageHandler
    {
        return new HelloWorldPageHandler($container->get(TemplateRendererInterface::class));
    }
}
