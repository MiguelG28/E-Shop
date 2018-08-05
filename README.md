## Classic Parts
## Description

Em relação aos ficheiros php também existem grupos principais, sendo eles o grupo do registo, o grupo do login, o grupo do carrinho de compras e o grupo dos produtos.
O grupo de registo é composto por 3 ficheiros de php, register.php, register_action.php e success.php. No register_action.php , o código correspondente trabalha de forma a que através do $_POST feito no template registo.html os valores de nome, email,..., são enviados aquando efectuado o submit no formulário e são definidos como variáveis.

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/1.png)

Depois valida essas variáveis definidas. Em caso de erro envia um link embebido que vai ser recebido pelo $_GET realizado no ficheiro register.php que enviará uma mensagem de erro ao utilizador. Em caso de sucesso irá criar um novo utilizador com os dados que vêm do registo.html e insere na base de dados. Como disse anteriormente o register.php verifica os erros que se encontram nos links enviados pelo register_action e apresenta uma mensagem de erro ao utilizador, mas também preenche as variáveis do template registo.html com os valores anteriormente inserido pelo utilizador em caso de erro. No success.php é chamado quando o registo é bem-sucedido e preenche o template register_success.html com os valores indicados no php.


O grupo de login também é composto por 3 ficheiros php, login.php, login_action.php e logout.php. O código do fichiero login_action.php funciona de forma a que o seja recebido o email e a palavra passe que são enviados através do $_POST no template login.html.

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/2.png)

Depois vai criar 2 sessões novas, uma com o email de o utilizador e outra com a palavra passe inserida. Com estes dados são efetuados 2 testes, primeiro é verificado se o email se encontra na base de dados e de seguida verificar se a palavra passe inserida corresponde ao email. Se algum destes testes falhar vai emitir um erro através de um link embebido que vai ser recebido pelo login.php. Se tudo correr de acordo com o esperado, então é criada uma nova sessão com os valores da base de dados relativos ao utilizador. O que o login.phh faz importante é transmitir uma mensagem de erro ao utilizador se este violar algumas das restrições implementadas no login_action.php. A forma como é apresentado o erro ao utilizador é através do $GET que é feito. Conforme o valor retornado por essa variável irá apresentar uma mensagem de erro ao utilizador. No logout.php, o que é executado é um session_destroy de forma a terminar a sessão quando o utlizador seleciona a opção de sair.

O grupo de carrinho mais uma vez é composto por 3 ficheiros php, carrinho.php, edita_carrinho.php, apresenta_carrinho.php. No edita_carrinho.php, vão estar implementadas 2 funções principais a de adicionar ao carrinho e a de remover produtos do carrinho. Para a primeira vai verificar se existe um post(roda_protected.html) feito chamado ação, se o value dessa ação é add e se a quantidade desse produto a inserir é maior que 1, se passar essa validação através do roda_protected.html ele vai buscar os valores inseridos no form através do post em que o value é add e o name é ação e vai preencher no array do novo produto com os valores que vêm da pagina do produto singular(roda_protected.html) e por fim vai inserir na sessão onde esta o array com novos produtos o novo produto onde o idprod vai ser o identificador do produto inserido. 

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/3.png)

Em relação à função de remover, vem do carrinho.html onde é verificado se foi feito um post chamado "apagar", se foi, remove do array dos produtos o que possui um identificador igual à variavel idprod que foi selecionada, depois é retirado da sessão o produto que esta no array dos produtos com o id correspondente. 
No apresenta_carrinho.php verifica se existe uma sessão já iniciada com produtos no carrinho, se existir vai à sessão do carrinho com produtos e cria um array que tem as várias componentes dos produtos e define cada elemento desse novo array como variáveis a serem utilizadas para preencher a tabela do carrinho com os produtos que existem no carrinho.
Enquanto passa por cada variável do produto, através do preço de cada produto é constuíd uma nova variável "total", sendo esta a soma do preço de todos os produtos na tabela do carrinho de compras. 
No carrinho.php, o que é feito é que em caso de existir uma sessão iniciada com dado nome de utilizador, redireciona para a pagina do carrinho com o template carrinho_protected.html, em caso de não existir, redireciona para o template carrinho.html e preenche as suas variáveis com os nomes indicados.

O grupo dos produtos e resumidamente constituído pelos 2 principais php desse grupo que são roda.php e prodroda.php/prodescape.php. No prodroda.php, a sua função é construir o template da pagina do produto singular, desta forma tal como dito anteriormente verifica se existe uma sessão com o nome de utilizador ou não e redireciona para o html protected ou para o normal, respetivamente. Em relação ao preenchimento do template com os dados da base de dados relativos ao produto que é selecionado, por exemplo, no index_template.php, o que é realizado é que quando o utilizador seleciona o produto, este botão tem uma referencia para "roda.php?PRODUTO={ID}", assim no roda.php quando é feito  $_GET["PRODUTO"], desta forma vai buscar o id do produto para utilizar na query à base de dados para apresentar a informação relativa ao produto.

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/4.png)

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/5.png)

Por fim, o ultimo elemento do grupo dos produtos que é importante explicar é o prodroda.php/prodescape.php pois estes para além de verificar se existe a sessão com o nome de utilizador e atribuir o template respetivo preenchendo-o, vai criar também a disposição dos produtos na página. Esta disposição é feita através do id que o produto tem na base de dados, sendo assim, é feito um bloco para cada linha, e em cada linha são introduzidos 2 produtos. Desta forma o que o php vai fazer é correr a base de dados e preencher as linhas com as características dos produtos com base no id do produto, como por exemplo: 

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/6.png)

O que esta porção de código irá representar será uma linha com os produtos com o id=10 e 11.

## DataBase

Em relação à base de dados, esta é constituída por 4 tabelas, sendo elas a tabela de “users” que é uma tabela com os dados dos utilizadores, uma tabela chamada “nov”, ou seja, com os novos produtos que são inseridos na base de dados, e por fim duas tabelas que foram construidas para completar a tabela de produtos sendo elas a tabela” disp” e a “tipo”.
Em relação à estrutura, a tabela users é constituída por 13 atributos, sendo que a sua chave primária é um valor que incrementa automaticamente que é o id, ou seja, vai ser um valor que vai distinguir todos os utilizadores.
Em relação à estrutura da tabela nov, possui 7 atributos e tal como a tabela "users", esta também irá possuir um atributo que irá fazer diferir os produtos uns dos outros que é o atributo “id”. Para além desta chave primária, esta tabela irá possuir 2 chaves estrangeiras “disp” e “tipo”.
Por fim temos a tabela “disp” e a “tipo”, na primeira é guardado a referência relativa à disponibilidade (Em Stock/Fora de Stock) de um certo produto. Na segunda o que será guardado é a variedade de tipo de produtos que existe, como por exemplo neste caso em específico irá ser (Roda/Escape). Os atributos de ambas as tabelas irão ser usados como chave estrangeira na tabela nov, de forma a estabelecer e impor um link entre os dados de ambas as tabelas.

![alt text](https://github.com/MiguelG28/E-Shop/blob/master/Examples/7.png)

## Authors

* **Miguel Guerreiro** - [My profile](https://github.com/MiguelG28)

See also the list of [contributors](https://github.com/MiguelG28/Ualg-Eventos/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

