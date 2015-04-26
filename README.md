# Harii
Hugo's ActiveRecord Inspired Implementation

## Models

### Definition
```php
class Product extends Harii {
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

// filter
$toys = Product::where('category = ?', 'Toys');
```

### Inserting
```php
$user = User.create(array(
	'name' => 'Hugo',
	'age' => 21
));
```

### Validations
```php
class User extends Harii {
	public $user, $email, $password;
	
	// validates required field and only letters
	validates('user', array('presence' => true, 'regex' => '/\A[a-zA-Z]+\z/'));
	
	// validates required field with minimum 6 and maximum 12 length
	validates('password', array('presence' => true, 'min' => 6, 'max' => 12));
}
```