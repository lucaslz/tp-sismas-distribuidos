#!/bin/bash
docker run -it --rm --name gearman-producer --network rede_gearman -v "$PWD":/var/www lucaslz/gearman-producer php producer.php