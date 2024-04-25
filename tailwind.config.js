import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import colors from "tailwindcss/colors";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    darkMode: "class",

    theme: {
        extend: {
            fontFamily: {
                Poppins: ["Poppins", ...defaultTheme.fontFamily.sans],
                Montserrat: ["Montserrat", ...defaultTheme.fontFamily.sans],
                Inter: ["Inter", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                darkGreen: "#0C3B2E",
                darkBlue: "#222831",
                darkLightGrey: "#393E46",
                alum: "#A6A6A6",
            },
        },
    },

    plugins: [forms],
};
