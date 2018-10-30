# Laravel

###### Creació d'una ruta amb pas de paràmetres
~~~
Route::get('/post/{id}/{name}', function ($id,$name){
    return "Este es el post numº $id de $name";
});
~~~
###### Creació d'una ruta amb pas de paràmetres i filtrat dels mateixos
~~~
Route::get('/post/{id}/{name}', function ($id,$name){
    return "Este es el post nº $id de $name";
})->where('name', '[a-zA-Z]+');
~~~
* namespace (S'utilitza per no crear conflicte en altres classes, mètodes o variables que vaiguin crear les altres usuaris)
* Si la App es mol complexa, utilitzarem els controladors per a gestionar les rutes.
###### Per enllaçar l'arxiu de les rutes amb el contolador creat
~~~
Route::get('/start','ExampleController@start');

    * Primer argument: URL
    * Segon argument: Nom del controlador@nomDeLaFuncioQueUtilitzarem
~~~
* php artisan make:controller nomControlador (Per crear un controlador de forma automàtica (hem d'estar dintre la carpeta del projecte!!!))
* php artisan make:controller --resource nomControlador (Per crear un controlador de forma automàtica amb una serie de recursos predefinits (hem d'estar dintre la carpeta del projecte!!!))
* php artisan route:list (Llista totes les URL's que tenim creades)
* Si els mètodes que ens crea el "php artisan make:controller --resource" ens serveixen per la nostra web, si dintre el fitxer de rutes afegim "Route::resource("post","Example3Controller");", ens crea totes les rutes automàticament
* Bootstrap (Framework CSS, permet donar format a un lloc Web utilitzant llibreries CSS)
* Per utilitzar Bootstrap, reemplaçar carpetes /public/css i /public/js per les que ens descargarem de la Web de [Bootstrap](http://getbootstrap.com/).
* compact("nomArray") (Permet pasar un número de elements variable)
* php artisan migrate (executa les migracions)
* php artisan make:migration create_nomTaula(opcional)_table --create="nomTaula"
* php artisan migrate:rollback (Tira un pas enrere)
* php artisan migrate:reset (Fa un reset de totes les migracions)
* php artisan migrate:refresh (Elimina i executa TOTES les migracions)
* php artisan migrate:status (Per saber si hem executat els arxius migrate)
* php artisan dump-server (Per que surtin els xivatos per consola)
* php artisan serve (Per obrir servidor Laravel)
* laravel new nomApp (Per crear una App Laravel)
* $this->withoutExceptionHandling(); (Mostra errors en el test al PHPStorm)
* php artisan make:model nomModel (Per crear un model)
* php artisan make:model -a nomModel (Per crear un model, factoria, migració i controlador)
* use RefreshDatabase; (Sempre avans de fer un test que use bases de dades)
* php artisan tinker (Provar App)
###### Crear un formulari bàsic
~~~
<form action="/tasks" method="POST">
    {{--Label--}}
    @csrf
    <input name="name" type="text" placeholder="Nova tasca">
    <input hidden name="token" value="MY_TOKEN" type="text">
    <button>Afegir</button>
</form>
~~~
* phpunit (Executa testos per línia de comandes)
* Models -> Eloquent -> ORM (HIBERNATE de Java) Object Relational Model
* Fitxer helpers.php (Van funcions on les podrem utilitzar d'es d'on vulguem)

# Javascript i  VUE
* console.log('Hello World') (Igual que el echo del PHP)
* npm | yarn (Es el composer del Javascript)
* npm -g install (Es igual que el composer install)
* node.js (Interpret de Javascript)
* http-server . (Per obrir el servidor)
###### Formes d'executar Javascript
~~~
<button onclick="alert('Hello wolrd!')">Saluda</button>
~~~
~~~
<button onclick="alert(suma(1,2))">Suma 1+2</button>
<script>
    console.log('Hello World')
    function suma(x,y) {
        return x+y
    }
</script>
~~~
~~~
<button onclick="saluda()">Saluda</button>
~~~
~~~
<script src="functions.js"></script>
~~~
* Les variables no van amb $
* MVC -> Model??? -> NO tenim base de dades!!
    * Model = Variables/Objectes Javascript
* document (guarda tota la pagina HTML)
###### Crear llista amb foreach
~~~
var app = document.getElementById('app')
    var ul = document.createElement('ul');
    tasks.forEach(function(task) {
        var li = document.createElement('li');
        var text = li.appendChild(document.createTextNode(task))
        li.appendChild(text)
        ul.appendChild(li)
    })
    app.appendChild(ul);
~~~
* tasks.splice(0, 0, "Comprar jocs"); (Agefir en un array, 0 posició, 0 no vull borrar res, nomTasca)
* divtasks.innerHTML = '' (Agafa un element i posa el contingut que l'hi pases, en aquet cas, agafa l'element <div id="tasks"></div> i el deixa sense res)
* {} (Dintre dels corxetes per crear un objecte en VUE)
* data() dintre de export default {} (Hi posarem les variables que volem que s'actualitzin automàticament)
* API (JSON APIS / REST APIS, NO tornen HTML, tornen objectes Javascript en format JSON)
* CORS
    * Failed to load http://localhost:8050/api/v1/tasks: No 'Access-Control-Allow-Origin' header is present on the requested resource. Origin 'http://localhost:8080' is therefore not allowed access.
    * No permet les peticions entre pàgines Web diferents.
* 