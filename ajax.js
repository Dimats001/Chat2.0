window.onload = function(){
    //Каждый раз при загрузке страницы будем обновлять чат
    updateChat()
}

function updateChat(){
    xml = new XMLHttpRequest() //Такая штука не прокатит во всех браузерах, но лень писать под каждый случай

    xml.open("POST", "update.php", true)
    xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
    xml.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200)
            document.getElementById("msg").innerHTML = this.response
    }
    xml.send()
}

function sendMsg(){
    if(document.getElementById("chat-in").value != ""){
        xml = new XMLHttpRequest()

        var request = "message=" + document.getElementById("chat-in").value

        xml.open("POST", "update.php", false)
        xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

        xml.onreadystatechange = function(){
            if(this.status == 200 && this.readyState == 4)
                document.getElementById("msg").innerHTML = this.response
        }

        xml.send(request)
    }
    updateChat() //Обновляем картинку у пользователя
}

//Здесь можно было бы обойтись обычными формами, но я тренирую AJAX
function enter(){
                xml = new XMLHttpRequest()

                user = document.getElementById("user").value
                pass = document.getElementById("pass").value
                //Пароли надо хранить в хэшированном виде, но лень
                request = "user=" + user + "&pass=" + pass

                xml.open("POST", "checkUser.php", true)
                xml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
                xml.onreadystatechange = function(){
                    if(this.status == 200 && this.readyState == 4)
                        if(this.response == true)
                            document.location.href = "chatPage.html"
                        else
                            document.getElementById("test").innerHTML = this.response
                }

                xml.send(request)
            }
