## Classic Parts
## Description

Em relação ao php também existem grupos principais, sendo eles o grupo do registo, o grupo do login, o grupo do carrinho de compras e o grupo dos produtos.
O grupo de registo é composto por 3 ficheiros de php, register.php, register_action.php e success.php. No register_action.php , o código o que faz é ir buscar através do $_POST feito no template registo.html os valores de nome, email,..., através do submit que é feito no fim formulário (registo.html) e são definidos como variáveis, e defini-los como variáveis.

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/1.png)

Depois valida essas variáveis definidas e em caso de erro envia um link embebido que vai ser recebido pelo $_GET realizado register.php que enviará uma mensagem de erro ao utilizador, em caso de sucesso irá criar um novo utilizador com os dados que vêm do registo.html e insere na base de dados. Como disse anteriormente o register.php verifica os erros que vai buscar aos links enviados pelo register_action e dá uma mensagem de erro ao utilizador, preenche também as variáveis do template registo.html com os valores anteriormente inserido pelo utilizador em caso de erro. No success.php é chamado quando o registo é bem-sucedido e preenche o template register_success.html com os valores indicados no php.


O grupo de login é também composto por 3 ficheiros php, login.php, login_action.php e logout.php. No login_action.php o código vai buscar o email e a palavra passe que são enviados através do $_POST no template login.html com o submit tem no fim do formulario. 

2

Depois vai criar 2 sessoes novas uma com o email de o utilizador e outra com a palavra passe inserida e continua fazendo 2 testes aos valores que o utilizador insere, verificando se o email se encontra na base de dados e de seguida verificar se a palavra passe inserida corresponde ao email. Se algum destes testes falhar vai emitir um erro através de um link embebido que vai ser recebido pelo login.php. Se tudo correr de acordo com o esperado, então é criada uma nova sessão com os valores da base de dados relativos ao utilizador. O que o login.ph faz importante é transmitir uma mensagem de erro ao utilizador se este violar algumas das restrições implementadas no login_action.php, a forma como ele vê que erro existiu é definindo o $GET do erro como uma variável, e depois conforme o valor dessa variável apresenta uma mensagem de erro ao utilizador. No logout.php, o que é executado é um session_destroy de forma a terminar a sessão quando o utlizador seleciona a opção de sair.

O grupo de carrinho mais uma vez é composto por 3 ficheiros php, carrinho.php, edita_carrinho.php, apresenta_carrinho.php. No edita_carrinho.php, vão estar implementadas 2 funções principais a de adicionar ao carrinho e a de remover produtos do carrinho. Para a primeira vai verificar se existe um post(roda_protected.html) feito chamado acao e também se o value dessa acao for add e se a quantidade desse produto a inserir é maior que 1, se passar essa validação através do roda_protected.html ele vai buscar os valores feitos no form com o post em que o value é add e o name é ação e vai preencher no array do novo produto com os valores que vêm da pagina do produto singular(roda_protected.html) e por fim vai inserir na sessão onde esta o array com novos produtos o novo produto onde o idprod vai ser o identificador do produto inserido. 

3

Já na função de remover que vem do carrinho.html e verifica se foi feito um post chamado apagar, se foi, remove do array dos produtos os que estão com identificador idprod que é selecionado e com array das remoções e feita uma variável com o id do produto que é para ser removido, depois é tirado da sessão o produto que esta no array dos produtos com o id correspondente. No apresenta_carrinho.php para além de preencher as variáveis, verifica se existe uma sessão já iniciada com produtos no carrinho, se existir vai à sessão com o carrinho com produtos e define um array que tem as várias componentes dos produtos e define cada elemento desse novo array como incógnitas a serem utilizadas para preencher a tabela do carrinho com os produtos que existem no carrinho.
Enquanto passa por cada variável de cada produto, vai utilizar a variável preço para construir a nova variável total, sendo esta ultima a soma do preço de todos os produtos na tabela do carrinho de compras. No carrinho.php o que faz é, em caso de existir uma sessão iniciada com o nome de utilizador redireciona para a pagina do carrinho com o template carrinho_protected.html, em caso de não existir, redireciona para o template carrinho.html e preenche as suas variáveis com os nomes indicados.

O grupo dos produtos e resumidamente constituído pelos 2 principais php desse grupo que são roda.php e prodroda.php/prodescape.php. No roda.php, a sua função é construir o template da pagina do produto singular, desta forma tal como dito anteriormente verifica se existe uma sessao com o nome de utilizador ou não e redireciona para o html protected ou para o normal, respetivamente. Em relação ao preenchimento do template com os dados da base de dados relativos ao produto que é selecionado, por exemplo, no índex_template.php, o que é realizado é que quando o utilizador seleciona o botão do produto este botam tem uma referencia para "roda.php?PRODUTO={ID}", assim no roda.php quando é feito  $_GET["PRODUTO"], vai buscar o id do produto e assim pode fazer uma query à base de dados de forma a ir buscar a informação relativa ao produto.

4

5

Por fim, o ultimo elemento do grupo dos produtos que é importante explicar é o prodroda.php/prodescape.php pois este para além de verificar se existe a sessão com o nome de utilizador e atribuir o template respetivo preenchendo-o, vai criar também a disposição dos produtos na página. Esta disposição é feita através do id que o produto tem na base de dados, sendo assim, é feito um bloco para cada linha, e em cada linha são introduzidos 2 produtos. Desta forma o que o php vai fazer é correr a base de dados e preencher as linhas com as características dos produtos relativos ao id, como por exemplo: 

6

O que esta porção de código irá representar será
uma linha com os produtos com o id=10 e 11.

## DataBase

Em relação à base de dados, esta é constituída por 4 tabelas, sendo elas a tabela de “users” que é uma tabela com de utilizadores, uma tabela chamada “nov”, ou seja, com os novos produtos que são inseridos na base de dados, e por fim duas tabelas que foram construídas para serem usadas na tabela “nov” como foreign key sendo elas a tabela” disp” e a “tipo”.
Em relação à estrutura, a tabela users é constituída por 13 atributos, sendo que chave primária é um valor que incrementa automaticamente com o nome de id, ou seja, vai ser um valor que vai distinguir todos os utilizadores.
Em relação à estrutura da tabela nov, possui 7 atributos e tal como a tabela que guarda os utilizadores registados, esta irá também possuir um atributo que irá fazer diferir os produtos uns dos outros que é o atributo “id”. Para além desta chave primária, esta tabela irá possuir 2 chaves estrangeiras “disp” e “tipo”.
Por fim temos a tabela “disp” e a “tipo”, na primeira é guardado a referência relativa à disponibilidade (Em Stock/Fora de Stock) de um certo produto. Na segunda o que será guardado é a variedade de tipo de produtos que existe, como por exemplo neste caso em específico irá ser (Roda/Escape). Os atributos de ambas as tabelas irão ser usados como chave estrangeira na tabela nov, de forma a estabelecer e impor um link entre os dados em duas tabelas.

7

## Authors

* **Miguel Guerreiro** - [My profile](https://github.com/MiguelG28)

See also the list of [contributors](https://github.com/MiguelG28/Ualg-Eventos/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

