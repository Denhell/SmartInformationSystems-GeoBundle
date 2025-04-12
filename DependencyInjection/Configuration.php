<?php
namespace SmartInformationSystems\GeoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('smart_information_systems_geo');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode->children()
            ->scalarNode('api_url')->defaultValue('https://geo-api.ru')->end()
            ->scalarNode('client_key')->isRequired()->end()
        ->end();

        return $treeBuilder;
    }
}
