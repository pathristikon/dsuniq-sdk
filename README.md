## SDK DsUniq

#### Installation
`composer require pathristikon/dsuniq-sdk`

#### Usage
1. initialize an object `Dsuniq\DsuniqSdk\Config` with parameter string apiToken
2. initialize an object `Dsuniq\DsuniqSdk\ApiHandler` which will handle all your requests
3. use `apihandler->getProducts()` to fetch the first page of your products
4. if you already fetched the products, use `apihandler->getTotalPages` to get all the pages you can iterate
5. if you have more than one page, use `apihandler->getProducts(2)` to get the page number 2
6. if you want to see the mapped categories, use `apihandler->getCategories()`

#### Disclaimer
For internal use only!