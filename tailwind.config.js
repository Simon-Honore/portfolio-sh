/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
        "./vendor/tales-from-a-dev/flowbite-bundle/templates/**/*.html.twig",
    ],
    theme: {
        colors: {
            primary: 'hsl(var(--primary) / <alpha-value>)',
            'primary-foreground': 'hsl(var(--primary-foreground) / <alpha-value>)',
            background: 'hsl(var(--background) / <alpha-value>)',
            foreground: 'hsl(var(--foreground) / <alpha-value>)',
            card: 'hsl(var(--card) / <alpha-value>)',
            'card-foreground': 'hsl(var(--card-foreground) / <alpha-value>)',
            border: 'hsl(var(--border) / <alpha-value>)',
            accent: 'hsl(var(--accent) / <alpha-value>)',
            ring: 'hsl(var(--ring) / <alpha-value>)',
        },
        extend: {},
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
