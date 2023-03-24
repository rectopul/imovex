<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Home\{
    HomeController, 
    PropertyController,
    PostController
};

use App\Http\Controllers\Web\History\{
    PropertyController as HistoryPropertyController
};

use App\Http\Controllers\Web\Catalog\{
    CatalogController,
    PropertyController as CatalogPropertyController,
    CityController as CatalogCityController,
    MonthlyPropertiesController
};

use App\Http\Controllers\Web\Product\{
    ProductController
};

use App\Http\Controllers\Web\About\AboutController;
use App\Http\Controllers\Web\Blog\BlogController;
use App\Http\Controllers\Web\Contact\ContactController;
use App\Http\Controllers\Web\Faq\FaqController;

use App\Http\Controllers\Web\Blog\{
    PostController as BlogPostController,
    PostCommentController as BlogPostCommentController
};

use App\Http\Controllers\Web\Bookmark\{
    BookmarkController,
    PropertyController as BookmarkPropertyController
};

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Dashboard\DashboardController;

use App\Http\Controllers\Dashboard\{
    Property\PropertyController as DashboardPropertyController
};

use App\Http\Controllers\Dashboard\{
    Contact\ContactController as DashboardContactController
};

use App\Http\Controllers\Dashboard\{
    Blog\Post\PostController as DashboardBlogPostController,
    Blog\Post\CategoryController as DashboardBlogPostCategoryController,
    Blog\Post\PostPublishController as DashboardBlogPostPublishController,
    Blog\Post\UserController as DashboardBlogPostUserController,
    Blog\Post\PostHighlightController as DashboardBlogPostHighlightController,
    Blog\Post\PostAtHomeController as DashboardBlogPostAtHomeController,
    Blog\Comment\CommentController as DashboardBlogCommentController,
    Blog\Comment\CommentModerateController as DashboardBlogCommentModerateController,
    Blog\Category\CategoryController as DashboardBlogCategoryController    
};

use App\Http\Controllers\Dashboard\Faq\{
    FaqController as DashboardFaqController
};
use App\Http\Controllers\Dashboard\Privacy\PrivacyController as DashboardPrivacyController;
use App\Http\Controllers\Dashboard\User\{
    UserController as DashboardUserController
};

use App\Http\Controllers\Dashboard\WebConfiguration\{
    WebConfigurationController
};
use App\Http\Controllers\Web\Search\PostController as SearchPostController;
use App\Http\Controllers\Web\Privacy\PrivacyController;
use App\Http\Controllers\Web\Search\FaqController as SearchFaqController;
use App\Http\Controllers\Web\Search\PropertyController as SearchPropertyController;
use App\Http\Controllers\Web\Search\SearchController;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

/**
 * Força a requisição por HTTPS quando em ambiente de produção
 */
if (App::environment('production')) URL::forceScheme('https');

Auth::routes(['register' => false, 'login' => false]);

Route::get('home', function(){
    
    if(Auth::check()) {
        return redirect()->route('dashboard.index');
    }

    return redirect()->route('web.home.index');

});
/**
 * Rotas do site
 */
Route::name('web.')->group(function(){
    
    Route::middleware('only.ajax')->group(function(){
        Route::get('imoveis/home', [PropertyController::class, 'index'])->name('home.property.index');
        Route::get('imoveis/catalogo', [CatalogPropertyController::class, 'index'])->name('catalog.property.index');    
        Route::get('cidades', [CatalogCityController::class, 'index'])->name('catalog.city.index');
        Route::get('imoveis/favoritos', [BookmarkPropertyController::class, 'index'])->name('bookmark.property.index');
        Route::get('historico/{visitor}', [HistoryPropertyController::class, 'index'])->name('history.visitor');
        Route::get('posts', [PostController::class, 'index'])->name('home.post.index');
        Route::get('posts/blog', [BlogPostController::class, 'index'])->name('blog.post.index');
        Route::post('contato', [ContactController::class, 'store'])->name('contact.store');
        Route::post('favoritos', [BookmarkController::class, 'store'])->name('bookmark.store');
        Route::delete('favoritos/{id}/deletar', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
        Route::post('comentario', [BlogPostCommentController::class, 'store'])->name('comment.store');
        Route::get('imoveis/mensais', [CatalogPropertyController::class, 'monthly'])->name('catalog.monthly_properties.index');

        Route::get('busca/posts', [SearchPostController::class, 'index'])->name('search.post.index');
        Route::get('busca/faqs', [SearchFaqController::class, 'index'])->name('search.faq.index');
        Route::get('busca/imoveis', [SearchPropertyController::class, 'index'])->name('search.property.index');
    });

    Route::get('/', [HomeController::class, 'index'])->name('home.index');
    Route::get('catalogo', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('produto/{id}', [ProductController::class, 'show'])->name('product.show');

    Route::get('sobre', [AboutController::class, 'index'])->name('about.index');

    Route::get('contato', [ContactController::class, 'create'])->name('contact.create');

    Route::get('faq', [FaqController::class, 'index'])->name('faq.index');
    Route::get('faq/{index}/{faq:slug?}', [FaqController::class, 'show'])->name('faq.show');

    Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('post/{post:slug}', [BlogPostController::class, 'show'])->name('blog.post.show');

    Route::get('favoritos', [BookmarkController::class, 'index'])->name('bookmark.index');

    Route::get('privacidade', [PrivacyController::class, 'index'])->name('privacy.index');

    Route::get('busca', [SearchController::class, 'index'])->name('search.index');

    Route::get('imoveis-mes', [MonthlyPropertiesController::class, 'index'])->name('monthly_properties.index');




});

Route::name('dashboard.')->group(function(){

    Route::middleware('guest')->group(function(){
        Route::get('admin', [LoginController::class, 'create'])->name('auth.login.create');
        Route::post('login', [LoginController::class, 'store'])->name('auth.login.store');
        Route::get('recuperar-senha', [LoginController::class, 'forgotPassword'])->name('auth.forgot-password');
    });
    
    Route::middleware('auth')->prefix('painel')->group(function(){

        Route::middleware('only.ajax')->group(function(){
            
            Route::get('post/categorias', [DashboardBlogPostCategoryController::class, 'index'])->name('blog.post.category.index');
            Route::post('post/categoria', [DashboardBlogPostCategoryController::class, 'store'])->name('blog.post.category.store');

            Route::patch('post/{post:id}/publicar', [DashboardBlogPostPublishController::class, 'update'])->name('blog.post.publish.update');
            Route::patch('post/{post:id}/destacar', [DashboardBlogPostHighlightController::class, 'update'])->name('blog.post.highlight.update');
            Route::put('post/{post:id}/atualizar', [DashboardBlogPostController::class, 'update'])->name('blog.post.update');
            Route::post('post', [DashboardBlogPostController::class, 'store'])->name('blog.post.store');
            Route::delete('post/{post:id}/deletar', [DashboardBlogPostController::class, 'destroy'])->name('blog.post.destroy');

            Route::put('post/{post:id}/home', [DashboardBlogPostAtHomeController::class, 'update'])->name('blog.post.at_home');
            
            Route::get('post/autores', [DashboardBlogPostUserController::class, 'index'])->name('blog.post.user.index');

            Route::post('categoria', [DashboardBlogCategoryController::class, 'store'])->name('blog.category.store');
            Route::put('categoria/{category:id}/atualizar', [DashboardBlogCategoryController::class, 'update'])->name('blog.category.update');
            Route::delete('categoria/{category:id}/deletar', [DashboardBlogCategoryController::class, 'destroy'])->name('blog.category.destroy');

            Route::patch('comentario/{comment:id}/moderar/{status}', [DashboardBlogCommentModerateController::class, 'update'])->name('blog.post.comment.moderate.update');
            Route::delete('comentario/{comment}/deletar', [DashboardBlogCommentController::class, 'destroy'])->name('blog.post.comment.destroy');

            Route::post('faq', [DashboardFaqController::class, 'store'])->name('faq.store');
            Route::put('faq/{faq:id}/atualizar', [DashboardFaqController::class, 'update'])->name('faq.update');
            Route::delete('faq/{faq:id}/deletar', [DashboardFaqController::class, 'destroy'])->name('faq.destroy');

            Route::post('usuario', [DashboardUserController::class, 'store'])->name('user.store');
            Route::put('usuario/{user:id}/atualizar', [DashboardUserController::class, 'update'])->name('user.update');
            Route::delete('usuario/{user:id}/deletar', [DashboardUserController::class, 'destroy'])->name('user.destroy');

            Route::delete('contato/{contact}', [DashboardContactController::class, 'destroy'])->name('contact.destroy');
            Route::post('configuracao', [WebConfigurationController::class, 'update'])->name('configuration.update');
        });

        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::get('imoveis', [DashboardPropertyController::class, 'index'])->name('property.index');
        Route::get('imovel/{property}', [DashboardPropertyController::class, 'show'])->name('property.show');

        Route::get('contatos', [DashboardContactController::class, 'index'])->name('contact.index');
        Route::get('contato/{contact}', [DashboardContactController::class, 'show'])->name('contact.show');
        Route::put('contato/{contact}/atualizar', [DashboardContactController::class, 'update'])->name('contact.update');
        
        Route::get('posts', [DashboardBlogPostController::class, 'index'])->name('blog.post.index');
        Route::get('post/criar', [DashboardBlogPostController::class, 'create'])->name('blog.post.create');
        Route::get('post/{post:id}/editar', [DashboardBlogPostController::class, 'edit'])->name('blog.post.edit');

        Route::get('comentarios', [DashboardBlogCommentController::class, 'index'])->name('blog.comment.index');

        Route::get('categorias', [DashboardBlogCategoryController::class, 'index'])->name('blog.category.index');
        Route::get('categoria/criar', [DashboardBlogCategoryController::class, 'create'])->name('blog.category.create');
        Route::get('categoria/{category:id}/editar', [DashboardBlogCategoryController::class, 'edit'])->name('blog.category.edit');

        Route::get('faqs', [DashboardFaqController::class, 'index'])->name('faq.index');
        Route::get('faq/criar', [DashboardFaqController::class, 'create'])->name('faq.create');
        Route::get('faq/{faq:id}/editar', [DashboardFaqController::class, 'edit'])->name('faq.edit');

        Route::get('usuarios', [DashboardUserController::class, 'index'])->name('user.index');
        Route::get('usuario/criar', [DashboardUserController::class, 'create'])->name('user.create');
        Route::get('usuario/{user:id}/editar', [DashboardUserController::class, 'edit'])->name('user.edit');

        Route::get('configuracao', [WebConfigurationController::class, 'create'])->name('configuration.create');

        Route::get('privacidade', [DashboardPrivacyController::class, 'create'])->name('privacy.create');
        Route::post('privacidade', [DashboardPrivacyController::class, 'store'])->name('privacy.store');

        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    });

});

/** Testes */
Route::get('teste', function(){

    return \App\Models\Property::first();

});
