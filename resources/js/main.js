const env = { 
    env_url : 'app/api',
    required: [],
    loginRoute : {
        loginHelper : 'loginHelper.php'
    },
    regiterRoute : {
        registerHelper : 'registerHelper.php'
    }
}

class requestConfiguration {
    signinRequest(object) {
        return new Promise(resolve => {
            new requestValidation().validateLogin(object)
            .then(r => {
                if(r === "empty handed") {
                    return resolve();
                }else{
                    return new requestSender().loginRequest(object).then(r => {
                        return resolve(r)
                    })
                }
            })
        })
    }
    registrationRequest(object) {
        return new Promise(resolve => {
            new requestValidation().validateRegistration(object).then(r => {
                if(JSON.parse(r)[0].label === "emptyHanded"){
                    return resolve(r)
                } else if(JSON.parse(r)[0].label === "mismatchPassword"){
                    return resolve(r)
                } else if(JSON.parse(r)[0].label === "password8MaxLength"){
                    return resolve(r)
                }else{
                        return new requestSender().registerRequest(object).then(r => {
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
    validateRegistration(object) {
        return new Promise(resolve => {
            if(!object.firstname || !object.lastname){
                env.required.push({label : 'emptyHanded'})
                return resolve(JSON.stringify(env.required));
            } else if(object.password != object.cpass) {
                env.required.push({label : 'mismatchPassword'})
                return resolve(JSON.stringify(env.required));
            } else if(object.password.length <= 8){
                env.required.push({label : 'password8MaxLength'})
                return resolve(JSON.stringify(env.required))
            }
            else{
                env.required.push({label : 'notEmpty'})
                return resolve(JSON.stringify(env.required))
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
    registerRequest(object) {
        return new Promise(resolve => {
            $.post(env.env_url + `/helpers/` + env.regiterRoute.registerHelper, object, (response) => {
                return resolve(response)
            })
        })
    }
}

export default new requestConfiguration();