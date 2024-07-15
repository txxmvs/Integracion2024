import requests

user = 'tomvvalenzuela16@gmail.com' 
password = 'Tomasito129' 
timeseries = 'Tipo de cambio nominal (dólar observado $CLP/USD); tipo de cambio; ; precio; diario; ; Banco Central de Chile; ;'
first_date = '2022-04-01'
last_date = '2022-04-30'

url = f'https://si3.bcentral.cl/SieteRestWS/SieteRestWS.ashx?user={user}&pass={password}&firstdate={first_date}&lastdate={last_date}&timeseries={timeseries}&function=GetSeries'

try:
    response = requests.get(url)
    data = response.json()
    print(data)
except Exception as e:
    print(f'Error al conectar con la API: {str(e)}')
