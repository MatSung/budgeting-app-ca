'use strict';

import fetchData from "./js/connectionHandler.js";

let tbody = document.getElementById('data-tbody');
let negativeClass = 'bg-red-200';
let positiveClass = 'bg-green-200';
let entryContents = ['date_time', 'group', 'amount', 'note', 'actions'];

const apiUrl = 'api/v1/';

function generateButton(type){
    let a = document.createElement('a');
    a.href = '#';
    a.classList.add(type+'-button');
    let img = document.createElement('img');
    img.classList.add('w-4','inline-block');
    img.src = 'icons/' + type + '.svg';
    img.alt = type;
    a.append(img);
    return a;
}

function generateButtonDiv(...buttons){
    let div = document.createElement('div');
    div.classList.add('flex', 'gap-4', 'justify-end', 'pr-4');
    buttons.forEach(element => {
        div.append(generateButton(element));
    });
    return div;
}

function entryFactory(content) {
    let tr = document.createElement('tr');
    tr.classList.add(
        content.amount < 0 ? negativeClass : positiveClass,
        'border-b-2'
        
    );
    tr.id = 'entry-' + content.id;

    let tdArr = [];
    for (let i = 0; i < entryContents.length; i++) {
        let td = document.createElement('td');
        td.classList.add('p-2');
        tr.append(td);
        tdArr.push(td);
    }

    tdArr[0].textContent = content.date_time;
    tdArr[1].textContent = content.type;
    tdArr[2].classList.add('pl-2');
    tdArr[2].textContent = Math.abs(content.amount);
    tdArr[3].textContent = content.note;
    tdArr[4].append(generateButtonDiv('edit','delete'));

    return tr;

}

function populateTable(data) {
    data.forEach(element => {
        tbody.append(entryFactory(element));
    });
    let sum = 0;
    for (let i = 0; i < data.length; i++) {
        sum += parseFloat(data[i].amount);
    }
    sum = sum.toFixed(2);
    console.log(sum);
    let finalTr = document.createElement('tr');
    finalTr.classList.add('bg-slate-300', 'border-b-2', 'text-gray-500');
    tbody.append(finalTr);
    for (let i = 0; i < entryContents.length; i++) {
        let td = document.createElement('td');
        td.classList.add('pb-2');
        finalTr.append(td);
    }

    if(sum == 0){
        finalTr.children[2].textContent = '±0';
    } else {
        finalTr.children[2].textContent = (sum > 0) ? '+' + sum : sum;
    }
    
    finalTr.children[4].append(generateButtonDiv('add'));
    finalTr.children[4].classList.add('pr-2');
}

async function handleApi(target = 'entries') {
    return await fetchData(target);
    // timeout and error handling
}

async function initTable() {
    let apiDetails = await handleApi();
    console.log(apiDetails);
    populateTable(apiDetails.results);
}

function generateForm(){
    console.log('generate me');
};


window.addEventListener('DOMContentLoaded', () => {
    initTable();
    document.getElementById('add-button').addEventListener('click', ()=>{
        generateForm();
    });
});

