# Operacao do Sistema - Inventario de Bens de TI

## Requisitos
- PHP 8.2+
- Composer 2+
- Node.js 22+ (funciona), 24+ recomendado pela dependencia do scanner
- MySQL 8+

## Configuracao inicial
1. Copiar ambiente:
```bash
cp .env.example .env
```
2. Ajustar banco no `.env`:
- `DB_CONNECTION=mysql`
- `DB_HOST`
- `DB_PORT`
- `DB_DATABASE`
- `DB_USERNAME`
- `DB_PASSWORD`
3. Gerar chave da aplicacao:
```bash
php artisan key:generate
```
4. Instalar dependencias:
```bash
composer install
npm install
```
5. Migrar e popular base:
```bash
php artisan migrate:fresh --seed
```

## Execucao local
1. Iniciar backend:
```bash
php artisan serve
```
2. Em outro terminal, iniciar frontend:
```bash
npm run dev
```
3. Acessar:
- `http://127.0.0.1:8000`

## Build de producao
```bash
npm run build
php artisan optimize
```

## Fluxo principal de uso
1. Acessar `Levantamento`.
2. Definir contexto: cidade/comarca, vara, setor, tipo, marca/modelo.
3. Ler codigo por camera ou digitar manualmente.
4. Salvar com `Salvar e ler proximo`.
5. Repetir para os demais equipamentos.

## Rotas importantes
- Dashboard: `/`
- Equipamentos: `/equipamentos`
- Levantamento em lote: `/equipamentos-levantamento`
- API verificar codigo: `/api/equipamentos/verificar-codigo/{codigo}`

