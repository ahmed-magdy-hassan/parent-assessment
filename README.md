### Requirements:

    - PHP >= 7.4
    - Composer

### Optional Requirements

    - Docker

### Docker Installation

    - `cd docker`
    - `docker-compose up -d --build`

### Without Docker Installation

    - run `composer install`

### Visit site with Docker

    See [Live Demo](http://localhost:81/api/user)

### How the project is structured?

    - We made service that will handle all the core functionality for the data providors
    - To add a new provider you should create new class for it, also this class should ```extends DataProvider implements ContractsDataProvider```
    - this class will have 4 main methods
        * [configKey] method
        * [getFilePath] method
        * [getSchema] method
        * [getAvailableStatusCodes] method
    - visit `/api/users/ to filter the result
    - allowed filters in the query string are (all are case insensitive):
        - provider
            ```sh
                http://localhost:81/api/users?provider=DataProviderX
            ```
        - currency
            ```sh
                http://localhost:81/api/users?currency=USD
            ```
        - balanceMin
            ```sh
                http://localhost:81/api/users?balanceMin=300
            ```
        - balanceMax
            ```sh
                http://localhost:81/api/users?balanceMax=300
            ```
        - status
            * [available status] ('authorized', 'declined', 'refunded')
            ```sh
                http://localhost:81/api/users?status=declined
            ```
    - all filters together
    example: `http://you-server.test/api/users?provider=DataProviderX&status=declined&balanceMin=200`
