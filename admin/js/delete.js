function deleteButton(ID){
    event.preventDefault();
    let table = document.getElementById("row-id-"+ID).className;
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          const xhttp = new XMLHttpRequest();
          xhttp.onload = function() {
            document.getElementById("row-id-"+ID).remove();
          }
          xhttp.open("GET", "php_execute/delete.php?id="+ID+"&table="+table);
          xhttp.send();
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
}