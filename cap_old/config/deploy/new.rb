set :deploy_to, "/var/www/apps/eorder2"

#set :repository,  "ssh://hexaceram/home/pppstudio/eorder2.git"
server "110.164.212.183",:web,:app,:db
set :port,22