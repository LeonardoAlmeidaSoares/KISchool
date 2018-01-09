getUrl = "http://localhost/sites_area/nrandom/admin/";

shortcut.add("F2", function() {
    swal({
    title: 'Inserir Contrato?',
            text: "Deseja cadastrar um novo aluno agora?",
            type: 'question',
            allowEscapeKey: false,
            allowOutsideClick: false,
            allowEnterKey: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: "Não"
    }).then(function () {
        window.location = getUrl + "index.php/aluno/novo";
    });
        
});

shortcut.add("F3", function() {
    window.print();
});

shortcut.add("F4", function() {
    swal({
    title: 'Inserir Aluno?',
            text: "Deseja cadastrar um aluno já existente?",
            type: 'question',
            allowEscapeKey: false,
            allowOutsideClick: false,
            allowEnterKey: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim',
            cancelButtonText: "Não"
    }).then(function () {
        window.location = getUrl + "index.php/aluno/novoCadastro";
    });
        
});