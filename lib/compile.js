var compiler;
try {
    compiler = require('stylus');
} catch(e) {
    process.stdout.write(e.message);
}

var args = process.argv;
if (args[3]) {
    process.chdir(args[3]);
}

compiler.render(args[2],
    function(e, output) {
        if (e) {
            process.stdout.write('error ' + e);
        } else {
            process.stdout.write('output ' + output);
        }
    }
);


