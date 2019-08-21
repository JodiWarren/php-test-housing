# PHP worksim

This repo gives you a small WordPress site to get started with.

You will need [Docker desktop](https://www.docker.com/products/docker-desktop), or alternative, for running `docker` and `docker-compose` commands from the terminal.

# Setup 

Clone the repo, and cd into the worksim directory.

Then run:

```bash 
docker-compose up -d
```

Wait a minute for the containers to be started, then run:

```bash
bin/setup 
```

If you visit http://localhost, you should see the site. You can login using username & password `admin`.

Any mail sent from WordPress will go to the Mailcatcher which you can view at http://localhost:1080, and MySQL is running on localhost port 3306 (username `root`, password `foobar`).

From now on, you can start the site with `docker-compose up -d`, and stop it with `docker-compose down`. You won't need to run the setup script again.

