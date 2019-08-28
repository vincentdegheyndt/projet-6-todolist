document.getElementById("addTask").addEventListener('click', (e)=>{
    e.preventDefault();
    let activity = document.getElementById("activity");
    let newTask = new Object();
    newTask.id = 0,
    newTask.text = activity.value,
    newTask.check = false,
    newTask.archive = false
    //AJAX vers formulaire.php pour sanitiastion et mis-à-jour du json
    const req = new XMLHttpRequest();

    req.open("POST","formulaire.php", true);
    // important sinon php ne sait pas à quoi il a affaire
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

    req.send("data="+JSON.stringify(newTask));
    
    req.onreadystatechange = function(event){//déclenché par le echo dataSend
        if(this.readyState === XMLHttpRequest.DONE){
            let reponse = JSON.parse(this.responseText);
            let li = document.createElement("LI");
            let textnode = document.createTextNode(reponse.text);
            li.appendChild(textnode);
            li.onclick = function check(){
                li.classList.toggle("checked")
                console.log(li.className)
            };
            document.getElementById("todoList").appendChild(li);
            activity.value = "";
            console.log(reponse.id)

        }
    }

})


