# This is the initial configuration for our machine with Vagrant

Vagrant.configure("2") do |config|
  config.vm.box = "debian/jessie64"
  config.vm.hostname = "budgets"
  config.vm.network "forwarded_port", guest: 80, host:8081
  config.vm.network "forwarded_port", guest: 8080, host:8080
  config.vm.network "forwarded_port", guest: 3306, host:3307

  config.vm.provider :virtualbox do |vb|
    vb.customize [
      "modifyvm", :id,
      "--cpuexecutioncap", "50",
      "--memory", "768",
    ]
  end
  config.vm.provision :shell, path: "setup.sh"
end
