<!-- Handlebars templates -->
<!-- https://www.youtube.com/watch?v=3zVYH16yogQ -->


<!--------------------
  template "page"
  --------------------
  title
  text
  -------------------->
<script id="template-page" type="text/x-handlebars-template">
  <div class="page">
    <h1>{{title}}</h1>
    <p>{{text}}</p>
  </div>
</script>

<!--------------------
  template "projects"
  --------------------
  items
    title
    desc
  -------------------->
<script id="template-projects" type="text/x-handlebars-template">
  <div class="projects">
    {{#each items}}
      <div class="my-5">
        <h2>{{this.title}}</h2>
        <p>{{this.desc}}</p>
      </div>
    {{/each}}
  </div>
</script>

<script>

var templates = {
  "page": Handlebars.compile($("#template-page").html()),
  "projects": Handlebars.compile($("#template-projects").html()),
};

function mapResponseToTemplateContext (responseData, responseType) {
  
  if (responseType == "list") {
    return {
      "items": responseData.items.map(function (d) {
        return {
          "title": d.title,
          "desc": d.desc,
        };
      })
    };
  }
  if (responseType == "item") {
    var d = responseData;
    return {
      "title": d.title,
      "text": d.text,
    };
  }
}

</script>

<!-- Templates end -->