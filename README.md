
# **PROJETO PDI 2023**



## **Rodando Ambiente**



- **1 - Clone o projeto utilizando:**
 ```bash
  git clone https://github.com/gabrielsantos8/pdi_project_2023.git
```

- **2 - Na pasta raiz, copie o arquivo .env.example, e cole, renomeando o mesmo para apenas .env.**

- **3 - Na raiz do projeto, abra o terminal e digite os seguintes comandos:**
 ```bash
  composer install
  php artisan key:generate
  docker-compose up -d
```

- **4 - Acesse o container com o seguinte comando:**
 ```bash
  docker exec -it pdi_project_2023_app_1 bash
```
- **5 - Dentro do container, execute os seguintes comandos:**
```bash
  php artisan migrate
```
- **6 - Pronto, por fim, basta acessar a seguinte url:**
- http://localhost:8989/