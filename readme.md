## Configurações
Alguns comandos devem ser executador para o funcionamento do sistema.

## Instalando dependencias
```
cd /var/www/html ; composer install
composer require guzzlehttp/guzzle
cd /var/www/html ; npm install --unsafe=true
```

## Permissão na pasta de storage
```
chmod 775 /var/www/html/storage -R
chown nginx.nginx /var/www/html/storage -R
```

## Copiando arquivo de configuração
```
cp /var/www/html/.env.example /var/www/html/.env
```

## Gerando token de autenticação
```
cd /var/www/html ; php artisan key:generate
```

## Habilitando serviço de php-fpm e nginx
```
systemctl start php-fpm
systemctl enable php-fpm
systemctl start nginx
systemctl enable nginx
systemctl enable iptables
systemctl restart iptables
```

## Cria banco de dados
```
mysql -u root -e "create database schedules";
```

## Criando usuário padrão (Email:admin@gmail.com Senha: 123)
```
cd /var/www/html ; php artisan migrate; php artisan db:seed
```
