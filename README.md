
# 
O intuito deste projeto é tentar extrair informações de um conjunto de dados sobre queimadas no Brasil. <br>
Fonte dos dados: Dados públicos

# Biomas que mais sofreram queimadas em 2018

```sql
SELECT bioma_referencial,
(COUNT(1)/(SELECT COUNT(1) FROM queimadas WHERE queimadas_2018 != 0)) * 100 AS media
FROM queimadas
WHERE queimadas_2018 != 0
GROUP BY bioma_referencial
```

<table>
  <thead>
    <tr>
      <th>Bioma Referencial</th>
      <th>Queimadas</th>
    </tr>
  </head>
  <tbody>
    <tr>
      <td>Amazônia</td>
      <td>155.034</td>
    </tr>
    <tr>
      <td>Caatinga</td>
      <td>31.003</td>
    </tr>
    <tr>
      <td>Cerrado</td>
      <td>452.110</td>
    </tr>
    <tr>
      <td>Mata Atlântica</td>
      <td>1.036</td>
    </tr>
  </tbody>
</table>

# Queimadas por coordenação regional em 2018

```sql
SELECT coordenacao_regional,
(COUNT(1)/(SELECT COUNT(1) FROM queimadas WHERE queimadas_2018 != 0)) * 100 AS media
FROM queimadas WHERE queimadas_2018 != 0
GROUP BY coordenacao_regional ORDER BY media DESC
```

<table>
  <thead>
    <tr>
      <th>CR1 Porto Velho/RO</th>
      <th>28.2051</th>
    </tr>
  </head>
  <tbody>
    <tr>
      <td>CR11 Lagoa Santa/MG</td>
      <td>17.9487</td>
    </tr>
    <tr>
      <td>CR3 Santarém/PA</td>
      <td>12.8205</td>
    </tr>
    <tr>
      <td>CR5 Parnaíba/PI</td>
      <td>10.2564</td>
    </tr>
    <tr>
      <td>CR7 Porto Seguro/BA</td>
      <td>7.6923</td>
    </tr>
    <tr>
      <td>CR2 Manaus/AM</td>
      <td>5.1282</td>
    </tr><tr>
      <td>CR10 Cuiabá/MT</td>
      <td>5.1282</td>
    </tr>
    <tr>
      <td>CR4 Belém/PA</td>
      <td>5.1282</td>
    </tr>
    <tr>
      <td>CR8 Rio de Janeiro/RJ</td>
      <td>5.1282</td>
    </tr>
    <tr>
      <td>CR6 Cabedelo/PB</td>
      <td>2.5641</td>
    </tr>
  </tbody>
</table>

# Dashboard para sumarizar as informações mineradas no Dataset
<img src="https://raw.githubusercontent.com/valdiney/IncendiosEmUnidadesDeConservacaoFederais/master/assets/img/img_do_dashboard.png"/>
