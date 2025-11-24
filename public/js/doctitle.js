console.log("ssssssssssssssssss");
let docTitle = document.title;
window.addEventListener("blur", ()=>{
    document.title="Session sur le point d'expirer...";
})
window.addEventListener("focus",()=>{
    document.title= docTitle;
})