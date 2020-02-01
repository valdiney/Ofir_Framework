## The environment development in Ofir

In `Ofir` we has using a file called `.env` to provide a powerful experience in development. This file enables that the developer run the same project in several servers.

For example, in a common case you have two environments:

- A local, where you create and edit everything.
- A production, where the others peoples access the site, service...

**In `Ofir` you can do it easily!**

All that you need to do is copy all files to each servers, then create a file called `.env` in each of ones. We have been facilited it for you! :wink: All that you need to do is copy the `.env.sample` (this file is on root folder) file to `.env` (it's easy!).

### the file

Actualy the file look like:

```
APP_ENV=local
TIMEZONE=America/Sao_Paulo

DB_CONNECTION=mysql
HOST_NAME=localhost
HOST_USERNAME=root
HOST_PASSWORD=admin
HOST_DBNAME=ofir
```

#### Explaining the lines:

- APP_ENV: This says to Ofir about the actual enviroment. If the server is a local server, or a production etc.
- TIMEZONE: Says to Ofir what is the timezone to uses.
- HOST_*: These lines says to Ofir about the database configurations.
  - NAME:     The name of your HOST (e.g.: localhost, 123.53.63.11).
  - USERNAME: The user of your host.
  - PASSWORD: The password, obviously.
  - DBNAME:   For last, the name of your DB.

For now, these lines provides to `Ofir` all necessaries configs.\
If after others will be requireds, then we put it in another versions.

---

#### vlucas/phpdotenv

`Ofir` is using the project: vlucas/phpdotenv. You can see more about [here](https://github.com/vlucas/phpdotenv). Our thanks for this package! This package is helping us to easily manipulate the `.env` file.
