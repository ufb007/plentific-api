# Plentific API request test

### Install composer package
```bash
composer require ubozdemir/plentific
```

### Import UserRepository/UserService classes
```bash
use Ubozdemir\Plentific\Repositories\UserRepository;
use Ubozdemir\Plentific\Services\UserService;
```

### Instantiate UserService & UserRepository
```bash
$userService = new UserService(new UserRepository());
```

### Make request to get paginated users 6 at a time
```bash
$users = $userService->all(1);
```

## Get user by their ID
```bash
$user = $userService->getById(5);
```

### Create new user

POST with request 'name' => 'Some name' and 'job' => 'Job Title'

```bash
try {
    $createdUser = $userService->create($_POST);

    //$createdUser returns new ID
} catch (Exception $e) {
    die($e->getMessage());
}
```

### Run tests
```bash
composer test
```
