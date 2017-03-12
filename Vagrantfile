# This is the initial configuration for our machine with Vagrant

Vagrant.configure("2") do |config|
  config.vm.box = "debian/jessie64"
  config.vm.hostname = "budgets"
  config.vm.network :private_network, type: "dhcp"

  config.vm.provider :virtualbox do |vb|
    vb.customize [
      "modifyvm", :id,
      "--cpuexecutioncap", "50",
      "--memory", "512",
    ]
  end
  config.vm.provision :shell, path: "setup.sh"
end
