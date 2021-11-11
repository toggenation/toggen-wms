barryvdh/laravel-debugbar          v3.6.4  PHP Debugbar integration for Laravel
beyondcode/laravel-dump-server     1.7.0   Symfony Var-Dump Server for Laravel
brianium/paratest                  v6.3.2  Parallel testing for PHP
brick/math                         0.9.3   Arbitrary-precision arithmetic library
dflydev/dot-access-data            v3.0.1  Given a deep data structure, access data by dot notation.
doctrine/inflector                 2.0.4   PHP Doctrine Inflector is a small library that can perform string manipulations with regard to upper/lowercase...
doctrine/instantiator              1.4.0   A small, lightweight utility to instantiate objects in PHP without invoking their constructors
doctrine/lexer                     1.2.1   PHP Doctrine Lexer parser library that can be used in Top-Down, Recursive Descent Parsers.
dragonmantank/cron-expression      v3.1.0  CRON for PHP: Calculate the next or previous run date and determine if a CRON expression is due
egulias/email-validator            2.1.25  A library for validating emails against several RFCs
facade/flare-client-php            1.9.1   Send PHP errors to Flare
facade/ignition                    2.16.0  A beautiful error page for Laravel applications.
facade/ignition-contracts          1.0.2   Solution contracts for Ignition
fakerphp/faker                     v1.16.0 Faker is a PHP library that generates fake data for you.
fideloper/proxy                    4.4.1   Set trusted proxies for Laravel
filp/whoops                        2.14.4  php error handling for cool kids
graham-campbell/result-type        v1.0.3  An Implementation Of The Result Type
guzzlehttp/psr7                    2.1.0   PSR-7 message implementation that also provides common utility methods
hamcrest/hamcrest-php              v2.0.1  This is the PHP port of Hamcrest Matchers
inertiajs/inertia-laravel          v0.4.5  The Laravel adapter for Inertia.js.
intervention/image                 2.7.0   Image handling and manipulation library with support for Laravel integration
kalnoy/nestedset                   v6.0.0  Nested Set Model for Laravel 5.7 and up
laravel/framework                  v8.70.2 The Laravel Framework.
laravel/sail                       v1.12.4 Docker files for running a basic Laravel application.
laravel/serializable-closure       v1.0.3  Laravel Serializable Closure provides an easy and secure way to serialize closures in PHP.
laravel/tinker                     v2.6.2  Powerful REPL for the Laravel framework.
laravel/ui                         v3.3.2  Laravel UI utilities and presets.
league/commonmark                  2.0.2   Highly-extensible PHP Markdown parser which fully supports the CommonMark spec and GitHub-Flavored Markdown (GFM)
league/config                      v1.1.1  Define configuration arrays with strict schemas and access values with dot notation
league/flysystem                   1.1.5   Filesystem abstraction: Many filesystems, one API.
league/glide                       1.7.0   Wonderfully easy on-demand image manipulation library with an HTTP based API.
league/glide-laravel               1.0.0   Glide adapter for Laravel
league/glide-symfony               1.0.4   Glide adapter for Symfony
league/mime-type-detection         1.8.0   Mime-type detection for Flysystem
maximebf/debugbar                  v1.17.3 Debug bar in the browser for php application
mockery/mockery                    1.4.4   Mockery is a simple yet flexible PHP mock object framework
monolog/monolog                    2.3.5   Sends your logs to files, sockets, inboxes, databases and various web services
myclabs/deep-copy                  1.10.2  Create deep copies (clones) of your objects
nesbot/carbon                      2.54.0  An API extension for DateTime that supports 281 different languages.
nette/schema                       v1.2.2  📐 Nette Schema: validating data structures against a given Schema.
nette/utils                        v3.2.5  🛠  Nette Utils: lightweight utilities for string & array manipulation, image handling, safe JSON encoding/d...
nikic/php-parser                   v4.13.1 A PHP parser written in PHP
nunomaduro/collision               v5.10.0 Cli error handling for console/command-line PHP applications.
opis/closure                       3.6.2   A library that can be used to serialize closures (anonymous functions) and arbitrary objects.
phar-io/manifest                   2.0.3   Component for reading phar.io manifest information from a PHP Archive (PHAR)
phar-io/version                    3.1.0   Library for handling version information and constraints
phpdocumentor/reflection-common    2.2.0   Common reflection classes used by phpdocumentor to reflect the code structure
phpdocumentor/reflection-docblock  5.3.0   With this component, a library can provide support for annotations via DocBlocks or otherwise retrieve informa...
phpdocumentor/type-resolver        1.5.1   A PSR-5 based resolver of Class names, Types and Structural Element Names
phpoption/phpoption                1.8.0   Option Type for PHP
phpspec/prophecy                   1.14.0  Highly opinionated mocking framework for PHP 5.3+
phpunit/php-code-coverage          9.2.8   Library that provides collection, processing, and rendering functionality for PHP code coverage information.
phpunit/php-file-iterator          3.0.5   FilterIterator implementation that filters files based on a list of suffixes.
phpunit/php-invoker                3.1.1   Invoke callables with a timeout
phpunit/php-text-template          2.0.4   Simple template engine.
phpunit/php-timer                  5.0.3   Utility class for timing
phpunit/phpunit                    9.5.10  The PHP Unit Testing framework.
psr/container                      1.1.2   Common Container Interface (PHP FIG PSR-11)
psr/event-dispatcher               1.0.0   Standard interfaces for event handling.
psr/http-factory                   1.0.1   Common interfaces for PSR-7 HTTP message factories
psr/http-message                   1.0.1   Common interface for HTTP messages
psr/log                            2.0.0   Common interface for logging libraries
psr/simple-cache                   1.0.1   Common interfaces for simple caching
psy/psysh                          v0.10.9 An interactive shell for modern PHP.
ralouphie/getallheaders            3.0.3   A polyfill for getallheaders.
ramsey/collection                  1.2.2   A PHP library for representing and manipulating collections.
ramsey/uuid                        4.2.3   A PHP library for generating and working with universally unique identifiers (UUIDs).
reinink/remember-query-strings     v0.1.0  Laravel middleware that automatically remembers and restores query strings.
sebastian/cli-parser               1.0.1   Library for parsing CLI options
sebastian/code-unit                1.0.8   Collection of value objects that represent the PHP code units
sebastian/code-unit-reverse-lookup 2.0.3   Looks up which function or method a line of code belongs to
sebastian/comparator               4.0.6   Provides the functionality to compare PHP values for equality
sebastian/complexity               2.0.2   Library for calculating the complexity of PHP code units
sebastian/diff                     4.0.4   Diff implementation
sebastian/environment              5.1.3   Provides functionality to handle HHVM/PHP environments
sebastian/exporter                 4.0.3   Provides the functionality to export PHP variables for visualization
sebastian/global-state             5.0.3   Snapshotting of global state
sebastian/lines-of-code            1.0.3   Library for counting the lines of code in PHP source code
sebastian/object-enumerator        4.0.4   Traverses array structures and object graphs to enumerate all referenced objects
sebastian/object-reflector         2.0.4   Allows reflection of object attributes, including inherited and non-public ones
sebastian/recursion-context        4.0.4   Provides functionality to recursively process PHP variables
sebastian/resource-operations      3.0.3   Provides a list of PHP built-in functions that operate on resources
sebastian/type                     2.3.4   Collection of value objects that represent the types of the PHP type system
sebastian/version                  3.0.2   Library that helps with managing the version number of Git-hosted PHP projects
swiftmailer/swiftmailer            v6.3.0  Swiftmailer, free feature-rich PHP mailer
symfony/console                    v5.3.10 Eases the creation of beautiful and testable command line interfaces
symfony/css-selector               v5.3.4  Converts CSS selectors to XPath expressions
symfony/debug                      v4.4.31 Provides tools to ease debugging PHP code
symfony/deprecation-contracts      v2.4.0  A generic function and convention to trigger deprecation notices
symfony/error-handler              v5.3.7  Provides tools to manage errors and ease debugging PHP code
symfony/event-dispatcher           v5.3.7  Provides tools that allow your application components to communicate with each other by dispatching events and...
symfony/event-dispatcher-contracts v2.4.0  Generic abstractions related to dispatching event
symfony/finder                     v5.3.7  Finds files and directories via an intuitive fluent interface
symfony/http-client-contracts      v2.4.0  Generic abstractions related to HTTP clients
symfony/http-foundation            v5.3.10 Defines an object-oriented layer for the HTTP specification
symfony/http-kernel                v5.3.10 Provides a structured process for converting a Request into a Response
symfony/mime                       v5.3.8  Allows manipulating MIME messages
symfony/polyfill-ctype             v1.23.0 Symfony polyfill for ctype functions
symfony/polyfill-iconv             v1.23.0 Symfony polyfill for the Iconv extension
symfony/polyfill-intl-grapheme     v1.23.1 Symfony polyfill for intl's grapheme_* functions
symfony/polyfill-intl-idn          v1.23.0 Symfony polyfill for intl's idn_to_ascii and idn_to_utf8 functions
symfony/polyfill-intl-normalizer   v1.23.0 Symfony polyfill for intl's Normalizer class and related functions
symfony/polyfill-mbstring          v1.23.1 Symfony polyfill for the Mbstring extension
symfony/polyfill-php72             v1.23.0 Symfony polyfill backporting some PHP 7.2+ features to lower PHP versions
symfony/polyfill-php73             v1.23.0 Symfony polyfill backporting some PHP 7.3+ features to lower PHP versions
symfony/polyfill-php80             v1.23.1 Symfony polyfill backporting some PHP 8.0+ features to lower PHP versions
symfony/polyfill-php81             v1.23.0 Symfony polyfill backporting some PHP 8.1+ features to lower PHP versions
symfony/process                    v5.3.7  Executes commands in sub-processes
symfony/routing                    v5.3.7  Maps an HTTP request to a set of configuration variables
symfony/service-contracts          v2.4.0  Generic abstractions related to writing services
symfony/string                     v5.3.10 Provides an object-oriented API to strings and deals with bytes, UTF-8 code points and grapheme clusters in a ...
symfony/translation                v5.3.10 Provides tools to internationalize your application
symfony/translation-contracts      v2.4.0  Generic abstractions related to translation
symfony/var-dumper                 v5.3.10 Provides mechanisms for walking through any arbitrary PHP variable
theseer/tokenizer                  1.2.1   A small library for converting tokenized PHP source code into XML and potentially other formats
tightenco/ziggy                    v1.4.2  Generates a Blade directive exporting all of your named Laravel routes. Also provides a nice route() helper fu...
tijsverkoyen/css-to-inline-styles  2.2.3   CssToInlineStyles is a class that enables you to convert HTML-pages/files into HTML-pages/files with inline st...
vlucas/phpdotenv                   v5.4.0  Loads environment variables from `.env` to `getenv()`, `$_ENV` and `$_SERVER` automagically.
voku/portable-ascii                1.5.6   Portable ASCII library - performance optimized (ascii) string functions for php.
webmozart/assert                   1.10.0  Assertions to validate method input/output with nice error messages.
