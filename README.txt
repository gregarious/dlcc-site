Left to do:

- Ask Steve to:
	1. Make the `data-admin\protected\runtime\` folder writable by the web server
	2. Install MySQL PDO driver
	3. Restart the server
- Test on test site (/muffintest/)
- Create master credential file with DB and admin names. Ensure this doesn't get served.
- Connect DB/admin to credential file
- Other misc. "TODO-greg" tags

Some notes to leave Hilary/Steve/whoever with regarding future maintenance:

1. Credentials for administrator access to the database admin page is hard-coded into a file: `www/data-admin/protected/components/UserIdentity.php`

2. The database configuration is also hard-coded in a file: `www/data-admin/protected/config/main.php`

3. `www/events.php` and `www/map.php` only need read access to the DB. A special read-only username/password is used for these pages, hard-coded into their respective PDO connection functions.
