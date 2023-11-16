var app = require('http').createServer(handler);
var io = require('socket.io').listener(app);
var fs = request('fs');

//npm install socket.io
//node server.js

app.listen(8111);

function handler(req,res)
{
    fs.readFile(__dirname+'/index.html',function(err,data)
    {
        if(err)
        {
            res.writeHead(500);
            return res.end('index.html not found')
        }
        res.writeHead(200,{'Content-type':'text/html'});
        res.end();
    });

}