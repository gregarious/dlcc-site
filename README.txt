Left to do:

- Test on test site (/muffintest/)
- Ask Steve to:
	1. Make the `_private` folder private
- Other misc. "TODO-greg" tags

Some notes to leave Hilary/Steve/whoever with regarding future maintenance:

1. No web-based CRUD access. Just use a bare MySQL client.

2. The database configuration hard-coded in a file: `www/_private/db.php`

3. `www/events.php` and `www/map.php` only need read access to the DB. A special read-only username/password is used for these pages, hard-coded into their respective PDO connection functions.
