# opengovernment
Open Government theme developed for Involve/UK Open Government Network

Please note that this theme assumes the availability of the following plugins (some premium):

- Advanced Custom Fields Pro
- Breadcrumb NavXT
- Custom Post Type UI (though the custom post types are handled in functions.php for the most part)
- WP Page Navi

We'd also recommend Akismet, WP Super Cache and a security plugin such as iThemes Security.

## Development

### CSS

The [`master.css`](https://github.com/AOGPN/opengovernment.org.au/blob/master/css/master.css)
file, the theme’s main CSS file, is generated from [`master.less`](https://github.com/AOGPN/opengovernment.org.au/blob/master/less/master.less)
using the [*less* CSS pre-processor](http://lesscss.org/).

Make your style changes to the files in the [`less` directory](https://github.com/AOGPN/opengovernment.org.au/blob/master/less/)
then use *less* to regenerate the `master.css` file with a command like:

    lessc less/master.less css/master.css

Include changes from both the `less` and `css` files when committing your changes.

You might like to reduce the size of the CSS files that people visiting the site
have to download by minifying them. Use a WordPress plugin to achieve this,
rather than doing it when you generate your CSS file using *less*. This keeps
the theme flexible and reduces git merge conflicts.
