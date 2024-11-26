# Marius API Package

A Laravel package for easy interaction with the Marius Application API.

## 📋 Table of Contents

- [Installation](#-installation)
- [Configuration](#️-configuration)
- [Usage](#-usage)
    - [Campus](#campus)
    - [Courses](#courses)
    - [Applications](#applications)
- [Testing](#-testing)
- [Error Handling](#-error-handling)
- [Contributing](#-contributing)
- [License](#-license)

## 🚀 Installation

### Requirements

- PHP 8.1 or higher
- Laravel 9.0 or higher

### Via Composer

```bash
composer require amphibee/marius-api
```

The package will be automatically discovered by Laravel. The following Facades will be registered:
- `Campus`
- `Formation`
- `Candidature`

## ⚙️ Configuration

1. Publish the configuration file:

```bash
php artisan vendor:publish --tag="marius-config"
```

2. Configure your environment variables in your `.env` file:

```env
MARIUS_API_BASE_URL=https://marius.website.com/api
MARIUS_API_KEY=your-api-key
MARIUS_API_TIMEOUT=10
```

## 📖 Usage

First, import the Facades you need:

```php
use Amphibee\MariusApi\Facades\Campus;
use Amphibee\MariusApi\Facades\Formation;
use Amphibee\MariusApi\Facades\Candidature;
use Amphibee\MariusApi\Exceptions\MariusApiException;
```

### Campus

Retrieve and manage campus information:

```php
try {
    // Get all campuses with their courses
    $campuses = Campus::getCampuses();
    
    foreach ($campuses as $campus) {
        echo $campus->campus; // Campus name
        echo $campus->id_campus; // Campus ID
        
        // Access campus courses
        foreach ($campus->formations as $formation) {
            echo $formation->nom_formation;
            echo $formation->niveau_sortie;
        }
    }
} catch (MariusApiException $e) {
    // Handle API errors
    Log::error('Marius API Error: ' . $e->getMessage());
}
```

### Courses

Manage course information by campus:

```php
try {
    // Get courses for a specific campus
    $formations = Formation::getFormationsByCampus('1');
    
    foreach ($formations as $formation) {
        echo $formation->id_formation;
        echo $formation->nom_formation;
        echo $formation->niveau_sortie;
    }
} catch (MariusApiException $e) {
    // Handle API errors
}
```

### Applications

Submit and manage student applications:

```php
use Amphibee\MariusApi\DTO\CandidatureDTO;

try {
    $application = new CandidatureDTO([
        'civilite' => 'Mr',
        'nom' => 'Doe',
        'prenom' => 'John',
        'email' => 'john@example.com',
        'portable' => '0612345678',
        'id_campus' => '1',
        'id_formation' => '30'
    ]);
    
    $response = Candidature::submit($application);
    // $response contains the API response with the application ID
    
} catch (MariusApiException $e) {
    // Handle API errors
}
```

### Example in a Controller

Here's a complete example of using the Facades in a Laravel controller:

```php
namespace App\Http\Controllers;

use Amphibee\MariusApi\DTO\CandidatureDTO;
use Amphibee\MariusApi\Exceptions\MariusApiException;
use Amphibee\MariusApi\Facades\Campus as Campus;
use Amphibee\MariusApi\Facades\Formation as Formation;
use Amphibee\MariusApi\Facades\Candidature as Candidature;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        try {
            return view('application.form', [
                'campuses' => Campus::getCampuses()
            ]);
        } catch (MariusApiException $e) {
            return back()->withError($e->getMessage());
        }
    }

    public function getFormations(string $campusId)
    {
        try {
            return response()->json([
                'formations' => Formation::getFormationsByCampus($campusId)
            ]);
        } catch (MariusApiException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    public function submit(Request $request)
    {
        try {
            $application = new CandidatureDTO($request->validated());
            $response = Candidature::submit($application);
            
            return redirect()
                ->route('application.success')
                ->with('application_id', $response['id_candidature']);
                
        } catch (MariusApiException $e) {
            return back()
                ->withInput()
                ->withError($e->getMessage());
        }
    }
}
```

## 🧪 Testing

The package includes a comprehensive test suite. When testing your own application, you can mock the Facades:

```php
use Amphibee\MariusApi\Facades\Campus;
use Amphibee\MariusApi\Facades\Formation;
use Amphibee\MariusApi\Facades\Candidature;

it('can list all campuses', function () {
    // Arrange
    Campus::shouldReceive('getCampuses')
        ->once()
        ->andReturn([
            // Your mock data here
        ]);

    // Act
    $response = $this->get('/applications/create');

    // Assert
    $response->assertOk();
});

it('can get formations for campus', function () {
    // Arrange
    Formation::shouldReceive('getFormationsByCampus')
        ->with('1')
        ->once()
        ->andReturn([
            // Your mock data here
        ]);

    // Act
    $response = $this->get('/api/campus/1/formations');

    // Assert
    $response->assertOk();
});
```

## ❌ Error Handling

All Facade methods can throw `MariusApiException`. It's recommended to wrap calls in try-catch blocks:

```php
use Amphibee\MariusApi\Exceptions\MariusApiException;

try {
    $campuses = Campus::getCampuses();
} catch (MariusApiException $e) {
    // The error contains the message and HTTP code from the API error
    Log::error('Marius API Error: ' . $e->getMessage());
    // Handle the error appropriately
}
```

## 📚 Advanced Usage

### Working with DTOs

The package uses Data Transfer Objects (DTOs) to ensure type safety and validation:

```php
use Amphibee\MariusApi\DTO\CandidatureDTO;

// Create from array
$application = new CandidatureDTO([
    'civilite' => 'Mr',
    'nom' => 'Doe',
    'prenom' => 'John',
    'email' => 'john@example.com',
    'portable' => '0612345678',
    'id_campus' => '1',
    'id_formation' => '30'
]);

// Create from request
$application = new CandidatureDTO($request->validated());

// Submit
$response = Candidature::submit($application);
```

## 🧪 Testing

The package includes a comprehensive test suite using Pest. To run the tests:

```bash
./vendor/bin/pest
```

## ❌ Error Handling

The package uses a custom `MariusApiException` for error handling. All methods can throw this exception in case of API errors.

```php
use Amphibee\MariusApi\Exceptions\MariusApiException;

try {
    $campuses = $campusService->getCampuses();
} catch (MariusApiException $e) {
    // The error contains the message and HTTP code from the API error
    echo $e->getMessage();
}
```

## 🤝 Contributing

Contributions are welcome! Feel free to:

1. Fork the project
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

Make sure to update tests as appropriate.

### Development Setup

1. Clone the repository
2. Install dependencies: `composer install`
3. Run tests: `./vendor/bin/pest`

### Coding Standards

This package follows PSR-12 coding standards. Before submitting a PR, please ensure your code follows these standards by running:

```bash
composer fix-style
```

## 📄 License

This package is licensed under the MIT License. See the [LICENSE](LICENSE.md) file for details.

## 🏢 About Amphibee

Developed and maintained by [Amphibee](https://amphibee.fr). For more information about our services or other open-source projects, please visit our website.

## 🔒 Security

If you discover any security-related issues, please email security@amphibee.fr instead of using the issue tracker.

## ⭐ Support

If you find this package helpful, please consider starring it on GitHub. For professional support or custom development needs, contact us at contact@amphibee.fr.

## 📚 Documentation

For detailed documentation of the Marius API itself, please refer to the official API documentation provided by your institution.

### Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Package Development Guide](https://laravel.com/docs/packages)
