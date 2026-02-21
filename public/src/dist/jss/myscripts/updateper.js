
        function stateu(cell) {

            var gid = cell.getAttribute('data-id');
            var vali= cell.getAttribute('data-vali');
            
          //alert(gid +" from "+vali);

          Swal.fire({
  title: "Do you want To Change Group Permission Status?",
  text: "You can redo this Afterwards!",
  icon: "info",
  showCancelButton: true,
  confirmButtonColor: "#FF9F43",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, Change"
}).then((result) => {
  if (result.isConfirmed) {
    
    axios.post('/group/update', {
           gid: gid,
           vali: vali
           
           
        })
        .then(function (response) {
            //console.log(response.data);
            
        })
        .catch(function (error) {
            //console.log(error);
        });
    
  }
});

     
    }


    
    function changestate(cell) {
 
      var gid = document.getElementById('gid').value;
      var descr= document.getElementById('descr').value;
      var vali= cell.getAttribute('data-value');
      var state= cell.getAttribute('data-state');
      
    //alert(gid +" from "+vali);

   
axios.post('/changestate', {
     gid: gid,
     vali: vali,
     state: state,
     descr: descr
     
     
  })
  .then(function (response) {
      console.log(response.data);
      
  })
  .catch(function (error) {
      console.log(error);
  });



}
