# Harbour -  docker swarm set up for local and remote hosting using nginx and certbot

Set up:

# Local
create local ssl cert
edit harbour file
    add yor sites
    add the ssl certs
edit hosts file
docker swarm init
docker stack deploy -c ...

# Remote
set up server
set domains to point to server ip
docker swarm init
docker stack deploy -c ...