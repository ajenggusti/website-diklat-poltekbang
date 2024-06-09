<?php
namespace App\Providers;

use App\Models\User;
use App\Models\Diklat;
use App\Models\Event;
use App\Models\KatDiklat;
use App\Models\Pendaftaran;
use App\Models\Promos;
use App\Models\Testimoni;
use App\Policies\UserPolicy;
use App\Policies\DiklatPolicy;
use App\Policies\EventPolicy;
use App\Policies\KatDiklatPolicy;
use App\Policies\PendaftaranPolicy;
use App\Policies\PromoPolicy;
use App\Policies\TestimoniPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Diklat::class => DiklatPolicy::class,
        User::class => UserPolicy::class,
        Event::class=>EventPolicy::class,
        KatDiklat::class=>KatDiklatPolicy::class,
        Pendaftaran::class=>PendaftaranPolicy::class,
        Promos::class=>PromoPolicy::class,
        Testimoni::class=>TestimoniPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
