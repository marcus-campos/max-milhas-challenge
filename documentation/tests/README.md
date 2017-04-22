# Testes com PHPUnit

Acesse o diretório da aplicação clonada.

Dentro do diretório da aplicação execute o seguinte comando:

```
phpunit [caminho_do_teste] --bootstrap=[caminho_do_arquivo_bootstrap]
```

Ex:

```
phpunit tests/UploadTest.php --bootstrap=tests/bootstrap.php
```

###Outras formas de executar

```
vendor/bin/phpunit [caminho_do_teste]
```

Ex:
```
vendor/bin/phpunit tests/UploadTest.php
```