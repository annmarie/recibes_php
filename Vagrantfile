# -*- mode: ruby -*-
# vi: set ft=ruby :

project_name = "recibes-vagrant"

# IP Address for the host only network, change it to anything you like
# but please keep it within the IPv4 private network range
ip_address = "172.12.12.12"

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  config.vm.box = "debian/wheezy7.7"
  config.vm.box_url = "https://github.com/zauberpony/vagrant-boxes/releases/download/v1.3/wheezy.box"

  # Forward ports to Apache and MySQL
  config.vm.network "forwarded_port", guest: 80, host: 6666, auto_correct: true
  config.vm.network "forwarded_port", guest: 3306, host: 6667, auto_correct: true

  # Set share folder
  config.vm.synced_folder "./", "/var/www", create: true, group: "www-data", owner: "www-data", type: "rsync", rsync__auto: true, rsync__args: ["--verbose", "--archive", "-z", "--copy-links", "--rsync-path='sudo rsync'", "--perms", "--chmod=u+rwx,g+rwx,o+rx,o-w"], rsync__exclude: [".git/", ".vagrant/", "Vagrantfile"], :mount_options => ['dmode=775', 'fmode=775']

  # Use hostonly network with a static IP Address and enable
  # hostmanager so we can have a custom domain for the server
  # by modifying the host machines hosts file
  config.hostmanager.enabled = true
  config.hostmanager.manage_host = true
  config.vm.define project_name do |node|
    node.vm.hostname = project_name + ".local"
    node.vm.network :private_network, ip: ip_address
    node.hostmanager.aliases = [ "www." + project_name + ".local" ]
  end
  config.vm.provision :hostmanager

  config.vm.provision "shell" do |s|
    s.path = "dev/vagrant/provision-setup.sh"
  end

  config.vm.provision "shell", :args => "background", run: "always" do |s|
    s.path = "dev/vagrant/provision-up.sh"
  end

  config.vm.provider "virtualbox" do |vb|
    # Don't boot with headless mode
    # vb.gui = true

    # Use VBoxManage to customize the VM. For example to change memory:
    vb.memory = 1024;
    vb.cpus = 2;
  end
end
