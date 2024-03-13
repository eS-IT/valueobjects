<?php

/**
 * @package     valueobjects
 * @since       21.07.2022 - 16:10
 * @author      Patrick Froch <info@easySolutionsIT.de>
 * @see         http://easySolutionsIT.de
 * @copyright   e@sy Solutions IT 2022
 * @license     LGPL
 */

declare(strict_types = 1);

namespace Esit\Valueobjects\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class EsitValueobjectsExtension extends Extension
{


    /**
     * Lädt die Konfigurationen
     * @param array            $mergedConfig
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    public function load(array $mergedConfig, ContainerBuilder $container): void
    {
        $path   = __DIR__ . '/../Resources/config';
        $files  = ['duration', 'email', 'iban', 'ip', 'isbn', 'money', 'url'];
        $loader = new YamlFileLoader($container, new FileLocator($path));

        foreach ($files as $file) {
            if (\is_file("$path/$file.yml")) {
                $loader->load("$file.yml");
            }
        }
    }
}
