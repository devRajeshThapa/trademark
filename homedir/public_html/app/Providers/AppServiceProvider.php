<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Country;
use App\Models\Favicon;
use App\Models\Service;
use App\Models\Category;
use App\Models\University;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\BlogPostsCategory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    Schema::defaultStringLength(191);

    if (Schema::hasTable('favicons')) {
        $favicon = Favicon::first();
        View::share('favicon', $favicon);
    }

    if (Schema::hasTable('site_settings')) { // Use your exact table name
        $sitesetting = SiteSetting::first();
        View::share('sitesetting', $sitesetting);
    }

    View::composer('frontend.includes.navbar', function ($view) {
        if (Schema::hasTable('countries') &&
            Schema::hasTable('testimonials') &&
            Schema::hasTable('courses') &&
            Schema::hasTable('categories') &&
            Schema::hasTable('blog_posts_categories') && // your actual table name
            Schema::hasTable('site_settings')) {

            $countries = Country::all();
            $testimonials = Testimonial::all();
            $courses = Course::all();
            $categories = Category::all();
            $blogpostcategories = BlogPostsCategory::all();

            // Check if those categories exist before querying posts to avoid null errors
            $testPreparationPosts = Category::where('title', 'Test Prepration')->exists()
                ? Category::where('title', 'Test Prepration')->first()->posts
                : collect();

            $livingAbroadPosts = Category::where('title', 'Living Abroad')->exists()
                ? Category::where('title', 'Living Abroad')->first()->posts
                : collect();

            $sitesetting = SiteSetting::first();

            $view->with(compact(
                'countries', 'testimonials', 'courses', 'categories',
                'blogpostcategories', 'testPreparationPosts', 'livingAbroadPosts', 'sitesetting'
            ));
        }
    });

    view()->composer('frontend.includes.footer', function ($view) {
        if (Schema::hasTable('site_settings') &&
            Schema::hasTable('categories') &&
            Schema::hasTable('services') &&
            Schema::hasTable('courses')) {

            $sitesetting = SiteSetting::first();

            $counsellingCategory = Category::where('title', 'Counselling')->first();
            $counsellingPosts = $counsellingCategory ? $counsellingCategory->posts()->take(2)->get() : collect();

            $newsCategory = Category::where('title', 'News')->first();

            $livingAbroadPosts = Category::where('title', 'Living Abroad')->exists()
                ? Category::where('title', 'Living Abroad')->first()->posts
                : collect();

            $services = Service::all();
            $courses = Course::all();
            $siteSettings = SiteSetting::first();

            $view->with(compact(
                'sitesetting', 'counsellingPosts', 'newsCategory',
                'livingAbroadPosts', 'services', 'courses', 'siteSettings'
            ));
        }
    });
}

}
