# PROMPT COMPLETO PARA O AGENTE DO VS CODE

Atue como um Arquiteto Sênior de Software, Tech Lead Laravel, Especialista em UX Mobile-First e Engenheiro Frontend com experiência em PWA, acesso à câmera no navegador e leitura de código de barras.

Você deve projetar e implementar este sistema com foco em:

- arquitetura limpa;
- código organizado;
- segurança;
- validações no backend;
- boa experiência em celular;
- manutenção futura;
- performance em dispositivos simples;
- uso real em campo;
- leitura de código de barras pela câmera;
- fluxo rápido para cadastrar muitos equipamentos em sequência.

Não quero apenas telas soltas ou um CRUD básico.

Quero um módulo/sistema bem estruturado para inventário de equipamentos de TI, com prioridade máxima para o fluxo de levantamento em lote pelo celular usando a câmera.

Antes de implementar qualquer arquivo, leia este prompt inteiro, entenda o fluxo principal e só depois comece a execução em partes.

---

Quero criar um sistema/app para levantamento e cadastro de equipamentos de TI usando celular.

A principal funcionalidade do sistema é:

> O usuário deve abrir o sistema pelo celular, acessar a câmera, ler o código de barras ou etiqueta patrimonial do equipamento e cadastrar/consultar o bem de forma rápida.

---

# 1. Stack obrigatória

Use:

- Backend: Laravel 12
- Linguagem backend: PHP 8.2+
- Banco de dados: MySQL
- Frontend: Blade + Tailwind CSS
- JavaScript: JavaScript moderno via Vite
- Leitura de código de barras: `@zxing/browser`
- Tipo inicial do projeto: sistema web responsivo/PWA
- Estratégia de interface: mobile-first

Não criar app nativo agora.

Primeiro o sistema deve funcionar no navegador do celular. Depois poderá ser convertido para app mobile com Capacitor/Ionic, se necessário.

Comando para instalar o leitor de código de barras:

```bash
npm install @zxing/browser
```

## 2. Objetivo do sistema

Criar um sistema para inventário/levantamento de equipamentos de TI.

Equipamentos previstos:

Computador
Monitor
Nobreak
Scanner
Impressora
Outros

Cada equipamento será identificado principalmente pelo campo:

codigo_patrimonio

Esse campo representa o código de barras, etiqueta patrimonial ou número de patrimônio do bem.

## 3. Funcionalidade principal: câmera do celular

A câmera é a funcionalidade mais importante do sistema.

O sistema deve permitir que o usuário leia o código de barras/patrimônio usando a câmera traseira do celular.

Requisitos obrigatórios da câmera

Implementar leitor de código de barras com:

@zxing/browser

Usar:

BrowserMultiFormatReader

A leitura deve funcionar assim:

O usuário toca em um botão grande: Ler código ou Ler próximo equipamento.
O sistema solicita permissão para usar a câmera.
O sistema abre preferencialmente a câmera traseira do celular.
O usuário aponta para o código de barras ou etiqueta patrimonial.
O sistema detecta o código.
O sistema preenche automaticamente o campo codigo_patrimonio.
O sistema fecha/paralisa a câmera após a leitura bem-sucedida.
O usuário continua o cadastro ou consulta o equipamento.
Observações técnicas obrigatórias
Usar navigator.mediaDevices.getUserMedia.
A câmera só funciona corretamente em ambiente seguro: HTTPS ou localhost.
Em produção, o sistema precisa rodar com HTTPS.
Em HTTP comum no celular, a câmera pode ser bloqueada pelo navegador.
Exibir mensagem amigável caso a câmera esteja indisponível.
Exibir mensagem amigável caso a permissão seja negada.
Exibir mensagem amigável se nenhum dispositivo de câmera for encontrado.
Ter botão Cancelar leitura ou Fechar câmera.
Ao sair da tela, parar a câmera corretamente.
Não deixar o stream da câmera ativo depois de fechar o scanner.
Evitar travar a interface em celulares simples.
Permitir digitação manual do código caso a leitura falhe.
Não usar API antiga navigator.getUserMedia, pois está obsoleta.
## 4. Arquivo JavaScript do scanner

Criar um arquivo específico para a câmera:

resources/js/barcode-scanner.js

Esse módulo deve ser reutilizável em várias telas.

Ele deve conter a lógica para:

iniciar câmera;
listar dispositivos de vídeo quando necessário;
preferir câmera traseira;
iniciar leitura contínua;
capturar o primeiro código válido;
preencher o input indicado;
chamar callback de sucesso;
parar leitura;
limpar stream da câmera;
resetar reader;
tratar erros.

Sugestão de estrutura:

import { BrowserMultiFormatReader } from '@zxing/browser';

class BarcodeScanner {
    constructor(options = {}) {
        this.videoElement = options.videoElement;
        this.onDetected = options.onDetected;
        this.onError = options.onError;
        this.reader = null;
        this.controls = null;
    }

    async start() {
        // iniciar câmera e leitura
    }

    stop() {
        // parar leitura, câmera e tracks
    }
}

export default BarcodeScanner;

O código deve ser limpo, comentado e preparado para uso em:

Tela de levantamento em lote.
Tela de cadastro/edição.
Tela de consulta rápida.
## 5. Tratamento de erros da câmera

Exibir mensagens amigáveis.

Permissão negada
Permissão da câmera negada. Libere o acesso à câmera nas configurações do navegador ou digite o código manualmente.
Sem HTTPS
A câmera só funciona em ambiente seguro. Use HTTPS ou localhost para testes.
Nenhuma câmera encontrada
Nenhuma câmera foi encontrada neste dispositivo.
Erro desconhecido
Não foi possível iniciar a câmera. Digite o código manualmente ou tente novamente.
## 6. Campos do cadastro de equipamento

O cadastro de equipamento deve conter estes campos:

Tipo do equipamento

Exemplos:

Computador
Monitor
Nobreak
Scanner
Impressora
Outro

Será cadastrado em tabela auxiliar.

Código de barras / patrimônio

Campo no banco:

codigo_patrimonio

Exemplos:

7891234567890
000154

Regras:

Obrigatório.
�snico.
Pode ser preenchido pela câmera.
Pode ser digitado manualmente.
Marca

Exemplos:

Dell
HP
SMS
Epson
Lenovo
Canon
Brother
Outro

Será cadastrada em tabela auxiliar.

Modelo

Exemplos:

Optiplex 3080
L3150

Campo texto.

Ajuda a identificar melhor o equipamento.

Cidade/Comarca

Exemplos:

Capela
Aracaju

Será cadastrada em tabela auxiliar.

Vara

Exemplos:

�snica
1ª Vara
2ª Vara

Será cadastrada em tabela auxiliar.

Deve estar vinculada a uma Cidade/Comarca.

Setor

Exemplos:

Secretaria
Assessoria
Gabinete
Sala de instruções
Atendimento geral
Arquivo
Recepção
Outro

Será cadastrado em tabela auxiliar.

Observações

Campo texto longo.

Exemplos:

Tela quebrada.
Sem fonte.
Equipamento sem etiqueta.
Equipamento não liga.
Data de cadastro

Automática.

Usar:

created_at

Não deve ser digitada manualmente pelo usuário.

## 7. Cadastros auxiliares obrigatórios

Criar CRUD simples para:

Tipos de equipamento
Marcas
Cidades/Comarcas
Varas
Setores

Todos devem ter:

id
nome
ativo
created_at
updated_at

Regras:

Tipo de equipamento deve ter nome único.
Marca deve ter nome único.
Cidade/Comarca deve ter nome único.
Vara deve pertencer a uma Cidade/Comarca.
Não permitir varas duplicadas dentro da mesma Cidade/Comarca.
Setor pode ser cadastrado como lista geral.
Usar campo ativo para ocultar registros antigos.
Não apagar registros auxiliares usados por equipamentos.
## 8. Estrutura do banco de dados

Criar migrations para as tabelas abaixo.

Tabela: tipos_equipamento

Campos:

id
nome
ativo boolean default true
created_at
updated_at

Regras:

nome único
Tabela: marcas

Campos:

id
nome
ativo boolean default true
created_at
updated_at

Regras:

nome único
Tabela: cidades_comarcas

Campos:

id
nome
ativo boolean default true
created_at
updated_at

Regras:

nome único
Tabela: varas

Campos:

id
cidade_comarca_id
nome
ativo boolean default true
created_at
updated_at

Regras:

cidade_comarca_id + nome único

Relacionamento:

vara pertence a cidade/comarca
Tabela: setores

Campos:

id
nome
ativo boolean default true
created_at
updated_at

Regras:

nome único
Tabela: equipamentos

Campos:

id
tipo_equipamento_id
marca_id nullable
cidade_comarca_id
vara_id nullable
setor_id nullable
codigo_patrimonio string único
modelo nullable
observacoes nullable text
created_at
updated_at

Regras:

codigo_patrimonio obrigatório e único.
tipo_equipamento_id obrigatório.
cidade_comarca_id obrigatório.
marca_id nullable.
vara_id nullable.
setor_id nullable.
modelo nullable.
observacoes nullable.
Usar foreign keys corretamente.
Usar índices nos campos mais pesquisados.
## 9. Models

Criar models:

TipoEquipamento
Marca
CidadeComarca
Vara
Setor
Equipamento
Relacionamentos
Equipamento
pertence a TipoEquipamento
pertence a Marca
pertence a CidadeComarca
pertence a Vara
pertence a Setor
CidadeComarca
possui muitas Varas
possui muitos Equipamentos
Vara
pertence a CidadeComarca
possui muitos Equipamentos
TipoEquipamento
possui muitos Equipamentos
Marca
possui muitos Equipamentos
Setor
possui muitos Equipamentos
## 10. Controllers

Criar controllers:

EquipamentoController
EquipamentoLevantamentoController
TipoEquipamentoController
MarcaController
CidadeComarcaController
VaraController
SetorController
EquipamentoController

Métodos:

index()
create()
store()
show()
edit()
update()
destroy()

O destroy deve evitar apagar registros importantes. Se possível, usar apenas desativação futura. Caso implemente exclusão, proteger contra exclusão acidental.

EquipamentoLevantamentoController

Controller específico para o fluxo principal de levantamento em lote.

Métodos:

index()
store()
verificarCodigo()

Esse controller é prioridade.

## 11. Form Requests

Criar Form Requests para validação:

StoreEquipamentoRequest
UpdateEquipamentoRequest
StoreLevantamentoEquipamentoRequest
StoreTipoEquipamentoRequest
StoreMarcaRequest
StoreCidadeComarcaRequest
StoreVaraRequest
StoreSetorRequest

Validações principais:

tipo_equipamento_id obrigatório e existente
codigo_patrimonio obrigatório, string, único
marca_id nullable e existente
modelo nullable, string, máximo 150
cidade_comarca_id obrigatório e existente
vara_id nullable e existente
setor_id nullable e existente
observacoes nullable, string

Na atualização, o campo codigo_patrimonio deve continuar único, ignorando o próprio registro atual.

## 12. Rotas

Criar rotas web com nomes claros.

Exemplo:

Route::resource('equipamentos', EquipamentoController::class);

Route::get('equipamentos-levantamento', [EquipamentoLevantamentoController::class, 'index'])
    ->name('equipamentos.levantamento');

Route::post('equipamentos-levantamento', [EquipamentoLevantamentoController::class, 'store'])
    ->name('equipamentos.levantamento.store');

Route::get('equipamentos-levantamento/verificar-codigo/{codigo}', [EquipamentoLevantamentoController::class, 'verificarCodigo'])
    ->name('equipamentos.levantamento.verificar-codigo');

Route::resource('tipos-equipamento', TipoEquipamentoController::class);
Route::resource('marcas', MarcaController::class);
Route::resource('cidades-comarcas', CidadeComarcaController::class);
Route::resource('varas', VaraController::class);
Route::resource('setores', SetorController::class);

Criar também rotas auxiliares para AJAX/API interna:

GET /api/cidades-comarcas/{id}/varas
GET /api/equipamentos/buscar-por-codigo/{codigo}
GET /api/equipamentos/verificar-codigo/{codigo}
## 13. Fluxo principal: Levantamento em Lote pelo celular

A funcionalidade principal do sistema não deve ser apenas um cadastro individual comum.

Criar um modo específico chamado:

Levantamento em Lote

Esse será o fluxo mais usado no celular.

O objetivo é permitir cadastrar muitos equipamentos rapidamente, sem o usuário precisar selecionar Cidade/Comarca, Vara, Setor e Tipo de equipamento a cada item.

Funcionamento do Levantamento em Lote

O fluxo deve ser assim:

O usuário abre o sistema pelo celular.
Acessa a tela Levantamento em Lote.
Antes de começar a leitura, o usuário seleciona:
Cidade/Comarca
Vara
Setor
Tipo de equipamento
Depois de selecionar esses dados, o sistema entra em modo de leitura/cadastro rápido.
O usuário clica em Ler próximo equipamento.
A câmera abre.
O usuário aponta para o código de barras ou etiqueta patrimonial do primeiro equipamento.
O sistema lê o código.
O sistema preenche automaticamente o campo codigo_patrimonio.
O usuário confere e clica em Salvar e ler próximo.
Após salvar, o sistema volta para a mesma tela com os dados anteriores ainda preenchidos:
Cidade/Comarca
Vara
Setor
Tipo de equipamento
Marca, se informada
Modelo, se informado
O campo codigo_patrimonio deve ser limpo.
O campo observacoes deve ser limpo.
O sistema deve ficar pronto para ler o próximo equipamento do mesmo tipo e do mesmo setor.
O usuário repete o processo até finalizar todos os equipamentos daquele tipo naquele setor.
Quando terminar aquele tipo de equipamento, o usuário pode alterar apenas o Tipo de equipamento e continuar a leitura dos próximos bens.
Se mudar de sala/setor, o usuário altera o Setor.
Se mudar de Vara ou Cidade/Comarca, altera os campos correspondentes.
O sistema deve evitar recarregamentos desnecessários e manter o fluxo rápido.
## 14. Exemplo prático do levantamento em lote

Exemplo:

O usuário está na Comarca de Capela, Vara �snica, Setor Secretaria, cadastrando computadores.

Ele seleciona:

Cidade/Comarca: Capela
Vara: �snica
Setor: Secretaria
Tipo de equipamento: Computador

Depois começa a leitura:

Lê computador 001 �?' salva
Lê computador 002 �?' salva
Lê computador 003 �?' salva
Lê computador 004 �?' salva

Todos devem ser cadastrados automaticamente com:

Cidade/Comarca: Capela
Vara: �snica
Setor: Secretaria
Tipo: Computador

Depois, ao terminar os computadores, ele muda apenas:

Tipo de equipamento: Monitor

E continua:

Lê monitor 001 �?' salva
Lê monitor 002 �?' salva
Lê monitor 003 �?' salva

Depois muda para:

Tipo de equipamento: Nobreak

E continua.

## 15. Tela obrigatória: Levantamento em Lote

Criar tela específica:

/equipamentos-levantamento

Nome da rota:

equipamentos.levantamento

Essa tela deve ser a mais importante do sistema e deve ser otimizada para celular.

Campos fixos no topo

Esses campos formam o contexto atual do levantamento:

Cidade/Comarca
Vara
Setor
Tipo de equipamento
Campos que podem permanecer para agilizar
Marca
Modelo

Se o usuário estiver cadastrando vários computadores Dell Optiplex 3080, ele não deve precisar selecionar a marca e digitar o modelo a cada item.

Área de leitura

A tela deve conter:

Botão grande: Ler próximo equipamento
Campo codigo_patrimonio
Campo modelo
Campo marca_id
Campo observacoes
Botão Salvar e ler próximo
Botão Salvar
Botão Limpar código
Contador de equipamentos cadastrados nesta sessão
Lista curta dos últimos cadastrados
## 16. Persistência dos dados selecionados

Após salvar um equipamento no modo levantamento em lote:

Manter preenchidos
Cidade/Comarca
Vara
Setor
Tipo de equipamento
Marca
Modelo
Limpar
Código de barras / patrimônio
Observações

Como regra:

codigo_patrimonio sempre limpa após salvar.
observacoes sempre limpa após salvar.
modelo permanece preenchido.
marca_id permanece selecionada.
Os campos de localização permanecem selecionados.
O tipo de equipamento permanece selecionado.
## 17. Sessão de levantamento

O sistema deve manter uma sessão de levantamento no navegador e/ou no Laravel.

Pode usar:

Session do Laravel;
LocalStorage;
ou ambos.

Guardar temporariamente:

cidade_comarca_id
vara_id
setor_id
tipo_equipamento_id
marca_id
modelo

Se a página recarregar, o usuário não deve perder o contexto do levantamento.

## 18. Comportamento após salvar

Ao salvar no modo levantamento em lote, o sistema deve retornar para a mesma tela:

/equipamentos-levantamento

Com os dados principais preenchidos.

Exemplo:

Cidade/Comarca: Capela
Vara: �snica
Setor: Secretaria
Tipo de equipamento: Computador
Marca: Dell
Modelo: Optiplex 3080
Código/patrimônio: [vazio]
Observações: [vazio]

Mensagem exibida:

Equipamento cadastrado com sucesso. Leia o próximo equipamento.

Também mostrar contador:

Cadastrados nesta sessão: 12
## 19. Modo de leitura com câmera no levantamento

A tela de levantamento em lote deve dar prioridade à câmera.

Botão principal:

Ler próximo equipamento

Ao clicar:

Abrir câmera traseira.
Ler código.
Preencher codigo_patrimonio.
Fechar/parar câmera.
Dar foco no botão Salvar e ler próximo.

Na primeira versão, implementar o modo seguro:

Ler código �?' preencher campo �?' usuário confere �?' clica Salvar e ler próximo

Não salvar automaticamente na primeira versão.

Deixar o código preparado para futuramente ativar modo rápido:

Ler código �?' sistema salva automaticamente �?' limpa código �?' pronto para próximo
## 20. Validação no levantamento em lote

Antes de salvar, validar:

Cidade/Comarca obrigatória.
Vara obrigatória, se houver no fluxo.
Setor obrigatório.
Tipo de equipamento obrigatório.
Código/patrimônio obrigatório.
Código/patrimônio único.

Se o código já existir:

Não salvar duplicado.
Exibir mensagem clara:
Este código/patrimônio já está cadastrado.

Mostrar dados básicos do equipamento encontrado:

Código/patrimônio
Tipo
Cidade/Comarca
Vara
Setor

Oferecer botão:

Abrir equipamento existente
## 21. Verificação de código duplicado durante a leitura

Quando a câmera ler um código:

Preencher o campo codigo_patrimonio.
Consultar se esse código já existe.
Se não existir, permitir salvar.
Se existir, exibir alerta e link para abrir o equipamento existente.
Não permitir duplicidade.

Essa verificação deve funcionar tanto na tela de levantamento em lote quanto no cadastro comum.

## 22. Interface sugerida da tela Levantamento em Lote

A tela deve ser pensada para celular.

Estrutura sugerida:

Levantamento em Lote

[ Cidade/Comarca              v ]
[ Vara                        v ]
[ Setor                       v ]
[ Tipo de equipamento         v ]

[ Marca                       v ]
[ Modelo                        ]

--------------------------------

Código/patrimônio
[ _____________________________ ]

[ Ler próximo equipamento ]

[ Salvar e ler próximo ]

Cadastrados nesta sessão: 12

�sltimos cadastrados:
- 000154 | Computador | Secretaria
- 000155 | Computador | Secretaria
- 000156 | Computador | Secretaria
## 23. �sltimos equipamentos cadastrados

Na tela de levantamento em lote, exibir uma lista curta dos últimos equipamentos cadastrados na sessão atual.

Exemplo:

�sltimos cadastrados
000154 - Computador - Secretaria
000155 - Computador - Secretaria
000156 - Computador - Secretaria

Isso ajuda o usuário a ter segurança de que os bens estão sendo salvos.

## 24. Telas obrigatórias do sistema

Criar as seguintes telas.

Dashboard

Mostrar cards com:

Total de equipamentos
Total por tipo
Total por cidade/comarca
�sltimos equipamentos cadastrados
Botão destacado para Levantamento em Lote
Listagem de equipamentos

A tela deve ter:

Campo de busca por código/patrimônio
Botão grande Consultar pela câmera
Filtros por:
Tipo
Marca
Cidade/Comarca
Vara
Setor
Tabela responsiva
Cards no mobile, se a tabela ficar ruim no celular
Botão para novo cadastro
Botão para levantamento em lote

Quando o usuário clicar em Consultar pela câmera:

Abrir leitor com câmera.
Ler o código.
Buscar o equipamento pelo código.
Se existir, redirecionar para a página de detalhes.
Se não existir, perguntar se deseja cadastrar novo equipamento com o código já preenchido.
Redirecionar para:
/equipamentos/create?codigo_patrimonio=CODIGO_LIDO
Cadastro comum de equipamento

Criar também uma tela tradicional de cadastro.

Campos:

Select de Tipo do equipamento
Input de Código de barras / patrimônio
Botão Ler código
Select de Marca
Input de Modelo
Select de Cidade/Comarca
Select de Vara
Select de Setor
Textarea de Observações
Botão Salvar

Regras:

O botão Ler código deve ser grande e fácil de tocar.
Ao ler código pela câmera, preencher automaticamente codigo_patrimonio.
Se a tela receber ?codigo_patrimonio=..., preencher o campo automaticamente.
Ao selecionar Cidade/Comarca, carregar as Varas correspondentes.
Data de cadastro não aparece como campo editável.
A data de cadastro aparece apenas na tela de detalhes.
Edição de equipamento

Mesmos campos do cadastro comum.

Detalhes do equipamento

Mostrar:

Código/patrimônio
Tipo
Marca
Modelo
Cidade/Comarca
Vara
Setor
Observações
Data de cadastro
Data de última atualização
Botão editar
Botão voltar
Cadastros auxiliares

Criar telas simples para:

Tipos de equipamento
Marcas
Cidades/Comarcas
Varas
Setores
## 25. Design e experiência de uso

O sistema será usado no celular durante o levantamento físico dos bens.

Prioridades:

Mobile-first.
Botões grandes.
Campos bem espaçados.
Interface simples.
Poucos cliques.
Leitura rápida pela câmera.
Feedback claro de sucesso ou erro.
Mensagens simples.
Deve funcionar bem em telas pequenas.
Deve funcionar com internet instável, pelo menos sem quebrar a tela.
O usuário deve conseguir digitar manualmente se a câmera falhar.

Visual:

Institucional.
Limpo.
Fundo claro.
Cards brancos.
Bordas suaves.
Boa legibilidade.
Evitar excesso de cores.
Usar Tailwind CSS.
Não usar Bootstrap se o projeto estiver com Tailwind.
## 26. Componente visual do scanner

Criar componente visual/modal para scanner contendo:

Área de vídeo da câmera.
Texto: Aponte a câmera para o código de barras.
Botão Cancelar.
Mensagem de erro.
Mensagem de sucesso.
Indicação visual quando código for lido.

Comportamento esperado:

O scanner deve abrir em uma área/modal sobre a tela.
Usar câmera traseira preferencialmente.
Depois de detectar um código válido:
parar scanner;
fechar modal;
preencher campo ou executar callback de consulta;
mostrar feedback de sucesso.
## 27. Consulta por câmera

Na listagem de equipamentos, implementar consulta por câmera.

Fluxo:

Usuário clica em Consultar pela câmera.
Scanner abre.
Usuário aponta para o código.
Código é lido.
Fazer requisição para buscar equipamento.
Se encontrado:
redirecionar para /equipamentos/{id}.
Se não encontrado:
exibir mensagem:
Equipamento não encontrado. Deseja cadastrá-lo?

Oferecer botão:

Cadastrar com este código

Redirecionar para:

/equipamentos/create?codigo_patrimonio=CODIGO
## 28. Cadastro por câmera

No formulário de cadastro:

Usuário clica em Ler código.
Scanner abre.
Código é lido.
Campo codigo_patrimonio é preenchido.
Scanner fecha.
Sistema verifica automaticamente se o código já existe.
Se já existir:
avisar:
Este código já está cadastrado.
oferecer link para abrir o equipamento existente.
Se não existir:
permitir continuar o cadastro.
## 29. Validações no backend

Todas as validações devem existir no backend.

Equipamento
tipo_equipamento_id: obrigatório, existe na tabela tipos_equipamento.
codigo_patrimonio: obrigatório, string, único em equipamentos.
marca_id: nullable, existe na tabela marcas.
modelo: nullable, string, máximo 150.
cidade_comarca_id: obrigatório, existe na tabela cidades_comarcas.
vara_id: nullable, existe na tabela varas.
setor_id: nullable, existe na tabela setores.
observacoes: nullable, string.

Na atualização:

codigo_patrimonio continua único, ignorando o registro atual.
## 30. Segurança e boas práticas
Usar validação com Form Requests.
Usar mass assignment com $fillable bem definido.
Usar middleware de autenticação se o projeto já tiver login.
Não confiar apenas no JavaScript.
Toda validação deve existir no backend.
Usar CSRF nas rotas web.
Usar Eloquent.
Não apagar registros auxiliares usados por equipamentos.
Preferir campo ativo para ocultar registros antigos.
Sanitizar saídas nas views com Blade.
Organizar controllers por responsabilidade.
Evitar controllers gigantes.
Evitar duplicação de código.
Usar componentes Blade quando fizer sentido.
## 31. PWA

Preparar estrutura para virar PWA, mas sem complicar demais.

Desejável:

Manifest básico.
Nome do app.
Ícone.
Cor de tema.
Responsividade mobile.
Possibilidade futura de instalar na tela inicial do celular.

Não implementar offline completo agora.

## 32. Seeders

Criar seeders com dados iniciais.

Tipos de equipamento
Computador
Monitor
Nobreak
Scanner
Impressora
Outro
Marcas
Dell
HP
Lenovo
SMS
Epson
Canon
Brother
Outro
Setores
Secretaria
Assessoria
Gabinete
Sala de instruções
Atendimento geral
Arquivo
Recepção
Outro
Cidades/Comarcas de exemplo
Capela
Aracaju
Varas de exemplo

Para Capela:

�snica

Para Aracaju:

1ª Vara
2ª Vara
## 33. Ordem de implementação

Implementar nesta ordem:

Parte 1
migrations
models
seeders
relacionamentos
Parte 2
Form Requests
controllers
rotas
Parte 3
layout base
dashboard
listagem
cadastro comum
edição
detalhes
cadastros auxiliares
Parte 4
tela de levantamento em lote
manutenção dos dados pré-preenchidos após salvar
contador da sessão
últimos cadastrados
Parte 5
instalação do @zxing/browser
arquivo barcode-scanner.js
componente/modal da câmera
integração no levantamento em lote
integração no cadastro comum
integração na consulta por câmera
Parte 6
testes manuais
checklist de funcionamento no celular
orientações para rodar com HTTPS
## 34. Prioridade máxima

A prioridade máxima é o fluxo de campo pelo celular:

Selecionar Cidade/Comarca, Vara, Setor e Tipo
�?' Ler código pela câmera
�?' Salvar
�?' Voltar com os dados preenchidos
�?' Ler próximo equipamento

A tela de levantamento em lote é mais importante do que o cadastro tradicional.

Não implemente funcionalidades avançadas antes de garantir que:

o levantamento em lote funciona;
a câmera funciona no celular;
o código lido preenche codigo_patrimonio;
o equipamento é salvo;
os dados de Cidade/Comarca, Vara, Setor, Tipo, Marca e Modelo permanecem preenchidos;
o código e observações são limpos após salvar;
o usuário consegue continuar lendo o próximo equipamento rapidamente.
## 35. Checklist obrigatório para teste no celular

Depois de implementar, validar:

O sistema abre no celular.
A tela de levantamento em lote é fácil de usar.
O botão Ler próximo equipamento aparece grande e acessível.
A câmera pede permissão.
A câmera traseira é aberta.
O código de barras é lido.
O campo codigo_patrimonio é preenchido automaticamente.
A câmera fecha após a leitura.
O usuário consegue clicar em Salvar e ler próximo.
Após salvar, Cidade/Comarca permanece preenchida.
Após salvar, Vara permanece preenchida.
Após salvar, Setor permanece preenchido.
Após salvar, Tipo de equipamento permanece preenchido.
Após salvar, Marca permanece preenchida.
Após salvar, Modelo permanece preenchido.
Após salvar, Código/patrimônio fica vazio.
Após salvar, Observações ficam vazias.
O contador da sessão aumenta.
O equipamento aparece em últimos cadastrados.
O sistema impede código duplicado.
Se o código já existe, o sistema mostra o equipamento existente.
A consulta por câmera encontra equipamento já cadastrado.
Se o código não existe na consulta, o sistema oferece cadastro com código preenchido.
Se a permissão da câmera for negada, aparece mensagem amigável.
Se estiver fora de HTTPS, aparece orientação correta.
A digitação manual funciona como fallback.
A câmera não fica ligada depois de fechar o scanner.
A tela é confortável para uso em campo pelo celular.
## 36. Observação final

O sistema será usado para levantar muitos equipamentos em sequência.

Não trate como um simples CRUD.

Trate como um sistema de inventário em campo, com foco em velocidade, câmera, celular e repetição de cadastro.

Entregue os arquivos completos necessários e explique onde cada arquivo deve ser colocado.


