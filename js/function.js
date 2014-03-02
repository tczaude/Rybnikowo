function uk() {
for (a=0;a<document.links.length;)
document.links[a].onfocus=document.links[a++].blur;
}

function popUp(URL,w,h) {

	var winW = (screen.width - w) / 2;
	var winH = (screen.height - h) / 2;
	var day = new Date();
	var id = day.getTime();
	var winprops = "toolbar='0',scrollbars='1',location='0',statusbar='0',menubar='0',resizable='0',width="+w+",height="+h+",left="+winW+",top="+winH+"";
	var win = window.open(URL, id ,winprops);

	}

function showFilters() {
	
	if (document.getElementById('filters').style.display == 'none') {
		document.getElementById('filters').style.display = 'block';
	}
	else {
		document.getElementById('filters').style.display = 'none';
	}
}

function hideFilters() {
	
	if (document.getElementById('filters').style.display == 'none') {
		document.getElementById('filters').style.display = 'none';
	}
	else {
		document.getElementById('filters').style.display = 'none';
	}
}

function showSearchAdvanced() {
	
	if (document.getElementById('search_advanced').style.display == 'none') {
		document.getElementById('search_advanced').style.display = '';
		document.getElementById('slideHome').style.display = 'none';
		
	}
	else {
		document.getElementById('search_advanced').style.display = 'none';
		document.getElementById('slideHome').style.display = '';
	}
}
function showDelivery() {
	
	if (document.getElementById('orderAdressChange').style.display == 'none') {
		document.getElementById('orderAdressChange').style.display = '';
	}
	else {
		document.getElementById('orderAdressChange').style.display = 'none';
	}
}

function hideDelivery() {
	
	if (document.getElementById('deli').style.display == 'none') {
		document.getElementById('deli').style.display = 'none';
	}
	else {
		document.getElementById('deli').style.display = '';
	}
}
function showComments() {
	
	if (document.getElementById('comments').style.display == 'none') {
		document.getElementById('comments').style.display = 'table';
	}
	else {
		document.getElementById('comments').style.display = 'none';
	}
}

function hideComments() {
	
	if (document.getElementById('comments').style.display == 'none') {
		document.getElementById('comments').style.display = 'none';
	}
	else {
		document.getElementById('comments').style.display = 'none';
	}
}


function hideSearchAdvanced() {
	
	if (document.getElementById('search_advanced').style.display == 'none') {
		document.getElementById('search_advanced').style.display = 'none';
	}
	else {
		document.getElementById('search_advanced').style.display = 'none';
	}
}

function showForm() {
	
	if (document.getElementById('comment_form').style.display == 'none') {
		document.getElementById('comment_form').style.display = 'block';
	}
	else {
		document.getElementById('comment_form').style.display = 'none';
	}
}

function hideForm() {
	
	if (document.getElementById('comment_form').style.display == 'none') {
		document.getElementById('comment_form').style.display = 'none';
	}
	else {
		document.getElementById('comment_form').style.display = 'none';
	}
}

function checkUncheckAll(theElement) {
	
	var theForm = theElement.form, z = 0;

	for(z=0; z<theForm.length;z++){
		if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall'){
			theForm[z].checked = theElement.checked;
		}
	}
}

var agt=navigator.userAgent.toLowerCase();
var ie  = (agt.indexOf("msie") != -1);

function switchPanelMedia (media) {
	
	// alert(element);
	
	if (media == 2) {

		if (ie) {
			document.getElementById('outside_media').style.display = 'block';
		}
		else {
			document.getElementById('outside_media').style.display = 'table-row-group';
		}
		document.getElementById('for_media').style.display = 'none';
	}
	else {
		if (ie) {
			document.getElementById('for_media').style.display = 'block';
		}
		else {
			document.getElementById('for_media').style.display = 'table-row-group';
		}
		document.getElementById('outside_media').style.display = 'none';
	}
} 

function changeBulkAction (action) {
	
	if (action == "SetStatusBulk") {
		document.getElementById('access_bulk').style.display = "none";
		document.getElementById('type_bulk').style.display = "none";
		document.getElementById('description_bulk').style.display = "none";
		document.getElementById('status_bulk').style.display = "block";
	}
	else if (action == "SetAccessBulk") {
		document.getElementById('status_bulk').style.display = "none";
		document.getElementById('type_bulk').style.display = "none";
		document.getElementById('description_bulk').style.display = "none";
		document.getElementById('access_bulk').style.display = "block";
	}
	else if (action == "SetTypeBulk") {
		document.getElementById('description_bulk').style.display = "none";
		document.getElementById('status_bulk').style.display = "none";
		document.getElementById('access_bulk').style.display = "none";
		document.getElementById('type_bulk').style.display = "block";
	}
	else if (action == "SetDescriptionBulk") {
		document.getElementById('status_bulk').style.display = "none";
		document.getElementById('type_bulk').style.display = "none";
		document.getElementById('access_bulk').style.display = "none";
		document.getElementById('description_bulk').style.display = "block";
	}
	else {
		document.getElementById('access_bulk').style.display = "none";
		document.getElementById('status_bulk').style.display = "none";
		document.getElementById('type_bulk').style.display = "none";
		document.getElementById('description_bulk').style.display = "none";
	}
}

function checkUncheckAll(theElement) {
	
	var theForm = theElement.form, z = 0;

	for(z=0; z<theForm.length;z++){
		if(theForm[z].type == 'checkbox' && theForm[z].name != 'checkall'){
			theForm[z].checked = theElement.checked;
		}
	}
}

function checkByClass(checkedClass,checkedStatus,node) {
	checkedClass = checkedClass || '*';
	checkedStatus = document.getElementById(checkedStatus);
	node = (node == null)?document:document.getElementById(node);
	var elements = node.getElementsByTagName('input');
	var elementCount = elements.length;
	var pattern = new RegExp('(^|\\s)'+checkedClass+'(\\s|$)');
	for (i = 0, j = 0; i < elementCount; i++) {
		if ( elements[i].type == 'checkbox' && pattern.test(elements[i].className) ) {
			elements[i].checked = checkedStatus.checked;
		}
	}
}

function removeProduct() {
	
	if (confirm('Czy na pewno chcesz usunąć wybrany produkt? Wraz z nim zostaną usunięte WSZYSTKIE materiały z nim powiązane !!!')) {
		if (confirm('Na pewno? To jest operacja NIEODWRACALNA !!!')) {
			return true;
		}
	}
}