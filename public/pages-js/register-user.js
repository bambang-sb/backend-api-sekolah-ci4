var btn = document.getElementById('register');
var username = document.querySelector('input[name="username"]');
var password = document.querySelector('input[name="password"]');

btn.addEventListener('click',async function(){
  btn.disabled = true;
  await fetch(API_URL+"/user/register",{
    method:"POST",
    headers:{
      "Content-Type":"application/json"
    },
    body:JSON.stringify({
      "username":username.value,
      "password":password.value
    })
  })
  .then(response=>response.json())
  .then(res=>{
    btn.disabled = false;
    if(res.statusCode != 201){
      document.getElementById('msg').innerHTML = res.errors.username+" "+res.message;
      return
    }
    location.href=URL+'/login';
  })
  .catch(e=>{
    btn.disabled = false;
  });
})