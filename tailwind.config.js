import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',

        //Recursos para o Flowbite-vue
        'node_modules/flowbite-vue/**/*.{js,jsx,ts,tsx}',
        'node_modules/flowbite/**/*.{js,jsx,ts,tsx}'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [
        forms, 
        typography,
        require("daisyui"),
        require('flowbite/plugin'), // Invoca o Flowbite-vue
    ],

    // daisyUI config (optional)
    daisyui: {
        themes: ["emerald", "dark"],
        /* themes: [
            {
                mytheme: {
                    primary: "#b0b3f2",
                    "primary-content": "#292524",
                    secondary: "#f6d860",
                    accent: "#f87171",
                    neutral: "#3d4451",
                    "neutral-content": "#f9fafb",
                    "base-100": "#ffffff",
                    "base-200": "#e6e6e6",
                    "base-300": "#cfcfcf",
                    "base-content": "#333c4d",

                    "--rounded-box": "1rem", // border radius rounded-box utility class, used in card and other large boxes
                    "--rounded-btn": "0.3rem", // border radius rounded-btn utility class, used in buttons and similar element
                    "--rounded-badge": "1.9rem", // border radius rounded-badge utility class, used in badges and similar
                    "--animation-btn": "0.25s", // duration of animation when you click on button
                    "--animation-input": "0.2s", // duration of animation for inputs like checkbox, toggle, radio, etc
                    "--btn-text-case": "uppercase", // set default text transform for buttons
                    "--btn-focus-scale": "0.95", // scale transform of button when you focus on it
                    "--border-btn": "0px", // border width of buttons
                    "--tab-border": "2px", // border width of tabs
                    "--tab-radius": "1.5rem", // border radius of tabs
                    "--table-border": "1.5rem", // border radius of tabs
                    "--rounded-input": "1.9rem"
                },
            },
            "dark",
            "cupcake",
        ],  */
    },
};
