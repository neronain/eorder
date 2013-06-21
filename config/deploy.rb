=begin
ssh-keygen -t rsa -C "loopback"

=end




require 'rubygems'
require 'capistrano_colors'
require 'railsless-deploy'
require 'capistrano/ext/multistage'

set :application, "eorder2"
set :user, "pppstudio"

set :scm, :git
set :repository,  "ssh://hexaceram/home/pppstudio/eorder2.git"
#set :repository,  "/home/pppstudio/eorder_src"

# set :scm, :git # You can set :scm explicitly or Capistrano will make an intelligent guess based on known version control directory names
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `git`, `mercurial`, `perforce`, `subversion` or `none`

set :stages, ['main']
set :default_stage, 'main'
set :branch, 'master'


set :use_sudo,false
set :deploy_via, :remote_cache

set :keep_releases, 2
after "deploy:update", "deploy:cleanup" 
#set :copy_exclude, [ '.git' ]
#set :copy_exclude, [".svn", "**/.svn"]


default_run_options[:pty] = true

#ssh_options[:forward_agent] = true

#role :db,  "your slave db-server here"

# if you want to clean up old releases on each deploy uncomment this:
# after "deploy:restart", "deploy:cleanup"

# if you're still using the script/reaper helper you will need
# these http://github.com/rails/irs_process_scripts

# If you are using Passenger mod_rails uncomment this:
# namespace :deploy do
#   task :start do ; end
#   task :stop do ; end
#   task :restart, :roles => :app, :except => { :no_release => true } do
#     run "#{try_sudo} touch #{File.join(current_path,'tmp','restart.txt')}"
#   end
# end








