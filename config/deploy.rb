# Deploy simple PHP-site using Capistrano
# Complete working example for a very simple PHP-site.
#
# Usage:
# cap deploy:setup
# cap deploy
#
# See end for links

# application name
set :application, "guillotinet"
# user used to store the project in the server
set :home_folder, "/var/www/guilloti.net/"
# where is it version controlled?
set :repository, "REPO_URL"
 
# Using subversion? Try something like this
#set :repository, "http://svn.myhost.com/#{application}/trunk"
 
set :scm, :subversion
set :scm_checkout, "export"
set :scm_username, "SVN_USER"
set :scm_password, "SVN_PASS" # Useful for some setups, but look at http://help.github.com/msysgit-key-setup/
 
# some like to utilize a cache to speed up checkout/clone
#set :deploy_via, :remote_cache
 
# If you're stuck with an old version of git on the server you might need this
# set :scm_verbose, true
 
#set :ssh_options, {:forward_agent => true} # enable private keys with git
 
 
# show password requests on windows (http://weblog.jamisbuck.org/2007/10/14/capistrano-2-1)
default_run_options[:pty] = true
 
# Select git branch
#set :branch, "master"
 
# where to deploy your uploaded application
set :deploy_to, "DEPLOY_PATH"
 
role :app, "SERVER_URL" # or an IP-address, or your hosts servername
role :web, "SERVER_URL"
role :db, "SERVER_URL", :primary => true
 
# SSH login credentials (or better yet; use passwordless authentication)
set :user, "ROOT_USER"
set :password, "ROOT_PASS"
 
set :use_sudo, true # in case you do not have root access


# We need to over write a lot of the core functionality here
# since we don't need migrations, lots of the symlink stuff
# and server restarting.

# This is strictly for PHP deploys
namespace :deploy do
 
    task :update do
      transaction do
        maintenance
        update_code
        symlink
      end
    end
 
    task :maintenance do
      transaction do
        run "ln -nfs /home/#{home_folder}/common/maintenance #{deploy_to}/#{current_dir}"
      end
    end
 
    task :finalize_update do
      transaction do
        run "chmod -R g+w #{releases_path}/#{release_name}"
      end
    end
 
    task :symlink do
      transaction do
        run "ln -nfs #{current_release} #{deploy_to}/#{current_dir}"
        run "ln -nfs #{shared_path}/logs #{deploy_to}/#{current_dir}/logs"
        run "ln -nfs #{shared_path}/cache #{deploy_to}/#{current_dir}/cache"
        
        # run "chown -R www-data\: #{deploy_to}/#{current_dir}"
      end
    end
    
    task :setup do
      transaction do
        run "mkdir #{deploy_to}"
        run "mkdir #{deploy_to}/releases"
        run "mkdir #{deploy_to}/shared"
        run "mkdir #{deploy_to}/shared/logs"
        run "mkdir #{deploy_to}/shared/cache"
        
        # Set write permissions to log and cache
        run "chmod -R 777 #{deploy_to}/shared/logs"
        run "chmod -R 777 #{deploy_to}/shared/cache"
      end
    end
 
    task :migrate do
      # nothing
    end
 
    task :restart do
      # nothing
    end
 
  end
 
# Inspirational URLs:
# http://weblog.jamisbuck.org/search?q=capistrano
# http://www.claytonlz.com/index.php/2008/08/php-deployment-with-capistrano/
# http://paulschreiber.com/blog/2009/03/15/howto-deploy-php-sites-with-capistrano-2/
# http://wiki.dreamhost.com/index.php/Capistrano
# http://www.capify.org/index.php/Getting_Started
# http://www.jonmaddox.com/2006/08/16/automated-php-deployment-with-capistrano/
# http://github.com/leehambley/railsless-deploy
# http://help.github.com/msysgit-key-setup/
# http://help.github.com/capistrano/

