from flask import Flask, jsonify
import requests

app = Flask(__name__)

@app.route('/precio_dolar', methods=['GET'])
def obtener_precio_dolar():
    user = 'tomvvalenzuela16@gmail.com'  
    password = 'Tomasito129'  
    timeseries = 'Tipo de cambio nominal (dólar observado $CLP/USD); tipo de cambio; ; precio; diario; ; Banco Central de Chile; ;'
    url = f'https://si3.bcentral.cl/SieteRestWS/SieteRestWS.ashx?user={user}&pass={password}&timeseries={timeseries}&function=GetSeries'

    try:
        response = requests.get(url)
        data = response.json()

        if 'Codigo' in data and data['Codigo'] == 0:
            precio_dolar = float(data['Series']['Obs'][0]['value'])
            precio_clp = precio_dolar  

            return jsonify({'precio_clp': precio_clp})
        else:
            return jsonify({'error': 'No se pudo obtener el precio del dólar'})
    except Exception as e:
        return jsonify({'error': f'Error al conectar con la API: {str(e)}'})

if __name__ == '__main__':
    app.run(debug=True)
