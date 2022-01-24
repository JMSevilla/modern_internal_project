const env = {
    env_url : 'app/api',
    env_url_get: 'app/api/Controllers/GET/',
    env_token_url: 'app/api/Controllers/Token/',
    required: [],
    loginRoute : {
        loginHelper : 'loginHelper.php'
    },
    regiterRoute : {
        registerHelper : 'registerHelper.php',
        departmentGetter : 'Department.php',
        occupationGetter : 'occupation.php'
    },
    tokenization : {
        tokenRoute : 'tokenization.php'
    },
    jsonHelper : null
}

class JSONConfiguration {
    ResponseConfiguration(payload){
        const callback = new Promise((resolve) => {
            env.jsonHelper = JSON.parse(payload);
            return resolve(env.jsonHelper);
        })
        return callback;
    }
}

class requestConfiguration extends JSONConfiguration {
    signinRequest(object) {
        return new Promise(resolve => {
            new requestValidation().validateLogin(object)
            .then(r => {
                if(JSON.parse(r)[0].key === "emptyHanded") {
                  env.required=[];
                    return resolve(r);
                }else{
                    return new requestSender().loginRequest(object).then(r => {
                      console.log(r)
                        return resolve(r)
                    })
                }
            })
        })
    }
    registrationRequest(object) {
        return new Promise(resolve => {
            new requestValidation().validateRegistration(object).then(r => {
                if(JSON.parse(r)[0].key === "emptyHanded"){
                    env.required=[];
                    return resolve(r)
                } else if(JSON.parse(r)[0].key === "mismatchPassword"){
                    env.required=[];
                    return resolve(r)
                } else if(JSON.parse(r)[0].key === "password8MaxLength"){
                    env.required=[];
                    return resolve(r)
                }else{
                        return new requestSender().registerRequest(object).then(rep => {
                            return resolve(rep)
                         })
                }
            })
        })
    }
    departmentConfiguration(){
        return new Promise(resolve => {
            return new requestSender().departmentRequest().then(resp => {
                return resolve(resp)
            })
        })
    }
    occupationConfigation(){
        return new Promise(resolve => {
            return new requestSender().occupationRequest().then(resp => {
                return resolve(resp)
            })
        })
    }
    tokenConfiguration(){
        return new Promise((resolve) => {
            return new requestSender().scantokenRequest().then(resp => {
                return resolve(resp)
            })
        })
    }
}

class requestValidation {
    validateLogin(object) {
        return new Promise(resolve => {
            if(!object.email || !object.password){
              env.required.push({key : 'emptyHanded'})
                return resolve(JSON.stringify(env.required))
            }else{
              env.required.push({key : 'notEmpty'})
                return resolve(JSON.stringify(env.required))
            }
        })
    }
    validateRegistration(object) {
        return new Promise(resolve => {
            if(!object.firstname || !object.lastname){
                env.required.push({key : 'emptyHanded'})
                return resolve(JSON.stringify(env.required));
            } else if(object.password != object.cpass) {
                env.required.push({key : 'mismatchPassword'})
                return resolve(JSON.stringify(env.required));
            } else if(object.password.length <= 8){
                env.required.push({key : 'password8MaxLength'})
                return resolve(JSON.stringify(env.required))
            }
            else{
                env.required.push({key : 'notEmpty'})
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
                env.required=[];
                return resolve(response)
            })
        })
    }
    departmentRequest(){
        return new Promise(resolve => {
            $.get(env.env_url_get + env.regiterRoute.departmentGetter, (response) => {
                return resolve(response)
            })
        })
    }
    occupationRequest(){
        return new Promise(resolve =>{
            $.get(env.env_url_get + env.regiterRoute.occupationGetter, (response) => {
                return resolve(response)
            })
        })
    }
    scantokenRequest(){
        return new Promise(resolve => {
            const req = { 
                requestToken : true
            }
            $.post(env.env_token_url + env.tokenization.tokenRoute, req, (response) => {
                return resolve(response)
            })
        })
    }
}

export default new requestConfiguration();
