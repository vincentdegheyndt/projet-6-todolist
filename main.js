

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
            if (this.responseText == 0){
                alert("Champ vide")
            }else{
                let reponse = JSON.parse(this.responseText);
                let li = document.createElement("LI");
                let textnode = document.createTextNode(reponse.text);
                li.appendChild(textnode);
                li.id = reponse.id;
                li.onclick = function(){
                        this.classList.toggle("checked");
                        this.check == false? this.check = true : this.check=false;
                        console.log(this.check);
                };
                li.classList.add('column');
                li.setAttribute("draggable",true)
                document.getElementById("columns").appendChild(li);
                activity.value = "";
                location.reload();
                console.log(reponse.id)
            }

        }
    }

})

function checkStart(target) {
    target.classList.toggle("checked");
    target.check == false? target.check = true : target.check=false;
    console.log(target.check)
}


document.getElementById("addArchive").addEventListener('click', (e)=>{
    e.preventDefault();
    let archived = document.querySelectorAll("#columns > li.checked");
    let modifs = [];
    archived.forEach(element => {
        document.getElementById("archive").appendChild(element);
        element.onclick="";
        element.archive=true;
        let modified = new Object();
        modified.id = element.id;
        modified.check= element.check;
        modified.archive = element.archive;
        modifs.push(modified);

        console.log(modifs);
    });
        let update = new XMLHttpRequest();

        update.open("POST","edit.php", true);
        // important sinon php ne sait pas à quoi il a affaire
        update.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    
        update.send("edit="+JSON.stringify(modifs));
        
        update.onreadystatechange = function(event){//déclenché par la fin ded l'éxécution du php
            if(this.readyState === XMLHttpRequest.DONE){
                document.getElementById("response").innerHTML = this.responseText;
                location.reload();

            }
        }

/*
        formData.append('data',element)

        fetch('formulaire.php', {
            method:'post',
            body:formData
        })
*/

})





