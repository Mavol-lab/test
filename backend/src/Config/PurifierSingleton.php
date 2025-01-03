<?php

namespace App\Config;

use HTMLPurifier;
use HTMLPurifier_Config;

/**
 * This class implements the Singleton design pattern for a purifier instance.
 * It ensures that only one instance of the purifier exists throughout the application.
 */
final class PurifierSingleton
{
    // Holds the single instance of the HTMLPurifier class (null initially)
    private static ?HTMLPurifier $instance = null;

    /**
     * Returns the singleton instance of HTMLPurifier.
     * If the instance does not exist, it creates it.
     *
     * @return HTMLPurifier The HTMLPurifier instance
     */
    public static function getInstance(): HTMLPurifier
    {
        if (self::$instance === null) {
            $config = HTMLPurifier_Config::createDefault();

            self::$instance = new HTMLPurifier($config);
        }

        return self::$instance;
    }

    /**
     * Filters an HTML snippet/document to be XSS-free and standards-compliant.
     *
     * @param string $html String of HTML to purify
     * @return string Purified HTML
     */
    public static function purify(string $html): string
    {
        return self::getInstance()->purify($html);
    }
}
