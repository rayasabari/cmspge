<?php
return array(
    // Product
    'product' => array(
        'name'        => 'Metronic',
        'description' => 'Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme',
        'preview'     => 'https://preview.keenthemes.com/metronic8/laravel',
        'home'        => 'https://keenthemes.com/metronic',
        'purchase'    => 'https://1.envato.market/EA4JP',
        'licenses'    => array(
            'terms' => 'https://themeforest.net/licenses/standard',
            'types' => array(
                array(
                    'title'       => 'Regular License',
                    'description' => 'For single end product used by you or one client',
                    'tooltip'     => 'Use, by you or one client in a single end product which end users are not charged for',
                    'price'       => '39',
                ),
                array(
                    'title'       => 'Extended License',
                    'description' => 'For single SaaS app with paying users',
                    'tooltip'     => 'Use, by you or one client, in a single end product which end users can be charged for.',
                    'price'       => '939',
                ),
            ),
        ),
        'demos'       => array(
            'demo1' => array(
                'title'       => 'Demo 1',
                'description' => 'Default Dashboard',
                'published'   => true,
                'thumbnail'   => 'demos/demo1.png',
            ),

            'demo2' => array(
                'title'       => 'Demo 2',
                'description' => 'SaaS Application',
                'published'   => true,
                'thumbnail'   => 'demos/demo2.png',
            ),
        ),
    ),

    // Meta
    'meta'    => array(
        'title'       => 'Ryapi',
        'description' => 'Headles CMS by RYSB.',
        'keywords'    => 'RYSB, Raya Sabari, Rayasabari', 'ryapi',
        'canonical'   => 'https://rayasabari.com',
    ),

    // General
    'general' => array(
        'website'             => 'https://keenthemes.com',
        'about'               => 'https://keenthemes.com',
        'contact'             => 'mailto:support@keenthemes.com',
        'support'             => 'https://keenthemes.com/support',
        'bootstrap-docs-link' => 'https://getbootstrap.com/docs/5.0',
        'licenses'            => 'https://keenthemes.com/licensing',
        'social-accounts'     => array(
            array(
                'name' => 'Youtube', 'url' => 'https://www.youtube.com/c/KeenThemesTuts/videos', 'logo' => 'svg/social-logos/youtube.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Github', 'url' => 'https://github.com/KeenthemesHub', 'logo' => 'svg/social-logos/github.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Twitter', 'url' => 'https://twitter.com/keenthemes', 'logo' => 'svg/social-logos/twitter.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Instagram', 'url' => 'https://www.instagram.com/keenthemes', 'logo' => 'svg/social-logos/instagram.svg', "class" => "h-20px",
            ),

            array(
                'name' => 'Facebook', 'url' => 'https://www.facebook.com/keenthemes', 'logo' => 'svg/social-logos/facebook.svg', "class" => "h-20px",
            ),
            array(
                'name' => 'Dribbble', 'url' => 'https://dribbble.com/keenthemes', 'logo' => 'svg/social-logos/dribbble.svg', "class" => "h-20px",
            ),
        ),
    ),

    // Layout
    'layout'  => array(
        // Docs
        'docs'          => array(
            'logo-path'  => array(
                'default' => 'logos/logo-1.svg',
                'dark'    => 'logos/logo-1-dark.svg',
            ),
            'logo-class' => 'h-25px',
        ),

        // Illustration
        'illustrations' => array(
            'set' => 'sketchy-1',
        ),

        // Engage
        'engage'        => array(
            'demos'    => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'explore'  => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'help'     => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'purchase' => array(
                'enabled' => false,
            ),
        ),
    ),

);
