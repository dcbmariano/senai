const frontend = "http://localhost:8888/";  // endereço do front-end
const backend = "http://localhost:7777/";  // endereço do back-end

let pagina = document.URL.split("/"); // lê a url atual
pagina = pagina[pagina.length-1];

if(pagina==''){pagina=1}

const url = backend+"livros/listar/"+pagina;

const metodo = "GET";

const xhr = new XMLHttpRequest();
xhr.open(metodo, url);

xhr.onreadystatechange = ()=>{

    if((xhr.status == 200)&&(xhr.readyState == 4)){
        let resposta = xhr.response;
        resposta = JSON.parse(resposta);
        
        let tabela = document.querySelector("#tabela tbody");

        resposta.forEach((i)=>{
           // console.log(i);
            tabela.innerHTML += `
            <tr>
                <td>${i.id}</td>
                <td>${i.titulo}</td>
                <td>${i.autor}</td>
                <td>${i.isbn}</td>
                <td>${i.paginas}</td>
                <td>${i.ano}</td>
                <td>
                    <a href="${frontend}editar/${i.id}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                </td>
                <td>
                    <a href="${frontend}deletar/${i.id}">
                        <i class="bi bi-x-circle-fill"></i>
                    </a>
                </td>
            </tr>`;
        });
        
    }
}

xhr.send();


const buscar = ()=>{

    if(event.key === 'Enter') {
        const query = document.querySelector("#buscar").value;

        if(query == ''){
            document.location.reload(true);
        }
        let url = backend+"livros/buscar/query?itens_por_pagina=500&";

        if(query.split('autor:').length > 1){
            url+= "autor="+query.split('autor:')[1];
        }
        else if(query.split('isbn:').length > 1){
            url+= "isbn="+query.split('isbn:')[1];
        }
        else if(query.split('ano:').length > 1){
            let ano = query.split('ano:')[1];
            let ano_inicio = ano.split('-')[0];
            let ano_fim = ano.split('-')[1];
            url+= "ano_inicio="+ano_inicio+"&ano_fim="+ano_fim;
        }
        else{
            url+= "titulo="+query;
        }

        console.log(url);
        const metodo = "GET";

        const xhr = new XMLHttpRequest();
        xhr.open(metodo, url);

        xhr.onreadystatechange = ()=>{

            if((xhr.status == 200)&&(xhr.readyState == 4)){
                let resposta = xhr.response;
                resposta = JSON.parse(resposta);
                
                let tabela = document.querySelector("#tabela tbody");
                tabela.innerHTML = '';
                let cont = 0;
                resposta.forEach((i)=>{
                    cont++;
                    console.log(i);
                    tabela.innerHTML += `
                    <tr>
                        <td>[${cont}] ${i.id}</td>
                        <td>${i.titulo}</td>
                        <td>${i.autor}</td>
                        <td>${i.isbn}</td>
                        <td>${i.paginas}</td>
                        <td>${i.ano}</td>
                        <td>
                            <a href="${frontend}editar/${i.id}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>
                        <td>
                            <a href="${frontend}deletar/${i.id}">
                                <i class="bi bi-x-circle-fill"></i>
                            </a>
                        </td>
                    </tr>`;
                });
                
            }
        }

        xhr.send();
    }
}

// habilitar balões de ajuda
const exampleEl = document.getElementById('ajuda');
const popover = new bootstrap.Popover(exampleEl, {'trigger':'hover', 'html':true})