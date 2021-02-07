### Requirements:

    - PHP >= 7.4
    - Composer

### Optional Requirements

    - Docker

### Docker Installation

    - cd docker
    - docker-compose up -d --build

### Without Docker Installation

    - composer install

### Visit site with Docker

[Live Demo](http://localhost:81/api/users/)

### How the project is structured?

1. We made service that will handle all the core functionality for the data providors
2. To add a new provider you should create new class for it, also this class should
    > extends DataProvider implements ContractsDataProvider
3. this class will have 4 main methods
    - [configKey] method
    - [getFilePath] method
    - [getSchema] method
    - [getAvailableStatusCodes] method
4. visit `/api/users/ to filter the result
   allowed filters in the query string are (all are case insensitive):
    - provider
      [demo](http://localhost:81/api/users?provider=DataProviderX)
    - currency
      [demo](http://localhost:81/api/users?currency=USD)
    - balanceMin
      [demo](http://localhost:81/api/users?balanceMin=300)
    - balanceMax
      [demo](http://localhost:81/api/users?balanceMax=300)
    - status
      [demo](http://localhost:81/api/users?status=declined)
5. all filters together
    - [demo](http://you-server.test/api/users?provider=DataProviderX&status=declined&balanceMin=200)
