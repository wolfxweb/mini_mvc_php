



function Rota(rota){

    const rotasSistemas =[
        'home',
        'sobre_nos',
        'cadastro_usuario',
        'adicionar_usuario',
        'adm',
        'adm/categorias',
        'adm/unidade_medida',
        'adm/fabricante',
        'adm/produto',
        'adm/cadastro_categoria'


    ]
    const baseUrl = 'http://localhost:8000/'
    let url = baseUrl + rota;
    let url404 = baseUrl+'404'
    if(rotasSistemas.includes(rota)){
        window.location.replace(url);  
    }else{
        window.location.replace(url404);  
    }
    console.log(rotasSistemas.includes(rota))
   // window.location.replace(url);   
}