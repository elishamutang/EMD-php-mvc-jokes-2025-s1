/**
 * Vite Configuration File
 *
 * Filename:        vite.config.js
 * Location:        /
 * Project:         EMD-php-mvc-jokes-2025-s1
 * Date Created:    03/04/2025
 *
 * Author:          Elisha Mutang Daneil <20145565@tafe.wa.edu.au>
 */

import {defineConfig} from 'vite'
import tailwindcss from '@tailwindcss/vite'
import usePHP from 'vite-plugin-php'
import liveReload from 'vite-plugin-live-reload'

export default defineConfig({
    plugins: [
        tailwindcss(),
        usePHP({
            entry: [
                'index.php',
                'template.php',
                'public/index.{html,php,js}',
                'App/views/**/*.{html,php,js}'
            ],
        }),
        liveReload([
                'index.php',
                'template.php',
                'public/index.{html,php,js}',
                'App/views/**/*.{html,php,js}'
            ],
            {
                alwaysReload: true
            }
        ),
    ]
}) ;
