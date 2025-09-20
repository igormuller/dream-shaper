# dream-shaper

# Instalando e subindo o backend
- acessar a pasta backend dentro da pasta dream-shaper
- executar o comando ```docker compose up -d```
- acessar o container app com o comando ```docker exec -it app bash```
- dentro do container executar o comando ```composer install```
- após executar o comando ```cp .env.example .env```
- após executar o comanto ```php artisan key:generate```
- após executar o comando ```php artisan migrate``` responder sim para criar o banco sqlite.
- aqui terminamos a configuração do backend, pode executar o comando ```exit``` para sair do container

# Instalando e subindo o Frontend
- acessar a pasta frontend dentro da pasta dream-shaper (ou voltar ../frontend)
- garantir que está na versão 20.19.0 do node com o comando ```node -v```
- executar o comando ```npm install```
- executar o comando ```npm run dev```

  Pronto acessar a url indicada
