# html
PHP library to generate HTML code

## Usage

```php
namespace Html;

//Create a div
$div = div();

//Render the div
echo $div;
//<div></div>

//Create a div with text content
echo div('Hello world');
//<div>Hello world</div>

//Create a div with more text content
echo div('Hello', ' world');
//<div>Hello world</div>

//Create a div with html content
echo div('Hello ', strong('world'));
//<div>Hello <strong>world</strong></div>

//A div with many content
echo div(
    h1('Hello world'),
    p('This is a paragraph'),
    ul(
        li('And this is a list item'),
        li('Other list item')
    )
);
```

## Attributes

There are two ways to add attributes to the html tags: using an array as the first argument or using magic methods.

```php
//Add attributes using an array
echo div(['id' => 'foo'], 'Hello world');

//Or add attributes with magic methods
echo div('Hello world')->id('foo');

//Both examples outputs: <div id="foo">Hello world</div>
```

All attributes with `null` as value are omitted:

```php
//Add attributes using an array
echo div(['id' => null], 'Hello world');

//Or add attributes with magic methods
echo div('Hello world')->id(null);

//Both examples outputs: <div>Hello world</div>
```

### Flags

In HTML, flags (or boolean attributes) are attributes that does not need a value. Use `boolean` values to add flags.

Example using array syntax:

```php
//Positive flag 
echo div(['hidden' => true]);
//<div hidden></div>

//Negative flag 
echo div(['hidden' => false]);
//<div></div>

//A short method to add positive flags:
echo div(['hidden']);
//<div hidden></div>

//Mixing attributes and flags
echo div(['hidden', 'class' => 'foo']);
//<div hidden class="foo"></div>
```

Example using magic methods:
```php
//Positive flag 
echo div()->hidden(true);
//<div hidden></div>

//Negative flag 
echo div()->hidden(false);
//<div></div>

//A short method to add positive flags (true is not needed):
echo div()->hidden();
//<div hidden></div>
```

### Classes

Some attributes can contain several space-separated values, for example `class`. You can use an array to add classes:

```php
//Using an array
echo div(['class' => ['foo', 'bar']]);

//Using the magic method:
echo div()->class(['foo', 'bar']);

//Both examples return: <div class="foo bar"></div>
```

Use the `key => value` syntax to add classes under some conditions. Only if the value is evaluated as true, the class will be added:

```php
//Using an array
echo div([
    'class' => [
        'foo',
        'bar',
        'theme-blue' => true,
        'error' => !empty($error)
    ]
]);

//Using the magic method:
echo div()->class([
    'foo',
    'bar',
    'theme-blue' => true,
    'error' => !empty($error)
]);

//Both examples output: <div class="foo bar theme-blue"></div>
```

### data-* attributes

Any `data-*` attribute containing a non-scalable value, will be converted to json. Unlike flags, boolean values are included too:

```php
//Using an array
echo div([
    'data-enabled' => true,
    'data-other' => false,
    'data-omitted' => null, //Null values are ommitted
    'data-options' => ['foo', 'bar']
]);

//Using the special method `data()`
echo div()
    ->data('enabled', true),
    ->data('other', false),
    ->data('omitted', null),
    ->data('options', ['foo', 'bar']);

//Both examples output: <div data-enabled="true" data-other="false" data-options="[&quot;foo&quot;,&quot;bar&quot;]"></div>
```

## Import/Export

Elements implements `JsonSerializable` and `Serializable` interfaces, so you can export them:

```php
$article = article(
    header(
        h1('Hello world')
    ),
    div(['class' => 'content'],
        p('This is an article')
    )
);

//Export to JSON
$json = json_encode($article);

//Use the function array2Html to recreate the html from json:
$article = array2Html(json_decode($json, true));

//Serialize and unserialize
$ser = serialize($article);
$article = unserialize($ser);
```

## Other interfaces implemented

All elements that can contain children (not self-closing elements like `<br>` or `<img>`) implement the following standard PHP interfaces:

### ArrayAccess

To access to the children elements using the array API.

```php
$div = div('First child', strong('Second child'), 'Third child');

echo $div[2]; //Third child
```

### IteratorAggregate

To iterate with the element:

```php
$div = div('First child', strong('Second child'), 'Third child');

foreach ($div as $child) {
    echo $child;
}
```

### Countable

To use `count()`:

```php
$div = div('First child', strong('Second child'), 'Third child');

echo count($div); //3
```