const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
const port = 3000; // Your server port

// MySQL connection configuration
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root', // Your MySQL username
    password: '', // Your MySQL password
    database: 'churchRecords'
});

connection.connect((err) => {
    if (err) throw err;
    console.log('Connected to MySQL database.');
});

app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());
app.use(cors()); // Allow CORS for frontend requests

// Rou('/register-event', (req, res) => {
    const { date, name, location } = req.body;

    const query = 'INSERT INTO events (date, name, location) VALUES (?, ?, ?)';
    connection.query(query, [date, name, location], (err, results) => {
        if (err) {
            res.json({ success: false, message: 'Failed to register event.' });
        } else {
            res.json({ success: true, message: 'Event registered successfully!' });
        }
    });
});

// Route to fetch events
app.get('/events', (req, res) => {
    const query = 'SELECT * FROM events ORDER BY date DESC';
    connection.query(query, (err, results) => {
        if (err) {
            res.status(500).json({ error: 'Failed to fetch events.' });
        } else {
            res.json(results);
        }
    });
});

app.listen(port, () => {
    console.log(`Server is running on http://localhost:${port}`);
});te to handle event registration
app.post
