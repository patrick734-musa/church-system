const express = require('express');
const router = express.Router();
const mysql = require('mysql2');
const { promisify } = require('util');

// MySQL connection configuration
const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root', // Your MySQL username
    password: '', // Your MySQL password
    database: 'churchRecords'
});
const promisePool = connection.promise();

router.post('/register-event', async (req, res) => {
    const { date, name, location } = req.body;

    try {
        const [result] = await promisePool.query(
            'INSERT INTO events (date, name, location) VALUES (?, ?, ?)',
            [date, name, location]
        );
        res.json({ success: true, message: 'Event registered successfully!', eventId: result.insertId });
    } catch (err) {
        console.error('Database error:', err);
        res.status(500).json({ success: false, message: 'Failed to register event.' });
    }
});

router.get('/events', async (req, res) => {
    try {
        const [rows] = await promisePool.query('SELECT * FROM events ORDER BY date DESC');
        res.json(rows);
    } catch (err) {
        console.error('Database error:', err);
        res.status(500).json({ error: 'Failed to fetch events.' });
    }
});

module.exports = router;
