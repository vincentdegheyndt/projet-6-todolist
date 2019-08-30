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

            li.onclick = check;
            document.getElementById("todoList").appendChild(li);
            activity.value = "";
            console.log(reponse.id)
        }
    }

})
function check(){
    this.classList.toggle("checked");
    this.check == false? this.check = true : this.check=false;
    console.log(this.check)
};
function checkStart(target) {
    target.classList.toggle("checked");
    target.check == false? target.check = true : target.check=false;
    console.log(target.check)
}


document.getElementById("addArchive").addEventListener('click', (e)=>{
    e.preventDefault();
    let archived = document.querySelectorAll("li.checked");


    archived.forEach(element => {
        document.getElementById("archive").appendChild(element);
        element.onclick="";
        element.archive=true;

        const update = new XMLHttpRequest();

        update.open("POST","edit.php", true);
        // important sinon php ne sait pas à quoi il a affaire
        update.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    
        update.send("edit="+JSON.stringify(archived));
        
        update.onreadystatechange = function(event){//déclenché par la fin ded l'éxécution du php
            if(this.readyState === XMLHttpRequest.DONE){
                document.getElementById("response").innerHTML = update.responseText
                //location.reload();
                console.log(archived)
            }
        }
/*
        formData.append('data',element)

        fetch('formulaire.php', {
            method:'post',
            body:formData
        })
*/
    });
})




