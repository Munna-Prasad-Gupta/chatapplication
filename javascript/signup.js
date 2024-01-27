const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input");
errorText = form.querySelector(".error-text");

form.onsubmit = (e)=>{
    e.preventDefault();//preventing form from submitting
}

continueBtn.onclick = ()=>{
    //lets start Ajax
    let xhr = new XMLHttpRequest();//creating XML object
    xhr.open("POST", "php/signup.php" , true);
    xhr.onload=()=>{
          if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                console.log(data);
                // console.log("i have arrived inside 2nd if");
                if(data.trim() == 'succeeded'){
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
               
            }
           
        }
       
    }
    // console.log("i am out of function onload");
    // we have to send the form data through ajax to php
    let formData = new FormData(form); //creating new formData Object
    xhr.send(formData);//sending form data to php
}