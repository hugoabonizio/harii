# Harii
Hugo's ActiveRecord Inspired Implementation

## Models

### Definition
```php
class Product extends \Harii\Model {
	public $price, $name, $description;
}
```

### Query Interface
```php
// all products
$products = Product::all(); 
foreach ($products as $p) {
	echo "Name: " . $p->name;
}

// product where ID is 5
$product = Product::find(5); 
echo "$" . $product->price;

// where filter
$toys = Product::where('category = ?', 'Toys');
$cheap_toys = Product::where('category = :category AND price < :price', array( // TODO
	'category' => 'Toys',
	'price' => 10.99
));
```

### Manipulate
```php
$user = User::create(array(
	'name' => 'Hugo',
	'age' => 21
));

$user = User::find($_GET['id']);
$user->name = 'New Name';
$user->save();
```

### Validations
```php
class User extends \Harii\Model {
	public $user, $email, $password;
	
	// validates required field and only letters
	validates('name', array('presence' => true, 'regex' => '/\A[a-zA-Z]+\z/'));
	
	// validates required field with minimum 6 and maximum 12 length
	validates('password', array('presence' => true, 'min' => 6, 'max' => 12));
}

// and in your controller
$user = new User();
$user->name = $_POST['name'];
$user->password = $_POST['password'];
if ($user->isValid()) {
	$user->save();
} else {
	// show some error message
}
```