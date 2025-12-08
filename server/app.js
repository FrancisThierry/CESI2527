const http = require('http');
const https = require('https');
const fs = require('fs');
const path = require('path');

const server = http.createServer((req, res) => {
    // Reverse proxy pour les ressources externes
    if (req.url === '/weweb.css') {
        const proxyUrl = 'http://172.26.152.177/weweb.css';
        
        http.get(proxyUrl, (proxyRes) => {
            res.writeHead(proxyRes.statusCode, proxyRes.headers);
            proxyRes.pipe(res);
        }).on('error', (err) => {
            res.writeHead(500, { 'Content-Type': 'text/plain' });
            res.end('Erreur proxy');
        });
        return;
    }
    
    // Servir index.html par défaut
    const filePath = path.join(__dirname, 'index.html');
    
    fs.readFile(filePath, 'utf8', (err, data) => {
        if (err) {
            res.writeHead(500, { 'Content-Type': 'text/plain' });
            res.end('Erreur serveur');
            return;
        }
        
        res.writeHead(200, { 'Content-Type': 'text/html' });
        res.end(data);
    });
});

const PORT = 3001;
server.listen(PORT, () => {
    console.log(`Serveur en écoute sur http://localhost:${PORT}`);
});