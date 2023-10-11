# Thai language support for barryvdh/laravel-dompdf package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/soap/dompdf-thai.svg?style=flat-square)](https://packagist.org/packages/soap/dompdf-thai)
[![Total Downloads](https://img.shields.io/packagist/dt/soap/dompdf-thai.svg?style=flat-square)](https://packagist.org/packages/soap/dompdf-thai)
![GitHub Actions](https://github.com/soap/dompdf-thai/actions/workflows/main.yml/badge.svg)

Add thai font support for barryvdh/laravel-dompdf package. Currently only THSanrabunNew is included. 

## Installation

You can install the package via composer:

```bash
composer require soap/dompdf-thai
```

Publish the assets (font files) into public/vendor/dompdf-thai
```bash
php artisan vendor:publish --tag="dompdf-thai-assets"
```

Create storage/fonts to store cache files.
```bash
mkdir storage/fonts
```

## Usage

Add @DompdfThaiFont inside head of your pdf view layout. You may put in resources/views/layouts/pdf.blade.php file. The following file was adapted from Laravel Breeze Guest layout file.

```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @DompdfThaiFont
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'THSarabunNew';
            }
        </style>
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0 dark:bg-gray-900">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
                </a>
            </div>

            <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md dark:bg-gray-800 sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
```
The following file is in resources/views/products. This file will be used by ProductController to stream pdf content.
```php
<x-pdf-layout>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    ทดสอบ This is a test for pdf
                </div>
            </div>
        </div>
    </div>
</x-pdf-layout>
```
This is part of the product controller.
```php
  namespace App\Http\Controllers;

  use App\Models\Product;
  use App\Http\Requests\StoreProductRequest;
  use App\Http\Requests\UpdateProductRequest;
  use Barryvdh\DomPDF\Facade\Pdf;

  ....
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function toPdf()
    {
        $pdf = Pdf::loadView('products.pdf'); //, ['products' => Product::all()]);

        return $pdf->stream();
    }
  ```
Please consult the [barryvdh/laravel-dompdf documentation](https://github.com/barryvdh/laravel-dompdf) for detail how to produce pdf from Laravel view.

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email prasit.gebsaap@gmail.com instead of using the issue tracker.

## Credits

-   [Prasit Gebsaap](https://github.com/soap)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
