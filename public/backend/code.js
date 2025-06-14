$(function(){
  $(document).on('click','#delete',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Estás seguro?',
      text: "Eliminar estos datos?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Eliminado!',
          'Los datos han sido eliminados.',
          'success'
        )
      }
    })
  });
});

$(function(){
  $(document).on('click','#ApproveBtn',function(e){
    e.preventDefault();
    var link = $(this).attr("href");
    Swal.fire({
      title: 'Estás seguro?',
      text: "Aprobar estos datos?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, aprobar!',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = link
        Swal.fire(
          'Aprobar!',
          'Los datos han sido aprobados.',
          'success'
        )
      }
    })
  });
});
