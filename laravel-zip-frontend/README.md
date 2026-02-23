# Laravel ZIP API Frontend

A modern Laravel frontend application for managing Hungarian cities and counties. This application communicates with the Laravel ZIP API backend to provide a user-friendly interface for CRUD operations.

## Features

- **Dashboard**: Overview of the application with quick navigation
- **Cities Management**: 
  - View all cities
  - Create new cities
  - Edit existing cities
  - Delete cities
  - View detailed city information
  - Bulk operations support

- **Counties Management**:
  - View all counties
  - Create new counties
  - Edit existing counties
  - Delete counties
  - View detailed county information

## Requirements

- PHP 8.1 or higher
- Composer
- Node.js & npm (for frontend assets)
- Laravel 11.x

## Installation

### 1. Clone or Download the Project

```bash
cd laravel-zip-frontend
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

Copy the example environment file and configure it:

```bash
cp .env.example .env
```

The frontend is configured to run on `http://localhost:8001` and communicate with the API backend running on `http://localhost:8000/api`.

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Database Migrations (Optional)

If you need to set up the local database (for session storage):

```bash
php artisan migrate
```

## Usage

### Starting the Development Server

**Terminal 1 - Start the Laravel Application Server:**

```bash
php artisan serve --port=8001
```

The application will be available at `http://localhost:8001`

**Terminal 2 - Start the Vite Dev Server (Optional, for frontend assets):**

```bash
npm run dev
```

## API Integration

This frontend communicates with the Laravel ZIP API backend through HTTP requests. The API base URL is configured in the controllers at:

```php
private $apiUrl = 'http://localhost:8000/api';
```

### Available API Endpoints

**Cities:**
- `GET /api/cities` - List all cities
- `GET /api/cities/{id}` - Get a specific city
- `POST /api/cities` - Create a new city
- `PUT /api/cities/{id}` - Update a city
- `DELETE /api/cities/{id}` - Delete a city

**Counties:**
- `GET /api/counties` - List all counties
- `GET /api/counties/{id}` - Get a specific county
- `POST /api/counties` - Create a new county
- `PUT /api/counties/{id}` - Update a county
- `DELETE /api/counties/{id}` - Delete a county

## Project Structure

```
laravel-zip-frontend/
 app/
    Http/
        Controllers/
            CityController.php          # Handles city operations
            CountyController.php        # Handles county operations
 resources/
    views/
        layouts/
           app.blade.php              # Base layout template
        dashboard.blade.php            # Home page
        cities/
           index.blade.php            # List cities
           create.blade.php           # Create city form
           edit.blade.php             # Edit city form
           show.blade.php             # View city details
        counties/
            index.blade.php            # List counties
            create.blade.php           # Create county form
            edit.blade.php             # Edit county form
            show.blade.php             # View county details
 routes/
     web.php                             # Web routes for the frontend
```

## Technologies Used

- **Laravel 11**: PHP web application framework
- **Blade**: Laravel templating engine
- **Bootstrap 5**: Frontend CSS framework
- **HTTP Client**: Laravel's HTTP client for API communication
- **Vite**: Frontend build tool

## Styling

The application uses Bootstrap 5 via CDN for responsive and modern UI components. Custom styling is added in the base layout for enhanced visual appearance.

## Error Handling

- The application displays user-friendly error messages for failed API requests
- Validation errors are displayed on forms with Bootstrap styling
- Session flash messages provide feedback for successful operations

## Configuration Options

### API URL
To change the API URL, update the `$apiUrl` property in both controllers:

**CityController.php:**
```php
private $apiUrl = 'http://your-api-url/api';
```

**CountyController.php:**
```php
private $apiUrl = 'http://your-api-url/api';
```

### Port Configuration
To run on a different port, use:

```bash
php artisan serve --port=YOUR_PORT
```

### Environment Variables
Key environment variables in `.env`:
- `APP_NAME`: Application name
- `APP_URL`: The URL where this frontend is hosted
- `DB_*`: Database connection settings (if using database sessions)

## Troubleshooting

### 1. "Connection refused" error
- Ensure the backend API is running on `http://localhost:8000`
- Check that the API URL in the controllers matches your backend URL

### 2. "Failed to fetch" errors
- Verify the backend API is accessible
- Check CORS settings if the frontend and backend are on different domains
- Verify API endpoint availability

### 3. Session or database issues
- Run migrations: `php artisan migrate`
- Clear cache: `php artisan cache:clear`

## Development

To build frontend assets for production:

```bash
npm run build
```

## License

This project is open-source and available under the MIT License.

## Support

For issues or questions about the API backend, refer to the `laravel-zip-api` project documentation.

---

**Built with Laravel 11 and Bootstrap 5**
