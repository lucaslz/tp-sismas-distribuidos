#!/bin/bash

# Script responsavel por criar um rede externa para os containers e configurar os mesmos

docker network create --subnet 172.25.0.0/16 --gateway 172.25.0.1 rede_gearman

if [ $? -eq 0 ]; then
    echo ""
    echo -e "\e[1;31;42m rede_gearman Criada com sucesso! \e[0m"
else
    echo ""
    echo -e "\e[1;32;41m FAIL !!! \e[0m"
fi

exit 1