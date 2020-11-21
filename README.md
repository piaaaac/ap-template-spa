# AP template: Single Page Application

Main features:

- .htaccess transfers `/whatever/blah` to `index.php` as `?uid=/whatever/blah`
- `index.php` passes the uid to javascript initializing the `App` object
- js function `loadPage`:
	- maps the uid to an ajax call according to `apiBindings.json`
	- maps response to context data for handlebar template
	- renders the markup using the template and loads it in `#content`