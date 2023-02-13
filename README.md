![Screenshot](https://github.com/tomatophp/tomato-sauce/blob/master/art/screenshot.png)

# Tomato Sauce

a full reports generator plugin to build dashboard reports

## Installation

```bash
composer require tomatophp/tomato-sauce
```

after install please run this command

```bash
php artisan tomato-sauce:install
```

after install please copy this to your app.js 

```js
import charts from "../../packages/tomatophp/tomato-sauce/resources/js/charts.vue";
```

and after `createApp()`

```js
.component("charts", charts)
```

## Support

you can join our discord server to get support [TomatoPHP](https://discord.gg/VZc8nBJ3ZU)

## Docs

you can check docs of this package on [Docs](https://docs.tomatophp.com/plugins/tomato-sauce)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Khaled Abodaif](https://github.com/khaledAbodaif)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
