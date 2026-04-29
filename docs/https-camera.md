# HTTPS e Camera no Navegador

## Regra principal
A camera no navegador exige contexto seguro:
- HTTPS em producao
- `localhost` ou `127.0.0.1` em ambiente local

Sem isso, a permissao de camera pode ser bloqueada.

## Ambiente local
- `php artisan serve` em `127.0.0.1` funciona para testes de camera.
- Em celulares, prefira abrir por URL segura/tunel HTTPS.

## Producao
1. Configurar certificado TLS valido no dominio.
2. Forcar redirecionamento HTTP -> HTTPS.
3. Definir `APP_URL` com `https://...` no `.env`.
4. Validar no browser mobile:
- permissao solicitada
- abertura da camera traseira
- leitura e fechamento do stream

## Mensagens de erro previstas
- Permissao negada:
`Permissao da camera negada. Libere o acesso nas configuracoes do navegador ou digite o codigo manualmente.`
- Sem HTTPS:
`A camera so funciona em ambiente seguro. Use HTTPS ou localhost para testes.`
- Sem camera:
`Nenhuma camera foi encontrada neste dispositivo.`
- Erro generico:
`Nao foi possivel iniciar a camera. Digite o codigo manualmente ou tente novamente.`

