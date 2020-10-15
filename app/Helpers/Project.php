<?php

if (! function_exists('getProjectName')) {
    /**
     * Get Project Name
     *
     * @return string
     */
    function getProjectName(): string
    {
        return config('app.name');
    }
}

if (! function_exists('getShortProjectName')) {
    /**
     * Get Short Project Name
     *
     * @return string
     */
    function getShortProjectName(): string
    {
        return config('short_name', config('app.name'));
    }
}

if (! function_exists('getSiteUrl')) {
    /**
     * Get Site Url
     *
     * @return string
     */
    function getSiteUrl(): string
    {
        return config('app.url');
    }
}

if (! function_exists('getAdminUrl')) {
    /**
     * Get Site Url
     *
     * @return string
     */
    function getAdminUrl(): string
    {
        return route('admin.dashboard');
    }
}

if (! function_exists('getTitle')) {
    /**
     * Get Title
     *
     * @param string $title
     * @return string
     */
    function getTitle(string $title = ''): string
    {
        if ($title === '') {
            return getSiteTitle();
        }
        
        return $title;
    }
}

if (! function_exists('getSiteTitle')) {
    /**
     * Get Site Title
     *
     * @return string
     */
    function getSiteTitle(): string
    {
        return config('app_voluntarios.meta_title');
    }
}

if (! function_exists('getSiteDescription')) {
    /**
     * Get Site Description Site
     *
     * @return string
     */
    function getSiteDescription(): string
    {
        return config('app_voluntarios.meta_description');
    }
}

if (! function_exists('getSiteKeywords')) {
    /**
     * Get Site Keywords
     *
     * @return string
     */
    function getSiteKeywords(): string
    {
        return config('app_voluntarios.settings.meta_keywords');
    }
}

if (! function_exists('getSiteAuthor')) {
    /**
     * Get Site Keywords
     *
     * @return string
     */
    function getSiteAuthor(): string
    {
        return config('app_voluntarios.settings.meta_author');
    }
}

if (! function_exists('getSiteRobots')) {
    /**
     * Get Site Keywords
     *
     * @return string
     */
    function getSiteRobots(): string
    {
        return config('app_voluntarios.settings.meta_robots');
    }
}

if (! function_exists('getLogo')) {
    /**
     * Get Logo
     *
     * @return string
     */
    function getLogo(): string
    {
        $logo = config('app_voluntarios.settings.company_icon');

        if (! File::exists($logo)) {
            return '';
        }

        return asset($logo);
    }
}

if (! function_exists('app_voluntarios.settings.getSiteVersion')) {
    /**
     * Get Site Version
     *
     * @return string
     */
    function getSiteVersion(): string
    {
        return '<b>Versión</b> ' . config('app_voluntarios.settings.version');
    }
}

if (! function_exists('getUsername')) {
    /**
     * Get Username from logged in user
     *
     * @return string
     */
    function getUsername(): string
    {
        return auth()->user()->name;
    }
}

if (! function_exists('getGender')) {
    /**
     * Get Gender
     *
     * @param string $gender
     * @param bool $shorthand
     * @return string
     */
    function getGender(string $gender = '1', bool $shorthand = true): string
    {
        if ($gender === '' || $gender === '0' || $gender === 0 || $gender === 'M') {
            $gender = '1';
        } else {
            $gender = '0';
        }

        if (! $shorthand) {
            return ($gender === '1') ? 'Masculino' : 'Femenino';
        }

        return ($gender === '1') ? 'M' : 'F';
    }
}

if (! function_exists('profile_image')) {
    /**
     * Profile Image
     *
     * @param string $image
     * @return string
     */
    function profile_image($image = ''): string
    {
        $profile_img            = '';
        $default_profile_img    = config('app_buro.profile.default_user');

        if ($image === '') {
            $profile_img = (auth()->user()->image !== '') ? auth()->user()->image : $default_profile_img;
        }

        if (File::exists($image)) {
            return asset($image);
        }

        return asset($profile_img);
    }
}

if (! function_exists('copyright')) {
    /**
     * Profile Image
     *
     * @return string
     */
    function copyright(): string
    {
        return 'Copyright @ ' . getProjectName() . '  - ' . now()->format('Y');
    }
}
