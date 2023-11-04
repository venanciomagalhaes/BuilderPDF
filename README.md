# BuilderPDF

BuilderPDF is a useful tool for easily creating and manipulating PDF files using the Dompdf library in PHP.

With this class, you can generate PDF files from HTML content, set paper size and orientation, as well as save, delete, or download the generated PDFs.

## Requirements

To use this package, you need:

- PHP 8.1 or higher.
- The dompdf/dompdf library.

## Installation

You can install the library using Composer with the following command:

```bash
composer require venancio/builderpdf
```

## Usage Example

Here's a basic example of how to use the `BuilderPdf` class:

```php
<?php

use Venancio\Builderpdf\BuilderPdf;

// Saving a PDF file
$pathSavePdf = (new BuilderPdf())
      ->setPaper('A3', 'landscape')
      ->setHTML(file_get_contents(__DIR__ . "/template.php"))
      ->setPathToSaveFile(__DIR__ . "/pdf", "my-test.pdf")
      ->save();

// Deleting a PDF file
BuilderPdf::destroy($pathSavePdf);

// Downloading a PDF file in the browser
(new BuilderPdf())
    ->setPaper()
    ->setHTML(file_get_contents(__DIR__ . "/template.php"))
    ->setPathToSaveFile(__DIR__ . "/pdf", "my-test.pdf")
    ->download();
```

This is just a simple example. You can customize the `BuilderPdf` class to suit your needs.

## Contribution

Feel free to contribute, report issues, or suggest improvements for this class. If you encounter any problems or have any suggestions, please open an issue on the repository.

## License

This project is licensed under the MIT license. See the [LICENSE](https://github.com/venanciomagalhaes/BuilderPDF/blob/main/LICENSE) file for details.

## Authors

Developed with passion by [Venâncio Magalhães](https://www.linkedin.com/in/deividsonvm/).

Questions or Suggestions? Contact us.
