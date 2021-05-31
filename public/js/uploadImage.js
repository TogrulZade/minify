function fileUpload(index){
    t = document.querySelector('.t').value;
    const {file, el} = files[index];
    const formData = new FormData();
    formData.append('image', file);
    formData.append('_token',csrf);
    formData.append('t',t);
    
    const request = new XMLHttpRequest();

     request.addEventListener('load', function(){
        if (index + 1 < files.length){
            fileUpload(index+1);
        }else{
            files = [];
            console.log('Yükləmə bitdi');
        }
     });

     request.upload.addEventListener('progress', function(e){
        let faiz = (e.loaded / e.total) * 100;
     });



    //  request.open("POST", '/uploadImage');
    //  request.send(formData);
    //  request.onreadystatechange = function() {
    // 	if (this.readyState == 4 && this.status == 200) {
    // 		console.log(this.responseText);
    // 	}else{
    // 		console.log(this.responseText);
    // 	}
    // }
}

const fileInput = document.querySelector('#file'),
result = document.querySelector('.izle'),

files = [];

fileInput.addEventListener('change', function(){
    [...this.files].map((file, index)=>{
        if(file.name.match(/\.jpe?g|png|gif/)){
            const reader = new FileReader();
            reader.addEventListener('load', function(){
                const item = document.createElement('div');
                item.className = 'item';
                item.innerHTML = `<img style='width: 100px; margin: 10px; height: 80px' src='${this.result}' />`;
                result.appendChild(item);
                files.push({
                    el: item
                });
            });

            files.push({
                file,
            });

                reader.readAsDataURL(file);
        }else{
            alert('error');
        }
    })

    fileUpload(0);
});