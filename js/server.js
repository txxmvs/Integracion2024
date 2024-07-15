const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(bodyParser.json());
app.use(cors());

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'Tomasito129',
    database: 'bd_ferramas'
});

db.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL:', err);
        throw err;
    }
    console.log('Conectado a la base de datos MySQL');
});

app.get('/api/products', (req, res) => {
    console.log('GET /api/products called');
    const sql = 'SELECT * FROM producto';
    db.query(sql, (err, results) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error fetching products' });
            return;
        }
        res.json(results);
    });
});

app.get('/api/products/:id', (req, res) => {
    console.log(`GET /api/products/${req.params.id} called`);
    const sql = 'SELECT * FROM producto WHERE producto_id = ?';
    db.query(sql, [req.params.id], (err, result) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error fetching product' });
            return;
        }
        if (result.length === 0) {
            return res.status(404).json({ message: 'Producto no encontrado' });
        }
        res.json(result[0]);
    });
});

app.post('/api/products', (req, res) => {
    console.log('POST /api/products called');
    const newProduct = req.body;
    const sql = 'INSERT INTO producto SET ?';
    db.query(sql, newProduct, (err, result) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error creating product' });
            return;
        }
        res.status(201).json({ producto_id: result.insertId, ...newProduct });
    });
});

app.put('/api/products/:id', (req, res) => {
    console.log(`PUT /api/products/${req.params.id} called`);
    const sql = 'UPDATE producto SET ? WHERE producto_id = ?';
    db.query(sql, [req.body, req.params.id], (err) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error updating product' });
            return;
        }
        res.json({ message: 'Producto actualizado' });
    });
});

app.delete('/api/products/:id', (req, res) => {
    console.log(`DELETE /api/products/${req.params.id} called`);
    const sql = 'DELETE FROM producto WHERE producto_id = ?';
    db.query(sql, [req.params.id], (err) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error deleting product' });
            return;
        }
        res.status(204).send();
    });
});

app.get('/api/trabajadores', (req, res) => {
    console.log('GET /api/trabajadores called');
    const sql = 'SELECT * FROM trabajador';
    db.query(sql, (err, results) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error fetching workers' });
            return;
        }
        res.json(results);
    });
});

app.delete('/api/trabajadores/:id', (req, res) => {
    console.log(`DELETE /api/trabajadores/${req.params.id} called`);
    const sql = 'DELETE FROM trabajador WHERE trabajador_id = ?';
    db.query(sql, [req.params.id], (err) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error deleting worker' });
            return;
        }
        res.status(204).send();
    });
});

app.post('/api/trabajadores', (req, res) => {
    console.log('POST /api/trabajadores called');
    const newTrabajador = req.body;
    const sql = 'INSERT INTO trabajador SET ?';
    db.query(sql, newTrabajador, (err, result) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error creating worker' });
            return;
        }
        res.status(201).json({ trabajador_id: result.insertId, ...newTrabajador });
    });
});

app.get('/api/usuarios', (req, res) => {
    console.log('GET /api/usuarios called');
    const sql = 'SELECT * FROM usuario';
    db.query(sql, (err, results) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error fetching users' });
            return;
        }
        res.json(results);
    });
});

app.delete('/api/usuarios/:id', (req, res) => {
    console.log(`DELETE /api/usuarios/${req.params.id} called`);
    const sql = 'DELETE FROM usuario WHERE usuario_id = ?';
    db.query(sql, [req.params.id], (err) => {
        if (err) {
            console.error('Error executing query:', err);
            res.status(500).json({ error: 'Error deleting user' });
            return;
        }
        res.status(204).send();
    });
});

app.listen(3000, () => {
    console.log('Servidor corriendo en el puerto 3000');
});