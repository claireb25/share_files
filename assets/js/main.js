// main Js pour Share_files

// pré-validation formulaire avant envoi serveur

var form = document.querySelector('#mainForm');
var fileInput = form.querySelector('input.activeInputFile');
const totalMaxFileSize = 2147483648;
var totalUploadSize = 0;
var addedFilesElt = document.querySelector('#addedFilesField');

//
function inputFileGenerator(){
	var inputFieldFragment = document.createDocumentFragment();	
	var inputElt = document.createElement('input');
	inputElt.setAttribute('type', 'file');
	inputElt.setAttribute('multiple', '');
	inputElt.setAttribute('name', 'file_name[]')
	inputElt.classList.add('activeInputFile');
	inputFieldFragment.appendChild(inputElt);
	return inputFieldFragment;
}
function newElt(type, className = '', inner = ''){
	let elem = document.createElement(type);
	elem.classList.add(className);
	elem.innerHTML = inner;
	return elem;
}
function addedFileLayout(name, size, type){
	let newFileElt = document.createDocumentFragment();
	let artElt = newElt('article', 'addedFileBox');
	let titleElt = newElt('h6', 'addedFileName', name);
	artElt.appendChild(titleElt);
	let divElt = newElt('div', 'addedFileInfos');
	divElt.appendChild(newElt('p', 'emptyElt'));
	type = type.split('/');
	type = type[1];
	divElt.appendChild(newElt('p', 'addedFileType', type));
	divElt.appendChild(newElt('p', 'addedFileSize', Math.round(size / 1024) + "ko"));
	artElt.appendChild(divElt);
	newFileElt.appendChild(artElt);
	return newFileElt;
}
//
function computeAddedFile(size){
	totalUploadSize += size;
	if (totalUploadSize >= totalMaxFileSize){
		totalUploadSize -= size;
		return false;
	} else {
		return true;
	}
}
function inputFieldEvent(event){
	let parentElt  = fileInput.parentNode;
	let inputFieldFragment = inputFileGenerator();
	let fichiers = this.files;
	let fileName = fichiers[0].name;
	let fileSize = fichiers[0].size * 1;
	let fileType = fichiers[0].type;
	if (computeAddedFile(fileSize)){
		document.querySelector('#totalSize').textContent = "";
		document.querySelector('#totalSize').textContent = Math.round(totalUploadSize / 1024);
		let newFile = addedFileLayout(fileName, fileSize, fileType);
		addedFilesElt.appendChild(newFile);
		parentElt.insertBefore(inputFieldFragment, fileInput);
		fileInput.style.display = "none";
		fileInput.classList.toggle("activeInputFile");
		fileInput.removeEventListener('change', inputFieldEvent);
		fileInput = form.querySelector('input.activeInputFile');
		fileInput.addEventListener('change', inputFieldEvent);
	} else {
		// traitement 2go dépassés
		window.alert('2go de transfert maximum!');
		parentElt.replaceChild(inputFieldFragment, fileInput);
		fileInput.removeEventListener('change', inputFieldEvent);
		// parentElt.removeChild(fileInput);
		fileInput = form.querySelector('input.activeInputFile');
		fileInput.addEventListener('change', inputFieldEvent);
	}
	// parentElt.insertBefore(inputFieldFragment, fileInput);
	// fileInput.style.display = "none";
	// fileInput.classList.toggle("activeInputFile");
	// fileInput.removeEventListener('change', inputFieldEvent);
	// fileInput = form.querySelector('input[type=file].activeInputFile');
	// fileInput.addEventListener('change', inputFieldEvent);
}
function checkEmptyField(field){
	
	if (field.name == "file_name[]"){
		
		var errorFocus = form.querySelector('input.activeInputFile');
	}
	if ((field.name == "sender_email") || (field.name == "receiver_email") || (field.name == "envoi")){
		var errorFocus = form.querySelector('input[name=' + field.name + ']');
	}
	if (field.name == "message"){
		var errorFocus = form.querySelector('textarea[name=' + field.name + ']');
		
	}
	if (!field.value.length > 0){
		if (errorFocus.type === "file"){
			if (addedFilesField.innerHTML == ""){
				form.querySelector('#addFileField').style.border = "2px solid red";
				errorFocus.focus();
        		return true;
			} else {
				form.querySelector('#addFileField').style.border = "none";
				return false;
			}
		}
        errorFocus.style.border = "2px solid red";
        errorFocus.focus();
        return true;

	} else {
		errorFocus.style.border = "none";
		return false;	
	}	
}
function checkValidMail(field){
	var maRegex =  /^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	return maRegex.test(field.value);
}
form.addEventListener('submit', function (event){	
	event.preventDefault();
	var error = -1;
	for (let field of form){
		let empty = checkEmptyField(field);
		if (empty){
			error *= -1;
			break;
		}
		if (field.type == "email"){
			if (!checkValidMail(field)){
				error *= -1;
				break;
			}
		}
	}
	if (error == 1){
		alert('des erreurs dans le formulaire');
	} else {
		form.submit();
	}
});
fileInput.addEventListener('change', inputFieldEvent);

