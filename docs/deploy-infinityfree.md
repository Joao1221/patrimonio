# Deploy na InfinityFree (funcionando em producao)

## Estrutura correta (obrigatoria)
Na InfinityFree, o ponto mais estavel para Laravel e:

- `htdocs/` -> somente arquivos do `public/`
- `laravel_app/` -> restante do projeto (fora de `htdocs`)

Se o projeto inteiro ficar dentro de `htdocs`, e comum aparecer `403`.

## Gerar pacote pronto no seu PC
No projeto local, rode:

```powershell
powershell -ExecutionPolicy Bypass -File .\scripts\prepare-infinityfree.ps1
```

Isso cria:
- `dist-infinityfree/htdocs`
- `dist-infinityfree/laravel_app`

## Upload no painel/FTP da InfinityFree
1. Envie o conteudo de `dist-infinityfree/htdocs` para `htdocs/` do dominio.
2. Envie `dist-infinityfree/laravel_app` para uma pasta irma de `htdocs` (fora do webroot).

Exemplo:
- `/htdocs` (publico)
- `/laravel_app` (privado)

## index.php ja ajustado
O script gera `htdocs/index.php` apontando para:

```php
$basePath = __DIR__ . '/../laravel_app';
```

Se voce escolher outro nome de pasta, ajuste essa linha.

## Permissoes
- Pastas: `755`
- Arquivos: `644`

## Variaveis .env (em producao)
No arquivo `laravel_app/.env`:
- `APP_ENV=production`
- `APP_DEBUG=false`
- `APP_URL=https://seu-dominio`
- `DB_*` com os dados MySQL da InfinityFree

## Comandos no servidor (se tiver terminal)
```bash
php artisan optimize
php artisan migrate --force
php artisan db:seed --force
```

Se nao houver terminal, rode migrate/seed localmente contra o banco remoto.

## Localhost
Localmente, continue abrindo:
- `http://localhost/patrimonio/`

O `.htaccess` raiz atual foi mantido para esse fluxo.
