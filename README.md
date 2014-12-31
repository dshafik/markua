# Markua

[![Build Status](https://travis-ci.org/dshafik/markua.svg?branch=master)](https://travis-ci.org/dshafik/markua)


**league/markua** is a Markdown parser for PHP which intends to support the full [Markua] spec.  The Markua spec is [still evolving](https://leanpub.com/markua/read).

## Goals

This aims to fully support the Markua specification, and will continue to evolve as the spec does.

### League\CommonMark

This package depends on [League\CommonMark](http://commonmark.thephpleague.com) and functions identically
except for using the Markua specification.

## Installation

This project can be installed via [Composer]:

``` bash
$ composer require league/markua
```

## Basic Usage

The `MarkuaConverter` class provides a simple wrapper for converting Markua to HTML:

```php
use League\Markua\MarkuaConverter;

$converter = new MarkuaConverter();
echo $converter->convertToHtml('# Hello World!');

// <h1>Hello World!</h1>
```

## Advanced Usage & Customization

The actual conversion process requires two steps:

 1. Parsing the Markdown input into an AST
 2. Rendering the AST document as HTML

Although the `MarkuaConverter` wrapper simplifies this process for you, advanced users will likely want to do this themselves:

```php
use League\CommonMark\DocParser;
use League\CommonMark\Environment;
use League\CommonMark\HtmlRenderer;
use League\Markua\Environment\Markua;

// Obtain a pre-configured Environment with all the Markua parsers/renderers ready-to-go
$environment = Environment::createEnvironment(new Markua());

// Optional: Add your own parsers/renderers here, if desired
// For example:  $environment->addInlineParser(new TwitterHandleParser());

// Create the document parser and HTML renderer engines
$parser = new DocParser($environment);
$htmlRenderer = new HtmlRenderer($environment);

// Here's our sample input
$markdown = '# Hello World!';

// 1. Parse the Markdown to AST
$documentAST = $parser->parse($markdown);

// Optional: If you want to access/modify the AST before rendering, do it here

// 2. Render the AST as HTML
echo $htmlRenderer->renderBlock($documentAST);

// The output should be:
// <h1>Hello World!</h1>
```

This approach allows you to access/modify the AST before rendering it.

You can also add custom parsers/renderers by [registering them with the `Environment` class](http://commonmark.thephpleague.com/customization/environment/).
The [league/commonmark documentation][commonmark-docs] provides several [customization examples][docs-examples] such as:

- [Parsing Twitter handles into profile links][docs-example-twitter]
- [Converting smilies into emoticon images][docs-example-smilies]

You can also reference the core CommonMark parsers/renderers as they use the same functionality available to you.

## Compatibility with Markua ##

This project aims to fully support the entire [Markua Spec]. Other flavors of Markdown may work but are not supported.  Any/all changes made to the spec should eventually find their way back into this codebase.

This package is **not** part of Markua, but rather a compatible derivative.

## Documentation

Documentation can be found at [markua.thephpleague.com][docs].

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## Stability and Versioning

While this package does work well, the underlying code should not be considered "stable" yet.  The original spec may undergo changes in the near future, which will result in corresponding changes to this code.  Any methods tagged with `@api` are not expected to change, but other methods/classes might.

Major release 1.0.0 will be reserved for when both Markua and this project are considered stable. 0.x.x will be used until that happens.

SemVer will be followed [closely](http://semver.org/).

## Contributing

If you encounter a bug in the spec, please report it to the [Markua] project.  Any resulting fix will eventually be implemented in this project as well.

Please see [CONTRIBUTING](https://github.com/thephpleague/commonmark/blob/master/CONTRIBUTING.md) for additional details.

## Credits & Acknowledgements

- [Davey Shafik][@dshafik]
- [Colin O'Dell][@colinodell]
- [John MacFarlane][@jgm]
- [All Contributors]

## License ##

**league/markua** is licensed under the BSD-3 license.  See the `LICENSE` file for more details.

[Markua]: http://markua.org/
[Markua spec]: https://leanpub.com/markua/read
[John MacFarlane]: http://johnmacfarlane.net
[commonmark-docs]: http://commonmark.thephpleague.com/
[docs]: http://markua.thephpleague.com/
[docs-examples]: http://commonmark.thephpleague.com/customization/overview/#examples
[docs-example-twitter]: http://commonmark.thephpleague.com/customization/inline-parsing#example-1---twitter-handles
[docs-example-smilies]: http://commonmark.thephpleague.com/customization/inline-parsing#example-2---emoticons
[All Contributors]: https://github.com/thephpleague/markua/contributors
[@colinodell]: https://github.com/colinodell
[@jgm]: https://github.com/jgm
[jgm/stmd]: https://github.com/jgm/stmd
[Composer]: https://getcomposer.org/
[Davey Shafik]: http://twitter.com/dshafik
[@dshafik]: https://github.com/dshafik
