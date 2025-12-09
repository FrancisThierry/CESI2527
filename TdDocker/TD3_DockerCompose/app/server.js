const http = require('http');
// L'hôte 'redis' est automatiquement résolu par Docker Compose
const redisHost = 'redis';
const redisPort = 6379;

const requestListener = function (req, res) {
  res.writeHead(200, { 'Content-Type': 'text/plain' });
  res.end(`Hello World from Node.js!\nTrying to connect to Redis at ${redisHost}:${redisPort}...\n`);
};

const server = http.createServer(requestListener);
server.listen(8080, () => {
  console.log('Server is running on http://localhost:8080');
  console.log(`Expecting Redis service at: ${redisHost}`);
});