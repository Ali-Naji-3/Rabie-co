<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->renderHook(
                'panels::head.end',
                fn (): string => '
                    <style>
                        /* Fast admin dashboard transitions */
                        body { transition: opacity 0.15s ease; }
                        
                        /* Navigation hover effects */
                        .fi-sidebar-nav-item a,
                        .fi-topbar-nav-item a,
                        .fi-breadcrumbs-item a {
                            transition: all 0.15s ease;
                        }
                        
                        .fi-sidebar-nav-item a:hover,
                        .fi-topbar-nav-item a:hover,
                        .fi-breadcrumbs-item a:hover {
                            transform: translateY(-1px);
                        }
                    </style>
                '
            )
            ->renderHook(
                'panels::body.end',
                fn (): string => '
                    <script>
                        // Fast admin navigation
                        document.addEventListener("DOMContentLoaded", function() {
                            const navLinks = document.querySelectorAll(".fi-sidebar-nav-item a, .fi-topbar-nav-item a, .fi-breadcrumbs-item a");
                            
                            navLinks.forEach(link => {
                                link.addEventListener("click", function(e) {
                                    const href = this.getAttribute("href");
                                    if (href && (href.startsWith("/admin") || href.startsWith("admin"))) {
                                        document.body.style.transition = "opacity 0.1s ease";
                                        document.body.style.opacity = "0.95";
                                    }
                                });
                            });
                            
                            window.addEventListener("load", function() {
                                document.body.style.transition = "opacity 0.15s ease";
                                document.body.style.opacity = "1";
                            });
                        });
                    </script>
                '
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->userMenuItems([
                'homepage' => MenuItem::make()
                    ->label('Back to Home')
                    ->url('/')
                    ->icon('heroicon-o-home'),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
