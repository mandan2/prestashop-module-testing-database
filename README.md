# PrestaShop Module Testing Database

## Overview

The **PrestaShop Module Testing Database** package aims to enable automated integration tests on a separate testing database. This allows data to be manipulated and truncated freely without affecting the original database, which can be preserved for manual testing. While this functionality is common in popular frameworks like Symfony or Laravel, it is now available for PrestaShop modules.

## Goal

The primary goal of this package is to:
- Enable automated integration tests on a separate testing database.
- Ensure the original database remains intact for manual testing.

## How to Use

### Installation

Firstly, install this composer package in your target module:

```bash
composer require mandan2/prestashop-module-testing-database
```

### Creating a Clone Database

To create a clone database, run the following command in your terminal from module's main dir:

```bash
php vendor/prestashop-module-testing-database/CreateTestDatabase.php
```

### Using the Clone Database

To switch to the clone database, use the following command from module's main dir:

```bash
php vendor/prestashop-module-testing-database/UseTestDatabase.php
```

### Using the Original Database

To revert to the original database, use the following command from module's main dir:

```bash
php vendor/prestashop-module-testing-database/UseOriginalDatabase.php
```

### Integration

These commands can be integrated into your workflow when launching tests. This enables seamless switching between the test and original databases, ensuring an efficient and isolated testing environment.

## Requirements

- PHP 7.1+
- PrestaShop 1.7.1+ (not tested)
- File editing permissions for app/config/parameters.php
- Folder editing permissions for the entire package

## Compatibility

Tested on: PrestaShop 8.1 within a Docker image

## License

This package is open-source and licensed under the MIT License.

## Contributing

Contributions are welcome! Please open an issue or submit a pull request on GitHub.

## Support

If you encounter any issues or have questions, please open an issue on the GitHub repository.