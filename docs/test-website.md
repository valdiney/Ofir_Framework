## Creating a website to show products

Imagine that we need to create a website to show various products. So, some routes as need to work with it. You will can create these ones:

- /: home
- /products: show all products
- /products/12: show a individual product by id "12"
- /users/john-doe: show a individual user called "jhon-doe"

**IMPORTANT!**

For now, to get args in url, you need to pass at least one branch, for example:

- http://website.com/[users]/edit/123
- http://website.com/[products]/test-123
- http://website.com/[items]/1-lorem-ipsum

These items: "users", "products" and "item" is the first branch passed in url.\
Possibly, in these items, you can uses:

- **HomeController::users(int $id)** or **UserController::edit(int $id)**
- **HomeController::products(int $slug)** or **ProductsController::index(int $slug)**
- **HomeController::item(int $slug)** or **ItemsController::index(int $slug)**

It will help so mutch to provides to the user of your website an `friendly url`, then you routes go from:

- **http://website.com/users-edit.php?id=123** to **http://website.com/users/edit/123**
- **http://website.com/products.php?slug=test-123** to **http://website.com/products/test-123**
- **http://website.com/items.php?slug=1-lorem-ipsum** to **http://website.com/items/1-lorem-ipsum**

### the next step is create the Controller

We will create a Controller called: "ProductsController".

In controller folder, in "sources/controllers/" create this `php` file: "ProductsController.php".\
Then, put it in this file:

```php
<?php
class ProductsController extends BaseController
{
    protected $products;
    public function __construct() {
        $this->products = $this->model('Products');
    }
    public function index()
    {
        $title = 'All products';
        $products = $this->products->select()->getAll();
        return $this->view('producsts.home', compact('title','products'));
    }
}
```

Then create a file in views folder "sources/views/products/home.php", and put it in this file:

```html
<?php foreach($products as $product) { ?>
    <section>
        <h3><?php echo $product->name;?></h3>
        <p><?php echo $product->description;?></p>
    </section>
<?php } ?>
```

The next step is creates a `Model Class`. Create this file in: "sources/models/Products.php", and put this:

```php
<?php
class Products extends BaseModel
{
    protected $table = 'products';
}
```

When you access the url: `http://website.com/products/` it will show all products.

To show a individual one, alter the view "sources/views/products/home.php":

```html
<?php foreach($products as $product) { ?>
    <section>
        <h3><?php echo $product->title;?></h3>
        <p><?php echo $product->description;?></p>
        <p>
            <a href="products/show/<?php echo $product->id; ?>">
                see this product
            </a>
        </p>
    </section>
<?php } ?>
```

In your `ProductsController`, create a new method:

```php
<?php
class ProductsController extends BaseController
{
    ...
    public function show(int $id)
    {
        $product = $this->products->find($id);
        $title = "Product: {$product->title}";
        return $this->view('products.unique', compact('title','product'));
    }
}
```

Create a new file "sources/views/products/unique.php", an put:

```html
<h2><?php echo $product->title; ?></h2>
<h4><?php echo $product->description; ?></h4>
<a href="products/buy/<?php echo $product->id; ?>">
    Buy this product!
</a>
```

This will provides to you an simple and fast website.

#### Exercise

Well, did you see the simple steps to create a `Controller`, a `Model` and a `View`, and did you see too that in the file "sources/views/products/unique.php", the url that has been implanted is pointing to "products/buy/[id]". But the url not exists.\
Create this `Method` and this `View` and made it works! :wink:

---

It's all from now!
