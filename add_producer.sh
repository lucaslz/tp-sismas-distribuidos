#!/bin/bash

docker run -it --rm --name gearman-producer --network rede_gearman -v "$PWD":/var/www -v "$PWD/logs:/var/www/logs" lucaslz/gearman-producer php producer.php $1