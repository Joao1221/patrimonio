# Backlog Executável - Inventário de Bens de TI

## Como usar este backlog
- Ordem obrigatória: executar de cima para baixo.
- Política de avanço: só iniciar tarefa seguinte após cumprir critérios de aceite da tarefa atual.
- Definição de pronto global por tarefa:
- Código versionado.
- Rotas/telas funcionando.
- Validação backend coberta.
- Teste manual rápido registrado.

## Marco A - Base técnica e dados

### A1. Preparar projeto e ambiente
- Objetivo: garantir stack e base de execução.
- Tarefas:
- Confirmar `PHP 8.2+`, `Laravel 12`, `MySQL`, `Node`.
- Configurar `.env` (DB, APP_URL, sessão).
- Instalar dependências JS e build (`npm install`).
- Critérios de aceite:
- `php artisan --version` e `php -v` compatíveis.
- `php artisan migrate:fresh` executa sem erro.
- `npm run build` executa sem erro.

### A2. Criar migrations de cadastros auxiliares
- Objetivo: estruturar tabelas de domínio auxiliar.
- Tarefas:
- Criar migrations:
- `tipos_equipamento`
- `marcas`
- `cidades_comarcas`
- `varas`
- `setores`
- Incluir colunas padrão: `id`, `nome`, `ativo`, timestamps.
- Aplicar `unique(nome)` onde exigido.
- Em `varas`, aplicar `unique(cidade_comarca_id, nome)` e FK.
- Critérios de aceite:
- Migrations sobem sem erro.
- Constraints de unicidade e FKs existentes no banco.

### A3. Criar migration de equipamentos
- Objetivo: suportar cadastro principal.
- Tarefas:
- Criar tabela `equipamentos` com FKs e campos do prompt.
- Definir `codigo_patrimonio` como único.
- Adicionar índices para filtros frequentes (`tipo`, `cidade`, `vara`, `setor`, `codigo_patrimonio`).
- Critérios de aceite:
- Tabela criada com todas as FKs válidas.
- Índices presentes e `codigo_patrimonio` único.

### A4. Criar Models e relacionamentos
- Objetivo: mapear domínio no Eloquent.
- Tarefas:
- Criar models:
- `TipoEquipamento`, `Marca`, `CidadeComarca`, `Vara`, `Setor`, `Equipamento`.
- Definir `$fillable`.
- Implementar relacionamentos `belongsTo` e `hasMany`.
- Critérios de aceite:
- Relações funcionam em Tinker (`with`, `belongsTo`, `hasMany`).
- Sem erro de mass assignment nos creates principais.

### A5. Criar seeders iniciais
- Objetivo: disponibilizar dados base para uso imediato.
- Tarefas:
- Seeders de tipos, marcas, setores, cidades/comarcas e varas de exemplo.
- Amarrar no `DatabaseSeeder`.
- Critérios de aceite:
- `php artisan db:seed` popula dados esperados.
- Dados de exemplo batem com o prompt.

## Marco B - Regras de negócio (backend)

### B1. Form Requests de equipamentos
- Objetivo: centralizar validação backend.
- Tarefas:
- Criar:
- `StoreEquipamentoRequest`
- `UpdateEquipamentoRequest`
- `StoreLevantamentoEquipamentoRequest`
- Regras:
- obrigatórios/existentes
- unicidade de `codigo_patrimonio`
- `ignore` na atualização.
- Critérios de aceite:
- Requisições inválidas retornam erros esperados.
- Atualização permite manter mesmo código no próprio registro.

### B2. Form Requests de cadastros auxiliares
- Objetivo: padronizar validações auxiliares.
- Tarefas:
- Criar:
- `StoreTipoEquipamentoRequest`
- `StoreMarcaRequest`
- `StoreCidadeComarcaRequest`
- `StoreVaraRequest`
- `StoreSetorRequest`
- Validar unicidade e vínculos.
- Critérios de aceite:
- Duplicidade inválida bloqueada via backend.
- `vara` exige `cidade_comarca_id` válido.

### B3. Controllers de cadastros auxiliares
- Objetivo: CRUDs simples e seguros.
- Tarefas:
- Implementar resource controllers dos auxiliares.
- Garantir uso de Requests.
- Evitar exclusão destrutiva quando houver vínculo (preferir `ativo=false`).
- Critérios de aceite:
- CRUD completo funcional.
- Exclusão protegida para registros em uso.

### B4. EquipamentoController (CRUD principal)
- Objetivo: CRUD tradicional de equipamentos.
- Tarefas:
- Implementar `index/create/store/show/edit/update/destroy`.
- Integrar validações de requests.
- Implementar filtros e busca por `codigo_patrimonio` no `index`.
- Critérios de aceite:
- Fluxo completo de cadastro/edição/visualização funciona.
- Busca e filtros básicos funcionando.

### B5. EquipamentoLevantamentoController
- Objetivo: backend do fluxo prioritário.
- Tarefas:
- Implementar:
- `index()`
- `store()`
- `verificarCodigo()`
- Persistir sessão de levantamento.
- Retornar dados para contador e últimos cadastrados.
- Critérios de aceite:
- Salva em lote mantendo contexto configurado.
- Verificação de código duplicado responde corretamente.

### B6. Rotas web e API interna
- Objetivo: expor endpoints previstos no prompt.
- Tarefas:
- Definir resources web.
- Definir rotas de levantamento e verificação.
- Definir APIs internas:
- `/api/cidades-comarcas/{id}/varas`
- `/api/equipamentos/buscar-por-codigo/{codigo}`
- `/api/equipamentos/verificar-codigo/{codigo}`
- Critérios de aceite:
- Todas as rotas resolvem com `route:list`.
- Endpoints retornam status e payload esperados.

## Marco C - Interface base e telas gerais

### C1. Layout base mobile-first
- Objetivo: fundação visual e navegação.
- Tarefas:
- Criar layout Blade principal com Tailwind.
- Definir navegação e feedbacks globais (alertas sucesso/erro).
- Critérios de aceite:
- Layout responsivo em viewport mobile.
- Mensagens de validação e sucesso visíveis.

### C2. Dashboard
- Objetivo: visão geral operacional.
- Tarefas:
- Cards:
- total de equipamentos
- total por tipo
- total por cidade/comarca
- últimos cadastrados
- CTA destacado para levantamento em lote.
- Critérios de aceite:
- Métricas carregam corretamente.
- Botão de acesso ao levantamento visível no topo mobile.

### C3. Listagem de equipamentos
- Objetivo: consulta e filtro rápido.
- Tarefas:
- Busca por código/patrimônio.
- Filtros por tipo, marca, cidade/comarca, vara, setor.
- Render responsivo (tabela + cards no mobile).
- Critérios de aceite:
- Filtros combinados funcionando.
- Visual legível em tela pequena.

### C4. Cadastro, edição e detalhes de equipamentos
- Objetivo: fluxo tradicional completo.
- Tarefas:
- Formulário com todos os campos.
- Carregamento dinâmico de varas por cidade/comarca.
- Tela de detalhes com datas e ações.
- Critérios de aceite:
- `create/edit/show` funcionando sem regressão.
- Querystring `?codigo_patrimonio=` preenche campo no cadastro.

### C5. Telas de cadastros auxiliares
- Objetivo: manutenção de domínio.
- Tarefas:
- Listagem + criação + edição para tipos, marcas, cidades/comarcas, varas e setores.
- Critérios de aceite:
- Todos os cadastros operacionais via interface.

## Marco D - Levantamento em lote (sem scanner)

### D1. Tela `/equipamentos-levantamento`
- Objetivo: implementar o fluxo de campo principal.
- Tarefas:
- Campos de contexto fixo:
- cidade/comarca, vara, setor, tipo, marca, modelo.
- Campos operacionais:
- `codigo_patrimonio`, `observacoes`.
- Botões:
- `Salvar e ler próximo`, `Salvar`, `Limpar código`.
- Critérios de aceite:
- Fluxo de cadastro em sequência executável só com digitação.

### D2. Persistência de contexto (Session + LocalStorage)
- Objetivo: não perder contexto no recarregamento.
- Tarefas:
- Persistir:
- `cidade_comarca_id`, `vara_id`, `setor_id`, `tipo_equipamento_id`, `marca_id`, `modelo`.
- Restaurar automaticamente ao abrir/recarregar a tela.
- Critérios de aceite:
- Recarregar página mantém contexto preenchido.

### D3. Pós-salvamento rápido
- Objetivo: reduzir cliques por item.
- Tarefas:
- Após salvar:
- manter contexto + marca/modelo
- limpar `codigo_patrimonio` e `observacoes`
- foco no próximo passo operacional.
- Critérios de aceite:
- Usuário consegue cadastrar sequência sem reconfigurar contexto.

### D4. Indicadores da sessão
- Objetivo: feedback de progresso em campo.
- Tarefas:
- Exibir `Cadastrados nesta sessão`.
- Exibir lista curta de últimos cadastrados da sessão atual.
- Critérios de aceite:
- Contador incrementa corretamente.
- Lista mostra últimos itens recém salvos.

## Marco E - Scanner e integração

### E1. Instalar e configurar `@zxing/browser`
- Objetivo: habilitar leitura via câmera.
- Tarefas:
- Instalar pacote.
- Garantir bundle pelo Vite sem erro.
- Critérios de aceite:
- Build frontend sem erro de import.

### E2. Criar módulo `resources/js/barcode-scanner.js`
- Objetivo: scanner reutilizável.
- Tarefas:
- Implementar classe com:
- start/stop
- seleção de câmera traseira
- leitura contínua
- retorno do primeiro código válido
- cleanup completo do stream e reader.
- Tratamento de erro:
- permissão negada
- sem HTTPS/localhost
- sem câmera
- erro desconhecido.
- Critérios de aceite:
- Scanner inicia e para sem deixar câmera ativa.
- Callback retorna código lido corretamente.

### E3. Criar modal/componente visual de scanner
- Objetivo: UX consistente de leitura.
- Tarefas:
- Modal com vídeo, texto instrutivo, cancelamento e mensagens de estado.
- Feedback visual de sucesso ao ler código.
- Critérios de aceite:
- Modal abre/fecha corretamente.
- Botão cancelar interrompe leitura e libera câmera.

### E4. Integrar scanner no levantamento em lote
- Objetivo: acelerar fluxo principal.
- Tarefas:
- Botão `Ler próximo equipamento`.
- Ao ler:
- preencher `codigo_patrimonio`
- verificar duplicidade
- focar ação `Salvar e ler próximo`.
- Critérios de aceite:
- Leitura preenche campo e impede duplicidade.
- Fluxo de repetição fica operacional no celular.

### E5. Integrar scanner no cadastro comum
- Objetivo: reaproveitar scanner no CRUD tradicional.
- Tarefas:
- Botão `Ler código` no formulário.
- Verificação automática de duplicidade após leitura.
- Link para abrir equipamento existente quando duplicado.
- Critérios de aceite:
- Cadastro comum recebe código por câmera sem regressão.

### E6. Integrar consulta por câmera na listagem
- Objetivo: consulta rápida por etiqueta.
- Tarefas:
- Botão `Consultar pela câmera`.
- Se encontrado, redirecionar `show`.
- Se não encontrado, ofertar cadastro com querystring.
- Critérios de aceite:
- Fluxo de consulta e fallback para novo cadastro funcionando.

## Marco F - PWA, validação final e operação

### F1. Estrutura PWA básica
- Objetivo: preparar instalabilidade futura.
- Tarefas:
- Manifest (nome, ícone, tema).
- Ajustes básicos de metadados mobile.
- Critérios de aceite:
- Manifest acessível e válido.

### F2. Checklist de testes em celular
- Objetivo: validar uso real em campo.
- Tarefas:
- Executar checklist do prompt (câmera, duplicidade, sessão, UX mobile, fallback manual).
- Validar em Android/iOS se possível.
- Critérios de aceite:
- Checklist completo sem bloqueadores críticos.

### F3. Documentação operacional
- Objetivo: facilitar implantação e uso.
- Tarefas:
- Documentar execução local e build.
- Documentar requisito de HTTPS para câmera.
- Documentar fluxo de levantamento em lote para usuário final.
- Critérios de aceite:
- Documento de operação suficiente para outro dev subir e testar.

## Sequência de execução recomendada (sprints)

### Sprint 1
- A1, A2, A3, A4, A5

### Sprint 2
- B1, B2, B3, B4, B6

### Sprint 3
- C1, C2, C3, C4, C5

### Sprint 4
- D1, D2, D3, D4, B5

### Sprint 5
- E1, E2, E3, E4, E5, E6

### Sprint 6
- F1, F2, F3

## Riscos e mitigação
- HTTPS/câmera em produção:
- Mitigação: validar ambiente seguro cedo (Sprint 5 início).
- Duplicidade por concorrência:
- Mitigação: manter `unique` no banco e tratar erro de gravação com mensagem amigável.
- Performance em celular simples:
- Mitigação: reduzir JS pesado, parar câmera sempre, evitar recarregamentos completos.
- Perda de contexto no levantamento:
- Mitigação: Session + LocalStorage e testes de recarga/reabertura.
