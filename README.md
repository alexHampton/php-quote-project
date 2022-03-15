# php-quote-project
## API that uses GET, POST, PUT, DELETE to update database containing famous quotes

See the project here:
https://php-quote-project.herokuapp.com/api/

Sample GET requests: (append these to the end of the above url to get the data)

| Parameters | Description|
| --- | --- |
| quotes/ |  returns array of json objects containing all the quotes in the db. |
| authors/ | returns array of json objects containing all the authors in the db |
| categories/ | returns all the categories |
| quotes/?id=1 | returns the quote matching the id provided |
| authors/?id=1 | same as above, but with authors |
| categories/?id=1 | same |
| quotes/?authorId=1 | returns all quotes of the author |
| quotes/?categoryId=1 | returns all quotes of the category |
| quotes/?authorId=1&categoryId=1; | returns all quotes of the author that match the category |
