const ROOT_SELF='http://search.loc'
export const getCaption=(turn)=>{
    var formdata = new FormData();
    formdata.append("get_caption",turn)
    var requestOptions={
        method: 'POST',
        body:formdata,
    }
   return  fetch(`${ROOT_SELF}/apiсaption.php`,requestOptions)
        .then(res=>res.json())
}
export const sendRequest=(data)=>{
         var formdata = new FormData();
               formdata.append("search_param", data)
               var requestOptions={
                   method: 'POST',
                   body:formdata,
               }
            return   fetch(`${ROOT_SELF}/api.php`,requestOptions)
                   .then(res=>res.json())

}