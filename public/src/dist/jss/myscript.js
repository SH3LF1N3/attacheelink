function displaydata(cell){

    var num= cell.getAttribute('data-num');

//alert(num);

document.getElementById('dis').append(num);
document.getElementById('dis2').append().value = num;

}

function cleardis(){

    document.getElementById('dis').innerHTML = '';

    var link = document.getElementById('dis');
    var text = link.innerHTML;
    var length = text.length;
    
  
        if (text.length > 0) {
            text = text.slice(0, -1); // Remove the last character
            link.innerHTML = text;
            //setTimeout(clearText, 100); // Adjust speed of clearing here (100ms)
        }
    

}


function login() {
 
    var selectElement = document.getElementById('cash');
    // Get the selected value
    var cid = selectElement.value;

    var pin= document.getElementById('dis').innerText;
    var sid= document.getElementById('sid').value;
    var stid= document.getElementById('stid').value;
   
    
  //alert(stid);

 
axios.post('/slogin', {
   cid: cid,
   pin: pin,
   sid: sid,
   stid: stid
   
   
})
.then(function (response) {
    window.location.href = "/dashboard";
    console.log(response.data);
    
})
.catch(function (error) {
   window.location.href = "/dashboard";
    console.log(error);
});



}
 /*window.addEventListener('load', function() {
    Redirect to another page
    window.location.href = 'https://www.example.com/new-page';
});

function copyText() {
    // Select the input element
    var input = document.getElementById('myInput');
    
    // Select the text inside the input element
    input.select();
    input.setSelectionRange(0, 99999); // For mobile devices
    
    // Copy the selected text
    document.execCommand('copy');
    
    // Deselect the input field
    input.blur(); // Optional: Unselect the input field after copying
}

*/

