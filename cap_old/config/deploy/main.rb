set :deploy_to, "/var/www/apps/eorder2"

#set :repository,  "ssh://hexaceram:23/home/pppstudio/eorder2.git"
server "eorder.hexadentallab.com",:web,:app,:db
set :port,23