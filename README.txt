Left to do:

x. Import dump `data/dlcc_data_2013-11-25.sql` into DLCC's database (blocking on invalid phpmyadmin credentials)
x. Fix all DB connection info (search for "TODO-greg" tags)
3. Fix admin username/password in UserIdentity.php
4. Other misc. "TODO-greg" tags
5. Compile all credentials into master PHP file? Then the following notes are unnecessary.

Some notes to leave Hilary/Steve/whoever with regarding future maintenance:

1. Credentials for administrator access to the database admin page is hard-coded into a file: `www/data-admin/protected/components/UserIdentity.php`

2. The database configuration is also hard-coded in a file: `www/data-admin/protected/config/main.php`

3. `www/events.php` and `www/map.php` only need read access to the DB. A special read-only username/password is used for these pages, hard-coded into their respective PDO connection functions.
