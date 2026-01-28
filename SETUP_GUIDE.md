# Project Setup & Run Guide

To ensure consistent results across all devices and environments, please follow these steps exactly.

## Prerequisites

-   **PHP**: 8.2 or higher
-   **Node.js**: 20.x or higher
-   **Composer**: v2.x

## Initial Setup (Run Once)

1.  **Install PHP Dependencies**:
    ```bash
    composer install
    ```

2.  **Install Node.js Dependencies**:
    ```bash
    npm install
    ```

3.  **Environment Setup**:
    -   Copy `.env.example` to `.env` if you haven't already.
    -   Generate application key:
        ```bash
        php artisan key:generate
        ```

## Running the Project (Development)

To run the project with live asset compilation (Vite) and the server, you must run TWO commands in separate terminals.

**Terminal 1 (Vite Asset Server):**
This compiles Tailwind CSS and JS in real-time.
```bash
npm run dev
```

**Terminal 2 (Laravel Server):**
This runs the PHP application.
```bash
php artisan serve
```

Access the site at: `http://127.0.0.1:8000`

## Assets Breakdown

-   **Tailwind CSS**: Compiled via Vite (`resources/css/app.css` -> `public/build/...`). Defined in `tailwind.config.js` (or inline in v4).
-   **Bootstrap 5**: Loaded via CDN in `resources/views/layouts/master.blade.php` to ensure zero conflicts with the build process.
-   **Fonts**: Loaded via Google Fonts CDN in `resources/views/layouts/master.blade.php`.

## Troubleshooting

-   **Design looks broken?**
    -   Ensure `npm run dev` is running.
    -   Try a hard refresh (Ctrl+F5) to clear cache.
    -   Check if the layout file includes `@vite(['resources/css/app.css', 'resources/js/app.js'])`.

-   **Vite connection error?**
    -   Ensure nothing else is using port 5173.
    -   If running on a network, use `npm run dev -- --host` to expose it.
