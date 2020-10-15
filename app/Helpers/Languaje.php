<?php

if (! function_exists('getLang')) {
    /**
     * Get Language in short or long mode
     *
     * @param bool $short
     * @return string
     */
    function getLang(bool $short = true): string
    {
        if (! $short) {
            return config('app_invoice.available_languages')[app()->getLocale()];
        }

        return app()->getLocale();
    }
}

if (! function_exists('getLangLocale')) {
    /**
     * Get Language Locale
     *
     * @return string|string[]
     */
    function getLangLocale()
    {
        return str_replace('_', '-', getLang());
    }
}
