function deleteRegistroPaginacao(rotaUrl, idDoRegistro) {
    if (confirm('Deseja excluir o registro?')){
        $.ajax({
            url: rotaUrl,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {
                id: idDoRegistro,
            },
            beforeSend: function () {
                $.blockUI({
                    message: 'Carregando...',
                    timeout: 200,
                });
            },
        }).done(function(data){
            $.unblockUI();
            if(data.success == true){
                window.location.reload();
            } else{
                alert('Não foi possível deletar os dados');
            }

        }).fail(function(data){
            $.unblockUI();
            alert('Não foi possível buscar os dados');
        });

    }
}

$('#mascara_valor').mask('#.##0,00', { reverse: true})