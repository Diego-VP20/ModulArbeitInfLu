document.getElementById('archiveTodo').addEventListener('click', async () => {
    console.log("I was initialised");
    const result = await Swal.fire({
                            title: 'Sind Sie sicher?',
                            icon: 'warning',
                            html: '<b>Nachdem Sie ihr Todo archiviert haben, können Sie ihn nicht mehr sehen.</b>',
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText:'Archivieren',
                            cancelButtonText: 'Nicht archivieren',
                            confirmButtonColor: '#00ff71',
                            cancelButtonColor: '#ff0059'});

    if(result.isConfirmed) {

        window.location.replace('archiveTodo.php?todoID=<?=$row["ID"]?>');

    }



} );
