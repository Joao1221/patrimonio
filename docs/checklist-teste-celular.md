# Checklist de Teste no Celular

## Acesso e navegacao
- [ ] Sistema abre no celular sem quebra de layout.
- [ ] Dashboard carrega com metricas.
- [ ] Menu permite acesso rapido a Equipamentos e Levantamento.

## Levantamento em lote
- [ ] Tela `equipamentos-levantamento` abre corretamente.
- [ ] Campos de contexto (cidade, vara, setor, tipo) funcionam.
- [ ] Marca e modelo permanecem no fluxo sequencial.
- [ ] `codigo_patrimonio` e `observacoes` limpam apos `Salvar e ler proximo`.
- [ ] Contador da sessao incrementa apos cada salvamento.
- [ ] Lista de ultimos cadastrados atualiza.

## Camera - levantamento
- [ ] Botao `Ler codigo` abre modal da camera.
- [ ] Permissao de camera e solicitada.
- [ ] Camera traseira e utilizada quando disponivel.
- [ ] Codigo lido preenche `codigo_patrimonio`.
- [ ] Modal fecha apos leitura.
- [ ] Botao `Cancelar leitura` fecha e encerra stream.

## Camera - cadastro comum
- [ ] Botao `Ler codigo` preenche campo no formulario.
- [ ] Verificacao de duplicidade apresenta alerta e link.
- [ ] Fallback de digitacao manual continua funcionando.

## Camera - consulta
- [ ] Botao `Consultar pela camera` na listagem funciona.
- [ ] Se codigo existe, redireciona para detalhes.
- [ ] Se codigo nao existe, oferece cadastro com codigo preenchido.

## Regras de negocio
- [ ] Nao permite `codigo_patrimonio` duplicado.
- [ ] Validacoes backend continuam ativas com camera e digitacao manual.
- [ ] Cadastros auxiliares podem ser desativados sem exclusao fisica.

## Ambiente
- [ ] Teste em HTTPS (ou localhost) confirma funcionamento da camera.
- [ ] Teste sem HTTPS mostra mensagem amigavel de bloqueio.

