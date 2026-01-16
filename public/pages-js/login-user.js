var btn = document.getElementById('login');
var username = document.querySelector('input[name="username"]');
var password = document.querySelector('input[name="password"]');

btn.addEventListener('click',async function(){
  btn.disabled = true;
  await fetch(API_URL+"/user/login",{
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
    
    localStorage.setItem('token',res.data.token)
    btn.disabled = false;
    if(res.statusCode != 200){
      document.getElementById('msg').innerHTML = 'username atau passwor salah !';
      return;
    }
    location.href=URL
  })
  .catch(e=>{
    btn.disabled = false;
  });
})