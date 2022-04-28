function listSearch(db){
    const req = new XMLHttpRequest();
    req.onreadystatechange = function()  {
        if(req.readyState === 4 ){
            const data = req.responseText;
            const div = document.getElementById("database");
            div.innerHTML = data;
        }
    };
    const id = document.getElementById('search').value;
    req.open("GET", "ajax_db.php?id="+id+"&db="+db);
    req.send();
}
