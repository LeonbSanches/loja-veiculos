# 🚗 Loja de Veículos

Sistema completo de gerenciamento de loja de veículos desenvolvido em Laravel com interface moderna e sofisticada.

## ✨ Funcionalidades

### 🚙 Gestão de Veículos
- Cadastro completo de veículos (marca, modelo, ano, preço, etc.)
- Upload e gerenciamento de fotos
- Controle de status (disponível, reservado, vendido)
- Sistema de busca e filtros avançados

### 👥 Gestão de Clientes
- Cadastro de clientes (Pessoa Física e Jurídica)
- Controle de documentos (CPF, CNPJ, RG)
- Endereçamento completo
- Histórico de compras

### 💰 Gestão de Vendas
- Registro de vendas com cliente e veículo
- Múltiplos métodos de pagamento
- Controle de comissões
- Histórico de transações

### 📊 Relatórios Avançados
- Relatório de veículos com gráficos interativos
- Relatório de clientes com distribuição geográfica
- Relatório de vendas com análise temporal
- Gráficos Chart.js para visualização de dados

### 🎨 Interface Moderna
- Design sofisticado e minimalista
- Interface responsiva (Bootstrap 5)
- Animações suaves e efeitos visuais
- Ícones Font Awesome
- Tema profissional com paleta de cores elegante

## 🛠️ Tecnologias Utilizadas

- **Backend:** Laravel 10
- **Frontend:** Bootstrap 5, Chart.js, Font Awesome
- **Banco de Dados:** PostgreSQL
- **Autenticação:** Laravel Breeze
- **Upload de Arquivos:** Laravel Storage
- **Gráficos:** Chart.js

## 📋 Pré-requisitos

- PHP 8.1 ou superior
- Composer
- Node.js e NPM
- PostgreSQL
- Git

## 🚀 Instalação

1. **Clone o repositório:**
```bash
git clone https://github.com/LeonbSanches/loja-veiculos.git
cd loja-veiculos
```

2. **Instale as dependências:**
```bash
composer install
npm install
```

3. **Configure o ambiente:**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure o banco de dados no arquivo `.env`:**
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=loja_veiculos
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. **Execute as migrações:**
```bash
php artisan migrate
```

6. **Popule o banco com dados iniciais:**
```bash
php artisan db:seed
```

7. **Configure o storage para uploads:**
```bash
php artisan storage:link
```

8. **Compile os assets:**
```bash
npm run build
```

9. **Inicie o servidor:**
```bash
php artisan serve
```

## 📁 Estrutura do Projeto

```
loja-veiculos/
├── app/
│   ├── Http/Controllers/     # Controllers
│   ├── Models/              # Models Eloquent
│   ├── Services/            # Lógica de negócio
│   └── ...
├── database/
│   ├── migrations/          # Migrações do banco
│   ├── seeders/            # Seeders para dados iniciais
│   └── ...
├── resources/
│   ├── views/              # Views Blade
│   ├── css/               # Estilos SCSS
│   └── js/                # JavaScript
├── routes/
│   └── web.php            # Rotas da aplicação
└── storage/
    └── app/public/        # Arquivos públicos
```

## 🎯 Principais Recursos

### Sistema de Autenticação
- Login e registro de usuários
- Recuperação de senha
- Verificação de email
- Perfil do usuário

### Dashboard Inteligente
- Estatísticas em tempo real
- Gráficos de vendas
- Veículos recentes
- Clientes ativos

### Relatórios com Chart.js
- Gráficos de pizza para distribuições
- Gráficos de linha para tendências
- Gráficos de barras para comparações
- Dados em tempo real do banco

### Upload de Fotos
- Múltiplas fotos por veículo
- Foto principal destacada
- Redimensionamento automático
- Armazenamento seguro

## 🔧 Comandos Úteis

```bash
# Limpar cache
php artisan config:clear
php artisan view:clear
php artisan cache:clear

# Executar testes
php artisan test

# Gerar documentação
php artisan route:list

# Backup do banco
php artisan backup:run
```

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## 👨‍💻 Autor

**Leonardo Sanches**
- GitHub: [@LeonbSanches](https://github.com/LeonbSanches)

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📞 Suporte

Se você encontrar algum problema ou tiver dúvidas, por favor abra uma [issue](https://github.com/LeonbSanches/loja-veiculos/issues) no repositório.

---

⭐ **Se este projeto te ajudou, não esqueça de dar uma estrela!** ⭐