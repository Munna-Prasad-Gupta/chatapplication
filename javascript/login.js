const form = document.querySelector(".login form"),
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();//preventing form from submitting
}

continueBtn.onclick = ()=>{
    //lets start Ajax
    let xhr = new XMLHttpRequest();//creating XML object
    xhr.open("POST", "php/log.php" , true);
    xhr.onload=()=>{
          if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                
                if(data.trim() == 'success'){
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
               
            }
           
        }
       
    }
    
    // we have to send the form data through ajax to php
    let formData = new FormData(form); //creating new formData Object
    xhr.send(formData);//sending form data to php
}