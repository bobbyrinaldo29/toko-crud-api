'use strict';

const fs = require('fs');

process.stdin.resume();
process.stdin.setEncoding('utf-8');

let inputString = '';
let currentLine = 0;

process.stdin.on('data', function(inputStdin) {
    inputString += inputStdin;
});

process.stdin.on('end', function() {
    inputString = inputString.split('\n');

    main();
});

function readLine() {
    return inputString[currentLine++];
}

/*
 * Complete the 'timeInWords' function below.
 *
 * The function is expected to return a STRING.
 * The function accepts following parameters:
 *  1. INTEGER h
 *  2. INTEGER m
 */

function timeInWords(h, m) {
        const nums =['','one','two','three','four','five','six','seven','eight','nine','ten','eleven','twelve','thirteen','fourteen','quarter','sixteen','seventeen','eighteen','nineteen', 'twenty', 'twenty one', 'twenty two', 'twenty three', 'twenty four', 'twenty five','twenty six', 'twenty seven', 'twenty eight', 'twenty nine', 'half'];
    let inWords = '';
    if(m === 0){
        inWords = (nums[h] + ' o\' clock')
    } else if(m === 1) {
        inWords = (nums[m] + ' minute past ' + nums[h])
    } else if(m === 15 || m === 30) {
        inWords = (nums[m] + ' past ' + nums[h])
    } else if(m === 45) {
        inWords = (nums[60-m] + ' to ' + nums[h+1])
    } else if(m < 30) {
        inWords = (nums[m] + ' minutes past ' + nums[h])
    } else {
        inWords = (nums[60-m] + ' minutes to ' + nums[h+1])
    }
    return inWords;

}

function main() {
    const ws = fs.createWriteStream(process.env.OUTPUT_PATH);

    const h = parseInt(readLine().trim(), 10);

    const m = parseInt(readLine().trim(), 10);

    const result = timeInWords(h, m);

    ws.write(result + '\n');

    ws.end();
}
