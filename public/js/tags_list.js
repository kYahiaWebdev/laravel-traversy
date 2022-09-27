const tagsArea = document.getElementById('tags_list-area')
const tagsSuggest = document.getElementById("tags_list-suggest") || document.getElementById("tags_list-suggest-edit")
const tagsListInput = document.getElementById("tags_list-input") || document.getElementById("tags_list-input-edit")

const tagsSelected = document.getElementById("tags_list-selected") || document.getElementById("tags_list-selected-edit")

let suggest = []
tagsSelected.querySelectorAll('button').forEach(button => {
   suggest.push({ id: Number(button.id), name: button.textContent })
   button.addEventListener('click', deleteTag)
   if (tagsListInput.value == '') tagsListInput.value = button.id
   else tagsListInput.value += ',' + button.id
})

tagsArea.addEventListener('keyup', findSuggest);

function findSuggest(e) {
   if (tagsArea.value == "") {
      tagsSuggest.textContent = "";
      return;
   }

   clearChildren(tagsSuggest)

   const q = new XMLHttpRequest();
   q.open('GET', '/tag/?name=' + e.target.value);
   q.send();

   q.onreadystatechange = () => {
      if (q.readyState == 4 && q.status == 200) {
         const json = JSON.parse(q.responseText)
         Object.keys(json).map(key => {
            const prop = document.createElement('button')
            prop.className = 'inline-bloc bg-green-500 text-white px-3 mx-2'
            prop.id = key
            prop.type = 'button'
            prop.textContent = json[key]
            prop.addEventListener('click', addTag)
            tagsSuggest.appendChild(prop)
         });
      }
   }

}

function clearChildren(element) {
   element.querySelectorAll('*').forEach(child => {
      child.remove()
   });
}

function addTag(e) {
   suggest.push({ id: e.target.id, name: e.target.textContent })
   if (tagsListInput.value == '') tagsListInput.value = e.target.id
   else tagsListInput.value += ',' + e.target.id
   tagsArea.value = '';

   e.target.removeEventListener('click', addTag);
   e.target.addEventListener('click', deleteTag);
   
   tagsSelected.appendChild(tagsSuggest.removeChild(e.target))
   clearChildren(tagsSuggest)
}

function deleteTag(e) {
   suggest = suggest.filter(couple => couple.id != e.target.id);
   tagsListInput.value = suggest.map(couple => couple.id).join(',')
   
   e.target.remove()
}

tinymce.init({
   selector: '#project-description-area'
 });