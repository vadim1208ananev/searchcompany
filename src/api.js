//const ROOT_SELF='http://search.loc'
//const ROOT_SELF='http://monic.loc'
const ROOT_SELF=''
export const getCaption=()=>{
    var formdata = new FormData();
    formdata.append("get_caption",1)
    formdata.append("action",'get_headers')
    var requestOptions={
        method: 'POST',
        body:formdata
    }
   return  fetch(`${ROOT_SELF}/wp-admin/admin-ajax.php`,requestOptions)
        .then(res=>res.json())
}
export const sendRequest=(data)=>{
         var formdata = new FormData();
               formdata.append("search_param", data)
               formdata.append("action",'company_request')
               var requestOptions={
                   method: 'POST',
                   body:formdata,
               }
            return   fetch(`${ROOT_SELF}/wp-admin/admin-ajax.php`,requestOptions)
                   .then(res=>res.json())

}