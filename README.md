# Backend Code-Challenge

This is a dummy project, which is used to demonstrate knowledge of symfony and backend development in general.
It serves as an example with some bad practices included.

## Tasks

- [ ] Clone the repository or [download the code](https://github.com/cutlery42/backend-code-review/archive/refs/heads/main.zip)
  - [ ] Handle all [open issues](https://github.com/cutlery42/backend-code-review/issues) in the project
  - [ ] Make `vendor/bin/phpstan` pass without errors
  - [ ] Make `vendor/bin/phpunit` pass without errors
  - [ ] Upload the code to your own Repository (Avoid forking the repository and creating a PR, as this would make your solution visible to others)]

## Install

We prepared a dev environment with all dependencies included.
If this does not work / you're faster with your own setup, feel free to use your own environment.

1. Install [Nix](https://nixos.org/download) if you don't have it already.
2. Use `nix-shell` to enter the development environment
    - This will install all the necessary dependencies


## Development server

1. `just install` to install all dependencies
2. Run `just start` for a dev server (or `symfony serve` if you don't use `nix-shell`)


### Improvements Required  

1. **Code Reviews added in the file:** Comments are already added for code improvements.  
2. **Folder Structure:**  
   - Restructure `src/` for better organization, separating concerns like `Controllers`, `Services`, `Repositories`, and `Entities`.  
   - Move assets (`app.js`, `bootstrap.js`) into a dedicated `public/assets` folder for clarity.  
3. **Remove Extra Imports:**  
   - Review files for unused or redundant imports and remove them to improve readability and performance.  
4. **Composer Dependencies:**  
   - Remove unused dependencies from `composer.json` to streamline the project.  
5. **Static Analysis:**  
   - Configure PHPStan at a stricter level (Level 7 or max) for improved code quality and better detection of potential issues.  
6. **Testing:**  
   - Add or improve test cases for better code coverage, especially for critical services and controllers.  
7. **Docker Improvements:**  
   - Simplify and document `compose.override.yaml` and `compose.yaml` for easier use during development.  
8. **API Documentation:**  
   - Update `openapi.yaml` to ensure accurate reflection of current endpoints and parameters.  
