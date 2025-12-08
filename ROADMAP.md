# 🚀 Roadmap Laravel - Projet E-commerce/Catalogue

Voici une roadmap progressive pour ton projet solo Laravel. J'ai structuré le tout autour d'un système de **gestion de catalogue e-commerce** qui te permettra d'explorer un maximum de concepts.

## ⚡ Quick Start (Pour commencer maintenant)

```bash
# 1. Créer le projet
composer create-project laravel/laravel ShopHub
cd ShopHub

# 2. Installer Filament (Admin)
composer require filament/filament:"^3.2"
php artisan filament:install --panels
php artisan make:filament-user

# 3. Installer Livewire + Mary UI (Front)
composer require livewire/livewire
composer require robsontenorio/mary
php artisan mary:install

# 4. Configurer la BDD
# Éditer .env puis :
php artisan migrate

# 5. Lancer le serveur
php artisan serve
# Admin : http://localhost:8000/admin
# Front : http://localhost:8000
```

**Premiers fichiers à créer :**

```bash
# Modèles & migrations
php artisan make:model Product -mfs
php artisan make:model Category -mfs
php artisan make:model Order -mfs

# Ressources Filament (admin auto)
php artisan make:filament-resource Product --generate

# Composants Livewire (front)
php artisan make:livewire ProductCatalog
```

---

## 🎯 Projet : "ShopHub" - Plateforme de gestion de produits & commandes

---

## 🎨 Stack Front-End Recommandée

### Option 1 : Laravel Livewire + Blade (⭐ RECOMMANDÉ pour débuter)

**Le plus simple pour un dev backend !**

```bash
composer require livewire/livewire
php artisan make:livewire ProductList
```

**Avantages :**

-   ✅ Pas besoin de JS complexe (tout en PHP)
-   ✅ Composants réactifs automatiques
-   ✅ Validation en temps réel
-   ✅ Parfait avec **Filament** pour l'admin

**UI avec Livewire :**

-   **Mary UI** : `composer require robsontenorio/mary` - Components Tailwind + Livewire (très moderne)
-   **Tall Stack** : Tailwind + Alpine + Livewire + Laravel
-   **Wire UI** : Components Livewire pré-faits (modals, notifications, inputs)

**Exemple component produit :**

```php
// app/Livewire/ProductList.php
class ProductList extends Component {
    public $search = '';

    public function render() {
        return view('livewire.product-list', [
            'products' => Product::where('name', 'like', "%{$this->search}%")->get()
        ]);
    }
}
```

---

### Option 2 : Filament (Admin + Front public)

**Le plus rapide pour un backoffice complet !**

```bash
composer require filament/filament
php artisan filament:install --panels
```

**Avantages :**

-   ✅ Admin panel complet en 5 minutes
-   ✅ CRUD auto-généré
-   ✅ Tables, formulaires, stats built-in
-   ✅ Peut aussi servir pour le front avec Filament v3

**Idéal pour :**

-   Dashboard admin
-   Gestion produits/commandes/users
-   Rapports et analytics

## 🔍 Comparaison des Options UI

| Critère                    | Livewire + Mary UI | Filament               | Inertia + Vue         |
| -------------------------- | ------------------ | ---------------------- | --------------------- |
| **Courbe d'apprentissage** | ⭐⭐⭐⭐⭐ Facile  | ⭐⭐⭐⭐⭐ Très facile | ⭐⭐⭐ Moyen          |
| **Rapidité de dev**        | ⭐⭐⭐⭐ Rapide    | ⭐⭐⭐⭐⭐ Très rapide | ⭐⭐⭐ Moyen          |
| **Flexibilité design**     | ⭐⭐⭐⭐ Bonne     | ⭐⭐⭐ Limitée         | ⭐⭐⭐⭐⭐ Totale     |
| **Performance**            | ⭐⭐⭐⭐ Bonne     | ⭐⭐⭐⭐ Bonne         | ⭐⭐⭐⭐⭐ Excellente |
| **Idéal pour**             | Front public       | Admin/Backoffice       | SPA complexe          |
| **JS requis**              | Minimal (Alpine)   | Minimal                | Vue/React complet     |

**💡 Ma recommandation pour ton projet :**

-   **Admin** : Filament (gain de temps énorme)
-   **Front public** : Livewire + Mary UI (stack cohérente, facile à apprendre)

---

## 🛠️ Stack UI Recommandée pour ton Projet

### Pour l'Admin (Backoffice)

**👉 Filament v3** (sans hésiter !)

```bash
composer require filament/filament:"^3.2"
php artisan filament:install --panels

# Créer une ressource Product en 1 commande
php artisan make:filament-resource Product --generate
```

Tu auras instantanément :

-   ✅ CRUD produits avec filtres/recherche
-   ✅ Gestion utilisateurs et rôles
-   ✅ Dashboard avec widgets
-   ✅ Export Excel/PDF intégré
-   ✅ Upload images drag & drop

### Pour le Front Public (Catalogue client)

**👉 Livewire + Mary UI**

```bash
composer require livewire/livewire
composer require robsontenorio/mary

# Dans AppServiceProvider
Mary::install();
```

Components disponibles :

```blade
{{-- Carte produit --}}
<x-mary-card title="{{ $product->name }}" shadow>
    <x-slot:figure>
        <img src="{{ $product->image }}" />
    </x-slot:figure>

    <x-mary-button label="Ajouter au panier" wire:click="addToCart({{ $product->id }})" />
</x-mary-card>

{{-- Modal panier --}}
<x-mary-modal wire:model="showCart" title="Mon panier">
    @foreach($cartItems as $item)
        <x-mary-list-item :item="$item" />
    @endforeach
</x-mary-modal>
```

---

## 📍 Phase 1 : Fondations (Semaines 1-2)

**Objectif : Maîtriser les bases MVC et REST**

### Setup & Architecture de base

-   ✅ Installation Laravel 11
-   ✅ Configuration SQLite
-   ✅ Git & GitHub/GitLab setup
-   ✅ `.env` configuration (database, mail, queue)

### Modèles & Relations Eloquent

```
- Products (nom, description, prix, stock)
- Categories (avec relation many-to-many)
- Users (authentification Breeze/Sanctum)
```

**À apprendre :**

-   Migrations & seeders
-   Relations Eloquent (hasMany, belongsToMany, morphMany)
-   Factories pour données de test
-   **Spatie Laravel-medialibrary** pour gestion des images produits

### Controllers REST

-   ProductController (CRUD complet)
-   API Resources pour formatter les réponses JSON
-   Form Requests pour validation
-   Route grouping & middleware

**Package clé :** `spatie/laravel-query-builder` pour filtrage/tri API

---

## 📍 Phase 1.5 : Setup Front-End UI (Semaine 2)

**Objectif : Mettre en place les outils UI**

### Installation Filament (Admin)

```bash
composer require filament/filament:"^3.2"
php artisan filament:install --panels
php artisan make:filament-user

# Créer les ressources auto
php artisan make:filament-resource Product --generate
php artisan make:filament-resource Category --generate
php artisan make:filament-resource Order --generate
```

**Configuration :**

-   Panel admin sur `/admin`
-   Authentification séparée
-   Personnalisation thème (couleurs, logo)

### Installation Livewire + Mary UI (Front public)

```bash
composer require livewire/livewire
composer require robsontenorio/mary
php artisan mary:install

# Créer les composants
php artisan make:livewire ProductCatalog
php artisan make:livewire ProductDetail
php artisan make:livewire ShoppingCart
php artisan make:livewire Checkout
```

### Structure des vues

```
resources/views/
├── layouts/
│   ├── admin.blade.php (Filament géré auto)
│   └── app.blade.php (Layout front avec Mary UI)
├── livewire/
│   ├── product-catalog.blade.php
│   ├── product-detail.blade.php
│   └── shopping-cart.blade.php
└── components/ (Blade components custom si besoin)
```

**Package bonus :** `wire-elements/modal` pour modals Livewire élégantes

---

## 📍 Phase 2 : Sécurité & Permissions (Semaine 3)

### Authentification avancée

-   API tokens avec Sanctum
-   Rate limiting
-   Email verification

### Gestion des rôles

**Package :** `spatie/laravel-permission`

```
Rôles : Admin, Vendor, Customer
Permissions : create-products, manage-orders, view-analytics
```

**À implémenter :**

-   Middleware de permissions
-   Policies pour authorisation fine
-   Scopes Eloquent pour filtrer par utilisateur

---

## 📍 Phase 3 : Commandes & Paiements (Semaines 4-5)

### Système de commandes

```
Models : Orders, OrderItems, Addresses, DeliveryMethods
Statuts : pending → paid → processing → shipped → delivered
```

**Concepts clés :**

-   Transactions database (DB::transaction)
-   Events & Listeners (`OrderPlaced`, `OrderShipped`)
-   Queues pour envoi emails (notification vendeur/client)

### Paiements

**Package :** `stripe/stripe-php` ou `laravel/cashier`

-   Webhooks Stripe
-   Gestion remboursements

---

## 📍 Phase 4 : Features Avancées (Semaines 6-7)

### Internationalisation

**Package :** `spatie/laravel-translatable`

-   Produits multilingues (FR, EN, ES)
-   Traduction dynamique des catégories
-   **Carbon** pour gestion timezones (affichage dates commandes)

### Recherche & Filtres

**Package :** `laravel/scout` + Meilisearch/Algolia

-   Recherche full-text produits
-   Filtres avancés (prix, catégories, tags)
-   Autocomplete API

### Cache & Performance

**Package :** `spatie/laravel-responsecache`

-   Cache Redis pour listes produits
-   Cache invalidation sur update
-   Eager loading pour éviter N+1 queries

---

## 📍 Phase 5 : Temps Réel & Notifications (Semaine 8)

### Laravel Reverb (WebSockets)

**Cas d'usage :**

-   Notifications temps réel pour nouveaux commandes (dashboard admin)
-   Stock produit mis à jour en direct
-   Chat support client (bonus)

**À implémenter :**

```php
// Event
OrderPlaced → broadcast sur channel "orders.{userId}"

// Frontend (Alpine.js + Echo)
Echo.private('orders.1')
    .listen('OrderPlaced', (e) => {
        // Update UI en temps réel
    });
```

### Notifications multi-canaux

**Package :** `laravel/slack-notification-channel`

-   Email (Mailtrap en dev)
-   SMS (Twilio/Vonage)
-   Slack pour alertes admin
-   Database notifications (cloche dans l'app)

---

## 📍 Phase 6 : Administration & Analytics (Semaine 9)

### Backoffice Admin avec Filament

**Déjà installé en Phase 1.5, maintenant on l'enrichit !**

#### Widgets Dashboard

```bash
php artisan make:filament-widget StatsOverview --stats
php artisan make:filament-widget RevenueChart --chart
php artisan make:filament-widget LatestOrders --table
```

**Widgets à créer :**

-   Stats : Total ventes, Commandes du jour, Produits en rupture
-   Chart : Évolution revenus (Chart.js intégré)
-   Table : Dernières commandes avec actions rapides

#### Personnalisation Filament

```php
// app/Filament/Resources/ProductResource.php
public static function table(Table $table): Table
{
    return $table
        ->columns([
            ImageColumn::make('image'),
            TextColumn::make('name')->searchable(),
            TextColumn::make('price')->money('eur'),
            BadgeColumn::make('stock')
                ->colors([
                    'danger' => fn ($state) => $state < 10,
                    'warning' => fn ($state) => $state < 50,
                    'success' => fn ($state) => $state >= 50,
                ]),
        ])
        ->filters([
            SelectFilter::make('category'),
            Filter::make('low_stock')
                ->query(fn ($query) => $query->where('stock', '<', 10))
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\Action::make('duplicate')
                ->icon('heroicon-o-document-duplicate'),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
                ExportBulkAction::make(), // spatie/laravel-excel
            ]),
        ]);
}
```

#### Activity Log

**Package :** `spatie/laravel-activitylog`

```php
// Dans les models
use Spatie\Activitylog\Traits\LogsActivity;

protected static $logAttributes = ['name', 'price', 'stock'];
protected static $logOnlyDirty = true;

// Voir l'historique dans Filament
php artisan make:filament-resource Activity --generate
```

### Front Public : Composants Livewire à finaliser

#### ProductCatalog.php

```php
class ProductCatalog extends Component
{
    public $search = '';
    public $category = null;
    public $priceMin = 0;
    public $priceMax = 1000;
    public $sortBy = 'name';

    protected $queryString = ['search', 'category'];

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->category, fn($q) => $q->where('category_id', $this->category))
            ->whereBetween('price', [$this->priceMin, $this->priceMax])
            ->orderBy($this->sortBy)
            ->paginate(12);

        return view('livewire.product-catalog', compact('products'));
    }
}
```

#### ShoppingCart.php (avec Reverb pour updates temps réel)

```php
class ShoppingCart extends Component
{
    use WithDispatch;

    public $cartItems = [];

    protected $listeners = ['productAdded' => 'refreshCart'];

    public function addToCart($productId)
    {
        // Logique ajout panier
        $this->dispatch('cart-updated'); // Event Livewire

        // Broadcast Reverb pour autres onglets
        broadcast(new CartUpdated($this->cartItems));
    }
}
```

### Rapports & Exports

**Package :** `maatwebsite/laravel-excel`

-   Export commandes en CSV/Excel
-   Import produits en masse
-   Génération PDF factures avec `barryvdh/laravel-dompdf`

---

## 📍 Phase 7 : DevOps & Optimisation (Semaine 10)

### Tests

```
- Feature tests : API endpoints
- Unit tests : logique métier (calcul prix, stock)
- Package : laravel/pest (syntaxe moderne)
```

### CI/CD

-   GitHub Actions : tests automatiques
-   Deploy sur Laravel Forge / DigitalOcean
-   **Spatie Laravel-health** : monitoring santé app

### Optimisation

-   Horizon pour supervision queues
-   Telescope en dev pour debugging
-   Octane pour performance (optionnel)

---

## 💻 Exemples de Code Concrets

### 1. Page Catalogue avec Livewire + Mary UI

```blade
{{-- resources/views/livewire/product-catalog.blade.php --}}
<div class="container mx-auto px-4 py-8">

    {{-- Barre de recherche et filtres --}}
    <div class="mb-8">
        <x-mary-input
            wire:model.live="search"
            placeholder="Rechercher un produit..."
            icon="o-magnifying-glass"
        />

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-4">
            <x-mary-select
                wire:model.live="category"
                :options="$categories"
                placeholder="Catégorie"
            />

            <x-mary-range
                wire:model.live="priceRange"
                min="0"
                max="1000"
                label="Prix max: {{ $priceRange }}€"
            />

            <x-mary-select
                wire:model.live="sortBy"
                :options="[
                    ['id' => 'name', 'name' => 'Nom'],
                    ['id' => 'price_asc', 'name' => 'Prix croissant'],
                    ['id' => 'price_desc', 'name' => 'Prix décroissant']
                ]"
            />
        </div>
    </div>

    {{-- Grille de produits --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <x-mary-card
                title="{{ $product->name }}"
                subtitle="{{ $product->category->name }}"
                shadow
                class="hover:shadow-lg transition"
            >
                <x-slot:figure>
                    <img src="{{ $product->image_url }}" class="h-48 object-cover" />
                </x-slot:figure>

                <div class="space-y-2">
                    <p class="text-sm text-gray-600 line-clamp-2">
                        {{ $product->description }}
                    </p>

                    <div class="flex items-center justify-between">
                        <span class="text-2xl font-bold text-primary">
                            {{ $product->price }}€
                        </span>

                        <x-mary-badge
                            :value="$product->stock > 0 ? 'En stock' : 'Rupture'"
                            :class="$product->stock > 0 ? 'badge-success' : 'badge-error'"
                        />
                    </div>
                </div>

                <x-slot:actions>
                    <x-mary-button
                        label="Voir détails"
                        link="/products/{{ $product->id }}"
                        icon="o-eye"
                        class="btn-ghost btn-sm"
                    />

                    <x-mary-button
                        label="Ajouter"
                        wire:click="addToCart({{ $product->id }})"
                        icon="o-shopping-cart"
                        class="btn-primary btn-sm"
                        :disabled="$product->stock == 0"
                        spinner="addToCart({{ $product->id }})"
                    />
                </x-slot:actions>
            </x-mary-card>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-8">
        {{ $products->links() }}
    </div>

    {{-- Toast notifications --}}
    <x-mary-toast />
</div>
```

```php
<?php
// app/Livewire/ProductCatalog.php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category;
use Mary\Traits\Toast;

class ProductCatalog extends Component
{
    use WithPagination, Toast;

    public $search = '';
    public $category = null;
    public $priceRange = 1000;
    public $sortBy = 'name';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => null],
    ];

    public function addToCart($productId)
    {
        $product = Product::find($productId);

        // Logique ajout panier
        session()->push('cart', [
            'product_id' => $productId,
            'quantity' => 1,
        ]);

        $this->success("Produit ajouté au panier !");
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        $products = Product::query()
            ->with('category')
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', "%{$this->search}%")
            )
            ->when($this->category, fn($q) =>
                $q->where('category_id', $this->category)
            )
            ->where('price', '<=', $this->priceRange)
            ->orderBy(
                $this->sortBy === 'price_asc' ? 'price' :
                ($this->sortBy === 'price_desc' ? 'price' : 'name'),
                $this->sortBy === 'price_desc' ? 'desc' : 'asc'
            )
            ->paginate(12);

        $categories = Category::all();

        return view('livewire.product-catalog', compact('products', 'categories'));
    }
}
```

### 2. Ressource Filament Product (Admin)

```php
<?php
// app/Filament/Resources/ProductResource.php
public static function table(Tables\Table $table): Tables\Table
{
    return $table
        ->columns([
            Tables\Columns\ImageColumn::make('images')
                ->circular()
                ->stacked(),

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('category.name')
                ->badge(),

            Tables\Columns\TextColumn::make('price')
                ->money('EUR')
                ->sortable(),

            Tables\Columns\TextColumn::make('stock')
                ->badge()
                ->colors([
                    'danger' => fn ($state) => $state < 10,
                    'warning' => fn ($state) => $state < 50,
                    'success' => fn ($state) => $state >= 50,
                ]),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('category')
                ->relationship('category', 'name'),

            Tables\Filters\Filter::make('low_stock')
                ->query(fn ($query) => $query->where('stock', '<', 10)),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
        ]);
}
```

---

## 🎁 Packages Bonus à Explorer

| Package                    | Usage                            |
| -------------------------- | -------------------------------- |
| `spatie/laravel-settings`  | Paramètres app (config boutique) |
| `spatie/laravel-sluggable` | URLs propres produits            |
| `spatie/laravel-tags`      | Système tags produits            |
| `intervention/image`       | Redimensionnement images         |
| `laravel/pulse`            | Monitoring performance           |
| `league/flysystem-aws-s3`  | Upload images sur S3             |

---

## 🎨 Packages UI & Front-End à Utiliser

### Livewire Ecosystem

| Package                 | Usage                                   | Installation                                           |
| ----------------------- | --------------------------------------- | ------------------------------------------------------ |
| **Mary UI**             | Components Tailwind + Livewire modernes | `composer require robsontenorio/mary`                  |
| **Wire UI**             | Inputs, modals, notifications élégantes | `composer require wireui/wireui`                       |
| **Livewire PowerGrid**  | Tables de données avancées              | `composer require power-components/livewire-powergrid` |
| **Alpine Components**   | Dropdown, modals, tooltips              | Inclus avec Mary/Wire UI                               |
| **wire-elements/modal** | Modals Livewire élégantes               | `composer require wire-elements/modal`                 |

### Filament Plugins

| Plugin                    | Usage                       | Installation                                                    |
| ------------------------- | --------------------------- | --------------------------------------------------------------- |
| **Filament Spatie Media** | Gestion images dans admin   | `composer require filament/spatie-laravel-media-library-plugin` |
| **Filament Excel**        | Export/Import dans Filament | `composer require pxlrbt/filament-excel`                        |
| **Filament Shield**       | Permissions UI pour Spatie  | `composer require bezhansalleh/filament-shield`                 |
| **Filament Curator**      | Médiathèque avancée         | `composer require awcodes/filament-curator`                     |

### Tailwind + Alpine Stack

```bash
# Dans package.json
npm install -D tailwindcss@latest postcss autoprefixer
npm install alpinejs

# Layout de base avec Mary UI
<x-mary-nav sticky full-width>
    <x-slot:brand>
        <x-mary-icon name="o-shopping-cart" /> ShopHub
    </x-slot:brand>

    <x-slot:actions>
        <livewire:shopping-cart-badge />
    </x-slot:actions>
</x-mary-nav>
```

### Icons

**Heroicons** (inclus avec Mary/Filament) : `<x-mary-icon name="o-shopping-bag" />`

---

## 🏗️ Structure du Projet Complète

```
ShopHub/
├── app/
│   ├── Filament/
│   │   ├── Resources/
│   │   │   ├── ProductResource.php
│   │   │   ├── OrderResource.php
│   │   │   └── UserResource.php
│   │   └── Widgets/
│   │       ├── StatsOverview.php
│   │       └── RevenueChart.php
│   ├── Livewire/
│   │   ├── ProductCatalog.php
│   │   ├── ProductDetail.php
│   │   ├── ShoppingCart.php
│   │   └── Checkout.php
│   ├── Models/
│   ├── Http/
│   │   └── Controllers/Api/ (API REST si besoin)
│   └── Events/
│       ├── OrderPlaced.php
│       └── CartUpdated.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── livewire/
│       └── welcome.blade.php
└── routes/
    ├── web.php (Front Livewire)
    ├── api.php (API REST optionnelle)
    └── console.php
```

---

## 📚 Ressources d'apprentissage

### Laravel Core

1. **Laracasts** : série "Laravel From Scratch"
2. **Laravel Daily** (YouTube) : tips quotidiens
3. **Spatie Blog** : best practices packages
4. **Laravel News** : veille techno

### Livewire

1. **Laracasts - Livewire 3** : cours complet
2. **Documentation officielle** : laravel-livewire.com
3. **screencasts.com/livewire** : exemples pratiques
4. **Caleb Porzio** (créateur) sur Twitter/YouTube

### Filament

1. **Documentation Filament v3** : filamentphp.com
2. **Filament Daily** (YouTube) : tutorials quotidiens
3. **Filament Examples** : github.com/filamentphp/demo
4. **Filament Tricks** : filamentphp.com/community

### Mary UI

1. **Documentation Mary** : mary-ui.com
2. **Mary Kitchen Sink** : exemples tous composants

---

## 🎯 Checklist Finale du Projet

```markdown
Backend Core

-   [ ] API REST complète (Products, Orders, Users)
-   [ ] Authentification JWT/Sanctum
-   [ ] Rôles & Permissions (Spatie)
-   [ ] Validation avancée (Form Requests)

Base de données

-   [ ] Migrations complexes (foreign keys, indexes)
-   [X] Seeders avec Faker
-   [ ] Relations polymorphiques (commentaires produits)
-   [ ] Soft deletes

Features métier

-   [ ] Gestion stock (décrémentation auto)
-   [ ] Calcul frais livraison
-   [ ] Codes promo (package laravel-promocodes)
-   [ ] Wishlist utilisateur

Internationalisation

-   [ ] Traductions FR/EN
-   [ ] Timezones dans commandes
-   [ ] Devises multiples

Temps réel

-   [ ] Reverb configuré
-   [ ] Notifications WebSocket
-   [ ] Updates stock live

Performance

-   [ ] Cache Redis
-   [ ] Queues pour emails
-   [ ] Lazy loading images
-   [ ] Rate limiting API

Monitoring

-   [ ] Logs structurés
-   [ ] Error tracking (Sentry)
-   [ ] Tests >70% coverage

Front-End Admin (Filament)

-   [ ] Dashboard avec widgets (stats, charts)
-   [X] CRUD Produits avec filtres/recherche
-   [ ] Gestion Commandes (changement statuts)
-   [ ] Gestion Utilisateurs + Rôles
-   [ ] Upload images drag & drop
-   [ ] Export Excel/PDF commandes
-   [ ] Activity log (historique modifications)
-   [ ] Notifications admin (nouvelles commandes)

Front-End Public (Livewire + Mary UI)

-   [ ] Catalogue produits avec filtres
-   [ ] Recherche temps réel
-   [ ] Page détail produit (images, description)
-   [ ] Panier avec updates live
-   [ ] Checkout (formulaire commande)
-   [ ] Compte utilisateur (historique, wishlist)
-   [ ] Notifications toast (ajout panier, commande validée)
-   [ ] Mode responsive (mobile-first)
```

---

## 💡 Conseils de Progression

1. **Semaines 1-3** : Ne pas rush, bien comprendre Eloquent et les relations
2. **Semaines 4-6** : C'est là que tu apprends le plus (business logic)
3. **Semaines 7-10** : Features "cool" qui impressionnent en portfolio

**Temps estimé total :** 10-12 semaines à raison de 10-15h/semaine

---

## 📝 Notes Personnelles

_Espace pour tes notes au fur et à mesure de ta progression..._

---

Bonne chance ! 🚀
