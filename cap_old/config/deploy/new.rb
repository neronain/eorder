set :deploy_to, "/var/www/html/apps/eorder2"

#set :repository,  "ssh://hexaceram/home/pppstudio/eorder2.git"
server "eorder.hexadentallab.com",:web,:app,:db
set :port,22