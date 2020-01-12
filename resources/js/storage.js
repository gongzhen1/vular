export function setToStorage(key,value){
    if(window.localStorage){
        window.localStorage.setItem(key, value);
    }
}

export function get_fromStorage(key){
    if(window.localStorage){
        return window.localStorage.getItem(key);
    }
}

export function clearStorage(){
    if(window.localStorage){
        window.localStorage.clear();
    }
}

export function removeFromStorage(item){
    if(window.localStorage){
        window.localStorage.removeItem(item);
    }
}
