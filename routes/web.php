<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    $helloWorld = 'Hello World';
    //return view('welcome',['helloWorld' => $helloWorld]); 
    // outra maneira
    return view('welcome',compact('helloWorld')); 
})->name('home'); */

Route::get('/','HomeController@index')->name('home');
Route::get('/product/{slug}','HomeController@single')->name('product.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/','CartController@index')->name('index');
    Route::post('add','CartController@add')->name('add');
    Route::get('remove/{slug}','CartController@remove')->name('remove');
    Route::get('cancel','CartController@cancel')->name('cancel');
});

Route::get('/model', function () {
    // $products = \App\Product::all(); // lista todos os produtos
   /* $user= new \App\User();
    $user->name = 'Usuário Teste';
    $user->email = 'email@teste.com';
    $user->password = bcrypt('12345678');
    $user->save();
    return \App\User::all(); */
    //return $products;

   // $user = \App\User::find(4);
   // dd($user->store()->count());

    //$loja = \App\Store::find(1);
    //return $loja->products()->where('id',1)->get();

    //$categoria = \App\Category::find(1);
    //$categoria->products;

    // Criar uma loja para um usuário
    /*$user = \App\User::find(10);
    $store = $user->store()->create([
        'name' => 'Loja Teste',
        'description' => 'Loja teste de produtos de informática',
        'phone' => 'XX-XXXXX-XXXX',
        'mobile_phone' => 'XX-XXXXX-XXXX',
        'slug' => 'loja-teste'
    ]);
    dd($store);*/
    
    // Criar um produto para uma loja
   /* $store = \App\Store::find(41);
    $product = $store->products()->create([
        'name' => 'Notebook Dell',
        'description' => 'CORE I5 10GB',              
        'body' => 'Qualquer coisa...',
        'price' => '2999.90',
        'slug' => 'notebook-dell',
    ]);
    dd($product);*/

    // Criar uma categoria 
    /*\App\Category::create([
        'name' => 'Games',
        'description' => null,              
        'slug' => 'games',
    ]);

    \App\Category::create([
        'name' => 'Notebooks',
        'description' => null, 
        'slug' => 'notebooks',
    ]);
    return \App\Category::all();*/

    // Adicionar um produto para uma categoria ou vice-versa
    $product = \App\Product::find(41);
    //dd($product->categories()->attach(1)); // adiciona
    //dd($product->categories()->detach(1)); // remove
    //dd($product->categories()->sync([2])); //  adiciona e/ou remove (junção de attach e detach)
    //return \App\User::all();
    return $product->categories;
});

Route::group(['middleware'=>['auth']],function(){
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){ // pode usar com ou sem as barras prefix(/admin) e namespace('Admin\\')
        /*Route::prefix('stores')->name('stores.')->group(function(){
            Route::get('/', 'StoreController@index')->name('index');
            Route::get('/create', 'StoreController@create')->name('create');
            Route::post('/store', 'StoreController@store')->name('store');
            Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
            Route::post('/update/{store}', 'StoreController@update')->name('update');
            Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        });*/
        Route::resource('stores','StoreController');
        Route::resource('products','ProductController');
        Route::resource('categories','CategoryController');
        Route::post('photos/remove','ProductPhotoController@removePhoto')->name('photo.remove');
    });
});


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
