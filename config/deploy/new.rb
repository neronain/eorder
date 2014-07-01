set :deploy_to, "/var/www/apps/eorder2"

set :repository,  "ssh://hexaceram/home/pppstudio/eorder2.git"
server "hexaceram",:web,:app,:db
set :port,22