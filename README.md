# AP template: Single Page Application

Simple SPA that uses:

- `.htaccess` file
- jQuery ajax requests
- js `history` api
- handlebars.js templates

How it works:

- `.htaccess` transfers `/whatever/blah` to `index.php` as `?uid=/whatever/blah`
- `index.php` passes the uid to javascript initializing the `App` object
- js function `loadPage`:
	- maps the uid to an ajax call according to `apiBindings.json`
	- maps response to context data for handlebar template based on response type in `apiBindings.json`
	- renders the markup using the template (also in `apiBindings.json`) and loads it in `#content`
	- pushes a new state using the history api