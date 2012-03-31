//alert("js");
/*
   XMLHttpRequest.prototype.sendAsBinary = function(datastr) {
   function byteValue(x) {
   return x.charCodeAt(0) & 0xff;
   }
   var ords = Array.prototype.map.call(datastr, byteValue);
   var ui8a = new Uint8Array(ords);
   this.send(ui8a.buffer);
   }
 */
window.onload = init;
function init(){
	var dropbox = document.getElementById("dropbox");
	document.addEventListener("dragenter", function(e){  
			dropbox.style.borderColor = 'green';  
			}, false);  
	document.addEventListener("dragleave", function(e){  
			dropbox.style.borderColor = 'blue';  
			}, false);  
	dropbox.addEventListener("dragenter", function(e){  
			dropbox.style.borderColor = 'grey';  
			dropbox.style.backgroundColor = 'grey';  
			}, false);  
	dropbox.addEventListener("dragleave", function(e){  
			dropbox.style.backgroundColor = 'transparent';  
			}, false);  
	dropbox.addEventListener("dragenter", function(e){  
			e.stopPropagation();  
			e.preventDefault();  
			}, false);  
	dropbox.addEventListener("dragover", function(e){  
			e.stopPropagation();  
			e.preventDefault();  
			}, false);  
	dropbox.addEventListener("drop", function(e){  
			e.stopPropagation();  
			e.preventDefault();  

			handleFiles(e.dataTransfer.files);  

			//submit.disabled = false;  
			}, false);  
}
var ffff;
var handleFiles = function(files) {  
	for (var i = 0; i < files.length; i++) {  
		var file = files[i];  
		ffff = file;
		uploadFile(file);
	}  
}  
function uploadFile(file){
	var xhr = new XMLHttpRequest();  
	xhr.open('post', 'upload.php', true);
	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
	/*
	   xhr.upload.addEventListener("progress", function(e) {  
	   if (e.lengthComputable) {  
	   var percentage = Math.round((e.loaded * 100) / e.total);  
	   img.style.opacity = 1-percentage/100.0;  
	   }  
	   }, false);  
	 */
	xhr.upload.addEventListener("load", function(e){  
			//alert("upload end");
			}, false);  
	var fd = new FormData();
	fd.append('file', file);
	xhr.send(fd);
	xhr.onreadystatechange = function(){
		//alert(xhr.statusText);
		//alert(xhr.readyState);
		if(xhr.status == 200 && xhr.readyState == 4){
			//alert(xhr.response);	
			document.getElementById("result_qrcode").src=xhr.response;
		}
	};
	ffff = xhr;
}

































