const env = { 
    env_url : 'app/api',
    loginRoute : {
        loginHelper : 'loginHelper.php'
    }
}

class requestConfiguration {
    signinRequest(object) {
        return new Promise(resolve => {
            new requestValidation().validateLogin(object)
            .then(r => {
                if(r === "empty handed") {
                    return resolve("invalid")
                }else{
                    return new requestSender().loginRequest(object).then(r => {
                        return resolve(r)
                    })
                }
            })
        })
    }
}

class requestValidation {
    validateLogin(object) {
        return new Promise(resolve => {
            if(!object.username || !object.password){
                return resolve("empty handed")
            }else{
                return resolve("not empty");
            }
        })
    }
}

class requestSender {
    loginRequest(object) {
        return new Promise(resolve => {
            $.post(env.env_url + `/helpers/` + env.loginRoute.loginHelper, object,
            response => {
                return resolve(response)
            })
        })
    }
}

export default new requestConfiguration();