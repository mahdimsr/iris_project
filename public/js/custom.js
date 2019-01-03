var idCounter = 0;


function addTag(parentId, elementTag, elementId, body)
{
	var parentElement = document.getElementById(parentId);
	var newElement    = document.createElement(elementTag);
	newElement.setAttribute('id', elementId);
	newElement.innerHTML = body;
	parentElement.appendChild(newElement);
}



function removeRow(elementId)
{
	console.log(elementId);
	var element       = document.getElementById(elementId);
	var parentElement = document.getElementById('userRow');
	parentElement.removeChild(element);
}