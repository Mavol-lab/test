<?php

namespace App\Config;

use AutoMapper\AutoMapper;

/**
 * This class is a singleton that provides a single instance of an AutoMapper.
 * It ensures that only one instance of the AutoMapper is created and used throughout the application.
 */
final class AutoMapperSingleton
{
    // Holds the single instance of the AutoMapper class (null initially)
    private static ?AutoMapper $instance = null;

    /**
     * Returns the singleton instance of AutoMapper.
     * If the instance does not exist, it creates it.
     *
     * @return AutoMapper The AutoMapper instance
     */
    public static function getInstance(): AutoMapper
    {
        // Check if the instance already exists
        if (self::$instance === null) {
            // If not, create a new instance using the create() method of AutoMapper
            self::$instance = AutoMapper::create();
        }

        // Return the existing or newly created instance
        return self::$instance;
    }

    /**
     * Maps data from source to target using the AutoMapper instance.
     * 
     * @param array|object $source The source data to be mapped (can be an array or object)
     * @param string|array|object $target The target data where the mapping should be applied (can be an array or object)
     * @param array $context Additional context data to help with the mapping (optional)
     * 
     * @return array|object|null The mapped result (can be an array, object, or null)
     */
    public static function map(array|object $source, string|array|object $target, array $context = []): array | object | null
    {
        // Get the singleton instance of AutoMapper
        $mapper = self::getInstance();

        // Use the map method of the AutoMapper instance to perform the mapping
        return $mapper->map($source, $target, $context);
    }
}
