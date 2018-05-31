// main Js pour Share_files

// pré-validation formulaire avant envoi serveur

var form = document.querySelector('#mainForm');
var fileInput = form.querySelector('input[type=file].activeInputFile');
const totalMaxFileSize = 2147483648;
var totalUploadSize = 0;
var addedFilesElt = document.querySelector('#addedFilesField');

//
function inputFileGenerator(){
var inputFieldFragment = document.createDocumentFragment();	
var inputElt = document.createElement('input');
inputElt.setAttribute('type', 'file');
inputElt.setAttribute('multiple', '');
inputElt.setAttribute('name', 'file_name')
inputElt.classList.add('activeInputFile');
inputFieldFragment.appendChild(inputElt);
return inputFieldFragment;
}
function addedFileLayout(name, size, type){
	let newFileElt = document.createDocumentFragment();
	let pElt = document.createElement('p');
	let pContent = name + '  ' + type + '  ' + Math.round(size / 1024) + "ko";
	pElt.textContent = pContent;
	newFileElt.appendChild(pElt);
	addedFilesElt.appendChild(newFileElt);
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
		addedFileLayout(fileName, fileSize, fileType);
		parentElt.insertBefore(inputFieldFragment, fileInput);
		fileInput.style.display = "none";
		fileInput.classList.toggle("activeInputFile");
		fileInput.removeEventListener('change', inputFieldEvent);
		fileInput = form.querySelector('input[type=file].activeInputFile');
		fileInput.addEventListener('change', inputFieldEvent);
	} else {
		// traitement 2go dépassés
		parentElt.replaceChild(inputFieldFragment, fileInput);
		fileInput.removeEventListener('change', inputFieldEvent);
		// parentElt.removeChild(fileInput);
		fileInput = form.querySelector('input[type=file].activeInputFile');
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
	
	let errorFocus = form.querySelector('input[name=' + field.name + ']');
	if (errorFocus === null){
			errorFocus = form.querySelector('textarea[name=' + field.name + ']');
	}
	if (!field.value.length > 0){
		if (errorFocus === null){
			errorFocus = form.querySelector('textarea[name=' + field.name + ']');
		}
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
form.addEventListener('submit', function (event){
	
	for (let field of form){
		let empty = checkEmptyField(field);
		if (empty){
			break;
			event.preventDefault();
		}
	}
	
});
fileInput.addEventListener('change', inputFieldEvent);

