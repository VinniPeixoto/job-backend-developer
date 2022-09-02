<p align="center"><a href="https://yampi.com.br" target="_blank"><img src="https://icons.yampi.me/svg/brand-yampi.svg" width="200"></a></p>

# Teste prático para Back-End Developer
***

Obrigado pela oportunidade!

Abaixo segue o endpoint para a busca, criação, edição ou exclusão de um produto.

## Create
metodo ``POST``
```bash
http://localhost:8000/api/product/store
```
json:
```bash
{
    "name": "product name",
    "price": 109.95,
    "description": "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...",
    "category": "test",
    "image": "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg"
}
```
---
## Find
metodo ``GET``

```bash
http://localhost:8000/api/product/find
```
json:
```bash
{
    "name": "product name"
}
```
Nesse método é possível adicionar mais parâmetros como "````category````" ou "````image````". Ex:
```bash
{
    "name": "product name",
    "category": "test",
    "image": true
}
```
Para verificar se o produto existe ou não uma imagem, basta adicionar ````true```` ou ````false```` no campo ````image````.

---
## Update
metodo ``PUT|PATCH``

```bash
http://localhost:8000/api/product/update
```

json:
```bash
{
    "name": "product name",
    "price": 109.95,
    "description": "Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...",
    "category": "test",
    "image": "https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg"
}
```
---
## Delete
metodo ``DELETE``

```bash
http://localhost:8000/api/product/delete/1
```
após o parametro ``delete/`` basta adicionar o ID do produto.

---
Qualquer dúvida, estou a disposição!
